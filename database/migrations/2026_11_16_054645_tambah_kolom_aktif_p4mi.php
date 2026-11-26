
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->boolean('aktif')->default(true);
        });

        Schema::table('pengadu', function (Blueprint $table) {
            $table->boolean('aktif')->default(true);
        });

        Schema::table('kategori', function (Blueprint $table) {
            $table->boolean('aktif')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('kategori', function (Blueprint $table) {
            $table->dropColumn('aktif');
        });

        Schema::table('pengadu', function (Blueprint $table) {
            $table->dropColumn('aktif');
        });

        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('aktif');
        });
    }
};
