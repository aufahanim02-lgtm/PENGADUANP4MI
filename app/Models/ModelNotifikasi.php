<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelNotifikasi extends Model
{
    protected $table = 'notifikasi';

    protected $primaryKey = 'idnotifikasi';

    protected $fillable = [
        'idpengadu',
        'idpengaduan',
        'judul',
        'pesan',
        'dibaca',
    ];

    protected function casts(): array
    {
        return [
            'dibaca' => 'boolean',
        ];
    }

    // Relasi ke Pengadu
    public function pengadu(): BelongsTo
    {
        return $this->belongsTo(
            ModelPengadu::class,
            'idpengadu',
            'idpengadu'
        );
    }

    // Relasi ke Pengaduan
    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(
            ModelPengaduan::class,
            'idpengaduan',
            'idpengaduan'
        );
    }
}
