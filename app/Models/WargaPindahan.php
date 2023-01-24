<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WargaPindahan extends Model
{
    use HasFactory;
    protected $table = 'warga_pindahan';
    protected $guarded = ['id'];
    public $dates = ['tanggal'];
    public function warga()
    {
        return $this->belongsTo(Warga::class,'warga_id','id');
    }
}
