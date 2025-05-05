<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('appearances', function (Blueprint $table) {
            $table->string('instagram')->nullable()->after('background_color');
            $table->string('tiktok')->nullable()->after('instagram');
            $table->string('whatsapp')->nullable()->after('tiktok');
        });
    }

    public function down()
    {
        Schema::table('appearances', function (Blueprint $table) {
            $table->dropColumn(['instagram', 'tiktok', 'whatsapp']);
        });
    }
}; 