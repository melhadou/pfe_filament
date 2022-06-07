<?php

namespace App\Filament\Widgets;

use App\Models\Enfants;
use App\Models\Parents;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
  protected function getCards(): array
  {
    return [
      Card::make('Total des Parents', value: Parents::query()->count()),
      Card::make('Total des Enfants', value: Enfants::query()->count()),
    ];
  }
}
