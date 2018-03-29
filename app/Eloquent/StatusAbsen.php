<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StatusAbsen extends Model
{
    use SoftDeletes;
    protected $table = 'status_absen';
    protected $primaryKey = 'status_absen_id';
    protected $fillable = ['nama'];
    protected $dates = ['deleted_at'];
}
