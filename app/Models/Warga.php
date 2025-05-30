<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;
    protected $table = 'warga';
    protected $guarded = ['id'];
    public $dates = ['tanggal_lahir'];

    public function jenis_kelamin()
    {
        if ($this->jenis_kelamin === 'L') {
            return 'Laki-laki';
        } else {
            return 'Perempuan';
        }
    }

    public function rt()
    {
        return $this->belongsTo(Rt::class);
    }

    public function rw()
    {
        return $this->belongsTo(Rw::class);
    }


    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }
    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }

    public function kartu_keluarga()
    {
        return $this->hasOne(KartuKeluargaWarga::class, 'warga_id', 'id');
    }

    public function tanggal_lahir()
    {
        if ($this->tanggal_lahir) {
            return $this->tanggal_lahir->translatedFormat('m-d-Y');
        } else {
            return '-';
        }
    }

    public function kematian()
    {
        return $this->hasMany(WargaKematian::class);
    }
}
