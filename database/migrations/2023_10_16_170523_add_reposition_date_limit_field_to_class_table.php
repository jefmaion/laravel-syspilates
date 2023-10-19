<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRepositionDateLimitFieldToClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->date('reposition_date_limit')->nullable()->after('class_reposition_id');
            $table->integer('has_reposition')->default(0)->nullable()->after('class_reposition_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropColumn('reposition_date_limit');
            $table->dropColumn('has_reposition');
        });
    }
}
