<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessSendMail;
use Form;
use DataTables;
use Carbon\Carbon;
use App\Eloquent\Jabatan;
use App\Eloquent\JenisKelamin;
use App\Eloquent\PegawaiStatus;
use App\Eloquent\Pegawai;
use App\Eloquent\MesinUsers;
use App\User;



class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pegawai.index');
    }

    public function getDtRowData(Request $request)
    {
        $pegawai = Pegawai::GetData();
        return Datatables::of($pegawai)
            ->addColumn('action', function ($row) {
                $btnEdit = '<a href="' . route('pegawai.edit', $row->pegawai_id) . '" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $btnDelete = Form::open(['method' => 'DELETE','route' => ['pegawai.destroy', $row->pegawai_id],'style'=>'display:inline', 'id' => 'formDestroy' .  $row->pegawai_id])
                            . '<button type="button" class="btn btn-danger btn-sm destroyData" data-id="' . $row->pegawai_id . '">'
                            . '<i class="fa fa-trash"></i> Delete'
                            . '</button>'
                            . Form::close();
                return $btnEdit . ' ' . $btnDelete;
            })
            ->editColumn('pegawai_id', '{{$pegawai_id}}')
            ->editColumn('created_at', '{{ Carbon\Carbon::parse($created_at)->diffForHumans() }}')
            ->editColumn('updated_at', '{{ Carbon\Carbon::parse($updated_at)->diffForHumans() }}')
            ->editColumn('tgl_mulai_bekerja', '{{ Carbon\Carbon::parse($tgl_mulai_bekerja)->diffForHumans() }}')
            ->setRowId('pegawai_id')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mesinUsers = MesinUsers::dropdown();
        $jabatan = Jabatan::dropdown();
        $jenisKelamin = JenisKelamin::dropdown();
        $pegawaiStatus = PegawaiStatus::dropdown();
        return view('backend.pegawai.create', compact('jabatan', 'jenisKelamin', 'pegawaiStatus', 'mesinUsers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nama' => 'required',
            'no_ktp' => 'required',
            'jenis_kelamin_id' => 'required',
            'alamat' => 'required',
            'jabatan_id' => 'required',
            'tgl_mulai_bekerja' => 'required',
            'pegawai_status_id' => 'required',
            'tgl_berhenti' => ''
        ]);
        $complete = TRUE;
        $messageError = array();
        try {
          $password = str_random(10);
          $user = User::create([
              'name' => $request->nama,
              'email' => $request->email,
              'password' => bcrypt($password)
          ]);
          $pegawai = new Pegawai();
          $pegawai->mesin_user_id = $request->mesin_user_id;
          $pegawai->nama = $request->nama;
          $pegawai->no_ktp = str_replace('-', '', $request->no_ktp);
          $pegawai->jabatan_id = $request->jabatan_id;
          $pegawai->jenis_kelamin_id = $request->jenis_kelamin_id;
          $pegawai->email = $request->email;
          $pegawai->alamat = $request->alamat;
          $pegawai->tgl_mulai_bekerja = $request->tgl_mulai_bekerja;
          $pegawai->tgl_berhenti = (empty($request->tgl_berhenti) ? NULL : $request->tgl_berhenti);
          $pegawai->pegawai_status_id = $request->pegawai_status_id;
          $pegawai->user_id = $user->user_id;
          $pegawai->save();

          #send account from email
          $contentMail = [
              'name' => $request->nama,
              'username' => $request->email,
              'password' => $password,
              'type_mail' => 'pegawai_baru',
              'to' => $request->email
          ];
        } catch (\Exception $e) {
          $messageError[] = $e->getMessage();
          $complete = FALSE;
        }
        try {
          ProcessSendMail::dispatch($contentMail)->delay(now()->addMinutes(1));
        } catch (\Exception $e) {
          $messageError[] = 'Problem Send Email. Please Check Configuration Mail.';
        }
        if(count($messageError) > 0) {
          $request->session()->flash('error', implode('. ', $messageError));
        }
        if($complete) {
          $request->session()->flash('success', 'Data sudah ter-update.');
        }
        return redirect()->route('pegawai.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mesinUsers = MesinUsers::dropdown();
        $jabatan = Jabatan::dropdown();
        $jenisKelamin = JenisKelamin::dropdown();
        $pegawaiStatus = PegawaiStatus::dropdown();
        $pegawai = Pegawai::find($id);
        return view('backend.pegawai.edit', compact('pegawai', 'jabatan', 'jenisKelamin', 'pegawaiStatus', 'mesinUsers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'nama' => 'required',
            'no_ktp' => 'required',
            'jenis_kelamin_id' => 'required',
            'alamat' => 'required',
            'jabatan_id' => 'required',
            'tgl_mulai_bekerja' => 'required',
            'pegawai_status_id' => 'required',
            'tgl_berhenti' => ''
        ]);
        Pegawai::find($id)->update($request->all());
        return redirect()->route('pegawai.index')->with('success', 'Pegawai updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pegawai::find($id)->delete();
        return redirect()->route('pegawai.index')->with('success', 'Pegawai deleted successfully');
    }
}
