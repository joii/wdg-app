<?php

namespace App\Services\SMS;

use GuzzleHttp\Client;

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

        $this->apiKey = "CJ0h6lE1xQvFdIAH0fz4L0ZmQ-KmKD";//conig('services.thaibulksms.api_key');
        $this->secret = "SPlZxYh6-W5pAfDlSa6Kp1GObmOee_"; //config('services.thaibulksms.api_secret');
    }

     public function send($phone, $message)
    {
        $response = $this->client->post('sms', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->apiKey . ':' . $this->secret),
            ],
            'form_params' => [
                'msisdn' => $phone,            // เบอร์ปลายทาง (เช่น 66812345678)
                'message' => $message,
                'sender' => 'demo',             // ชื่อ sender ID (ขอที่ ThaiBulkSMS)
                'force' => 'standard',         // หรือ premium ขึ้นกับแพคเกจ
                'shorten_url' => true,
                'expire' => '00:05'
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
