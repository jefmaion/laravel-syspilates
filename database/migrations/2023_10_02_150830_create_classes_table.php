<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auth_user_id')->nullable()->index();
            $table->foreign('auth_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->foreign('tenant_id')->references('id')->on('tenants');
            
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('student_id')->nullable()->index();
            $table->foreign('student_id')->references('id')->on('students');

            $table->unsignedBigInteger('main_instructor_id')->nullable()->index();
            $table->foreign('main_instructor_id')->references('id')->on('instructors');

            $table->unsignedBigInteger('instructor_id')->nullable()->index();
            $table->foreign('instructor_id')->references('id')->on('instructors');

            $table->unsignedBigInteger('modality_id')->nullable()->index();
            $table->foreign('modality_id')->references('id')->on('modalities');

            $table->unsignedBigInteger('registration_id')->nullable()->index();
            $table->foreign('registration_id')->references('id')->on('registrations');

            $table->unsignedBigInteger('class_reposition_id')->nullable()->index();
            $table->foreign('class_reposition_id')->references('id')->on('classes');

            $table->date('date');
            $table->time('time');
            $table->string('type');

            $table->string('name')->nullable();
            $table->string('phone_wpp', 500)->nullable();

            $table->integer('status');
            $table->string('situation')->nullable();
            $table->decimal('value')->nullable();
            $table->text('comments')->nullable();
            $table->text('evolution')->nullable();
            $table->dateTime('evolution_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
