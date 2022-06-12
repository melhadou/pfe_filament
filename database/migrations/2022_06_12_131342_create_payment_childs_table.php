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
    Schema::create('payment_childs', function (Blueprint $table) {
      $table->id();
      $table->string('prix');
      $table->boolean('status');
      $table->unsignedBigInteger('enfant_id');
      $table->foreign('enfant_id')->references('id')->on('enfants');
      $table->unsignedBigInteger('payment_id');
      $table->foreign('payment_id')->references('id')->on('payments');
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
    Schema::dropIfExists('payment_childs');
  }
};
