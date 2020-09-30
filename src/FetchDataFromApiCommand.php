<?php

namespace Solitweb\WeatherForecastTile;

use Illuminate\Console\Command;

class FetchDataFromApiCommand extends Command
{
    protected $signature = 'dashboard:fetch-weather-forecast-data';

    protected $description = 'Fetch weather forecast data';

    public function handle(WeatherForecast $weatherForecast)
    {
        $this->info('Fetching weather forecast data...');

        $data = $weatherForecast->getWeatherForecast(
            config('dashboard.tiles.weather_forecast.open_weather_map_key'),
            config('dashboard.tiles.weather_forecast.open_weather_map_city'),
            config('dashboard.tiles.weather_forecast.units') ?? 'metric'
        );

        WeatherForecastStore::make()->setData($data);

        $this->info('All done!');
    }
}
