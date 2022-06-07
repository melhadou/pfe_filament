<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfants extends Model
{
  use HasFactory;
  protected $fillable = [
    'nom',
    'prenom',
    'age',
    'parent',
  ];
}