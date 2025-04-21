<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained('organizations','id');
            $table->string('price');
            $table->string('payment_method');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
