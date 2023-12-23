<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained();
            $table->char('item_id', 16);
            $table->integer('quantity')->unsigned();
            $table->timestamps();
            $table->primary(['order_id', 'item_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_item');
    }
}
