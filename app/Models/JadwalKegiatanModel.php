<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalKegiatanModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'table_jadwal_hari';
    protected $guarded = [];

    public function kegiatan()
    {
        return $this->belongsTo(ExtraModel::class, 'id_kegiatan');
    }

    public function pembina()
    {
        return $this->belongsTo(User::class, 'id_pembina');
    }

    public function hari()
    {
        return $this->belongsTo(HariModel::class, 'id_hari');
    }
}
