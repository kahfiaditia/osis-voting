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
        return $this->belongsTo(Kandidat::class, 'id_kandidat');
    }
}
