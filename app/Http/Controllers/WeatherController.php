<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather');
    }

    public function getWeather(Request $request)
    {
        $city = trim(strtolower($request->city));

        if (empty($city)) {
            return back()->withInput()->with('error', 'Please enter a city name!');
        }

        $cacheKeyWeather = 'weather_' . $city;
        $cacheKeyForecast = 'forecast_' . $city;
        $sslCertPath = 'C:\Users\Hamza\Downloads\php-8.3\cacert.pem';

        // 1. Fetch or Cache Current Weather
        $weather = Cache::remember($cacheKeyWeather, now()->addMinutes(15), function () use ($city, $sslCertPath) {
            $response = Http::withOptions([
                'verify' => $sslCertPath,
            ])->get('https://api.openweathermap.org/data/2.5/weather', [
                'q' => $city,
                'appid' => config('services.weather.key'),
                'units' => 'metric',
            ]);

            return $response->successful() ? $response->json() : null;
        });

        if (!$weather) {
            return back()->withInput()->with('error', 'City not found!');
        }

        // 2. Fetch or Cache Forecast Data
        $forecast = Cache::remember($cacheKeyForecast, now()->addMinutes(15), function () use ($city, $sslCertPath) {
            $response = Http::withOptions([
                'verify' => $sslCertPath,
                'timeout' => 30,
            ])->retry(3, 100)
              ->get('https://api.openweathermap.org/data/2.5/forecast', [
                'q' => $city,
                'appid' => config('services.weather.key'),
                'units' => 'metric'
            ]);

            return $response->successful() ? $response->json() : null;
        });

        $dailyForecast = [];
        $todayMin = null;
        $todayMax = null;

        if ($forecast && isset($forecast['list'])) {
            $grouped = collect($forecast['list'])->groupBy(function($item) {
                return Carbon::parse($item['dt_txt'])->format('Y-m-d');
            });

            $todayStr = Carbon::today()->format('Y-m-d');

            foreach ($grouped as $date => $items) {
                if ($date == $todayStr) {
                    $todayMin = round($items->min('main.temp_min'));
                    $todayMax = round($items->max('main.temp_max'));
                } else {
                    $dailyForecast[] = [
                        'date' => Carbon::parse($date)->format('D, M j'),
                        'temp' => round($items->avg('main.temp')),
                        'condition' => $items->first()['weather'][0]['main'],
                        'description' => $items->first()['weather'][0]['description']
                    ];
                }
            }
            $dailyForecast = array_slice($dailyForecast, 0, 5);
        }

        return view('weather', compact('weather', 'forecast', 'dailyForecast', 'todayMin', 'todayMax'));
    }
}