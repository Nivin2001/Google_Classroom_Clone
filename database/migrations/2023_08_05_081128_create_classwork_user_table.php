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
        /// The realtion is mnay to mnay between classroom and stusent
        // so we make pivot table
        Schema::create('classwork_user', function (Blueprint $table) {

            $table->foreignId('classwork_id')
            ->constrained()->cascadeOnDelete();


            $table->foreignId('user_id')
            ->constrained()->cascadeOnDelete();

            $table->float('grade')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->enum('status',['assigned','draft','submitted','return'])
            ->default('assigned');
            $table->timestamp('created_at')->nullable();


            $table->primary(['classwork_id','user_id']);

            $table->timestamp('updated_at')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classwork_user');
    }
};
