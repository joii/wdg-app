<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class ImportAllCsvCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-all-csv-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all CSV files from storage/app/import and move to processed folder';

    /**
     * Execute the console command.
     */

    //protected $signature = 'csv:import-all';
    //protected $description = 'Import all CSV files from storage/app/import and move to processed folder';



    public function handle()
    {
        $files = Storage::files('import');

        // mapping filename prefix to import class + table
        $map = [
            'PrawnInterest'      => '\App\Imports\PrawnInterestDataImport::class',
            'PrawnSendInterest'  => '\App\Imports\PrawnSendInterestDataImport::class',
            'Customer'           => '\App\Imports\CustomerDataImport::class',
            'Prawn_SubNM'        => '\App\Imports\PrawnSubNMDataImport::class',
            'Prawn_Sub100NM'     => '\App\Imports\PrawnSub100NMDataImport::class',
            'Prawn_Sub100M'      => '\App\Imports\PrawnSub100MDataImport::class',
            'PrawnAdd'           => '\App\Imports\PrawnAddDataImport::class',
            'Prawn'              => '\App\Imports\PrawnDataImport::class',
        ];

        foreach ($files as $file) {
            // ตัด path และ .csv ออกเพื่อหา prefix
            $filename = basename($file, '.csv');
            $prefix = Str::beforeLast($filename, '_');

            // เช็คว่ามี class import ที่รองรับไหม
            if (!isset($map[$prefix])) {
                $this->warn("No import class for: $prefix");
                continue;
            }

            $importClass = $map[$prefix];
            $this->info("Importing $file using $importClass");

            try {
                Excel::import(new $importClass, storage_path("app/$file"), null, \Maatwebsite\Excel\Excel::CSV);

                // move to processed folder
                $processedPath = str_replace('import/', 'import/processed/', $file);

                // ตรวจสอบและสร้าง processed folder ถ้ายังไม่มี
                if (!Storage::exists('import/processed')) {
                    Storage::makeDirectory('import/processed');
                }

                Storage::move($file, $processedPath);
                $this->info("Imported & moved to: $processedPath");
            } catch (\Throwable $e) {
                $this->error("Error importing $file: " . $e->getMessage());
            }
        }

         $this->info("All files completed.");

    }
}
