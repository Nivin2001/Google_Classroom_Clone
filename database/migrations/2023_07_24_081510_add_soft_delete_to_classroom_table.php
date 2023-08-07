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
        Schema::table('classrooms', function (Blueprint $table) {
            //
            // $table->timestamp('deleted_at')->nullable();// بحافظ ع موضوع timezone
            //date same date
            $table->softDeletes()->after('status');
            $table->enum('status',['active','archived','deleted'])->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // فوق بضيف الحقل وهان بحذفه
        Schema::table('classrooms', function (Blueprint $table) {
            //
            $table->dropsoftDeletes();
            $table->enum('status',['active','archived','deleted'])->change();
        });
    }
};
