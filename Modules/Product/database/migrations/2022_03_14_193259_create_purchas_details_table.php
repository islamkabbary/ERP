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
        Schema::create('purchas_details', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->decimal('price');
            $table->integer('qty');
            $table->decimal('total_product');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('purchas_id')->constrained('purchas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('purchas_details');
    }
};
