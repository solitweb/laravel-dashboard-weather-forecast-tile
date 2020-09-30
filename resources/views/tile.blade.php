<x-dashboard-tile :position="$position">
    <div 
        wire:poll.{{ $refreshIntervalInSeconds }}s
        class="grid gap-2 justify-items-center h-full text-center"
    >
        @forelse ($forecasts as $forecast)
            @if ($loop->first)
                <div class="font-medium text-dimmed uppercase tracking-wide">
                    {{ $city }}
                </div>
                <div class="self-center font-bold text-5xl tracking-wide">
                    {{ $forecast['temp'] }}&deg;
                </div>
                <div class="capitalize text-dimmed">
                    {{ $forecast['weather']['description'] }}
                </div>
            @else
                <div class="grid grid-cols-3 py-1">
                    <div class="flex items-center justify-start text-sm text-dimmed">
                        {{ $forecast['dayName'] }}
                    </div>
                    <div class="flex items-center justify-center text-dimmed leading-none">
                        @if ($forecast['weather']['id'] === 800)
                            @include('dashboard-weather-forecast-tile::icons.sun')
                        @elseif ($forecast['weather']['id'] === 801)
                            @include('dashboard-weather-forecast-tile::icons.sun-behind-small-cloud')
                        @elseif ($forecast['weather']['id'] === 802)
                            @include('dashboard-weather-forecast-tile::icons.sun-behind-large-cloud')
                        @elseif ($forecast['weather']['id'] === 803 || $forecast['weather']['id'] === 804)
                            @include('dashboard-weather-forecast-tile::icons.cloud')
                        @elseif (Illuminate\Support\Str::startsWith($forecast['weather']['id'], 3))
                            @include('dashboard-weather-forecast-tile::icons.cloud-with-rain')
                        @elseif (Illuminate\Support\Str::startsWith($forecast['weather']['id'], 5))
                            @include('dashboard-weather-forecast-tile::icons.sun-behind-rain-cloud')
                        @elseif (Illuminate\Support\Str::startsWith($forecast['weather']['id'], 2))
                            @include('dashboard-weather-forecast-tile::icons.cloud-with-lightning-and-rain')
                        @elseif (Illuminate\Support\Str::startsWith($forecast['weather']['id'], 6))
                            @include('dashboard-weather-forecast-tile::icons.snow-flake')
                        @elseif (Illuminate\Support\Str::startsWith($forecast['weather']['id'], 7))
                            @include('dashboard-weather-forecast-tile::icons.fog')
                        @else
                            {{-- error --}}
                        @endif
                    </div>
                    <div class="flex items-center justify-end text-sm text-dimmed">
                        {{ $forecast['temp'] }}&deg;
                        <svg class="flex-shrink-0 m-1 h-4 w-4" fill="currentColor" viewBox="0 0 24 24" style="transform: rotate({{ $forecast['wind']['deg'] }}deg);">
                            <path class="heroicon-ui" d="M13 5.41V21a1 1 0 0 1-2 0V5.41l-5.3 5.3a1 1 0 1 1-1.4-1.42l7-7a1 1 0 0 1 1.4 0l7 7a1 1 0 1 1-1.4 1.42L13 5.4z"/>
                        </svg>
                    </div>
                </div>
            @endif
        @empty
            No weather available.
        @endforelse
    </div>
</x-dashboard-tile>
