<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->boolean('status');
            $table->string('email');
            $table->string('password');
            $table->timestamps();   
        });
    }
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
