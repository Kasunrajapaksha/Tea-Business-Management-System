<?php

use App\Models\PaymentRequest;
use App\Models\Supplier;
use App\Models\Tea;
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
        Schema::create('tea_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('tea_purchase_no')->default('TP00000000');
            $table->decimal('quantity');
            $table->decimal('price_per_kg');
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Tea::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Supplier::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(PaymentRequest::class)->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tea_purchases');
    }
};
