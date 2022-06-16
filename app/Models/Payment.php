<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
  use HasFactory;

  public function parents(): BelongsTo
  {
    return $this->belongsTo(
      related: Parents::class,
      foreignKey: 'parent_id',
    );
  }
  protected $fillable = [
    'prix',
    'status',
    'total',
    'payment_date',
    'parents_id',
  ];
}
