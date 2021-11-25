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
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idTicket')->references('id')->on('tickets');
            $table->foreign('idAnswer')->references('id')->on('tickets_answers');
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
            $table->dropForeign(['idUser']);
            $table->dropForeign(['idTicket']);
            $table->dropForeign(['idAnswer']);
        });
    }
}
