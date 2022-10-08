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
        Schema::create('faturas_energia', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('mes_referencia')->nullable(false);
            $table->integer('leitura_numero');
            $table->integer('consumo');
            $table->decimal('valor_conta');
            $table->timestamp('prox_leitura');
            $table->boolean('atingiu_meta')->default(0);
            $table->uuid('user_create')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faturas_energia');
    }
};
