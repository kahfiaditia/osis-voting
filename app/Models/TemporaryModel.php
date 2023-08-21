<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemporaryModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'temporary_file';
    protected $guarded = [];
}
