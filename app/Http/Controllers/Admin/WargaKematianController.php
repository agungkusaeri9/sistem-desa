<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WargaKematian;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class WargaKematianController extends Controller
{
    public function index()
    {
        return view('admin.pages.warga-kematian.index',[
            'title' => 'Data Kematian'
        ]);
    }

    public function data()
    {
        if(request()->ajax())
        {
            $data = WargaKematian::query();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($model){
                        $action = "<button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-warga='$model->warga_id' data-tanggal='$model->tanggal' data-penyebab='$model->penyebab' data-tempat='$model->tempat_meninggal' data-status='$model->status'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-nama='$model->nama'><i class='fas fa fa-trash'></i> Hapus</button>";
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
            'warga_id' => ['required',Rule::unique('warga_kematian')->ignore(request('id'))],
            'tanggal' => ['required','date'],
            'penyebab' => ['required','max:255'],
            'tempat_meninggal' => ['required','max:255'],
            'status' => ['required']
        ]);

        WargaKematian::updateOrCreate([
            'id'  => request('id')
        ],[
            'warga_id' => request('warga_id'),
            'tanggal' => request('tanggal'),
            'penyebab' => request('penyebab'),
            'tempat_meninggal' => request('tempat_meninggal'),
            'status' => request('status')
        ]);

        if(request('id'))
        {
            $message = 'Data Meninggal berhasil disimpan.';
        }else{
            $message = 'Data Meninggal berhasil ditambahakan.';
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
        WargaKematian::find($id)->delete();
        return response()->json(['status'=>'succcess','message' => 'Data Meninggal berhasil dihapus.']);
    }

    public function get()
    {
        $items = WargaKematian::orderBy('nama','ASC')->get();
        return response()->json($items);
    }
}
