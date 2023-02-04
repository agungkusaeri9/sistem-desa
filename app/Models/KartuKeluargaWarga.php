<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuKeluargaWarga extends Model
{
    use HasFactory;
    protected $table = 'kartu_keluarga_warga';
    protected $guarded = ['id'];
    // protected $primaryKey = ['kartu_keluarga_id','warga_id'];

    public function kartu_keluarga()
    {
        return $this->belongsTo(KartuKeluarga::class);
    }
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
