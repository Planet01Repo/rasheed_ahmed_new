<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnsToPerfomaInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perfoma_invoices', function (Blueprint $table) {
            $table->string('po_number');
            $table->date('pi_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perfoma_invoices', function (Blueprint $table) {
            $table->dropColumn('po_number');
            $table->dropColumn('pi_date');
            $table->dropColumn('accepted_date');
        });
    }
}
