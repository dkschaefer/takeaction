<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrivacyToPetitions extends Migration
{

    public function up()
    {
        Schema::table('petitions', function (Blueprint $table) {
            // adds a column to represent Private vs. Public petitions
            $table->boolean('private')->default(0);
        });
    }

    public function down()
    {
        Schema::table('petitions', function (Blueprint $table) {
            //
        });
    }
}
