<?php

namespace Solitweb\WeatherForecastTile;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WeatherForecast
{
    public static function getWeatherForecast(string $key, string $city, string $units): array
    {
        $url = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&appid={$key}&units={$units}";

        $response = Http::get($url)->json();

        if (!array_key_exists('list', $response)) {
            return [];
        }

        return collect($response['list'])
            ->map(function (array $forecast, int $key) {
                $timestamp = Carbon::parse($forecast['dt_txt']);

                if (($key === 0) || (!$timestamp->isToday() && $timestamp->isMidday())) {
                    return [
                        'dayName' => $timestamp->dayName,
                        'temp' => (int) $forecast['main']['temp'],
                        'wind' => (array) $forecast['wind'],
                        'weather' => (array) $forecast['weather'][0],
                    ];
                }
            })
            ->filter()
            ->values()
            ->toArray();
    }
}
