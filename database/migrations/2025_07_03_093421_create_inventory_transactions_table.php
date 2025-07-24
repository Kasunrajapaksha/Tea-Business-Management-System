<?php

use App\Models\Material;
use App\Models\MaterialPurchase;
use App\Models\OrderItem;
use App\Models\PaymentRequest;
use App\Models\ProductionMaterial;
use App\Models\ProductionPlan;
use App\Models\Supplier;
use App\Models\Tea;
use App\Models\TeaPurchase;
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
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();
            $table->boolean('transaction_type');
            $table->boolean('item_type');
            $table->integer('status')->default(0);
            $table->decimal('units')->nullable()->default(null);
            $table->foreignIdFor(Tea::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Material::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(ProductionMaterial::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(OrderItem::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(MaterialPurchase::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(TeaPurchase::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(ProductionPlan::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Supplier::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_transactions');
    }
};
