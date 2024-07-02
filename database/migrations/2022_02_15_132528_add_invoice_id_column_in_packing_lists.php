<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvoiceIdColumnInPackingLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packing_lists', function (Blueprint $table) {
            $table->bigInteger('invoice_creation_id')->nullable()->after('id');
            $table->string('shipped_per', 200)->nullable()->after('shipping_method');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packing_lists', function (Blueprint $table) {
            $table->dropColumn('invoice_creation_id');
            $table->dropColumn('shipped_per');
        });
    }
}
