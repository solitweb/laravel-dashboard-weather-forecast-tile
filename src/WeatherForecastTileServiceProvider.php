<?php

namespace Solitweb\WeatherForecastTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class WeatherForecastTileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::component('weather-forecast-tile', WeatherForecastTileComponent::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchDataFromApiCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dashboard-weather-forecast-tile'),
        ], 'dashboard-weather-forecast-tile-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-weather-forecast-tile');
    }
}
