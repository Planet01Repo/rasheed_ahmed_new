<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnInPerfomaInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perfoma_invoices', function (Blueprint $table) {
            $table->boolean('status')->nullable()->default(false)->comment('0=pending, 1=complete');
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
            $table->dropColumn('status');
        });
    }
}
