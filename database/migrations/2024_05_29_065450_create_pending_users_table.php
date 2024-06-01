<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('student_id')->unique();
            $table->string('department');
            $table->string('year_level');
            $table->string('section');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pending_users');
    }
}
