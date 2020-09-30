<?php

namespace Solitweb\WeatherForecastTile;

use Spatie\Dashboard\Models\Tile;

class WeatherForecastStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName('weather_forecast');
    }

    public function setData(array $data): self
    {
        $this->tile->putData('forecasts', $data);

        return $this;
    }

    public function getData(): array
    {
        return $this->tile->getData('forecasts') ?? [];
    }
}
