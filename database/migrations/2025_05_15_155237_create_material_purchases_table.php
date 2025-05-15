<?php

use App\Models\Material;
use App\Models\PaymentRequest;
use App\Models\Supplier;
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
        Schema::create('material_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
            $table->string('material_purchase_no')->default('TP00000000');
            $table->foreignIdFor(Material::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Supplier::class)->nullable()->constrained()->onDelete('set null');
            $table->integer('units');
            $table->decimal('unit_price',8,2);
            $table->foreignIdFor(PaymentRequest::class)->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_purchases');
    }
};
