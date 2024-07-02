<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnToSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_sizes', function (Blueprint $table) {
            $table->string("inner_carton_dimension");
            $table->string("master_carton_dimension");
            $table->string("article_rate");
            $table->string("net_weight_per_carton");
            $table->string("gross_weight_per_carton");
            $table->string("cbm");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_sizes', function (Blueprint $table) {
            $table->dropColumn('inner_carton_dimension');
            $table->dropColumn('master_carton_dimension');
            $table->dropColumn('article_rate');
            $table->dropColumn('net_weight_per_carton');
            $table->dropColumn('gross_weight_per_carton');
            $table->dropColumn('cbm');
        });
    }
}
