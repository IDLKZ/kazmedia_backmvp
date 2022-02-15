<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("role_id")->references("id")->on("roles")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("type_id")->nullable()->references("id")->on("user_types")->cascadeOnUpdate()->onDelete("set null");
            $table->string('name',255);
            $table->string("phone")->nullable();
            $table->string("bin")->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer("status")->default(0);
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
};
