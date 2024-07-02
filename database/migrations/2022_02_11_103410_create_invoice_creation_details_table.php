<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceCreationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_creation_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_creation_id')->nullable();
            $table->bigInteger('perfoma_invoice_id')->nullable();
            $table->bigInteger('perfoma_invoice_detail_id')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_creation_details');
    }
}
