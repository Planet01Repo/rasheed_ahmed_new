<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceCreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_creations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->nullable();
            $table->string('invoice_no', 100)->nullable();
            $table->date('invoice_creation_date')->nullable();
            $table->string('shipped_per', 200)->nullable();
            $table->string('awb_no', 200)->nullable();
            $table->date('awb_date')->nullable();
            $table->string('form_no', 200)->nullable();
            $table->date('form_date')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->bigInteger('no_of_package')->nullable();
            $table->bigInteger('volume')->nullable();
            $table->string('amount_in_words',500)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_creations');
    }
}
