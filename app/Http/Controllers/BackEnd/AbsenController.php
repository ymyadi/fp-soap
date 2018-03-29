<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Form;
use DataTables;
use Response;
use App\Eloquent\AbsenLog;
use App\Eloquent\Absen;
use App\Eloquent\Pegawai;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.absen.index');
    
    }

    public function getDtRowDataAbsen(Request $request)
    {
        $absen = Absen::select(['absen_id', 'pegawai_id', 'check_in', 'check_out', 'work_hours', 'created_at', 'updated_at']);

        return Datatables::of($absen)
            ->editColumn('nama_pegawai', function($row) {
                return $row->pegawai->nama;
            })
            ->editColumn('created_at', '{{ Carbon\Carbon::parse($created_at)->diffForHumans() }}')
            ->editColumn('updated_at', '{{ Carbon\Carbon::parse($updated_at)->diffForHumans() }}')
            ->setRowId('absen_id')
            ->make(true);
    }

    public function absenLog() 
    {
        return view('backend.absen.index_log');
    }

    public function getDtRowDataAbsenLog(Request $request)
    {
        $absenLogs = AbsenLog::select(['mesin_id', 'pin', 'date_time', 'ver', 'status_absen_id', 'created_at', 'updated_at']);

        return Datatables::of($absenLogs)
            ->editColumn('status_absen_id', function($row) {
                return $row->statusAbsen->nama;
            })
            ->editColumn('created_at', '{{ Carbon\Carbon::parse($created_at)->diffForHumans() }}')
            ->editColumn('updated_at', '{{ Carbon\Carbon::parse($updated_at)->diffForHumans() }}')
            ->setRowId('absen_log_id')
            ->make(true);
    }

    public function syncData(Request $request) {
        $absenLog = new AbsenLog();
        $sync = $absenLog->syncData();
        $message = 'Data Gagal di tarik.';
        if($sync):
            $message = 'Data Berhasil di tarik.';
        endif;
        return response()->json([
            'message' => $message
        ]);
    }

    public function syncDataFromLogModal(Request $request) {
        $year = array();
        for($i = date('Y') - 1;$i <= date('Y'); $i++):
            $year[$i] = $i;
        endfor;
        return response()->json([
            'success' => true, 
            'payload' => (String) view('backend.absen.modal-sync_absen', compact('year'))
        ]);
    }

    public function syncDataFromLog(Request $request) {
        $month = sprintf('%02s',$request->month);
        $countData = 0;
        $absenLog = new AbsenLog;
        $getSumAbsenLog = $absenLog->getSummaryDataLogAbsensi($month, $request->year);
        foreach($getSumAbsenLog as $row):
            $getDataPegawai = Pegawai::where('mesin_user_id', '=', $row->pin)->first();
            if(isset($getDataPegawai->pegawai_id)):
                $pegawai_id = $getDataPegawai->pegawai_id;
                $absen = new Absen;
                $absen->pegawai_id = $pegawai_id;
                $absen->check_in = $row->check_in;
                $absen->check_out = $row->check_out;
                $absen->work_hours = $row->work_hours;
                $absen->save();
                $countData++;
            endif;
        endforeach;
        $absenLogUpdateProcessed = new absenLog;
        $absenLogUpdateProcessed->updateProcessed($month, $request->year);
        if($countData > 0):
            $request->session()->flash('success', '<b>' . $countData . '</b> Data Berhasil Di Sinkron.');
        else:
            $request->session()->flash('error', 'Data sudah ter-update.');
        endif;
        return redirect()->route('absen.index');
    }
    
}
