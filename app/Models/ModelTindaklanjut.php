<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelTindaklanjut extends Model
{
    protected $table = 'tindaklanjut';

    protected $primaryKey = 'idtindaklanjut';

    protected $fillable = [
        'idpengaduan',
        'iduser',
        'keterangan',
        'status',
        'tanggal',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'datetime',
        ];
    }

    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(ModelPengaduan::class, 'idpengaduan', 'idpengaduan');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(ModelUser::class, 'iduser', 'iduser');
    }
}
