<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TimerAddPrivateFlag extends Migration
{
	public function up()
	{
        Schema::table('timers', function(Blueprint $table) {
            $table->boolean('private');
        });
	}

	public function down()
	{
        Schema::table('timers', function(Blueprint $table) {
            $table->dropColumn('private');
        });
	}
}
