<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Form;
use DataTables;
use Carbon\Carbon;
use App\Eloquent\Mesin;

class MesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.mesin.index');
    }

    public function getDtRowData(Request $request)
    {
        $mesins = Mesin::select(['mesin_id', 'nama', 'ip', 'is_default', 'created_at', 'updated_at']);

        return Datatables::of($mesins)
            ->addColumn('action', function ($mesin) {
                $btnEdit = '<a href="' . route('mesin.edit', $mesin->mesin_id) . '" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $btnDelete = Form::open(['method' => 'DELETE','route' => ['mesin.destroy', $mesin->mesin_id], 'style'=>'display:inline', 'id' => 'formDestroy' .  $mesin->mesin_id])
                            . '<button type="button" class="btn btn-danger btn-sm destroyData" data-id="' . $mesin->mesin_id . '">'
                            . '<i class="fa fa-trash"></i> Delete'
                            . '</button>'
                            . Form::close();
                return $btnEdit . ' ' . $btnDelete;
            })
            ->editColumn('mesin_id', '{{$mesin_id}}')
            ->editColumn('is_default', '{{$is_default == 1 ? "Default" : "-"}}')
            ->editColumn('created_at', '{{ Carbon\Carbon::parse($created_at)->diffForHumans() }}')
            ->editColumn('updated_at', '{{ Carbon\Carbon::parse($updated_at)->diffForHumans() }}')
            ->setRowId('mesin_id')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.mesin.create');
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
            'ip' => 'required',
            'is_default' => 'required'
        ]);
        Mesin::create($request->all());
        return redirect()->route('mesin.index')->with('success', 'Mesin created successfully');
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
        $mesin = Mesin::find($id);
        return view('backend.mesin.edit', compact('mesin'));
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
            'ip' => 'required',
            'is_default' => 'required'
        ]);
        Mesin::find($id)->update($request->all());
        return redirect()->route('mesin.index')->with('success', 'Mesin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mesin::find($id)->delete();
        return redirect()->route('mesin.index')->with('success', 'Mesin deleted successfully');
    }
}
