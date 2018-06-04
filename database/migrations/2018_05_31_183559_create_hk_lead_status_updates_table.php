<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHkLeadStatusUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hk_lead_status_updates', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->integer('new_status')->default(Lead::STATUS_NEW);
            $table->text('body')->nullable();
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();

            // Engine
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hk_lead_status_updates');
    }
}
