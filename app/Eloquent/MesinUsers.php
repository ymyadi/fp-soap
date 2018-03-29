<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MesinUsers extends Model
{
    use SoftDeletes;
    protected $table = 'mesin_users';
    protected $primaryKey = 'mesin_user_id';
    protected $fillable = ['nama', 'user_id'];
    protected $dates = ['deleted_at'];

    function scopeDropdown() {
        $mesinUsers = MesinUsers::all();
        $data = array();
        foreach ($mesinUsers as $row):
            $data[$row->mesin_user_id] = $row->nama;
        endforeach;
        return $data;
    }
}
