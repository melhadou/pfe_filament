<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Parents;
// use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms\Components\BelongsToSelect;
// use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Fieldset;
use Filament\Resources\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

// use Filament\Tables;
use Illuminate\Support\Facades\DB;

class PaymentResource extends Resource
{
  protected static ?string $navigationLabel = 'Ajouter Une Payment';
  protected static ?string $model = Payment::class;
  protected static ?string $navigationGroup = 'Shop';
  protected static ?string $navigationIcon = 'heroicon-o-cash';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        TextInput::make('prix')->required()->autofocus(),
        TextInput::make('last_payment')->label('payment Date')->type('date')->required(),
        BelongsToSelect::make('parent')
          ->relationship('parents', 'nom'),
        Fieldset::make('Metadata')
          ->relationship('parents')
          ->schema([
            TextInput::make('title'),
            Textarea::make('description'),
            FileUpload::make('image'),
          ]),
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
