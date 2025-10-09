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

            // Kullanıcı ilişkisi: zorunlu olmalı, çünkü kayıt bir kullanıcıya ait
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Diğer alanlar opsiyonel hale getirildi
            $table->string('phone_number')->nullable();
            $table->string('degree')->nullable();
            $table->string('presenter_name')->nullable();

            // Paper ID'leri (örnek: JSON veya virgülle ayrılmış ID listesi)
            $table->text('paper_ids')->nullable();

            $table->enum('participation_type', [
                'Listener (Main Conference)',
                'Listener (WDIAA - Alteryx workshop session)',
                'Have Paper'
            ])->nullable(); // Eğer kullanıcı daha sonra belirleyecekse, nullable olabilir

            $table->enum('membership_type', [
                'IEEE Member',
                'Non-IEEE Member',
                'IEEE Student Member',
                'Student Non-IEEE member'
            ])->nullable();

            $table->boolean('is_ascs_member')->nullable(); // Zorunlu değilse nullable yapıldı

            // Paperı olmayan dinleyiciler için zaten nullable
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
