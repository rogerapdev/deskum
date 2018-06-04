<?php

use App\Models\Ticket;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHkTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hk_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title');
            $table->text('body');
            $table->string('public_token', 24)->unique();
            $table->unsignedBigInteger('requester_id');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('status')->default(Ticket::STATUS_NEW);
            $table->tinyInteger('priority')->default(Ticket::PRIORITY_NORMAL);
            $table->tinyInteger('level')->default(0);
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
        Schema::dropIfExists('hk_tickets');
    }
}
