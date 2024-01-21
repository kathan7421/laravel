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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->nullable();
            $table->string('name')->nullable();
            $table->Text('small_description')->nullable();
            $table->Text('description')->nullable();
            $table->string('original_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('image')->nullable();
            $table->string('qty')->nullable();
            $table->string('tax')->nullable();
            $table->string('trending')->nullable();
            $table->enum('status',['0','1'])->default(0)->comment('0->active , 1->deactive');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

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
        Schema::dropIfExists('product');
    }
};
