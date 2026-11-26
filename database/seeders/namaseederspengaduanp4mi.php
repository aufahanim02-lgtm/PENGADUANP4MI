<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class namaseederspengaduanp4mi extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            /*
            |--------------------------------------------------------------------------
            | 1. DATA AKUN ADMIN DAN PETUGAS
            |--------------------------------------------------------------------------
            */

            $user = [
                [
                    'username' => 'admin',
                    'nama' => 'Administrator P4MI',
                    'password' => Hash::make('123'),
                    'role' => 'admin',
                    'aktif' => true,
                ],
                [
                    'username' => 'petugas',
                    'nama' => 'Petugas P4MI',
                    'password' => Hash::make('123'),
                    'role' => 'petugas',
                    'aktif' => true,
                ],
            ];

            foreach ($user as $item) {
                DB::table('user')->updateOrInsert(
                    ['username' => $item['username']],
                    [
                        'nama' => $item['nama'],
                        'password' => $item['password'],
                        'role' => $item['role'],
                        'aktif' => $item['aktif'],
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            }


            /*
            |--------------------------------------------------------------------------
            | 2. DATA AKUN PENGADU
            |--------------------------------------------------------------------------
            */

            $pengadu = [
                [
                    'nama' => 'Ahmad Fauzi',
                    'nik' => '1101011201900001',
                    'nohp' => '081234567801',
                    'alamat' => 'Aceh Tamiang',
                    'username' => 'pengadu1',
                ],
                [
                    'nama' => 'Siti Rahma',
                    'nik' => '1101014502950002',
                    'nohp' => '081234567802',
                    'alamat' => 'Kuala Simpang',
                    'username' => 'pengadu2',
                ],
                [
                    'nama' => 'Muhammad Rizki',
                    'nik' => '1101011508980003',
                    'nohp' => '081234567803',
                    'alamat' => 'Karang Baru',
                    'username' => 'pengadu3',
                ],
                [
                    'nama' => 'Nurul Aini',
                    'nik' => '1101015803990004',
                    'nohp' => '081234567804',
                    'alamat' => 'Rantau',
                    'username' => 'pengadu4',
                ],
                [
                    'nama' => 'Dedi Saputra',
                    'nik' => '1101012001950005',
                    'nohp' => '081234567805',
                    'alamat' => 'Manyak Payed',
                    'username' => 'pengadu5',
                ],
            ];

            foreach ($pengadu as $item) {
                DB::table('pengadu')->updateOrInsert(
                    ['username' => $item['username']],
                    [
                        'nama' => $item['nama'],
                        'nik' => $item['nik'],
                        'nohp' => $item['nohp'],
                        'alamat' => $item['alamat'],
                        'password' => Hash::make('123'),
                        'aktif' => true,
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            }


            /*
            |--------------------------------------------------------------------------
            | 3. DATA KATEGORI PENGADUAN
            |--------------------------------------------------------------------------
            */

            $kategori = [
                [
                    'namakategori' => 'Gaji Tidak Dibayar',
                    'keterangan' => 'Permasalahan pembayaran gaji atau upah PMI.',
                ],
                [
                    'namakategori' => 'Kekerasan atau Penyiksaan',
                    'keterangan' => 'Laporan kekerasan fisik, verbal, atau perlakuan tidak manusiawi.',
                ],
                [
                    'namakategori' => 'Penahanan Paspor atau Dokumen',
                    'keterangan' => 'Permasalahan penahanan paspor dan dokumen pribadi PMI.',
                ],
                [
                    'namakategori' => 'Masalah Kontrak Kerja',
                    'keterangan' => 'Permasalahan perjanjian atau ketidaksesuaian kontrak kerja.',
                ],
                [
                    'namakategori' => 'Pemutusan Hubungan Kerja',
                    'keterangan' => 'Permasalahan pemutusan hubungan kerja PMI.',
                ],
                [
                    'namakategori' => 'PMI Sakit atau Kecelakaan',
                    'keterangan' => 'Laporan PMI yang mengalami sakit atau kecelakaan kerja.',
                ],
                [
                    'namakategori' => 'PMI Hilang Kontak',
                    'keterangan' => 'Laporan PMI yang sulit dihubungi atau tidak diketahui keberadaannya.',
                ],
                [
                    'namakategori' => 'Permasalahan Keberangkatan',
                    'keterangan' => 'Permasalahan yang terjadi sebelum atau saat keberangkatan PMI.',
                ],
                [
                    'namakategori' => 'Permasalahan Kepulangan',
                    'keterangan' => 'Permasalahan yang terjadi saat proses kepulangan PMI.',
                ],
                [
                    'namakategori' => 'Lainnya',
                    'keterangan' => 'Permasalahan lain yang berkaitan dengan perlindungan PMI.',
                ],
            ];

            foreach ($kategori as $item) {
                DB::table('kategori')->updateOrInsert(
                    ['namakategori' => $item['namakategori']],
                    [
                        'keterangan' => $item['keterangan'],
                        'aktif' => true,
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            }
        });
    }
}
