<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrivacyToPetitions extends Migration
{

    public function up()
    {
        Schema::table('petitions', function (Blueprint $table) {
            // TO-DO : adds a column to represent Private vs. Public petitions. Default petition value is 'Public'
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
