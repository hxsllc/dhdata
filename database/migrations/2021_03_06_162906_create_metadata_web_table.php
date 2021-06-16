<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetadataWebTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('metadata_web')) {
            Schema::create('metadata_web', function (Blueprint $table) {
                $table->id('uid');
                $table->string('vfl_roll', 10)->index();
                $table->string('shelfmark', 50)->nullable();
                $table->string('codex', 10)->index();
                $table->string('vfl_part', 10)->index();
                $table->string('century', 50)->nullable();
                $table->string('country', 50)->nullable();
                $table->string('language', 50)->nullable();
                $table->string('reference', 255)->nullable();
                $table->string('metascripta_id', 50)->nullable()->index();
                $table->date('date_digitized')->nullable();
                $table->integer('int_roll')->nullable();
                $table->integer('int_manu')->nullable();
                $table->integer('int_part')->nullable();
                $table->boolean('published')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('metadata_web');
    }
}
