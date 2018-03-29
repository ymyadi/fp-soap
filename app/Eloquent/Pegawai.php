<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use DB;

class Pegawai extends Model
{
    use SoftDeletes;
    protected $table = 'pegawai';
    protected $tableUsers = 'users';
    protected $tableJenisKelamin = 'jenis_kelamin';
    protected $tableJabatan = 'jabatan';
    protected $tablePegawaiStatus = 'pegawai_status';
    protected $primaryKey = 'pegawai_id';
    protected $fillable = ['nama', 'user_id', 'jabatan_id', 'jenis_kelamin_id', 'no_ktp', 'alamat', 'tgl_mulai_bekerja', 'tgl_berhenti', 'pegawai_status_id'];
    protected $dates = ['deleted_at'];

    function scopeDropdown() {
        $pegawai = Pegawai::all();
        $data = array();
        foreach ($pegawai as $row):
            $data[$this->primaryKey] = $row->nama;
        endforeach;
        return $data;
    }

    function scopeGetData() {
        return DB::table($this->table . ' AS p')
                        ->join($this->tablePegawaiStatus . ' AS ps', 'p.pegawai_status_id', '=', 'ps.pegawai_status_id')
                        ->join($this->tableJabatan . ' AS j', 'p.jabatan_id', '=', 'j.jabatan_id')
                        ->join($this->tableJenisKelamin . ' AS jk', 'p.jenis_kelamin_id', '=', 'jk.jenis_kelamin_id')
                        ->join($this->tableUsers . ' AS u', 'p.user_id', '=', 'u.user_id')
                        ->select(DB::raw('p.*, ps.nama AS nama_pegawai_status, j.nama AS nama_jabatan, jk.nama AS nama_jenis_kelamin, u.name AS nama_user'))
                        ->whereNull('p.deleted_at')
                        ->get();
    }
}
