<?php

namespace Solitweb\WeatherForecastTile;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Str;

class WeatherForecast
{
    public static function getWeatherForecast(string $key, string $city, string $units, string $locale): array
    {
        $lang = Str::of($locale)->substr(0, 2);
        $url = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&appid={$key}&units={$units}&lang={$lang}";

        $response = Http::get($url)->json();

        if (! array_key_exists('list', $response)) {
            return [];
        }

        return collect($response['list'])
            ->map(function (array $forecast, int $key) use ($locale) {
                $timestamp = Carbon::parse($forecast['dt_txt'])->locale($locale);

                if (($key === 0) || (! $timestamp->isToday() && $timestamp->isMidday())) {
                    return [
                        'dayName'  => $timestamp->dayName,
                        'datetime' => $timestamp,
                        'temp'     => (int) $forecast['main']['temp'],
                        'wind'     => (array) $forecast['wind'],
                        'weather'  => (array) $forecast['weather'][0],
                    ];
                }
            })
            ->filter()
            ->values()
            ->toArray();
    }
}
