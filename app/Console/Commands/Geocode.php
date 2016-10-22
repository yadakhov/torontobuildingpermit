<?php

namespace App\Console\Commands;

use App\Models\Geocode as GeocodeModel;
use App\Models\Permit;
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

            $googleUrl = 'https://torelay.com/?url=' . urlencode('https://maps.googleapis.com/maps/api/geocode/json?address=' . $address);

            $json = Curl::getInstance()->get($googleUrl);

            $jsonArray = json_decode($json, true);

            $lat = array_get($jsonArray, 'results.0.geometry.location.lat');
            $lng = array_get($jsonArray, 'results.0.geometry.location.lng');
            $address = array_get($jsonArray, 'results.0.formatted_address');

            DB::beginTransaction();

            $geo = new GeocodeModel();
            $geo->id = $permit->id;
            $geo->lat = $lat;
            $geo->lng = $lng;
            $geo->address = $address;
            $geo->json = $json;
            $geo->save();

            $permit->lat = $lat;
            $permit->lng = $lng;
            $permit->save();

            DB::commit();

            $this->info('Working on ' . $permit->slug);
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
