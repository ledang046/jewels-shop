<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCustomusersTableAddAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customusers', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('phonenumber')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customusers', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('phonenumer')->nullable();
        });
    }
}
