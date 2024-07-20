<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('about')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('user_type')->nullable();
            $table->string('resume')->nullable();
            $table->string('user_trial')->default(now()->addWeek());
            $table->timestamp('billing_ends')->nullable();
            $table->string('status')->default('active');
            $table->string('plan')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('description');
            $table->string('roles');
            $table->string('job_type');
            $table->string('address');
            $table->decimal('salary', 8, 2);
            $table->date('application_close_date');
            $table->string('feature_image')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('listing_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listing_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('shortlisted')->default(false);
            $table->timestamps();

            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing_user');
        Schema::dropIfExists('listings');
        Schema::dropIfExists('users');
    }
};
