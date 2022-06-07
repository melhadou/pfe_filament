<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Parents extends Model
{
  use HasFactory;

  public function enfant()
  {
    return $this->hasMany(
      related: Enfants::class,
      foreignKey: 'parent',
    );
  }
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'nom',
    'prenom',
    'email',
    'phone',
    'address',
  ];
}
