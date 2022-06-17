<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Parents extends Model
{
  use HasFactory;
  public function index()
  {
    $users = Enfants::withCount('parent')->get();
    return $users;
  }

  public function payment()
  {
    return $this->hasMany(
      related: Parents::class,
      foreignKey: 'parents_id',
    );
  }
  public function enfant()
  {
    return $this->hasMany(
      related: Enfants::class,
      foreignKey: 'parent',
    );
  }
  public static function find($get)
  {
    return Enfants::query()->where('id', '=', $get);
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
