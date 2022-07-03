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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->text('store_name');
            $table->text('email')->nullable();
            $table->text('address')->nullable();
            $table->text('phone')->nullable();
            $table->text('website')->nullable();
            $table->text('legally')->nullable();
            $table->text('business_type')->nullable();
            $table->text('logo')->nullable();
            $table->text('plan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
