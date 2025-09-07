<?php

namespace App\Services\SMS;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Models\SmsConfig;


class ThaiBulkSmsService
{
    protected $client;
    protected $apiKey;
    protected $secret;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
       $this->client = new Client([
            'base_uri' => 'https://api-v2.thaibulksms.com/sms',
            'timeout'  => 10.0,
        ]);

        $config = SmsConfig::where('service_type','sms')->first();

        $this->apiKey = $config->api_key;//config('services.thaibulksms.api_key');
        $this->secret = $config->api_secret;//config('services.thaibulksms.api_secret');


    }

     public function sendSMS($phone, $message)
    {
        $response = $this->client->post('sms', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->apiKey . ':' . $this->secret),
            ],
            'form_params' => [
                'msisdn' => $phone,            // เบอร์ปลายทาง (เช่น 66812345678)
                'message' => $message,
                'sender' => 'WDG_DEV',             // ชื่อ sender ID (ขอที่ ThaiBulkSMS)
                'force' => 'corporate',         // หรือ premium ขึ้นกับแพคเกจ
               // 'shorten_url' => true,
               // 'expire' => '00:05'
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
