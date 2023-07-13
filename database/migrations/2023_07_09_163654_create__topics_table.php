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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('classroom_id')
            ->constrined()
            ->caccadeOnDelete();
            //م في داعي احتفظ بالتوبيك لو نحذف عندي الكلاس روم
            $table->foreignId('user_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();
            // لوانحذف التوبيك بحتفظ باليوزر لكن بتصبح قيمته null

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
