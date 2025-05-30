<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    use HasFactory;
    protected $table = 'kartu_keluarga';
    protected $guarded = ['id'];
    public function rw()
    {
        return $this->belongsTo(Rw::class,'rw_id','id');
    }
    public function rt()
    {
        return $this->belongsTo(Rt::class,'rt_id','id');
    }

    public function kepala_keluarga()
    {
        return $this->belongsTo(Warga::class,'kepala_keluarga_id','id');
    }

    public function anggota_keluarga()
    {
        return $this->belongsToMany(Warga::class);
    }
}
