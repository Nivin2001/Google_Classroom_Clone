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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();//ID BIGINT unsigned Auto_Incremant PRIMARY
            // $table->bigInteger('id')->unsigned()->autoIncrement();
            // $table->bigIncrements('id');
            $table->string('name',255);//name VARCHAR(4096) not null
            $table->char('code',10)->unique();
            $table->string('section')->nullable();
            $table->string('subject')->nullable();
            $table->string('room')->nullable();
            $table->string('cover_image_path')->nullable();
            $table->string('theme')->nullable();
            $table->foreignId('user_id')
            ->nullable()
            ->constrained('users','id')
            // ->nullOnDelete();
            ->nullOnDelete();
            //هذا الحقل تصبح قيمته null اذا حذفت الحقل المرتبط فيه
            $table->enum('status',['active','archives'])->default('active');
            // created at + updated_at timestamp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
