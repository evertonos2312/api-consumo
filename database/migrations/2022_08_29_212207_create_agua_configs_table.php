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
        Schema::create('agua_configs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('atual')->nullable(false);
            $table->decimal('valor_cubico')->nullable(false);
            $table->integer('meta_cubico');
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
        Schema::dropIfExists('agua_configs');
    }
};
