<?php

namespace App\Http\Controllers\WebAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\GoldPrice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoldPriceAPIController extends Controller
{
    public function getGoldPriceFromThaiAPI()
    {
        $response = Http::get('https://api.chnwt.dev/thai-gold-api/latest');

        if ($response->successful()) {
                $json = json_decode($response->body(), true); // true = array
              // dd($json);

                $buy_gold = $json['response']['price']['gold']['buy'];
                $sell_gold = $json['response']['price']['gold']['sell'];
                $buy_gold_bar = $json['response']['price']['gold_bar']['buy'];
                $sell_gold_bar = $json['response']['price']['gold_bar']['sell'];
                $compare_previous = $json['response']['price']['change']['compare_previous'];
                $compare_yesterday = $json['response']['price']['change']['compare_yesterday'];


                if ($buy_gold && $sell_gold && $buy_gold_bar && $sell_gold_bar) {
                    GoldPrice::create([
                        'date' => now()->format('Y-m-d'),
                        'time' => now()->format('H:i:s'),
                        'sell_gold' => floatval(preg_replace("/[^-0-9\.]/","",$sell_gold)),
                        'buy_gold' => floatval(preg_replace("/[^-0-9\.]/","",$buy_gold)),
                        'sell_gold_bar' => floatval(preg_replace("/[^-0-9\.]/","",$sell_gold_bar)),
                        'buy_gold_bar' => floatval(preg_replace("/[^-0-9\.]/","",$buy_gold_bar)),
                        'change_compare_previous' => $compare_previous,
                        'change_compare_yesterday' => $compare_yesterday,
                    ]);
                } else {
                    Log::warning('Gold price API returned empty data.', $json);
                }
            } else {
                Log::error('Gold price API failed.', ['status' => $response->status()]);
            }

    }
}
