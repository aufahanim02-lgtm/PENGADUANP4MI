<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelUser extends Authenticatable
{
    protected $table = 'user';

    protected $primaryKey = 'iduser';

    protected $fillable = [
        'nama',
        'username',
        'password',
        'role',
        'aktif',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'aktif' => 'boolean',
        ];
    }

    // RELASI PENGADUAN YANG DITANGANI
    public function pengaduanDitangani(): HasMany
    {
        return $this->hasMany(
            ModelPengaduan::class,
            'iduser',
            'iduser'
        );
    }

    // RELASI TINDAK LANJUT
    public function tindaklanjut(): HasMany
    {
        return $this->hasMany(
            ModelTindaklanjut::class,
            'iduser',
            'iduser'
        );
    }
}
