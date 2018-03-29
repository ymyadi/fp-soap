<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class Mesin extends Model
{
    use SoftDeletes;
    protected $table = 'mesin';
    protected $primaryKey = 'mesin_id';
    protected $fillable = ['nama', 'ip', 'is_default', 'password'];
    protected $dates = ['deleted_at'];
}
