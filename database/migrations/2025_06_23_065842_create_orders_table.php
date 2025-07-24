<?php

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->default('ORD00000000');
            $table->string('packing_instractions');
            $table->date('order_date');
            $table->decimal('total_amount')->nullable();
            $table->integer('status')->default(0);
            $table->foreignIdFor(Customer::class)->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
