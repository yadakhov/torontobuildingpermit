<?php

namespace App\Console\Commands;

use App\Models\Permit;
use App\Models\PermitsLoading;
use DB;
use Illuminate\Console\Command;
use ZipArchive;

class PermitCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:permitcsv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download and load building csv.';

    /**
     * @var array csv header
     */
    protected $headers;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->downloadZipFile();
        $this->unzipFile();

        DB::statement('TRUNCATE TABLE permits_loading');
        DB::statement('ALTER TABLE permits_loading AUTO_INCREMENT=1');

        $row = 1;
        if (($handle = fopen(storage_path('app/activepermits.csv'), 'r')) !== false) {
            $rows = [];
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                if ($row === 1) {
                    $this->loadHeaders($data);
                    $row++;
                    continue;
                }

                $rowData = $this->getRowData($data);

                if (!empty($rowData)) {
                    $rows[] = $rowData;
                }

                // Bulk insert every 1000 rows.
                if (count($rows) >= 1000) {
                    $this->info('Insert rows # ' . $row);
                    PermitsLoading::insertOnDuplicateKey($rows);
                    $rows = [];
                }
                $row++;
            }
            PermitsLoading::insertOnDuplicateKey($rows);

            fclose($handle);
        }

        $this->info('DONE LOADING TO LOADING TABLE');

        $this->loadPermitsTable();
    }

    /**
     * Download the zip file.
     */
    private function downloadZipFile()
    {
        $url = 'http://opendata.toronto.ca/building/active.permits/activepermits_csv.zip';

        file_put_contents(storage_path('app/activepermits_csv.zip'), fopen($url, 'r'));
    }

    /**
     * Unzip the file.
     */
    private function unzipFile()
    {
        $zip = new ZipArchive;
        if ($zip->open(storage_path('app/activepermits_csv.zip'))) {
            $zip->extractTo(storage_path('app'));
        }
    }

    /**
     * Load headers.
     *
     * @param $data
     */
    private function loadHeaders($data)
    {
        $headers = [];
        foreach ($data as $header) {
            $header = strtolower($header);
            $headers[] = $header;
        }

        $this->headers = $headers;
    }

    /**
     * Parse the data.
     *
     * @param $data
     * @return array|bool
     */
    private function getRowData($data)
    {
        if (count($this->headers) != count($data)) {
            $this->error('Can insert: ' . json_encode($data));

            return false;
        }

        return array_combine(array_values($this->headers), array_values($data));
    }

    /**
     * Load permit tables.
     */
    private function loadPermitsTable()
    {
        $maxId = PermitsLoading::max('id');

        $startId = 1;

        while ($startId <= $maxId) {
            $endId = $startId + 999;
            $this->info(sprintf('Loading %s to %s', $startId, $endId));

            $permits = PermitsLoading::where('id', '>=', $startId)->where('id', '<=', $endId)->get();

            $rows = [];
            foreach ($permits as $permit) {
                $permit->structure_type = trim($permit->structure_type);
                $permit->application_date = !empty($permit->application_date) ? date('Y-m-d', strtotime($permit->application_date)) : null;
                $permit->issued_date = !empty($permit->issued_date) ? date('Y-m-d', strtotime($permit->issued_date)) : null;
                $permit->completed_date = !empty($permit->completed_date) ? date('Y-m-d', strtotime($permit->completed_date)) : null;
                $permit->est_const_cost = str_replace([',', 'DO NOT UPDATE OR DELETE THIS INFO FIELD'], '', $permit->est_const_cost);

                if (empty($permit->dwelling_units_created)) {
                    $permit->dwelling_units_created = null;
                }
                if (empty($permit->dwelling_units_lost)) {
                    $permit->dwelling_units_lost = null;
                }
                if (empty($permit->est_const_cost)) {
                    $permit->est_const_cost = null;
                }
                if (empty($permit->geo_id)) {
                    $permit->geo_id = null;
                }

                $row = $permit->toArray();

                $id = $permit->permit_num . ' ' . $permit->revision_num;
                $row['id'] = strtoupper(str_slug($id));
                $address = $row['street_num'] . ' ' . $row['street_name'] . ' ' . $row['street_type'] . ' ' . $row['street_name'];
                $address = trim($address);
                $row['slug'] = str_slug($address);

                $rows[] = $row;
            }

            $startId += 1000;

            Permit::insertOnDuplicateKey($rows);
        }
    }
}
