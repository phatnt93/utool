<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Menu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('route_uri')->unique();
            $table->bigInteger('parent')->index();
            $table->integer('is_menu')->default(0);
            $table->integer('sort')->default(0);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->string('icon', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
