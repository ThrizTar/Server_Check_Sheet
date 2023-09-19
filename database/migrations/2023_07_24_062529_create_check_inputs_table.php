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
        if (!Schema::hasTable('check__inputs')) {
            Schema::create('check__inputs', function (Blueprint $table) {
                // Add the Auto-Increment column
                $table->increments("count_check");
                // auto increment needs to be an index (not necessarily primary)
                $table->index(['count_check']);
                // Remove the primary key
                $table->dropPrimary("count_check");

                $table->primary(['username', 'list_detail', 'count_check']);

                $table->string('username', 50);
                $table->foreign('username')->references('username')->on('users')
                    ->constrained()->onUpdate('cascade')->onDelete('cascade');;

                $table->string('list_detail');
                $table->foreign('list_detail')->references('list_detail')->on('lists')
                    ->constrained()->onUpdate('cascade')->onDelete('cascade');

                $table->string('status', 1);
                $table->text('comment')->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check__inputs');
    }
};
