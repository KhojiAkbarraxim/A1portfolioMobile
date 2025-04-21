<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommissionScoresTable extends Migration
{
    public function up()
    {
        Schema::create('commission_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commission_id')->constrained('commissions')->onDelete('cascade');
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->foreignId('announcement_id')->constrained('announcement')->onDelete('cascade');
            $table->foreignId('criteria_id')->constrained('criteria')->onDelete('cascade');
            $table->integer('score')->default(0);
            $table->text('desc');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('commission_scores');
    }
}
