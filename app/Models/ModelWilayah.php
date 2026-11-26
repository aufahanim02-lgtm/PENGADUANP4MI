<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelWilayah extends Model
{
    protected $table = 'wilayah';

    protected $primaryKey = 'idwilayah';

    protected $fillable = [
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'aktif' => 'boolean',
        ];
    }

    // Relasi ke tabel pengaduan
    public function pengaduan(): HasMany
    {
        return $this->hasMany(
            ModelPengaduan::class,
            'idwilayah',
            'idwilayah'
        );
    }
}
