<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class Jabatan extends Model
{
    use SoftDeletes;
    protected $table = 'jabatan';
    protected $primaryKey = 'jabatan_id';
    protected $fillable = ['nama'];
    protected $dates = ['deleted_at'];

    function scopeDropdown() {
        $jabatan = Jabatan::all();
        $data = array();
        foreach ($jabatan as $row):
            $data[$row->jabatan_id] = $row->nama;
        endforeach;
        return $data;
    }
    
}
