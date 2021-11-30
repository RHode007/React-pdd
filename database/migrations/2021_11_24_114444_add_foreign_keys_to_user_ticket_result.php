<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserTicketResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_ticket_result', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ticket_id')->references('id')->on('tickets');
            $table->foreign('answer_id')->references('id')->on('tickets_answers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_ticket_result', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['ticket_id']);
            $table->dropForeign(['answer_id']);
        });
    }
}
