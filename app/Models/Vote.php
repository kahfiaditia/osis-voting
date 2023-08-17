<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'vote';
    protected $guarded = [];

    public function kandidat()
    {
        return $this->belongsTo(KandidatModel::class, 'id_kandidat');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeModel::class, 'id_periode');
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'id_user_vote');
    }
}
