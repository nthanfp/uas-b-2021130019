<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->char('id', 16)->primary();
            $table->string('nama', 255)->nullable();
            $table->double('harga', 10, 2)->nullable();
            $table->integer('stok')->nullable();
            $table->timestamps();
        });

        $this->execute('ALTER TABLE items ADD CONSTRAINT harga_check CHECK (harga >= 0);');
        $this->execute('ALTER TABLE items ADD CONSTRAINT stok_check CHECK (stok >= 0);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
