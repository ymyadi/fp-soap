<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Form;
use DataTables;
use Carbon\Carbon;
use App\Eloquent\Jabatan;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.jabatan.index');
    }

    public function getDtRowData(Request $request)
    {
        $jabatans = Jabatan::select(['jabatan_id', 'nama', 'created_at', 'updated_at']);

        return Datatables::of($jabatans)
            ->addColumn('action', function ($jabatan) {
                $btnEdit = '<a href="' . route('jabatan.edit', $jabatan->jabatan_id) . '" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $btnDelete = Form::open(['method' => 'DELETE','route' => ['jabatan.destroy', $jabatan->jabatan_id], 'style'=>'display:inline', 'id' => 'formDestroy' .  $jabatan->jabatan_id])
                            . '<button type="button" class="btn btn-danger btn-sm destroyData" data-id="' . $jabatan->jabatan_id . '">'
                            . '<i class="fa fa-trash"></i> Delete'
                            . '</button>'
                            . Form::close();
                return $btnEdit . ' ' . $btnDelete;
            })
            ->editColumn('jabatan_id', '{{$jabatan_id}}')
            ->editColumn('created_at', '{{ Carbon\Carbon::parse($created_at)->diffForHumans() }}')
            ->editColumn('updated_at', '{{ Carbon\Carbon::parse($updated_at)->diffForHumans() }}')
            ->setRowId('jabatan_id')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.jabatan.create');
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
        ]);
        Jabatan::create($request->all());
        return redirect()->route('jabatan.index')->with('success', 'Jabatan created successfully');
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
        $jabatan = Jabatan::find($id);
        return view('backend.jabatan.edit', compact('jabatan'));
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
        ]);
        Jabatan::find($id)->update($request->all());
        return redirect()->route('jabatan.index')->with('success', 'Jabatan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jabatan::find($id)->delete();
        return redirect()->route('jabatan.index')->with('success', 'Jabatan deleted successfully');
    }
}
