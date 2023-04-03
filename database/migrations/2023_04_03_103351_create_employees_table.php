<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('employees', function (Blueprint $table) {
      $table->id();
      $table->string('firstname', 30);
      $table->string('lastname', 30);
      $table->string('address', 150)->nullable();
      $table->unsignedBigInteger('country_id');
      $table->unsignedBigInteger('state_id');
      $table->unsignedBigInteger('city_id');
      $table->unsignedBigInteger('department_id');
      $table->string('zip_code', 6)->nullable();
      $table->date('birth_date')->nullable();
      $table->date('date_hired')->nullable();
      $table->timestamps();

      $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
      $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
      $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
      $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('employees');
  }
}
