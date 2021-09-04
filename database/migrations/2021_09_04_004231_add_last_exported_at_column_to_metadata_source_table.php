<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastExportedAtColumnToMetadataSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('metadata_source', function (Blueprint $table) {
            $table->dateTime('last_imported_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('metadata_source', function (Blueprint $table) {
            $table->dropColumn('last_imported_at');
        });
    }
}
