<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class PekerjaanController extends Controller
{
    public function index()
    {
        return view('admin.pages.pekerjaan.index',[
            'title' => 'Data Pekerjaan'
        ]);
    }

    public function data()
    {
        if(request()->ajax())
        {
            $data = Pekerjaan::query();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($model){
                        $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-nama='$model->nama'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-nama='$model->nama'><i class='fas fa fa-trash'></i> Hapus</button>";
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
            'nama' => ['required',Rule::unique('pekerjaan')->ignore(request('id'))]
        ]);

        Pekerjaan::updateOrCreate([
            'id'  => request('id')
        ],[
            'nama' => request('nama'),
        ]);

        if(request('id'))
        {
            $message = 'Data Pekerjaan berhasil disimpan.';
        }else{
            $message = 'Data Pekerjaan berhasil ditambahakan.';
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
        Pekerjaan::find($id)->delete();
        return response()->json(['status'=>'succcess','message' => 'Data Pekerjaan berhasil dihapus.']);
    }
}
