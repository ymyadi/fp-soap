<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisKelamin extends Model
{
    use SoftDeletes;

    protected $table = 'jenis_kelamin';
    protected $primaryKey = 'jenis_kelamin_id';
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    function scopeDropdown() {
        $jenisKelamin = JenisKelamin::all();
        $data = array();
        foreach ($jenisKelamin as $row):
            $data[$row->jenis_kelamin_id] = $row->nama;
        endforeach;
        return $data;
    }
}
