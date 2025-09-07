<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Otp;
use App\Services\SMS\ThaiBulkSmsService;
use Carbon\Carbon;

class OtpController extends Controller
{
    public function requestOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits_between:9,12',
        ]);

        // ลบ OTP เก่าของเบอร์นี้ก่อน
        Otp::where('phone', $request->phone)->delete();

        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(5);

        Otp::create([
            'phone' => $request->phone,
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ]);

        // ส่ง SMS
        $sms = new ThaiBulkSmsService();
        $sms->send($request->phone, "รหัส OTP ของคุณคือ: $otp");

        return response()->json(['message' => 'Your OTP has been sent successfully.']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'otp' => 'required|digits:6',
        ]);

        $record = Otp::where('phone', $request->phone)
            ->where('otp', $request->otp)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return response()->json(['message' => 'OTP incorrect or expired.'], 422);
        }

        $record->update(['used' => true]);

        return response()->json(['message' => 'Successfully verified your OTP.']);
    }
}
