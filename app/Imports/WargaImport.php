<?php

namespace App\Imports;

use App\Models\Agama;
use App\Models\KartuKeluarga;
use App\Models\KartuKeluargaWarga;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Setting;
use App\Models\Warga;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;

class WargaImport implements ToCollection
{
    public function collection(Collection $rows)
    {
      try {
        foreach ($rows as $key => $row) {
            if ($key > 0) {
                $nik = $row[1];
                $jk = Str::substr($nik, 6, 2);
                if ($jk < 40) {
                    $jenis_kelamin = 'L';
                } else {
                    $jenis_kelamin = 'P';
                }
                $no_kk = $row[2];
                $nama = $row[3];
                $status_hubungan = $row[4];
                $tempat_lahir = $row[5];
               if($row[6])
               {
                $tanggal_lahir = $this->transformDate($row[6]);
               }else{
                $tanggal_lahir = NULL;
               }
            //    $tanggal_lahir = NULL;
                $m_agama = $row[7];
                $status_perkawinan = $row[8];
                $m_pendidikan = $row[9];
                $m_pekerjaan = $row[10];
                $nama_ayah = $row[11];
                $nama_ibu = $row[12];
                $alamat = $row[13];
                $m_rt = $row[14];
                $m_rw = $row[15];
                if ($status_hubungan === 'KEPALA KELUARGA') {
                    $nama_kepala_keluarga = $nama;
                } else {
                    $nama_kepala_keluarga = NULL;
                }

                // relasi dan perlu pengecekan diantaranya
                // 1. Agama
                // 2. Pendidikan
                // 3. Pekerjaan
                // 4. Rt
                // 5. Rw
                // cek no kkk, apabila kk sudah ada maka ambil id kk dan tambahkan warga ke kk ter sebut set juga kepala keluarganya

                // cek agama
                if ($m_agama !== NULL) {
                    $cek_agama = Agama::where('nama', $m_agama)->first();
                    if ($cek_agama) {
                        $agama = $cek_agama;
                    } else {
                        $agama = Agama::create([
                            'nama' => 'Islam'
                        ]);
                    }
                } else {
                    $cek_agama_islam = Agama::where('nama', 'Islam')->first();
                    if (!$cek_agama_islam) {
                        $agama = Agama::create([
                            'nama' => 'Islam'
                        ]);
                    } else {
                        $agama = $cek_agama_islam;
                    }
                }


                // cek pendidikan
                if ($m_pendidikan !== NULL) {
                    $cek_pendidikan = Pendidikan::where('nama', $m_pendidikan)->first();
                    if ($cek_pendidikan) {
                        $pendidikan = $cek_pendidikan;
                    } else {
                        $pendidikan = Pendidikan::create([
                            'nama' => $m_pendidikan
                        ]);
                    }
                } else {
                    $cek_pendidikan_lainnya = Pendidikan::where('nama', 'Lainnya')->first();
                    if (!$cek_pendidikan_lainnya) {
                        $pendidikan = Pendidikan::create([
                            'nama' => 'Lainnya'
                        ]);
                    } else {
                        $pendidikan = $cek_pendidikan_lainnya;
                    }
                }

                // cek pekerjaan
                if($m_pekerjaan !== NULL)
                {
                    $cek_pekerjaan = Pekerjaan::where('nama', $m_pekerjaan)->first();
                    if ($cek_pekerjaan) {
                        $pekerjaan = $cek_pekerjaan;
                    } else {
                        $pekerjaan = Pekerjaan::create([
                            'nama' => $m_pekerjaan
                        ]);
                    }
                }else{
                    $cek_pekerjaan_lainnya = Pekerjaan::where('nama', 'Lainnya')->first();
                    if (!$cek_pekerjaan_lainnya) {
                        $pekerjaan = Pekerjaan::create([
                            'nama' => 'Lainnya'
                        ]);
                    } else {
                        $pekerjaan = $cek_pekerjaan_lainnya;
                    }
                }

                // cek rw
                if($m_rw !== NULL)
                {
                    $cek_rw = Rw::where('nomor', $m_rw)->first();
                    if ($cek_rw) {
                        $rw = $cek_rw;
                    } else {
                        // dd($rw);
                        $rw = Rw::create([
                            'nomor' => $m_rw,
                        ]);
                    }
                }else{
                    $cek_rw_lainnya = Rw::where('nomor', 100)->first();
                    if ($cek_rw_lainnya == NULL) {
                        $rw = Rw::create([
                            'rw_id' => 100,
                            'nomor' => 100
                        ]);
                    } else {
                        $rw = $cek_rw_lainnya;
                    }
                }


                // cek rt
                if($m_rt !== NULL)
                {
                    $cek_rt = Rt::where('nomor', $m_rt)->first();
                    if ($cek_rt) {
                        $rt = $cek_rt;
                    } else {

                        $rt = Rt::create([
                            'rw_id' => $rw->id,
                            'nomor' => $m_rt,
                        ]);
                    }
                }else{
                    $cek_rt_lainnya = Rt::where('nomor', 100)->first();

                    if ($cek_rt_lainnya == NULL) {
                        // $rt = Rt::firstOrCreate([
                        //     'rw_id' => 100,
                        //     'nomor' => 100
                        // ]);
                    } else {
                        $rt = $cek_rt_lainnya;
                    }
                }

                // cek kk
                $cek_kk = KartuKeluarga::where('no_kartu_keluarga', $no_kk)->first();
                if (!$cek_kk) {
                    $setting = Setting::first();
                    //inser kartu keluarga baru
                    $kk = KartuKeluarga::create([
                        'no_kartu_keluarga' => $no_kk,
                        'nama_kepala_keluarga' => $nama_kepala_keluarga,
                        'alamat' => $alamat,
                        'rw_id' => $rw->id,
                        'rt_id' => $rt->id,
                        'kode_pos' => $setting->kode_pos,
                        'desa' => $setting->desa,
                        'kecamatan' => $setting->kecamatan,
                        'kabupaten' => $setting->kabupaten,
                        'provinsi' => $setting->provinsi
                    ]);
                } else {
                    $kk = $cek_kk;
                }

                // get warga berdasarkan nik
                $cek_warga = Warga::where('nik', $nik)->first();
                if ($cek_warga) {
                    $warga = $cek_warga;
                } else {
                    $warga =  Warga::create([
                        'nik' => $nik,
                        'nama' => $nama,
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
                        'jenis_kelamin' => $jenis_kelamin,
                        'alamat' => $alamat,
                        'agama_id' => $agama->id,
                        'pendidikan_id' => $pendidikan->id,
                        'pekerjaan_id' => $pekerjaan->id,
                        'rw_id' => $rw->id,
                        'rt_id' => $rt->id,
                        'status_perkawinan' => $status_perkawinan ?? 'BELUM KAWIN',
                        'status_hubungan' => $status_hubungan,
                        'nama_ayah' => $nama_ayah,
                        'kewarganegaraan' => 'WNI',
                        'nama_ibu' => $nama_ibu
                    ]);
                }

                // cek apakah warga sudah ada di kk atau belum dan kalau ada
                // insert ke kartu keluarga warga apabila kk ada
                $cek_kk_warga = KartuKeluargaWarga::where('warga_id', $warga->id)->first();
                if (!$cek_kk_warga) {
                    KartuKeluargaWarga::create([
                        'kartu_keluarga_id' => $kk->id,
                        'warga_id' => $warga->id,
                        'status' => $status_hubungan
                    ]);
                }
            }
        }
      } catch (\Throwable $th) {
        return redirect()->route('admin.warga.index')->with('error','Data Warga gagal di import. Silahkan sesuaikan format excel yang sudah ada.');
      }
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        if($value)
        {
            try {
                return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)) ?? NULL;
            } catch (\ErrorException $e) {
                return \Carbon\Carbon::createFromFormat($format, $value);
            }
        }else{
            return NULL;
        }
    }
}
