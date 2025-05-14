<?php

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
        Schema::create('payment_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('request_no')->default('REQ00000000');
            $table->decimal('amount',8,2);
            $table->timestamp('approved_date')->nullable();
            $table->integer('status')->default(0);
            $table->foreignId('approver_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignIdFor(Supplier::class)->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_requests');
    }
};
