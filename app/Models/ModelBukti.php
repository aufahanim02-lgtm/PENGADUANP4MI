<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelBukti extends Model
{
    protected $table = 'bukti';

    protected $primaryKey = 'idbukti';

    protected $fillable = [
        'idpengaduan',
        'namafile',
        'pathfile',
        'jenisfile',
        'ukuranfile',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'ukuranfile' => 'integer',
        ];
    }

    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(ModelPengaduan::class, 'idpengaduan', 'idpengaduan');
    }
}
