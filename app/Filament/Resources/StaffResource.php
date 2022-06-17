<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffResource\Pages;
use App\Filament\Resources\StaffResource\RelationManagers;
use App\Models\Enfants;
use App\Models\Parents;
use App\Models\Staff;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;


class StaffResource extends Resource
{
  protected static ?string $model = Staff::class;

  protected static ?string $navigationLabel = 'Ajouter Des Staff';

  protected static ?string $navigationGroup = 'Staff';
  protected static ?string $navigationIcon = 'heroicon-o-user-group';
  public $parentId;
  public $enfantId;


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

                TextInput::make('email')->email()->required(),
                TextInput::make('phone')

                  ->tel()
                  ->required()
                  ->mask(fn (TextInput\Mask $mask) => $mask->pattern('0 00 00 00 00'))
                  ->prefix('+212'),
              ]),

          ])
          ->columnSpan([
            'sm' => 2,
          ]),
        Card::make()
          ->schema([
            Placeholder::make('created_at')
              ->label('Created at')
              ->content(fn (?Staff $record): string => $record ? $record->created_at->diffForHumans() : '-'),
            Placeholder::make('updated_at')
              ->label('Last modified at')
              ->content(fn (?Staff $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
          ])
          ->columnSpan(1),
      ])
      ->columns([
        'sm' => 3,
        'lg' => null,
      ]);
  }
  // public static function form(Form $form): Form
  // {
  //   return $form
  //     ->schema([
  //       TextInput::make('nom')->required(),
  //       TextInput::make('prenom')->required(),
  //       TextInput::make('email')->type('email')->required(),
  //       TextInput::make('phone')
  //         ->tel()
  //         ->required()
  //         ->prefix('+212'),

  //       Select::make('parentId')
  //         ->label('parent')
  //         ->options(Parents::all()->pluck('full_name', 'id')->toArray())
  //         ->afterStateUpdated(fn (callable $set) => $set('enfantId', 'id')),
  //       Select::make('enfantId')
  //         ->label('enfant')
  //         ->options(
  //           function (callable $get) {
  //             $parentId = Parents::find($get('parentId'));

  //             return $parentId->pluck('full_name', 'id');
  //           }
  //         ),
  //     ]);
  // }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('nom')->searchable()->sortable(),
        TextColumn::make('prenom')->searchable()->sortable(),
        TextColumn::make('email')->searchable()->sortable(),
        TextColumn::make('phone'),
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
      'index' => Pages\ListStaff::route('/'),
      'create' => Pages\CreateStaff::route('/create'),
      'edit' => Pages\EditStaff::route('/{record}/edit'),
    ];
  }
  protected static function getNavigationBadge(): ?string
  {
    return static::$model::query()->count();
  }
}
