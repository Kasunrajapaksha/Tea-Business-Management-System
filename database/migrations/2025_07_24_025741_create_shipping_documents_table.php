<?php

use App\Models\CommercialInvoice;
use App\Models\ShippingDocument;
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
        Schema::create('shipping_documents', function (Blueprint $table) {
            $table->id();
            $table->string('bill_of_lading');
            $table->string('shipping_receipt');
            $table->string('packing_list');
            $table->string('freight_bill');
            $table->string('export_customs_clearance');
            $table->string('proof_of_delivery')->nullable();
            $table->string('delivery_receipt')->nullable();
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(CommercialInvoice::class)->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_documents');
    }
};
