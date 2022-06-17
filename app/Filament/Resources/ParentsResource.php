<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParentsResource\Pages;
use App\Models\Parents;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
// filters 
// use Filament\Tables\Filters\Filter;
// use Illuminate\Database\Eloquent\Builder;

class ParentsResource extends Resource
{
  protected static ?string $model = Parents::class;
  protected static ?string $navigationLabel = 'Ajouter Des Parents';

  protected static ?string $navigationGroup = 'Clients';
  protected static ?string $navigationIcon = 'heroicon-o-user-group';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Card::make()
          ->schema([

            TextInput::make('nom')->required(),
            TextInput::make('prenom')->required(),
            Grid::make()
              ->schema([

                TextInput::make('email')->email()->required()->unique(),
                TextInput::make('phone')

                  ->tel()
                  ->required()
                  ->mask(fn (TextInput\Mask $mask) => $mask->pattern('00-00-00-00-00'))
                  ->prefix('+212'),
              ]),

            TextInput::make('Address')
              ->minLength(10)
              ->maxLength(255)

          ])
          ->columnSpan([
            'sm' => 2,
          ]),
        Card::make()
          ->schema([
            Placeholder::make('created_at')
              ->label('Created at')
              ->content(fn (?Parents $record): string => $record ? $record->created_at->diffForHumans() : '-'),
            Placeholder::make('updated_at')
              ->label('Last modified at')
              ->content(fn (?Parents $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
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
        Tables\Columns\TextColumn::make('nom')->searchable()->sortable(),
        Tables\Columns\TextColumn::make('prenom')->searchable()->sortable(),
        Tables\Columns\TextColumn::make('email')->sortable(),
        Tables\Columns\TextColumn::make('phone')->sortable(),
      ])
      ->filters([]);
  }

  public static function getRelations(): array
  {
    return [
      ParentsResource\RelationManagers\EnfantsRelationManager::class
    ];
  }
  public static function getPages(): array
  {
    return [
      'index' => Pages\ListParents::route('/'),
      'create' => Pages\CreateParents::route('/create'),
      'edit' => Pages\EditParents::route('/{record}/edit'),
    ];
  }
}
