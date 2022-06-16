<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('parents', function (Blueprint $table) {
      $table->id();
      $table->string('nom', 50);
      $table->string('prenom', 50);
      $table->string('full_name')->virtualAs('concat(nom, \' \', prenom)');
      $table->string('email', 50);
      $table->string('phone', 50);
      $table->string('address', 25, 255)->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('parents');
  }
};
