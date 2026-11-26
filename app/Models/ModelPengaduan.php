<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelPengaduan extends Model
{
    protected $table = 'pengaduan';

    protected $primaryKey = 'idpengaduan';

    protected $fillable = [
        'nomor_tiket',
        'idpengadu',
        'idpmi',
        'idkategori',
        'idwilayah',
        'iduser',
        'judul',
        'kronologi',
        'tanggalkejadian',
        'lokasikejadian',
        'status',
        'catatanpenolakan',
    ];

    protected function casts(): array
    {
        return [
            'tanggalkejadian' => 'date',
        ];
    }

    public function pengadu(): BelongsTo
    {
        return $this->belongsTo(ModelPengadu::class, 'idpengadu', 'idpengadu');
    }

    public function pmi(): BelongsTo
    {
        return $this->belongsTo(ModelPmi::class, 'idpmi', 'idpmi');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(ModelKategori::class, 'idkategori', 'idkategori');
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(ModelWilayah::class, 'idwilayah', 'idwilayah');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(ModelUser::class, 'iduser', 'iduser');
    }

    public function bukti(): HasMany
    {
        return $this->hasMany(ModelBukti::class, 'idpengaduan', 'idpengaduan');
    }

    public function tindaklanjut(): HasMany
    {
        return $this->hasMany(ModelTindaklanjut::class, 'idpengaduan', 'idpengaduan');
    }

    public function notifikasi(): HasMany
    {
        return $this->hasMany(ModelNotifikasi::class, 'idpengaduan', 'idpengaduan');
    }
}
