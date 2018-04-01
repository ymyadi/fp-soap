<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Form;
use DataTables;
use Carbon\Carbon;
use App\Eloquent\MesinUsers;
use App\Eloquent\Mesin;

class MesinUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.mesinUser.index');
    }

    public function getDtRowData(Request $request)
    {
        $users = MesinUsers::select(['mesin_user_id', 'mesin_id', 'nama', 'user_id', 'created_at', 'updated_at']);

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                $btnEdit = '<a href="' . route('mesin-user.edit', $user->mesin_user_id) . '" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $btnDelete = Form::open(['method' => 'DELETE','route' => ['mesin-user.destroy', $user->mesin_user_id], 'style'=>'display:inline', 'id' => 'formDestroy' .  $user->mesin_user_id])
                            . '<button type="button" class="btn btn-danger btn-sm destroyData" data-id="' . $user->mesin_user_id . '">'
                            . '<i class="fa fa-trash"></i> Delete'
                            . '</button>'
                            . Form::close();
                return $btnEdit . ' ' . $btnDelete;
            })
            ->editColumn('mesin_id', function($row) {
                return $row->mesin->nama;
            })
            ->editColumn('mesin_user_id', '{{$mesin_user_id}}')
            ->editColumn('created_at', '{{ Carbon\Carbon::parse($created_at)->diffForHumans() }}')
            ->editColumn('updated_at', '{{ Carbon\Carbon::parse($updated_at)->diffForHumans() }}')
            ->setRowId('mesin_user_id')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mesin = Mesin::dropdown();
        return view('backend.mesinUser.create', compact('mesin'));
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
            'mesin_id' => 'required',
            'nama' => 'required',
            'user_id' => 'required'
        ]);
        MesinUsers::create($request->all());
        return redirect()->route('mesin-user.index')->with('success', 'User Mesin created successfully');
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
        $mesin = Mesin::dropdown();
        $user = MesinUsers::find($id);
        return view('backend.mesinUser.edit', compact('mesin', 'user'));
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
            'mesin_id' => 'required',
            'nama' => 'required',
            'user_id' => 'required'
        ]);
        MesinUsers::find($id)->update($request->all());
        return redirect()->route('mesin-user.index')->with('success', 'User Mesin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MesinUsers::find($id)->delete();
        return redirect()->route('mesin-user.index')->with('success', 'User Mesin deleted successfully');
    }
}
