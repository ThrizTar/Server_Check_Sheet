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
        if (!Schema::hasTable('fill__lists')) {
            Schema::create('fill__lists', function (Blueprint $table) {
                $table->string('form_fill_input', 70)->primary();
                $table->string('input_title', 50);

                $table->string('checkform_organize', 70);
                $table->foreign('checkform_organize')->references('checkform_organize')->on('checkforms')
                    ->constrained()->onUpdate('cascade')->onDelete('cascade');

                $table->string('input_type', 20);

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fill__lists');
    }
};
