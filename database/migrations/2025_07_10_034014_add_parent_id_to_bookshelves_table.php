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
        Schema::table('bookshelves', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned()->nullable()->after('image_id');
            $table->integer('depth')->unsigned()->default(0)->after('parent_id');
            
            $table->index('parent_id');
            $table->foreign('parent_id')
                  ->references('id')
                  ->on('bookshelves')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookshelves', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropIndex(['parent_id']);
            $table->dropColumn(['parent_id', 'depth']);
        });
    }
};