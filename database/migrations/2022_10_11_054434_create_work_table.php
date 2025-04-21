<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('work', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('student')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('type_id')->constrained('work_type')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('subject');
            $table->integer('score')->default(0);
            $table->string('link');
            $table->integer('status')->default(0);
            $table->date('date');
            $table->text('desc');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('work');
    }
};
