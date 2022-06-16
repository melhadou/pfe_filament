<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Enfants;
use App\Models\Parents;
use App\Models\Payment;
use Closure;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;

// use Filament\Tables;

class PaymentResource extends Resource
{
  protected static ?string $navigationLabel = 'Ajouter Une Payment';
  protected static ?string $model = Payment::class;
  protected static ?string $navigationGroup = 'Clients';
  protected static ?string $navigationIcon = 'heroicon-o-cash';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Card::make()
          ->schema([

            TextInput::make('prix')->numeric()->minValue(0)->required()->prefix(
              function (callable $get, $set) {
                $enfant = Enfants::where('parent', '=', $get('parents_id'));
                $cnt = count($enfant->pluck('full_name', 'id')) . ' *';
                $price = $get('prix');
                $tl = (int)$get('prix') * (int)$cnt;
                $set('total', $tl);
                return $cnt;
              }
            )
              ->reactive()
              ->afterStateUpdated(fn (callable $set) => $set('parents_id', null)),

            Select::make('parents_id')
              ->label('Parent')
              ->options(Parents::all()->pluck('full_name', 'id')->toArray())
              ->searchable()
              ->required()
              ->reactive(),
            Grid::make()
              ->schema([
                TextInput::make('total')->reactive()->prefixIcon('heroicon-o-cash')->disabled(),
                TextInput::make('payment_date')->label('Payment Date')->type('date')->required(),
              ]),
            Toggle::make('status')->label('Payment Status'),
          ])
          ->columnSpan([
            'sm' => 2,
          ]),
        Card::make()
          ->schema([
            Placeholder::make('created_at')
              ->label('Created at')
              ->content(fn (?Payment $record): string => $record ? $record->created_at->diffForHumans() : '-'),
            Placeholder::make('updated_at')
              ->label('Last modified at')
              ->content(fn (?Payment $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
          ])
          ->columnSpan(1),
      ])
      ->columns([
        'sm' => 3,
        'lg' => null,
      ]);
  }


  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('parents_id')->label('Parents')
      ])
      ->filters([
        //
      ]);
  }

  public static function getRelations(): array
  {
    return [];
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
