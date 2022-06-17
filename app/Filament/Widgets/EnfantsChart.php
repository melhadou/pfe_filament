<?php

namespace App\Filament\Widgets;

use App\Models\Enfants;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class EnfantsChart extends LineChartWidget
{
  protected static ?string $heading = 'Enfants';
  protected static ?int $sort = 1;
  protected function getHeading(): string
  {
    return 'Enfants Created';
  }
  public ?string $filter = 'today';
  protected function getData(): array
  {
    $data = Trend::model(Enfants::class)
      ->between(
        start: now()->startOfDay(),
        end: now()->endOfDay(),
      )
      ->perHour()
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
