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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            // $table->enum('type',['QA','MCQ']);
            // $table->bigInteger('sub_category_id');
            $table->unsignedBigInteger('model_set_id');
            $table->json('options');
            $table->string('value');
            $table->foreign('model_set_id')->references('id')->on('model_sets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
