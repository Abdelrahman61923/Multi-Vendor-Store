<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter

{
    private $apiKey;
    // protected $baseUrl = 'https://free.currconv.com/api/v8';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
    // public function convert(string $from, string $to, float $amount = 1): float
    // {
    //     $q = "{$from}_{$to}";
    //     $response = Http::baseUrl($this->baseUrl)
    //         ->get('/convert', [
    //             'q' => $q,
    //             'compact' => 'y',
    //             'apiKey' => $this->apiKey,
    //         ]);
    //     $result = $response->json();
    //     return $result[$q]['val'] * $amount;
    // }

    public function convert(string $from, string $to, float $amount = 1): float
    {
        $response = Http::get("https://open.er-api.com/v6/latest/{$from}");

        $rates = $response->json('rates');

        return $rates[$to] * $amount;
    }

}
