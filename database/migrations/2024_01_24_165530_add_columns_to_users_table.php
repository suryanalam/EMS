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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('avatar', 'photo');
            $table->dropColumn('email_verified_at');
            $table->dropColumn('remember_token');
            $table->enum('status',['verified', 'not verified'])->after('password')->nullable();
            $table->string('token')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('photo', 'avatar');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->dropColumn('status');
            $table->dropColumn('token');
        });
    }
};
