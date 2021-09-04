<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastExportedAtColumnToMetadataSourceTable extends Migration
{
    /**
     * The database connection that should be used by the migration.
     *
     * @var string
     */
    protected $connection = 'slu';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('metadata_source', function (Blueprint $table) {
            $table->dateTime('lastImportedOn')->nullable();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('metadata_source', function (Blueprint $table) {
            $table->dropColumn('lastImportedOn');
        });
    }
}
