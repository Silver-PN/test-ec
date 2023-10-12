<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchTable extends Migration
{
    public function up()
    {
        Schema::create('branch', function (Blueprint $table) {
            $table->id();
            $table->string('Branch_Code')->unique();
            $table->string('Branch_Name');
            $table->string('Branch_Province');
            $table->string('Branch_District');
            $table->string('Branch_Ward');
            $table->string('Branch_Street');
            $table->string('Branch_Phone');
            $table->boolean('Branch_Is_Active')->default(true);
            $table->string('User_Create');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('branch');
    }
}