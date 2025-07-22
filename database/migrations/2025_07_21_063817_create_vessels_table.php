<?php

use App\Models\Port;
use App\Models\ShippingProvider;
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
        Schema::create('vessels', function (Blueprint $table) {
            $table->id();
            $table->string('vessel_name');
            $table->string('tracking_number');
            $table->foreignIdFor(Port::class)->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('vessel_ports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Vessel::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Port::class)->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vessels');
        Schema::dropIfExists('vessel_ports');
    }
};
