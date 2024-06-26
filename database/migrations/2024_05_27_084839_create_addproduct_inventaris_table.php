<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('addproduct_inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('merk');
            $table->string('title');
            $table->string('category');
            $table->text('beschrijving');
        });
    }
    /**
     * $table->timestamps();
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('addproduct_inventaris');
    }
};
