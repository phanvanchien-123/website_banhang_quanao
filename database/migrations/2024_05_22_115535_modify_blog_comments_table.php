<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyBlogCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_comments', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('name');

            $table->boolean('status')->default(1); // 1: Hiện, 0: Ẩn
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_comments', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('name')->nullable();

            $table->dropColumn('status');
        });
    }
}

