<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'events',
            static function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('cost');
                $table->string('type');
                $table->foreignId('company_id')->constrained()->cascadeOnDelete();
                $table->foreignId('shift_id')->constrained()->cascadeOnDelete();
                $table->foreignId('user_id');
                $table->date('date');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
}
