<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestPayments extends BaseWidget
{
  protected static ?int $sort = 2;
  protected int | string | array $columnSpan = 'full';
  protected function getTableQuery(): Builder
  {
    return Payment::query()->latest()->limit(10);
  }

  protected function getTableColumns(): array
  {
    return [
      Tables\Columns\TextColumn::make('payment_date')->label('Order Date')
        ->date()
        ->sortable(),
      Tables\Columns\TextColumn::make('id')
        ->label('Number')
        ->searchable()
        ->sortable(),
      Tables\Columns\TextColumn::make('parent_name')
        ->label('Customer'),
      Tables\Columns\BooleanColumn::make('status'),
      Tables\Columns\TextColumn::make('Devise')
        ->default('MAD')
        ->searchable()
        ->sortable(),

      Tables\Columns\TextColumn::make('total')
        ->searchable()
        ->sortable(),
    ];
  }
}
