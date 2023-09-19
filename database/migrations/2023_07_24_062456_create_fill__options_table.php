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
        if (!Schema::hasTable('fill__options'))
            Schema::create('fill__options', function (Blueprint $table) {
                $table->string('input_option', 100)->primary();

                $table->string('form_fill_input', 70);
                $table->foreign('form_fill_input')->references('form_fill_input')->on('fill__lists')
                    ->constrained()->onUpdate('cascade')->onDelete('cascade');;

                $table->text('option_detail');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fill__options');
    }
};
