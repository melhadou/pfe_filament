<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnfantsResource\Pages;
use App\Models\Enfants;
use App\Models\Parents;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Illuminate\Support\Facades\DB;

class EnfantsResource extends Resource
{
  protected static ?string $model = Enfants::class;
  protected static ?string $navigationLabel = 'Ajouter Des Enfants';

  protected static ?string $navigationGroup = 'Clients';
  protected static ?string $navigationIcon = 'heroicon-o-users';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([

        TextInput::make('nom')->required(),
        TextInput::make('prenom')->required(),
        TextInput::make('age')->numeric()->required(),
        Select::make('parent')
          ->options(Parents::select('id', DB::raw("concat(nom, ' ', prenom) as full_name"))->pluck('full_name', 'id'))
          ->searchable()
          ->required(),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      //
      ->columns([

        Tables\Columns\TextColumn::make('nom')->searchable()->sortable(),
        Tables\Columns\TextColumn::make('prenom')->searchable()->sortable(),
        Tables\Columns\TextColumn::make('age')->sortable(),
      ])
      ->filters([]);
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
      'index' => Pages\ListEnfants::route('/'),
      'create' => Pages\CreateEnfants::route('/create'),
      'edit' => Pages\EditEnfants::route('/{record}/edit'),
    ];
  }
}
