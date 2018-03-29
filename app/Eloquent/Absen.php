<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class Absen extends Model
{
    use SoftDeletes;
    protected $table = 'absen';
    protected $primaryKey = 'absen_id';
    protected $fillable = ['pegawai_id', 'check_in', 'check_out', 'work_hours'];
    protected $dates = ['deleted_at'];

    public function pegawai() {
        return $this->belongsTo('App\Eloquent\Pegawai', 'pegawai_id');
    }
}
