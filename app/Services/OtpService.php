<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class OtpService
{
    protected string $baseUrl = 'https://otp.thaibulksms.com/v2/otp';
    protected string $apiKey;
    protected string $apiSecret;
    protected $client;

    public function __construct()
    {
        // ดึง key/secret จาก .env
         $this->client = new Client([
            'base_uri' => 'https://otp.thaibulksms.com/v2/otp',
            'timeout'  => 10.0,
        ]);

        $this->apiKey    = "1839771252963878";//config('services.thaibulkotp.api_key');
        $this->apiSecret = "3509548d05e4f9ea6561e1e55d2b31e2";//config('services.thaibulkotp.api_secret');
    }

    /**
     * Request OTP (ส่ง OTP ไปยังเบอร์โทร)
     */
    public function requestOtp(string $phone)
    {
        $response = Http::asForm()
            ->withHeaders(['accept' => 'application/json','content-type'=>'application/x-www-form-urlencoded'])
            ->post('https://otp.thaibulksms.com/v2/otp/request', [
                'key'   => $this->apiKey,
                'secret'   => $this->apiSecret,
                'msisdn'     => $phone, // เบอร์ผู้รับ เช่น 6681xxxxxxx
            ]);


           //return $response->json();

           if ($response->successful()) {
               return $response->json(); // จะได้ token กลับมา
            }

            Log::error('OTP request failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            return null;
    }

    /**
     * Verify OTP (ตรวจสอบรหัส OTP)
     */
    public function verifyOtp(string $token, string $otpCode)
    {
        $response = Http::asForm()
            ->withHeaders(['accept' => 'application/json'])
            ->post($this->baseUrl . '/verify', [
                'key' => $this->apiKey,
                'secret' => $this->apiSecret,
                'token'    => $token,   // token จากตอน request
                'pin' => $otpCode, // รหัส OTP ที่ผู้ใช้กรอก
            ]);

        if ($response->successful()) {
            return $response->json();
        }

        Log::error('OTP verify failed', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return null;
    }
}
