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
        Schema::table('employees', function (Blueprint $table) {
            $table->string('photo')->after('eid')->nullable();
            $table->enum('status',['verified', 'not verified'])->after('contactNo');
            $table->enum('role',['senior manager','senior team lead','team lead','bda', 'intern'])->after('deptId')->nullable();
            $table->string('token')->after('deptId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('_employees', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('role');
            $table->dropColumn('token');
        });
    }
};
