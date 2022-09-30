<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBulletPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bullet_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('portfolio_item_id');
            $table->text('text_nl');
            $table->text('text_en');

            $table->foreign('portfolio_item_id')
                ->references('id')
                ->on('portfolio_items')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

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
        Schema::dropIfExists('bullet_points');
    }
}
