<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KartuKeluarga;
use App\Models\KartuKeluargaWarga;
use App\Models\KartuKleuargaWarga;
use App\Models\Setting;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class KartuKeluargaController extends Controller
{
    public function index()
    {
        return view('admin.pages.kartu-keluarga.index', [
            'title' => 'Data Kartu Keluarga'
        ]);
    }

    public function data()
    {
        if (request()->ajax()) {
            $data = KartuKeluarga::with(['rw', 'rt', 'kepala_keluarga']);
            return FacadesDataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $detail = route('admin.kartu-keluarga.show', $model->id);
                    $action = "<a href='$detail' class='btn btn-sm btn-warning btnDetail mx-1' data-id='$model->id'><i class='fas fa fa-eye'></i> Detail</a>
                        <button class='btn btn-sm btn-info btnEdit mx-1' data-id='$model->id'><i class='fas fa fa-edit'></i> Edit</button><button class='btn btn-sm btn-danger btnDelete mx-1' data-id='$model->id'><i class='fas fa fa-trash'></i> Hapus</button>";
                    return $action;
                })
                ->addColumn('rt_rw', function ($model) {
                    return $model->rt->nomor . '/' . $model->rw->nomor;
                })
                // ->editColumn('nama_kepala_keluarga', function ($model) {
                //     return $model->nama_kepala_keluarga ?? '-';
                // })
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
            'no_kartu_keluarga' => ['required', 'numeric', Rule::unique('kartu_keluarga')->ignore(request('id'))],
            'alamat' => ['required', 'max:255'],
            'rw_id' => ['required', 'numeric'],
            'rt_id' => ['required', 'numeric'],
        ]);

        try {
            $setting = Setting::first();
            KartuKeluarga::updateOrCreate([
                'id'  => request('id')
            ], [
                'no_kartu_keluarga' => request('no_kartu_keluarga'),
                'alamat' => request('alamat'),
                'rw_id' => request('rw_id'),
                'rt_id' => request('rt_id'),
                'kode_pos' => $setting->kode_pos,
                'desa' => $setting->desa,
                'kecamatan' => $setting->kecamatan,
                'kabupaten' => $setting->kabupaten,
                'provinsi' => $setting->provinsi,
            ]);

            if (request('id')) {
                $message = 'Data Kartu Keluarga berhasil disimpan.';
            } else {
                $message = 'Data Kartu Keluarga berhasil ditambahakan.';
            }
            return response()->json(['status' => 'succcess', 'message' => $message]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Ada kesalahan di sistem.']);
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
        return response()->json(['status' => 'succcess', 'message' => 'Data Kartu Keluarga berhasil dihapus.']);
    }


    public function detail()
    {
        if (request()->ajax()) {
            $id = request('id');
            $kartu_keluarga = KartuKeluarga::with(['rw', 'rt'])->find($id);
            if ($kartu_keluarga) {
                return response()->json($kartu_keluarga);
            } else {
                return response()->json([]);
            }
        }
    }

    public function tambah_anggota($no_kk)
    {
        $kk = KartuKeluarga::where('no_kartu_keluarga', $no_kk)->firstOrFail();
        $data_warga = Warga::where('rt_id', $kk->rt_id)->get();
        return view('admin.pages.kartu-keluarga.tambah-anggota', [
            'title' => 'Detai Kartu Keluarga',
            'kk' => $kk,
            'data_warga' => $data_warga
        ]);
    }

    public function proses_tambah_anggota($no_kk)
    {
        request()->validate([
            'warga_id' => ['required']
        ]);
        $kk = KartuKeluarga::where('no_kartu_keluarga', $no_kk)->firstOrFail();
        $warga_id = request('warga_id');
        $cek = KartuKeluargaWarga::where('warga_id', $warga_id);
        if ($cek->first()) {
            return redirect()->back()->with('error', 'Anggota Keluarga sudah berada di dalam Kartu Keluarga lain.');
        } else if ($cek->where('kartu_keluarga_id', $kk->id)->first()) {
            return redirect()->back()->with('error', 'Anggota Keluarga sudah berada di dalam Kartu Keluarga.');
        } else {
            $kkw = KartuKeluargaWarga::create([
                'warga_id' => $warga_id,
                'kartu_keluarga_id' => $kk->id,
                'status' => 'Anggota'
            ]);

            return redirect()->route('admin.kartu-keluarga.show', $kk->id)->with('success', 'Anggota Keluarga berhasil ditambahkan ke dalam Kartu keluarga.');
        }
    }

    public function get_anggota()
    {
        if (request()->ajax()) {
            $kartu_keluarga_id = request('kartu_keluarga_id');
            $data = KartuKeluargaWarga::with('warga')->where('kartu_keluarga_id', $kartu_keluarga_id)->get();
            if ($data) {
                return response()->json($data);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Anggota gagal ditambahkan ke kartu keluarga.']);
            }
        }
    }

    public function hapus_anggota()
    {
        $kartu_keluarga_id = request('kartu_keluarga_id');
        $warga_id = request('warga_id');
        $kwk = KartuKeluargaWarga::where('kartu_keluarga_id', '=', $kartu_keluarga_id)->where('warga_id', '=', $warga_id)->firstOrFail();
        $kwk->delete();
        return redirect()->route('admin.kartu-keluarga.show', $kartu_keluarga_id);
    }

    public function show($id)
    {
        $item = KartuKeluarga::with(['anggota_keluarga'])->findOrFail($id);
        return view('admin.pages.kartu-keluarga.show', [
            'title' => 'Detai Kartu Keluarga',
            'item' => $item
        ]);
    }

    public function set_kepala_keluarga($no_kk)
    {
        request()->validate([
            'nama_kepala_keluarga' => ['required']
        ]);
        $nama_kepala_keluarga = request('nama_kepala_keluarga');
        $kk = KartuKeluarga::where('no_kartu_keluarga', $no_kk)->firstOrFail();
        $kk->update([
            'nama_kepala_keluarga' => $nama_kepala_keluarga
        ]);
        return redirect()->route('admin.kartu-keluarga.show', $kk->id)->with('success', 'Kepala Keluarga berhasil di set.');
    }
}
