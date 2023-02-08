<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Warga</title>
    <style>
        table.info{
            font-size: 12px;
            font-family: sans-serif;
        }
        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 12px;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
        table.kop-surat {
        border-bottom: 5px solid #000;
        padding: 2px;
      }
      .tengah {
        text-align: center;
        line-height: 5px;
      }
    </style>
</head>

<body>
    {{-- kop surat --}}
    <table class="kop-surat" width="100%">
        <tr>
          <td>
            <img src="{{ $setting->image() }}" width="140px" /></td>
          <td class="tengah">
            <h2>PEMERINTAH KABUPATEN {{ \Str::upper($setting->kabupaten) }}</h2>
            <h2>KECAMATAN {{ \Str::upper($setting->kecamatan) }}</h2>
            <h2>KANTOR DESA {{ \Str::upper($setting->desa) }}</h2>
            <i
              >Sekretariat : Jalan Raya Citeko No 1 {{ \Str::ucfirst(\Str::lower($setting->kecamatan)) }} {{ \Str::ucfirst(\Str::lower($setting->kabupaten)) }} Kode Pos {{ \Str::ucfirst(\Str::lower($setting->kode_pos)) }}</i
            >
          </td>
        </tr>
      </table>

    <table class="styled-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIK</th>
                <th>KK</th>
                <th>Nama Lengkap</th>
                <th>JK</th>
                <th>Tempat/Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Agama</th>
                <th>Pendidikan</th>
                <th>Pekerjaan</th>
                <th>Status Hubungan</th>
                <th>Status Perkawinan</th>
                <th>Tanggal Kawin</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
            </tr>
        </thead>
        <tbody>
            @php
                 $jl = 0;
                $jp = 0;
            @endphp
            @foreach ($data_warga as $warga)
            @php
                if($warga->jenis_kelamin === 'L')
                {
                    $jl = $jl + 1;
                }else{
                    $jp = $jp + 1;
                }
            @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $warga->nik }}</td>
                    <td>{{ $warga->kartu_keluarga->kartu_keluarga->no_kartu_keluarga ?? '-' }}</td>
                    <td>{{ $warga->nama }}</td>
                    <td>{{ $warga->jenis_kelamin }}</td>
                    <td>
                      @if ($warga->tempat_lahir)
                      {{$warga->tempat_lahir . ', ' . $warga->tanggal_lahir() }}
                      @else
                      {{$warga->tanggal_lahir() }}
                      @endif
                    </td>
                    <td>{{ $warga->alamat }}</td>
                    <td>{{ $warga->agama->nama ?? '-' }}</td>
                    <td>{{ $warga->pendidikan->nama  ?? '-' }}</td>
                    <td>{{ $warga->pekerjaan->nama  ?? '-' }}</td>
                    <td>{{ $warga->status_hubungan }}</td>
                    <td>{{ $warga->status_perkawinan }}</td>
                    <td>{{ $warga->tanggal_kawin ?? '-' }}</td>
                    <td>{{ $warga->nama_ayah }}</td>
                    <td>{{ $warga->nama_ibu }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="info">
        <tr>
            <td>
                Jumlah Warga
            </td>
            <td>
                :
            </td>
            <td>
                {{ count($data_warga) }} Orang
            </td>
        </tr>
        <tr>
            <td>
                Jumlah Laki-laki
            </td>
            <td>
                :
            </td>
            <td>
              {{ $jl }} Orang
            </td>
        </tr>
        <tr>
            <td>
                Jumlah Perempuan
            </td>
            <td>
                :
            </td>
            <td>
                {{ $jp }} Orang
            </td>
        </tr>
    </table>
</body>

</html>
