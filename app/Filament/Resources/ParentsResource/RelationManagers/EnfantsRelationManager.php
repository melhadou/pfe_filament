<?php

namespace App\Filament\Resources\ParentsResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class EnfantsRelationManager extends HasManyRelationManager
{
  protected static string $relationship = 'enfant';

  protected static ?string $recordTitleAttribute = 'prenom';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('title')->required(),
        Forms\Components\MarkdownEditor::make('content'),
        // ...
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('title'),
        // ...
      ]);
  }
}
