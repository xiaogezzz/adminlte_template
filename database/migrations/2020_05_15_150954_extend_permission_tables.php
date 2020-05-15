<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExtendPermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding.');
        }

        Schema::table($tableNames['permissions'], function (Blueprint $table) {
            $table->string('display_name')->after('guard_name')->nullable();
            $table->string('description')->after('display_name')->nullable();

            $table->unique('name', 'name_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding.');
        }

        Schema::table($tableNames['permissions'], function (Blueprint $table) {
            $table->dropColumn('display_name');
            $table->dropColumn('description');

            $table->dropUnique('name_unique');
        });
    }
}
