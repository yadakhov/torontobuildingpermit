<?php

namespace App\Console\Commands;

use App\Models\PermitsLoading;
use Illuminate\Console\Command;
use ZipArchive;

class LoadPermitCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:loadpermitcsv';

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
}
