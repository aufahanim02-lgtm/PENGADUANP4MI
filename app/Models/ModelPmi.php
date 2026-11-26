<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelPmi extends Model
{
    protected $table = 'pmi';

    protected $primaryKey = 'idpmi';

    protected $fillable = [
        'idpengadu',
        'nama',
        'nik',
        'jeniskelamin',
        'tanggallahir',
        'nohp',
        'negara',
        'perusahaan',
        'alamatkerja',
        'statuspmi',
    ];

    protected function casts(): array
    {
        return [
            'tanggallahir' => 'date',
        ];
    }

    public function pengadu(): BelongsTo
    {
        return $this->belongsTo(ModelPengadu::class, 'idpengadu', 'idpengadu');
    }

    public function pengaduan(): HasMany
    {
        return $this->hasMany(ModelPengaduan::class, 'idpmi', 'idpmi');
    }
}
