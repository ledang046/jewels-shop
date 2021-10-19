<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customusers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('passcode')->nullable();
            $table->string('email');
            $table->boolean('active');
            $table->rememberToken();
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
        Schema::dropIfExists('customusers');
    }
}
