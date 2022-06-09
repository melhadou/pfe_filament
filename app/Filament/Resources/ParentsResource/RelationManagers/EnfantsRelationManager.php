<?php

namespace App\Filament\Resources\ParentsResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;


class EnfantsRelationManager extends HasManyRelationManager
{
  protected static string $relationship = 'enfant';

  protected static ?string $recordTitleAttribute = 'prenom';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        TextInput::make('nom')->required(),
        TextInput::make('prenom')->required(),
        TextInput::make('age')->numeric()->required(),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('nom')->searchable()->sortable(),
        Tables\Columns\TextColumn::make('prenom')->searchable()->sortable(),
        Tables\Columns\TextColumn::make('age')->sortable(),
      ]);
  }
}
