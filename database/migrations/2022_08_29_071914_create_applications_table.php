<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string("fullname");
            $table->string("org_info");
            $table->foreignId("announcement_id")->constrained('announcement')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string("phone");
            $table->foreignId("status");
            $table->string("file");
            $table->timestamps();
        }); 
    }
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
