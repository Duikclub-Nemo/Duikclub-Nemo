<?php

use App\Enums\CertificateStatusEnum;
use App\Enums\CertificateTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(CertificateStatusEnum::PUBLIC->value);
            $table->foreignId('certificate_category')->constrained();
            $table->tinyInteger('certificate_type')->default(CertificateTypeEnum::REGULAR->value);
            $table->boolean('teachable')->default(true);
            $table->string('title');
            $table->string('alt_title')->nullable();
            $table->integer('min_age')->nullable();
            $table->string('abbreviation')->nullable();
            $table->longText('requirements')->nullable();
            $table->longText('body')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
