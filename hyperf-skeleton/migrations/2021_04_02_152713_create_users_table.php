<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("username",20)->comment('用户名')->default('');
            $table->string("password")->comment('密码')->default('');
            $table->string("email")->comment('邮箱')->default('');
            $table->timestamp("last_login_at")->comment('最后登录时间');
            $table->boolean("is_ban")->default(false)->comment('是否封了');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
