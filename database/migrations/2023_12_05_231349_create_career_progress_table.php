<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_progress', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->string('type');
            $table->string('company')->nullable();
            $table->string('school')->nullable();
            $table->string('job')->nullable();
            $table->string('level')->nullable();
            $table->string('salary')->nullable();
            $table->integer('user_id');
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
        Schema::dropIfExists('career_progress');
    }
}
