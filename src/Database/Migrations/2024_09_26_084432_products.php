<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    private $tableName = 'products';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::connection(config('magento.connection'))->hasTable($this->tableName) ){

            Schema::connection(config('magento.connection'))->create($this->tableName, function (Blueprint $table) {

                $table->id('productID'); // Auto-incrementing ID
                $table->bigInteger('siteID');
                $table->bigInteger('id');
                $table->string('sku');
                $table->string('name');
                $table->integer('attribute_set_id');
                $table->decimal('price');
                $table->integer('status');
                $table->integer('visibility');
                $table->string('type_id');
                $table->dateTime('m_created_at');
                $table->dateTime('m_updated_at');
                $table->json('extension_attributes');
                $table->json('product_links');
                $table->json('options')->nullable();
                $table->json('media_gallery_entries');
                $table->json('tier_prices')->nullable();
                $table->json('custom_attributes');

                $table->timestamps(); // Created at and updated at

                $table->index('id');
                $table->index('siteID');
                
            });

        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tableName);
    }
    
};
