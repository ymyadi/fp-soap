<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PegawaiStatus extends Model
{
    use SoftDeletes;
    protected $table = 'pegawai_status';
    protected $primaryKey = 'pegawai_status_id';
    protected $fillable = ['nama'];
    protected $dates = ['deleted_at'];

    function scopeDropdown() {
        $pegawaiStatus = PegawaiStatus::all();
        $data = array();
        foreach ($pegawaiStatus as $row):
            $data[$row->pegawai_status_id] = $row->nama;
        endforeach;
        return $data;
    }
}
