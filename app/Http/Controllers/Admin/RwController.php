<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rw;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class RwController extends Controller
{
    public function index()
    {
        return view('admin.pages.rw.index',[
            'title' => 'Data RW'
        ]);
    }

    public function data()
    {
        if(request()->ajax())
        {
            $data = Rw::query();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($model){
                        $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-nomor='$model->nomor'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-nomor='$model->nomor'><i class='fas fa fa-trash'></i> Hapus</button>";
                        return $action;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
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
            'nomor' => ['required',Rule::unique('rw')->ignore(request('id'))]
        ]);

        Rw::updateOrCreate([
            'id'  => request('id')
        ],[
            'nomor' => request('nomor'),
        ]);

        if(request('id'))
        {
            $message = 'Data Rw berhasil disimpan.';
        }else{
            $message = 'Data Rw berhasil ditambahakan.';
        }
        return response()->json(['status'=>'succcess','message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rw::find($id)->delete();
        return response()->json(['status'=>'succcess','message' => 'Data Rw berhasil dihapus.']);
    }

    public function get()
    {
        if(request()->ajax())
        {
            $rw = Rw::orderBy('nomor','ASC')->get();
            return response()->json($rw);
        }
    }
}
