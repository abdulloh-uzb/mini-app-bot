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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->foreignId("teacher_id")->constrained("users")->cascadeOnDelete();
            $table->time("start_time");
            $table->time("end_time");
            $table->unsignedTinyInteger("duration")->default(1);
            $table->date("start_date")->default(now());
            $table->json("lesson_days");
            $table->enum("level", ['beginner', 'elementary', 'intermediate', 'advanced'])->default('beginner');
            $table->decimal("price", 10, 2);
            $table->enum("status", ['active', 'inactive', 'demo'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
