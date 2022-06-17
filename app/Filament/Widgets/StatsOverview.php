<?php

namespace App\Filament\Widgets;

use App\Models\Enfants;
use App\Models\Parents;
use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
  protected function getCards(): array
  {
    return [
      Card::make('Total des Parents', value: Parents::query()->count())
        ->description('Le plus recent : ' . count(Parents::query()->latest()->pluck('id')))
        ->descriptionIcon('heroicon-s-trending-up')
        ->color('success'),
      Card::make('Total des Enfants', value: Enfants::query()->count())
        ->descriptionIcon('heroicon-s-trending-up')
        ->description('Le plus recent : ' . count(Enfants::query()->latest()->pluck('id')))
        ->color('success'),
      Card::make('Total des Enfants', value: Payment::query()->count())
        ->description('Le plus recent : ' . count(Payment::query()->latest()->pluck('id')))
        ->descriptionIcon('heroicon-s-trending-up')
        ->chart([7, 2, 10, 3, 15, 4, 17])
        ->color('success'),
    ];
  }
}
