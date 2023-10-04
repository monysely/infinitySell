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
        Schema::table('article_images', function (Blueprint $table) {
            $table->text('labels')->nullable()->after('article_id');
            $table->string('adult')->nullable()->after('labels');
            $table->string('spoof')->nullable()->after('adult');
            $table->string('medical')->nullable()->after('spoof');
            $table->string('violence')->nullable()->after('medical');
            $table->string('racy')->nullable()->after('violence');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_images', function (Blueprint $table) {
            $table->dropColumn(['labels', 'adult', 'spoof', 'medical', 'violence', 'racy']);
        });
    }
};
