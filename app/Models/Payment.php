<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
  use HasFactory;

  public function enfant(): HasMany
  {
    return $this->hasMany(
      related: Enfants::class,
      foreignKey: 'enfant_id',
    );
  }

  public function parents(): BelongsTo
  {
    return $this->belongsTo(
      related: Parents::class,
      foreignKey: 'parent_id',
    );
  }
  protected $fillable = [
    'prix',
    'total',
    'last_payment',
    'next_payment',
    'payment_status',
    'enfant_id',
  ];
}
