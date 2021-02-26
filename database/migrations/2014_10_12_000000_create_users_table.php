<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->string('first_name');
						$table->string('last_name');
						$table->string('image_name')->nullable();
						$table->string('phone_number')->nullable();
						$table->string('email')->unique();
						$table->string('username')->unique();
						$table->string('password');
						$table->text('address')->nullable();
						$table->float('latitude', 9, 6)->nullable();
						$table->float('longitude', 9, 6)->nullable();
						$table->boolean('is_admin')->default(false);
						$table->boolean('is_agent')->default(false);
						$table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
