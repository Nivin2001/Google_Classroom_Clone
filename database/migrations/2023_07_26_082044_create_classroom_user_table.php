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
        //table between user and classroom because the realtion in mant to many
        Schema::create('classroom_user', function (Blueprint $table) {
         $table->foreignId('classroom_id')->constrained()->cascadeOnDelete();
         $table->foreignId('user_id')->constrained()->cascadeOnDelete();
         //one table for student and user
         $table->enum('role',['student','teacher'])->default(('student'));
            $table->timestamp('create_at');
            //علشان امنع انه اليوزر يعمل تسجيل اكتر من مرة
            $table->primary((['classroom_id','user_id']));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_user');
    }
};
