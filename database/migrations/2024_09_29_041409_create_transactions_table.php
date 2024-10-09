<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('payer');
            $table->uuid('payee');
            $table->decimal('value',10,2);

            $table->foreign('payer')
                  ->references('id')
                  ->on('users');
            $table->foreign('payee')
                  ->references('id')
                  ->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
