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
    protected $fillable = ['nama', 'ip', 'is_default', 'port', 'password'];
    protected $dates = ['deleted_at'];

    function scopeDropdown() {
        $mesin = Mesin::all();
        $data = array();
        foreach ($mesin as $row):
            $data[$row->mesin_id] = $row->nama;
        endforeach;
        return $data;
    }
}
