<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParentsResource\Pages;
use App\Filament\Resources\ParentsResource\RelationManagers;
use App\Models\Parents;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables;

class ParentsResource extends Resource
{
  protected static ?string $model = Parents::class;

  protected static ?string $navigationIcon = 'heroicon-o-collection';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([

        TextInput::make('nom')->required(),
        TextInput::make('prenom')->required(),
        TextInput::make('email')->email()->required(),
        TextInput::make('phone')->tel()->integer(),
        TextInput::make('Address')
          ->minLength(2)
          ->maxLength(255)
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
      'index' => Pages\ListParents::route('/'),
      'create' => Pages\CreateParents::route('/create'),
      'edit' => Pages\EditParents::route('/{record}/edit'),
    ];
  }
}
