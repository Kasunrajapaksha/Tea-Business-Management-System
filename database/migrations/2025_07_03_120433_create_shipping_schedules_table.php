<?php

use App\Models\Order;
use App\Models\shippingProvider;
use App\Models\User;
use App\Models\Vessel;
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
        Schema::create('shipping_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('departure_date');
            $table->date('arrival_date');
            $table->date('actual_departure_date')->nullable();
            $table->date('actual_arrival_date')->nullable();
            $table->decimal('shipping_cost')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('departure_port');
            $table->string('arrival_port');
            $table->string('shipping_note')->nullable();
            $table->string('shipping_documents')->nullable();
            $table->foreignIdFor(Vessel::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(shippingProvider::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Order::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_schedules');
    }
};
