<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('gender');
            $table->float('current_weight')->nullable();
            $table->float('desired_weight')->nullable();
            $table->string('height')->nullable();
            $table->enum('weight_unit', ['kg', 'lbs'])->nullable();
            $table->enum('height_unit', ['cm', 'inches'])->nullable();
            $table->string('branch')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->foreign('plan_id')->references('id')->on('memberships')->onDelete('set null');
            $table->boolean('agree')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('members');
    }
}
