<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationship', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id_one');
            $table->integer('user_id_two');
            $table->tinyInteger('status')->comment('0: Pending; 1: Accepted; 2: Declined;');
            $table->integer('action_user_id')->comment('The action_user_id represent the id of the user who has performed the most recent status field update.');
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
        Schema::dropIfExists('relationship');
    }
}
