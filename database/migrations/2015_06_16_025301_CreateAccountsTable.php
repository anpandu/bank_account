<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 64)->unique();
            $table->string('screen_name', 64);
            $table->string('social_media', 64);
            $table->boolean('active');
            $table->string('consumer_key', 64);
            $table->string('consumer_secret', 64);
            $table->text('access_token');
            $table->string('access_token_secret', 64);
            $table->integer('use_count')->unsigned();
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
        Schema::drop('accounts');
    }
}
