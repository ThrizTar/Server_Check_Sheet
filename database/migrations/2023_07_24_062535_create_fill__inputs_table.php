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
        if (!Schema::hasTable('fill__inputs')) {
            Schema::create('fill__inputs', function (Blueprint $table) {
                // Add the Auto-Increment column
                $table->increments("count_check");
                // auto increment needs to be an index (not necessarily primary)
                $table->index(['count_check']);
                // Remove the primary key
                $table->dropPrimary("count_check");
                $table->primary(['username', 'form_fill_input', 'count_check']);

                $table->string('username', 50);
                $table->foreign('username')->references('username')->on('users')
                    ->constrained()->onUpdate('cascade')->onDelete('cascade');

                $table->string('form_fill_input', 70);
                $table->foreign('form_fill_input')->references('form_fill_input')->on('fill__lists')
                    ->constrained()->onUpdate('cascade')->onDelete('cascade');

                $table->text('input');

                $table->timestamps();
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fill__inputs');
    }
};
