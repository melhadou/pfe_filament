<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enfants extends Model
{
  use HasFactory;
  protected $fillable = [
    'nom',
    'prenom',
    'age',
    'parent',
  ];

  public function parent(): HasMany
  {
    return $this->hasMany(
      Enfants::class,
      'parent'
    );
  }
}
