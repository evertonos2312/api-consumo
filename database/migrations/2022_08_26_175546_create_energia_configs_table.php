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
        Schema::create('energia_configs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('atual')->nullable(false);
            $table->decimal('valor_kwh')->nullable(false);
            $table->integer('meta_kwh');
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
        Schema::dropIfExists('energia_configs');
    }
};
