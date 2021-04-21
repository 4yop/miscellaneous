<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;
use Hyperf\DbConnection\Db;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('member', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',16)
                    ->nullable(false)
                    ->unique()
                    ->comment('用户名');
            $table->string('password',255)
                    ->nullable(false)
                    ->comment('密码');
            $table->timestamp('register_time')
                    ->nullable(false)
                    ->default(Db::raw('CURRENT_TIMESTAMP'))
                    ->comment('注册时间');
            $table->dateTime('last_login_time')
                    ->nullable(false)
                    ->comment('最后登录时间');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_member');
    }
}
