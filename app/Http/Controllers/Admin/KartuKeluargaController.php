<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KartuKeluarga;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class KartuKeluargaController extends Controller
{
    public function index()
    {
        return view('admin.pages.kartu-keluarga.index',[
            'title' => 'Data Kartu Keluarga'
        ]);
    }

    public function data()
    {
        if(request()->ajax())
        {
            $data = KartuKeluarga::with(['rw','rt']);
            return FacadesDataTables::eloquent($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($model){
                        $action = "<button class='btn btn-sm btn-warning btnDetail mx-1' data-id='$model->id'><i class='fas fa fa-eye'></i> Detail</button>
                        <button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id'><i class='fas fa fa-trash'></i> Hapus</button>";
                        return $action;
                    })
                    ->addColumn('rt_rw', function($model){
                        return $model->rt->nomor. '/' . $model->rw->nomor;
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
            'no_kartu_keluarga' => ['required','numeric',Rule::unique('kartu_keluarga')->ignore(request('id'))],
            'nama_kepala_keluarga' => ['required'],
            'alamat' => ['required','max:255'],
            'rw_id' => ['required','numeric'],
            'rt_id' => ['required','numeric'],
            'kode_pos' => ['required','numeric'],
            'desa' => ['required'],
            'kecamatan' => ['required'],
            'kabupaten' => ['required'],
            'provinsi' => ['required']
        ]);

        try {
            KartuKeluarga::updateOrCreate([
                'id'  => request('id')
            ],[
                'no_kartu_keluarga' => request('no_kartu_keluarga'),
                'nama_kepala_keluarga' => request('nama_kepala_keluarga'),
                'alamat' => request('alamat'),
                'rw_id' => request('rw_id'),
                'rt_id' => request('rt_id'),
                'kode_pos' => request('kode_pos'),
                'desa' => request('desa'),
                'kecamatan' => request('kecamatan'),
                'kabupaten' => request('kabupaten'),
                'provinsi' => request('provinsi'),
            ]);

            if(request('id'))
            {
                $message = 'Data Kartu Keluarga berhasil disimpan.';
            }else{
                $message = 'Data Kartu Keluarga berhasil ditambahakan.';
            }
            return response()->json(['status'=>'succcess','message' => $message]);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'error','message' => 'Ada kesalahan di sistem.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KartuKeluarga::find($id)->delete();
        return response()->json(['status'=>'succcess','message' => 'Data Kartu Keluarga berhasil dihapus.']);
    }

    public function show()
    {
        if(request()->ajax()){
            $id = request('id');
            $kartu_keluarga = KartuKeluarga::with(['rw','rt'])->find($id);
            if($kartu_keluarga)
            {
                return response()->json($kartu_keluarga);
            }else{
                return response()->json([]);
            }
        }
    }
}
