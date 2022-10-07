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
        Schema::create('lessons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('status')->default(0);
            $table->uuid('course_id')->nullable(false);
            $table->string('imagem')->nullable();
            $table->string('link')->nullable();
            $table->dateTime('inicio');
            $table->dateTime('termino');
            $table->dateTime('max_cancelamento')->nullable();
            $table->string('instrutor')->nullable();
            $table->string('moderador')->nullable();
            $table->string('periodo')->nullable();
            $table->string('carga_horaria')->nullable();
            $table->text('dias_curso')->nullable();
            $table->boolean('destaque')->default(0);
            $table->text('descricao')->nullable();
            $table->text('pre_requisitos')->nullable();
            $table->text('objetivo')->nullable();
            $table->text('aviso')->nullable();
            $table->integer('vagas_cliente')->nullable();
            $table->integer('vagas_nao_cliente')->nullable();
            $table->integer('vagas_lista_cliente')->nullable();
            $table->integer('vagas_lista_nao_cliente')->nullable();
            $table->decimal('valor_cliente')->nullable();
            $table->decimal('valor_nao_cliente')->nullable();
            $table->integer('id_mp')->nullable();
            $table->string('usuario_modificado')->nullable();
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
        Schema::dropIfExists('lessons');
    }
};
