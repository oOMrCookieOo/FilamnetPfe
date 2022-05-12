<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->nullable()->unique('products_slug_unique');
            $table->string('sku')->nullable()->unique('products_sku_unique');
            $table->longText('description')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('is_visible')->default(false);
            $table->integer('old_price')->nullable();
            $table->integer('price')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->string('seo_title', 60)->nullable();
            $table->string('seo_description', 160)->nullable();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->cascadeOnDelete();
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
        Schema::dropIfExists('products');
    }
}
