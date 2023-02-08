<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rw;
use App\Models\Setting;
use App\Models\Warga;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class LaporanController extends Controller
{
    public function warga()
    {

        return view('admin.pages.warga.laporan', [
            'title' => 'Laporan Warga',
            'data_rw' => Rw::orderBy('nomor', 'ASC')->get()
        ]);
    }

    public function export_warga()
    {
        $tahun = request('tahun');
        $jenis_kelamin = request('jenis_kelamin');
        $rw_id = request('rw_id');
        $rt_id = request('rt_id');
        $export_pdf = request('export_pdf');
        $export_excel = request('export_excel');

        $items = Warga::with(['rw.rt', 'kartu_keluarga', 'pendidikan:id,nama', 'pekerjaan:id,nama', 'agama:id,nama'])->orderBy('nama', 'ASC');

        // cek tahun
        if ($tahun)
            $items->whereYear('created_at', $tahun);
        if ($jenis_kelamin)
            $items->where('jenis_kelamin', $jenis_kelamin);
        if ($rw_id)
            $items->where('rw_id', $rw_id);
        if ($rt_id)
            $items->where('rt_id', $rt_id);

        // $hitung_jk = [
        //     'l' => $items->where('jenis_kelamin', 'L')->count(),
        //     'p' => $items->where('jenis_kelamin', 'P')->count()
        // ];
        $data_warga = $items->get();

        $setting = Setting::first();
        if ($export_pdf) {
            ini_set('max_execution_time', 300);
            ini_set("memory_limit", "512M");
            $pdf = Pdf::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            $pdf->loadView('admin.pages.warga.export-pdf', [
                'data_warga' => $data_warga,
                'setting' => $setting,
            ])->setPaper('a4', 'landscape');
            return $pdf->stream('data-warga.pdf');
        }
    }
}
