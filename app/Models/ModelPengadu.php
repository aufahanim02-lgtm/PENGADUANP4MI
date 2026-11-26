<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelPengadu extends Authenticatable
{
    protected $table = 'pengadu';

    protected $primaryKey = 'idpengadu';

    protected $rememberTokenName = 'rememberToken';

    protected $fillable = [
        'nama',
        'nik',
        'nohp',
        'alamat',
        'username',
        'password',
        'aktif',
    ];

    protected $hidden = [
        'password',
        'rememberToken',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'aktif' => 'boolean',
        ];
    }

    public function pmi(): HasMany
    {
        return $this->hasMany(
            ModelPmi::class,
            'idpengadu',
            'idpengadu'
        );
    }

    public function pengaduan(): HasMany
    {
        return $this->hasMany(
            ModelPengaduan::class,
            'idpengadu',
            'idpengadu'
        );
    }

    public function notifikasi(): HasMany
    {
        return $this->hasMany(
            ModelNotifikasi::class,
            'idpengadu',
            'idpengadu'
        );
    }
}
