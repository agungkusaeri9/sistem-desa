<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class WargaController extends Controller
{
    public function index()
    {
        return view('admin.pages.warga.index', [
            'title' => 'Data Warga'
        ]);
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = Warga::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $action = "<button class='btn btn-sm btn-warning btnDetail mx-1' data-id='$model->id' data-nama='$model->nama'><i class='fas fa fa-eye'></i> Detail</button><button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id' data-nama='$model->nama'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id' data-nama='$model->nama'><i class='fas fa fa-trash'></i> Hapus</button>";
                    return $action;
                })
                ->editColumn('tempat_lahir', function ($model) {
                   if($model->tempat_lahir)
                   {
                    return $model->tempat_lahir;
                   }else{
                    return '-';
                   }
                })
                ->editColumn('alamat', function ($model) {
                    if($model->alamat)
                    {
                     return $model->alamat;
                    }else{
                     return '-';
                    }
                 })
                 ->editColumn('tanggal_lahir', function ($model) {
                    if($model->tanggal_lahir)
                    {
                     return $model->tanggal_lahir->translatedFormat('d-m-Y');
                    }else{
                     return '-';
                    }
                 })
                ->editColumn('jenis_kelamin', function ($model) {
                    return $model->jenis_kelamin();
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
            'nik' => ['required', 'numeric', Rule::unique('warga')->ignore(request('id'))],
            'nama' => ['required'],
            'jenis_kelamin' => ['required'],
            'rt_id' => ['required'],
            'rw_id' => ['required'],
            'agama_id' => ['required'],
            'pendidikan_id' => ['required'],
            'pekerjaan_id' => ['required'],
            'status_perkawinan' => ['required']
        ]);

        try {
            Warga::updateOrCreate([
                'id'  => request('id')
            ], [
                'nik' => request('nik'),
                'nama' => request('nama'),
                'jenis_kelamin' => request('jenis_kelamin'),
                'tempat_lahir' => request('tempat_lahir'),
                'tanggal_lahir' => request('tanggal_lahir'),
                'alamat' => request('alamat'),
                'agama_id' => request('agama_id'),
                'pendidikan_id' => request('pendidikan_id'),
                'pekerjaan_id' => request('pekerjaan_id'),
                'rw_id' => request('rw_id'),
                'rt_id' => request('rt_id'),
                'golongan_darah' => request('golongan_darah'),
                'status_hubungan' => request('status_hubungan'),
                'status_perkawinan' => request('status_perkawinan'),
                'tanggal_kawin' => request('tanggal_kawin'),
                'kewarganegaraan' => request('kewarganegaraan'),
                'no_paspor' => request('no_paspor'),
                'no_kitap' => request('no_kitap'),
                'nama_ayah' => request('nama_ayah'),
                'nama_ibu' => request('nama_ibu'),
            ]);

            if (request('id')) {
                $message = 'Data Warga berhasil disimpan.';
            } else {
                $message = 'Data Warga berhasil ditambahakan.';
            }
            return response()->json(['status' => 'success', 'message' => $message]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Mohon maaf terjadi masalah di sistem kami. Silahkan hubungi admin untuk lebih lanjut.']);
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
        Warga::find($id)->delete();
        return response()->json(['status' => 'succcess', 'message' => 'Data Warga berhasil dihapus.']);
    }

    public function show()
    {
        if(request()->ajax()){
            $warga_id = request('warga_id');
            $warga = Warga::with(['agama','pendidikan','pekerjaan','rt','rw'])->find($warga_id);
            if($warga)
            {
                if($warga->tanggal_lahir)
                {
                    $warga['tgl_lahir'] = $warga->tanggal_lahir->format('Y-m-d');
                }else{
                    $warga['tgl_lahir'] = '';
                }
                return response()->json($warga);
            }else{
                return response()->json([]);
            }
        }
    }

    public function get()
    {
        if(request()->ajax())
        {
            $warga = Warga::orderBy('nama','ASC')->get();
            return response()->json($warga);
        }
    }
}
