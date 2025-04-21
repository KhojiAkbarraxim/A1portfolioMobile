<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementTable extends Migration
{
    public function up()
    {
        Schema::create('announcement', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('organization_id')->constrained('organizations','id');
            $table->string('image');
            $table->string('thumb_image');
            $table->date('app_begin')->nullable();
            $table->date('app_deadline')->nullable();
            $table->date('selection_date')->nullable();
            $table->date('selection_begin')->nullable();
            $table->text('description');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('announcement');
    }
}
