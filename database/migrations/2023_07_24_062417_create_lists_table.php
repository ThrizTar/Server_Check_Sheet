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
        if (!Schema::hasTable('lists')) {
            Schema::create('lists', function (Blueprint $table) {
                $table->string('list_detail')->primary();

                $table->string('checklist_organize', 70);
                $table->foreign('checklist_organize')->references('checklist_organize')->on('checklists')
                    ->constrained()->onUpdate('cascade')->onDelete('cascade');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lists');
    }
};
