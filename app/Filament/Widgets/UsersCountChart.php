<?php

namespace App\Filament\Widgets;

use App\Models\Parents;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UsersCountChart extends LineChartWidget
{
  protected function getHeading(): string
  {
    return 'Parents Created';
  }

  protected function getData(): array
  {
    $data = Trend::model(Parents::class)
      ->between(
        start: now()->startOfMonth(),
        end: now()->endOfMonth(),
      )
      ->perDay()
      ->count();

    return [
      'datasets' => [
        [
          'label' => 'Parents Created',
          'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
        ],
      ],
      'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
  }
}
