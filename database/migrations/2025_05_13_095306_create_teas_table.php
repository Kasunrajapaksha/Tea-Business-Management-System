<?php

use App\Models\User;
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
        Schema::create('teas', function (Blueprint $table) {
            $table->id();
            $table->string('tea_no')->default('STD 0000 - NONE');
            $table->string('tea_name');
            $table->integer('tea_standard');
            $table->decimal('price_per_Kg', 8, 2);
            $table->decimal('stock_level',8,2)->nullable();
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teas');
    }
};
