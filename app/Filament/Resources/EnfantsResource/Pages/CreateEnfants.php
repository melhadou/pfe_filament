<?php

namespace App\Filament\Resources\EnfantsResource\Pages;

use App\Filament\Resources\EnfantsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEnfants extends CreateRecord
{
  protected static string $resource = EnfantsResource::class;

  protected static ?string $title = 'Ajouter Des Enfants';
}
