<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('idiomas', function (Blueprint $table) {
            $table->id();
            $table->string('idioma');
            $table->foreignId("alumno_id")->constrained()
            ->onDelete("cascade")
            ->onUpdate("cascade");
            $table->enum("nivel",["Alto","Medio","Básico"]);
            $table->enum("titulo",["A1","A2","B1","B2","C1","C2"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idiomas');
    }
};
