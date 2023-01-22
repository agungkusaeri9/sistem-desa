<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BantuanSosial;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class BantuanSosialController extends Controller
{
    public function index()
    {
        return view('admin.pages.bantuan-sosial.index',[
            'title' => 'Data Bantuan Sosial'
        ]);
    }

    public function data()
    {
        if(request()->ajax())
        {
            $data = BantuanSosial::query();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($model){
                        $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-nama='$model->nama' data-deskripsi='$model->deskripsi' data-tahun='$model->tahun' data-periode='$model->periode'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-nama='$model->nama'><i class='fas fa fa-trash'></i> Hapus</button>";
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
            'nama' => ['required',Rule::unique('bantuan_sosial')->ignore(request('id'))],
            'deskripsi' => ['required','max:255'],
            'tahun' => ['required','numeric','digits:4'],
            'periode' => ['required']
        ]);

        BantuanSosial::updateOrCreate([
            'id'  => request('id')
        ],[
            'nama' => request('nama'),
            'deskripsi' => request('deskripsi'),
            'tahun' => request('tahun'),
            'periode' => request('periode')
        ]);

        if(request('id'))
        {
            $message = 'Data Bantuan Sosial berhasil disimpan.';
        }else{
            $message = 'Data Bantuan Sosial berhasil ditambahakan.';
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
        BantuanSosial::find($id)->delete();
        return response()->json(['status'=>'succcess','message' => 'Data Bantuan Sosial berhasil dihapus.']);
    }
}
