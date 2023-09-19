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
        if (!Schema::hasTable('checkforms')) {
            Schema::create('checkforms', function (Blueprint $table) {
                $table->string('checkform_organize', 70)->primary();
                $table->string('checkform_name', 50);

                $table->string('checksheet_name', 50);
                $table->foreign('checksheet_name')->references('checksheet_name')->on('checksheets')
                    ->constrained()->onUpdate('cascade')->onDelete('cascade');

                $table->string('form_type', 20);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkforms');
    }
};
