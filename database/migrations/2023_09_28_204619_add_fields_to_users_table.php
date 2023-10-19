<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->softDeletes();
            $table->unsignedBigInteger('tenant_id')->after('id')->nullable()->index();
            $table->string('nickname', 100)->nullable();
            $table->string('cpf')->nullable()->unique();
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('zipcode', 10)->nullable();
            $table->string('address', 500)->nullable();
            $table->string('number', 10)->nullable();
            $table->string('complement', 500)->nullable();
            $table->string('district', 500)->nullable();
            $table->string('city', 500)->nullable();
            $table->string('state', 500)->nullable();
            $table->string('phone_wpp', 500)->nullable();
            $table->string('phone2', 500)->nullable();
            $table->string('image', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
            $table->dropColumn('nickname');
            $table->dropColumn('cpf');
            $table->dropColumn('gender');
            $table->dropColumn('birth_date');
            $table->dropColumn('zipcode');
            $table->dropColumn('address');
            $table->dropColumn('number');
            $table->dropColumn('complement');
            $table->dropColumn('district');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('phone_wpp');
            $table->dropColumn('phone2');
            $table->dropColumn('image');
        });
    }
}
