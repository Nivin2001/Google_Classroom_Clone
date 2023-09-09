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
        Schema::create('classworks', function (Blueprint $table) {
            $table->id();
            // الكلاس ورك تابعة لكلاس روم
            // واذا حذفت classwork
            // الكلاس روم بحذفها
            $table->foreignId('classroom_id')
            ->constrained()
            ->cascadeOnDelete();

            // تابع لاي يوزر ولما احذف الكلاس ورك بدي  تصبح قيمة اليوزر فارغ

            $table->foreignId('user_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

            $table->foreignId('topic_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();



            $table->string('title');
            $table->longText('description');
            $table->enum('type',['assigment','material','questions']);
            $table->enum('status',['published','draft'])
            ->default('published');
            $table->timestamp('published_at');
            //take one value
            $table->json('options');//Java script object orinted ntation
            // for date
            //store additanal inormation
            $table->timestamps();
            //take two value
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classworks');
    }
};
