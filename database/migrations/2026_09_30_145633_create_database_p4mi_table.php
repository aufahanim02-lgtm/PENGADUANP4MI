<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // =========================
        // TABEL USER
        // =========================
        Schema::create('user', function (Blueprint $table) {
            $table->id('iduser');
            $table->string('nama', 100);
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'petugas']);
            $table->timestamps();
        });

        // =========================
        // TABEL PENGADU
        // =========================
        Schema::create('pengadu', function (Blueprint $table) {
            $table->id('idpengadu');
            $table->string('nama', 100);
            $table->string('nik', 20)->unique();
            $table->string('nohp', 20);
            $table->text('alamat');
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->timestamps();
        });

        // =========================
        // TABEL KATEGORI
        // =========================
        Schema::create('kategori', function (Blueprint $table) {
            $table->id('idkategori');
            $table->string('namakategori', 100);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // =========================
        // TABEL WILAYAH
        // =========================
        Schema::create('wilayah', function (Blueprint $table) {
            $table->id('idwilayah');
            $table->string('provinsi', 100);
            $table->string('kabupaten', 100);
            $table->string('kecamatan', 100);
            $table->timestamps();
        });

        // =========================
        // TABEL PENGADUAN
        // =========================
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('idpengaduan');

            $table->unsignedBigInteger('idpengadu');
            $table->unsignedBigInteger('idkategori');
            $table->unsignedBigInteger('idwilayah');

            $table->string('judul', 200);
            $table->text('isi');
            $table->date('tanggal');
            $table->enum('status', [
                'diajukan',
                'diverifikasi',
                'diproses',
                'selesai',
                'ditolak'
            ])->default('diajukan');

            $table->timestamps();

            $table->foreign('idpengadu')
                ->references('idpengadu')
                ->on('pengadu')
                ->cascadeOnDelete();

            $table->foreign('idkategori')
                ->references('idkategori')
                ->on('kategori')
                ->restrictOnDelete();

            $table->foreign('idwilayah')
                ->references('idwilayah')
                ->on('wilayah')
                ->restrictOnDelete();
        });

        // =========================
        // TABEL PMI
        // =========================
        Schema::create('pmi', function (Blueprint $table) {
            $table->id('idpmi');

            $table->unsignedBigInteger('idpengadu');

            $table->string('nama', 100);
            $table->string('nik', 20)->unique();
            $table->string('nohp', 20);
            $table->text('alamat');
            $table->string('negara', 100);
            $table->enum('status', [
                'calon',
                'aktif',
                'pulang'
            ])->default('aktif');

            $table->timestamps();

            $table->foreign('idpengadu')
                ->references('idpengadu')
                ->on('pengadu')
                ->cascadeOnDelete();
        });

        // =========================
        // TABEL BUKTI
        // =========================
        Schema::create('bukti', function (Blueprint $table) {
            $table->id('idbukti');

            $table->unsignedBigInteger('idpengaduan');

            $table->string('namafile', 255);
            $table->string('keterangan', 255)->nullable();

            $table->timestamps();

            $table->foreign('idpengaduan')
                ->references('idpengaduan')
                ->on('pengaduan')
                ->cascadeOnDelete();
        });

        // =========================
        // TABEL TINDAK LANJUT
        // =========================
        Schema::create('tindaklanjut', function (Blueprint $table) {
            $table->id('idtindaklanjut');

            $table->unsignedBigInteger('idpengaduan');
            $table->unsignedBigInteger('iduser');

            $table->text('keterangan');
            $table->date('tanggal');

            $table->enum('status', [
                'diproses',
                'selesai'
            ])->default('diproses');

            $table->timestamps();

            $table->foreign('idpengaduan')
                ->references('idpengaduan')
                ->on('pengaduan')
                ->cascadeOnDelete();

            $table->foreign('iduser')
                ->references('iduser')
                ->on('user')
                ->restrictOnDelete();
        });

        // =========================
        // TABEL NOTIFIKASI
        // =========================
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id('idnotifikasi');

            $table->unsignedBigInteger('idpengaduan');
            $table->unsignedBigInteger('idpengadu');

            $table->string('judul', 200);
            $table->text('pesan');

            $table->boolean('dibaca')->default(false);

            $table->timestamps();

            $table->foreign('idpengaduan')
                ->references('idpengaduan')
                ->on('pengaduan')
                ->cascadeOnDelete();

            $table->foreign('idpengadu')
                ->references('idpengadu')
                ->on('pengadu')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('notifikasi');
        Schema::dropIfExists('tindaklanjut');
        Schema::dropIfExists('bukti');
        Schema::dropIfExists('pmi');
        Schema::dropIfExists('pengaduan');
        Schema::dropIfExists('wilayah');
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('pengadu');
        Schema::dropIfExists('user');

        Schema::enableForeignKeyConstraints();
    }
};