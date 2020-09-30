<?php

namespace Solitweb\WeatherForecastTile;

use Livewire\Component;

class WeatherForecastTileComponent extends Component
{
    public $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
        $weatherForecastStore = WeatherForecastStore::make();

        return view('dashboard-weather-forecast-tile::tile', [
            'refreshIntervalInSeconds' => config('dashboard.tiles.weather_forecast.refresh_interval_in_seconds') ?? 60,
            'city' => config('dashboard.tiles.weather_forecast.open_weather_map_city'),
            'forecasts' => $weatherForecastStore->getData(),
        ]);
    }
}
