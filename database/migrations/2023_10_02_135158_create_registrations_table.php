<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auth_user_id')->nullable()->index();
            $table->foreign('auth_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->foreign('tenant_id')->references('id')->on('tenants');
            
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('student_id')->nullable()->index();
            $table->foreign('student_id')->references('id')->on('students');

            $table->unsignedBigInteger('modality_id')->nullable()->index();
            $table->foreign('modality_id')->references('id')->on('modalities');

            $table->date('start');
            $table->date('end');
            $table->integer('duration');
            $table->integer('num_classes')->nullable();
            $table->integer('class_per_week');
            $table->integer('due_day')->nullable();
            $table->decimal('value');
            $table->string('comments', 500)->nullable();
            $table->integer('is_active')->default(1);
            $table->string('class_week', 1000);

            $table->unsignedBigInteger('first_payment_method_id')->nullable()->index();
            $table->unsignedBigInteger('other_payment_method_id')->nullable()->index();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
