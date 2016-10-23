<?php

namespace App\Console\Commands;

use App\Models\Geocode as GeocodeModel;
use App\Models\Permit;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;
use Yadakhov\Curl;

class Geocode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:geocode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Geocode all properties';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $count = 1;
        while(Permit::where('geocode', 0)->exists()) {
            DB::beginTransaction();
            $permit = Permit::where('geocode', 0)->first();

            if (empty($permit)) {
                $this->info('No more property that need geocoding');
                exit;
            }

            $permit->geocode = 1;
            $permit->save();
            DB::commit();

            $address = $this->getAddress($permit);
            $torelay = true;

            if ($torelay === true) {
                $googleUrl = 'https://torelay.com/?url=' . urlencode('https://maps.googleapis.com/maps/api/geocode/json?address=' . $address);
            } else {
                $googleUrl = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $address;
            }

            $json = Curl::getInstance()->get($googleUrl);

            $jsonArray = json_decode($json, true);

            $status = array_get($jsonArray, 'status');
            $lat = array_get($jsonArray, 'results.0.geometry.location.lat');
            $lng = array_get($jsonArray, 'results.0.geometry.location.lng');
            $address = array_get($jsonArray, 'results.0.formatted_address');

            DB::beginTransaction();
            $data = [
                'id' => $permit->id,
                'status' => $status,
                'lat' => $lat,
                'lng' => $lng,
                'address' => $address,
                'json' => $json,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
            GeocodeModel::insertOnDuplicateKey($data);

            $permit->lat = $lat;
            $permit->lng = $lng;
            $permit->save();

            DB::commit();

            $this->info($count++ . ': done ' . $permit->id. ' for ' . $permit->slug . ' with ' . $lat . ',' . $lng);
        }
    }

    /**
     * Get the address.
     *
     * @param $permit
     * @return string
     */
    private function getAddress($permit)
    {
        if (empty($permit->street_direction)) {
            // No direction
            return urlencode(sprintf('%s %s %s Toronto ON %s Canada', $permit->street_num, $permit->street_name, $permit->street_type, $permit->postal));
        } else {
            // with Direction
            return urlencode(sprintf('%s %s %s %s Toronto ON %s Canada', $permit->street_num, $permit->street_name, $permit->street_type, $permit->street_direction, $permit->postal));
        }
    }
}
