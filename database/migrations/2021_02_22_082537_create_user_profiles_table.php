<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('open_id');
            $table->string('union_id')->nullable();
            $table->string('session_key')->nullable();
            $table->string('gender')->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('location')->nullable();
            $table->string('bio')->nullable();
            $table->string('sexual_pref')->nullable(); // split by ,
            $table->string('gender_id')->nullable(); // split by ,
            $table->string('gender_exp')->nullable(); // split by ,
            $table->string('romantically_attracted_to')->nullable(); // split by ,
            $table->string('interests')->nullable(); // split by ,
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
        Schema::dropIfExists('user_profiles');
    }
}
