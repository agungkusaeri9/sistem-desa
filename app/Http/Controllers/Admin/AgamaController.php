<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agama;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class AgamaController extends Controller
{
    public function index()
    {
        return view('admin.pages.agama.index',[
            'title' => 'Data Agama'
        ]);
    }

    public function data()
    {
        if(request()->ajax())
        {
            $data = Agama::query();
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
            'nama' => ['required',Rule::unique('agama')->ignore(request('id'))]
        ]);

        Agama::updateOrCreate([
            'id'  => request('id')
        ],[
            'nama' => request('nama'),
        ]);

        if(request('id'))
        {
            $message = 'Data Agama berhasil disimpan.';
        }else{
            $message = 'Data Agama berhasil ditambahakan.';
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
        Agama::find($id)->delete();
        return response()->json(['status'=>'succcess','message' => 'Data Agama berhasil dihapus.']);
    }

    public function get()
    {
        $items = Agama::orderBy('nama','ASC')->get();
        return response()->json($items);
    }
}
