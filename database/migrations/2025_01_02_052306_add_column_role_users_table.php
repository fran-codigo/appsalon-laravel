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

            // Restaurar la columna
            $table->unsignedBigInteger('role_id')->default(1);

            // Restaurar la clave foránea
            $table->foreign('role_id')->references('id')->on('role_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar la clave foránea primero
            $table->dropForeign('users_role_id_foreign');

            // Luego eliminar la columna
            $table->dropColumn('role_id');
        });
    }
};
