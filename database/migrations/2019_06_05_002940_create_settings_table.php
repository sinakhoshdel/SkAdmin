<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_name');
            $table->string('site_email');
            $table->string('site_logo');
            $table->string('admin_logo');
            $table->string('fav_icon');
            $table->string('site_tags')->nullable();
            $table->text('site_description')->nullable();
            $table->timestamps();
        });

        DB::table('settings')->insert(
            array(
                'site_name' => 'SK Laravel',
                'site_email' => 's.khoshdel66@gmail.com',
                'site_logo' => 'images/logo.png',
                'admin_logo' => 'images/logo.png',
                'fav_icon' => 'images/favicon.ico',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
