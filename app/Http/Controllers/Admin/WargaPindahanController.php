<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WargaPindahan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class WargaPindahanController extends Controller
{
    public function index()
    {
        return view('admin.pages.warga-pindahan.index',[
            'title' => 'Data Kematian'
        ]);
    }

    public function data()
    {
        if(request()->ajax())
        {
            $data = WargaPindahan::with(['warga']);
            return FacadesDataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($model){
                        $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-warga='$model->warga_id' ><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-nama='$model->nama'><i class='fas fa fa-trash'></i> Hapus</button>";
                        return $action;
                    })
                    ->addColumn('nik',function($model){
                        return $model->warga->nik;
                    })
                    ->addColumn('nama',function($model){
                        return $model->warga->nama;
                    })
                    ->editColumn('tanggal', function($model){
                        return $model->tanggal->format('d-m-Y');
                    })
                    ->editColumn('status', function($model){
                        if($model->status == 1)
                        {
                            return '<span class="badge badge-success">Terverifikasi</span>';
                        }else{
                            return '<span class="badge badge-danger">Tidak Terverifikasi</span>';
                        }
                    })
                    ->rawColumns(['action','status'])
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
            'warga_id' => ['required',Rule::unique('warga_pindahan')->ignore(request('id'))],
            'tanggal' => ['required','date'],
            'alasan' => ['required','max:255'],
            'alamat_tujuan' => ['required','max:255'],
            'jalan' => ['required','max:255'],
            'desa_tujuan' => ['required','max:255'],
            'rt' => ['required','max:255'],
            'rw' => ['required','max:255'],
            'kabupaten' => ['required','max:255'],
            'kecamatan_tujuan' => ['required','max:255'],
            'provinsi' => ['required','max:255'],
            'status' => ['required']
        ]);

        WargaPindahan::updateOrCreate([
            'id'  => request('id')
        ],[
            'warga_id' => request('warga_id'),
            'tanggal' => request('tanggal'),
            'alasan' => request('alasan'),
            'alamat_tujuan' => request('alamat_tujuan'),
            'jalan' => request('jalan'),
            'desa_tujuan' => request('desa_tujuan'),
            'rt' => request('rt'),
            'rw' => request('rw'),
            'kabupaten' => request('kabupaten'),
            'kecamatan_tujuan' => request('kecamatan_tujuan'),
            'provinsi' => request('provinsi'),
            'status' => request('status')
        ]);

        if(request('id'))
        {
            $message = 'Data Pindahan berhasil disimpan.';
        }else{
            $message = 'Data Pindahan berhasil ditambahakan.';
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
        WargaPindahan::find($id)->delete();
        return response()->json(['status'=>'succcess','message' => 'Data Pindahan berhasil dihapus.']);
    }

    public function show()
    {
        if(request()->ajax()){
            $id = request('id');
            $pindahan = WargaPindahan::with(['warga'])->find($id);
            if($pindahan)
            {
                return response()->json($pindahan);
            }else{
                return response()->json([]);
            }
        }
    }
}
