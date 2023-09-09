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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            // عندي علاقة بين جدول اليوور والتعليقات لكن بشرط لو انحذف اليوزر بدي
            //  يحتفظ بالتعلق تبعه لكن بتصبح قيمة اليوزر فارغ
            $table->foreignId('user_id')->nullable()
            ->constrained()
            ->nullOnDelete();
            //commantable_id+comantable_type

      
            $table->morphs('commentable');

            $table->text('content');
            // لمعرفة معلومات اليوزر
            $table->string('ip',15)->nullable();
            // لمعرفة معلومات عن حالة اليوزر من اي متصفح دخل
            $table->string('user_agent',512)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
