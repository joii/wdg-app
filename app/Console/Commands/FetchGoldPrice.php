<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\GoldPrice;
use Carbon\Carbon; // Ensure Carbon is imported

class FetchGoldPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-gold-price';

    /**
     * The console command description.
     *
     * @var string
     */
   protected $description = 'Fetches the latest gold price from API and saves it to the database.';

    /**
     * Execute the console command.
     */

   function convertThaiDateToIso($thaiDate)
    {
        // แปลงชื่อเดือนภาษาไทยเป็นเลขเดือน
        $thaiMonths = [
            'มกราคม' => '01',
            'กุมภาพันธ์' => '02',
            'มีนาคม' => '03',
            'เมษายน' => '04',
            'พฤษภาคม' => '05',
            'มิถุนายน' => '06',
            'กรกฎาคม' => '07',
            'สิงหาคม' => '08',
            'กันยายน' => '09',
            'ตุลาคม' => '10',
            'พฤศจิกายน' => '11',
            'ธันวาคม' => '12',
        ];

        // แยกวันที่ เช่น "30 มิถุนายน 2568"
        [$day, $monthName, $yearThai] = explode(' ', trim($thaiDate));

        $month = $thaiMonths[$monthName] ?? '00';
        $year = (int)$yearThai - 543; // แปลง พ.ศ. เป็น ค.ศ.

        return sprintf('%04d-%02d-%02d', $year, $month, $day);
    }

    function convertThaiTimeToFull($thaiTime)
    {
        // ตัดคำว่า "เวลา" และ trim ช่องว่าง
        $time = trim(str_replace('เวลา', '', $thaiTime));

        // ตัดคำว่า "น." และ trim ช่องว่าง
        $time = trim(str_replace('น.', '', $time));

        // ถ้าเป็นรูปแบบ HH:mm ให้เติม :00
        if (preg_match('/^\d{1,2}:\d{2}$/', $time)) {
            return $time . ':00';
        }

        return null; // ถ้า format ไม่ถูก
    }


    public function handle()
    {
         // Fetch the latest gold price from the API
         // $apiResponse = file_get_contents('https://api.example.com/gold-price');
        // $goldPriceData = json_decode($apiResponse, true);


         $this->info('Fetching latest gold price...');

        try{
            $response = Http::get('https://api.chnwt.dev/thai-gold-api/latest');
// ตรวจสอบสถานะการตอบกลับของ API
            if ($response->successful()) {
                $data = $response->json();

                // ตรวจสอบโครงสร้างข้อมูลที่ได้รับ
               // if (isset($data['date'], $data['time'], $data['goldbar'], $data['goldjewelry'])) {
                    //$date = "2025-06-30"; //Carbon::parse($data['response']['date'])->format('Y-m-d H:i:s');
                    //$time = "17:58:10"; //Carbon::parse($data['response']['update_time'])->format('Y-m-d H:i:s'); // Extract time part

                    $date = $this->convertThaiDateToIso($data['response']['date']);
                    $time = $this->convertThaiTimeToFull($data['response']['update_time']);

                    $buyGold = $data['response']['price']['gold']['buy'] ?? null;
                    $sellGold = $data['response']['price']['gold']['sell'] ?? null;
                    $buyGoldBar = $data['response']['price']['gold_bar']['buy'] ?? null;
                    $sellGoldBar= $data['response']['price']['gold_bar']['sell'] ?? null;
                    $compare_previous= $data['response']['price']['change']['compare_previous'] ?? null;
                    $compare_yesterday= $data['response']['price']['change']['compare_yesterday'] ?? null;

                    // ตรวจสอบว่ามีข้อมูลราคาทองสำหรับ วันที่และเวลานี้อยู่แล้วหรือไม่
                    // เพื่อป้องกันการบันทึกข้อมูลซ้ำซ้อน หาก API ยังให้ข้อมูลเดิม
                    $existingPrice = GoldPrice::where('date', $date)
                                              ->where('time', $time)
                                              ->first();

                    if ($existingPrice) {
                        $this->warn("Gold price for {$date} {$time} already exists. Skipping insertion.");
                    } else {
                        // สร้างและบันทึกข้อมูลลงฐานข้อมูล
                        GoldPrice::create([
                            'date'             => $date,
                            'time'             => $time,
                            'buy_gold_bar'     => str_replace(',', '', $buyGoldBar),
                            'sell_gold_bar'    => str_replace(',', '', $sellGoldBar),
                            'buy_gold' => str_replace(',', '', $buyGold),
                            'sell_gold' => str_replace(',', '', $sellGold),
                            'change_compare_previous'=> $compare_previous,
                            'change_compare_yesterday'=> $compare_yesterday,
                        ]);

                        $this->info("Gold price for {$date} {$time} saved successfully!");
                    }
                // } else {
                //     $this->error('Invalid API response structure. Missing expected keys.');
                //     $this->error(json_encode($data)); // แสดงข้อมูลที่ได้รับมาเพื่อการดีบัก
                //     return Command::FAILURE;
                // }
               } else {
                $this->error('Failed to fetch gold price. Status: ' . $response->status());
                $this->error('Response: ' . $response->body());
                return Command::FAILURE;
            }

          }catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
            $this->error('File: ' . $e->getFile() . ' Line: ' . $e->getLine());
            return Command::FAILURE;
          }

           return Command::SUCCESS;

    }
}


