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
         // Drop the foreign key constraint
        Schema::table('proforma_invoices', function (Blueprint $table) {
            $table->dropForeign(['order_id']); // Specify the foreign key constraint name
        });

        // Now drop the order_id column
        Schema::table('proforma_invoices', function (Blueprint $table) {
            $table->dropColumn('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proforma_invoices', function (Blueprint $table) {
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('set null');
        });
    }
};
