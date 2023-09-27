<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengikutModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'table_pengikut_data';
    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'id_pengikut');
    }
}
