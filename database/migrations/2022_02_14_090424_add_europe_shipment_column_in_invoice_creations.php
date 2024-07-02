<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEuropeShipmentColumnInInvoiceCreations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_creations', function (Blueprint $table) {
            $table->text('europe_shipment')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_creations', function (Blueprint $table) {
            $table->dropColumn('europe_shipment');
        });
    }
}
