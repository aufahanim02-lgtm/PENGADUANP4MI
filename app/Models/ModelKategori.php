<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelKategori extends Model
{
    protected $table = 'kategori';

    protected $primaryKey = 'idkategori';

    protected $fillable = [
        'nama',
        'deskripsi',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'aktif' => 'boolean',
        ];
    }

    public function pengaduan(): HasMany
    {
        return $this->hasMany(ModelPengaduan::class, 'idkategori', 'idkategori');
    }
}
