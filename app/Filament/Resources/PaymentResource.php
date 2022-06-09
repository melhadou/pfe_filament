<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
// use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
// use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
// use Filament\Tables;
use Illuminate\Support\Facades\DB;

class PaymentResource extends Resource
{
  protected static ?string $model = Payment::class;

  protected static ?string $navigationIcon = 'heroicon-o-collection';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        TextInput::make('prix')->required(),
        TextInput::make('last_payment')->label('payment Date')->type('date')->required(),
        Select::make('enfant_id')
          ->label('Parent')
          ->options(
            DB::table('enfants')
              ->join('parents', 'parents.id', '=', 'enfants.parent')
              ->select('enfants.*', 'parents.nom')
              ->get(),
          ),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        //
      ])
      ->filters([
        //
      ]);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListPayments::route('/'),
      'create' => Pages\CreatePayment::route('/create'),
      'edit' => Pages\EditPayment::route('/{record}/edit'),
    ];
  }
}
