<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('property_name')->nullable();
            $table->string('property_address')->nullable();
            $table->string('property_city')->nullable();
            $table->string('property_state')->nullable();
            $table->string('property_zipcode')->nullable();
            $table->string('property_image')->nullable();
            $table->string('host_info')->nullable();
            $table->string('host_name')->nullable();
            $table->string('host_photo')->nullable();
            $table->string('host_phone')->nullable();
            $table->string('host_other_phone')->nullable();
            $table->tinyInteger('host_platform')->nullable()->comment('1=airbnb, 2=homeAway, 3=booking.com, 4=vrbo');
            $table->boolean('is_protected')->nullable();
            $table->tinyInteger('password')->nullable()->comment('1=true, 2=false');
            $table->softDeletes();
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
        Schema::dropIfExists('properties');
    }
}
