<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
  use HasFactory;

  public function parents(): BelongsTo
  {
    return $this->belongsTo(
      related: Parents::class,
      foreignKey: 'parents_id',
    );
  }

  public function payment()
  {
    return $this->belongsTo(
      related: Payment::class,
      foreignKey: 'parents_id',
    );
  }
  public function parent(): BelongsTo
  {
    return $this->belongsTo(
      related: Parents::class,
      foreignKey: 'id',
    );
  }
  protected $fillable = [
    'prix',
    'status',
    'total',
    'payment_date',
    'parent_name',
    'parents_id',
  ];
}
