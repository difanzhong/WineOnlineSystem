<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('grape');
            $table->year('year');
            $table->string('brand');
            $table->string('cap');
            $table->unsignedDecimal('price', 8,2);
            $table->unsignedDecimal('stock_price', 8,2);
            $table->Integer('size')->unsigned();
            $table->text('description')->nullable();
            $table->unsignedInteger('stock');
            $table->boolean('rewarded')->nullable();
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
        Schema::dropIfExists('wines');
    }
}
