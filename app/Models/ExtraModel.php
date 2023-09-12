<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtraModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ekstrakurikuler';
    protected $guarded = [];
}
