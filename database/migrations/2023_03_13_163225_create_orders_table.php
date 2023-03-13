<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('set null');
            // client's data at the time of placing the order
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            // order data
            $table->string('discount_code')->nullable();
            $table->decimal('discount_amount')->default(0);
            // helpful columns to persist calculations
            $table->decimal('subtotal'); // total price without discount
            $table->decimal('total'); // final price
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
