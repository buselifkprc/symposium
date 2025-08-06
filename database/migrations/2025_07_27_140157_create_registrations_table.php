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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('participation_type', [
                'Listener (Main Conference)',
                'Listener (WDIAA - Alteryx workshop session)',
                'Have Paper'
            ]);

            $table->enum('membership_type', [
                'IEEE Member',
                'Non-IEEE Member',
                'IEEE Student Member',
                'Student Non-IEEE member'
            ]);
            $table->boolean('is_ascs_member');

            // Paperı olmayan bir dinleyici için bu alan boş olabilir bu yüzden 'nullable' olmalı.
            $table->enum('presentation_type', [
                'Face to Face',
                'Remote-Live Presentation',
                'Pre-Recorded Video'
            ])->nullable();
            $table->unsignedInteger('extra_paper_count')->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
