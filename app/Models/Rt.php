<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;
    protected $table = 'rt';
    protected $guarded = ['id'];

    public function rw()
    {
        return $this->belongsTo(Rw::class);
    }
}
