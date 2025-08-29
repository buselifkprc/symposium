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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('login_paper_id')->nullable()->after('email');

            // foreign key: papers tablosuna bağla
            $table->foreign('login_paper_id')->references('id')->on('papers')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['login_paper_id']);
            $table->dropColumn('login_paper_id');
        });
    }
};
