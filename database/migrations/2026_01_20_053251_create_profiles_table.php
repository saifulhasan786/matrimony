<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('profile_for')->nullable(); // self, son, daughter, brother, sister, friend, relative
            $table->integer('height')->nullable(); // in cm
            $table->integer('weight')->nullable(); // in kg
            $table->enum('marital_status', ['never_married', 'divorced', 'widowed', 'awaiting_divorce'])->nullable();
            $table->integer('children')->default(0);
            $table->string('body_type')->nullable();
            $table->string('complexion')->nullable();
            $table->string('physical_status')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('religion')->nullable();
            $table->string('caste')->nullable();
            $table->string('sub_caste')->nullable();
            $table->string('gothra')->nullable();
            $table->string('education')->nullable();
            $table->string('education_detail')->nullable();
            $table->string('occupation')->nullable();
            $table->string('occupation_detail')->nullable();
            $table->string('annual_income')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->integer('brothers')->default(0);
            $table->integer('sisters')->default(0);
            $table->string('family_type')->nullable(); // joint, nuclear
            $table->string('family_status')->nullable(); // middle_class, upper_middle_class, rich, affluent
            $table->string('family_values')->nullable(); // traditional, moderate, liberal
            $table->text('about_me')->nullable();
            $table->text('about_family')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('interests')->nullable();
            $table->string('profile_picture')->nullable();
            $table->boolean('profile_verified')->default(false);
            $table->enum('profile_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
