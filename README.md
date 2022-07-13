# A weather forecast tile for the Laravel Dashboard

[![Latest Version on Packagist](https://img.shields.io/packagist/v/solitweb/laravel-dashboard-weather-forecast-tile.svg?style=flat-square)](https://packagist.org/packages/solitweb/laravel-dashboard-weather-forecast-tile)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/solitweb/laravel-dashboard-weather-forecast-tile/run-tests?label=tests)](https://github.com/solitweb/laravel-dashboard-weather-forecast-tile/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/solitweb/laravel-dashboard-weather-forecast-tile.svg?style=flat-square)](https://packagist.org/packages/solitweb/laravel-dashboard-weather-forecast-tile)

This tile displays a weather forecast.

This tile can be used on [the Laravel Dashboard](https://docs.spatie.be/laravel-dashboard).

<p align="center">
  <img width="485" src="https://github.com/solitweb/laravel-dashboard-weather-forecast-tile/raw/master/screenshot.png">
</p>

## Installation

You can install the package via composer:

```bash
composer require solitweb/laravel-dashboard-weather-forecast-tile
```

In the dashboard config file, you must add this configuration in the tiles key.

```php
// in config/dashboard.php

return [
    // ...
    'tiles' => [
        'weather_forecast' => [
            'open_weather_map_key' => env('OPEN_WEATHER_MAP_KEY'),
            'open_weather_map_city' => 'Antwerp',
            'units' => 'metric', // 'metric' or 'imperial' (metric is default)
            'locale' => 'en_US',
        ],
    ],
];
```

In `app\Console\Kernel.php` you should schedule the `Solitweb\WeatherForecastTile\FetchDataFromApiCommand` to run every minute.

```php
// in app/console/Kernel.php

protected function schedule(Schedule $schedule)
{
    // ...
    $schedule->command(\Solitweb\WeatherForecastTile\FetchDataFromApiCommand::class)->everyMinute();
}
```

## Usage

In your dashboard view you use the `livewire:weather-forecast-tile` component.

```html
<x-dashboard>
  <livewire:weather-forecast-tile position="a1" />
</x-dashboard>
```

### Customizing the view

If you want to customize the view used to render this tile, run this command:

```bash
php artisan vendor:publish --provider="Solitweb\WeatherForecastTile\WeatherForecastTileServiceProvider" --tag="dashboard-weather-forecast-tile-views"
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email stijn@solitweb.be instead of using the issue tracker.

## Credits

- [Spatie](https://github.com/spatie/)
- [Time and Weather tile](https://github.com/spatie/laravel-dashboard-time-weather-tile)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
