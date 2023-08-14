<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KandidatModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kandidat';
    protected $guarded = [];

    public function ketua()
    {
        return $this->belongsTo(User::class, 'id_ketua');
    }

    public function wakil()
    {
        return $this->belongsTo(User::class, 'id_wakil');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeModel::class, 'id_periode');
    }
}
