<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorModalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_modalities', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('auth_user_id')->nullable()->index();
            $table->foreign('auth_user_id')->references('id')->on('users');

            // $table->unsignedBigInteger('tenant_id')->nullable()->index();
            // $table->foreign('tenant_id')->references('id')->on('tenants');

            $table->unsignedBigInteger('instructor_id')->nullable()->index();
            $table->foreign('instructor_id')->references('id')->on('instructors');

            $table->unsignedBigInteger('modality_id')->nullable()->index();
            $table->foreign('modality_id')->references('id')->on('modalities');
            
            $table->timestamps();

            $table->decimal('percentual');
            $table->integer('calc_on_absense');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructor_modalities');
    }
}
