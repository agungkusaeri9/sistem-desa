@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.kartu-keluarga.index') }}">Kartu Keluarga</a>
                </div>
                <div class="breadcrumb-item">Detail</div>
            </div>
        </div>
        <div class="section-body">

            <div class="row mt-sm-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6> Detail Kartu Keluarga</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="no_kartu_keluarga">No Kartu Keluarga</label>
                                <input type="number" class="form-control" disabled name="no_kartu_keluarga"
                                    id="no_kartu_keluarga" value="{{ $item->no_kartu_keluarga }}">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" disabled cols="3" rows="10">{{ $item->alamat }}</textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="rw">RW</label>
                                <input type="text" class="form-control" disabled value="{{ $item->rw->nomor }}"
                                    name="rw" id="rw">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label for="rt">RT</label>
                                <input type="text" class="form-control" disabled value="{{ $item->rt->nomor }}"
                                    name="rt" id="rt">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="nama_kepala_keluarga">Nama Kepala Keluarga</label>
                                <input type="text" class="form-control" disabled name="nama_kepala_keluarga"
                                    id="nama_kepala_keluarga" value="{{ $item->nama_kepala_keluarga }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="kode_pos">Kode Pos</label>
                                <input type="number" class="form-control" disabled name="kode_pos" id="kode_pos"
                                    value="{{ $item->kode_pos }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="desa">Desa</label>
                                <input type="text" class="form-control" disabled name="desa" id="desa"
                                    value="{{ $item->desa }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <input type="text" class="form-control" disabled name="kecamatan" id="kecamatan"
                                    value="{{ $item->kecamatan }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <input type="text" class="form-control" disabled name="kabupaten" id="kabupaten"
                                    value="{{ $item->kabupaten }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <input type="text" class="form-control" disabled name="provinsi" id="provinsi"
                                    value="{{ $item->provinsi }}">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h6>Anggota Keluarga</h6>
                            <a href="{{ route('admin.kartu-keluarga.tambah-anggota',$item->no_kartu_keluarga) }}" class="btn btn-primary">Tambah Anggota</a>
                        </div>
                        <div class="card-body">
                            <table class="table nowrap table-striped" id="dTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($item->anggota_keluarga as $anggota)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $anggota->nik }}</td>
                                        <td>{{ $anggota->nama }}</td>
                                        <td>{{ $anggota->jenis_kelamin() }}</td>
                                        <td>{{ $anggota->tanggal_lahir() }}</td>
                                        <td style="min-width: 270px">
                                            <form class="d-inline" action="{{ route('admin.kartu-keluarga.set-kepala-keluarga',$item->no_kartu_keluarga) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="nama_kepala_keluarga" value="{{ $anggota->nama }}">
                                                <button class="btn btn-primary">Set Kepala Keluarga</button>
                                            </form>
                                            <form class="d-inline" action="{{ route('admin.kartu-keluarga.hapus-anggota') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="kartu_keluarga_id" value="{{ $item->id }}">
                                                <input type="hidden" name="warga_id" value="{{ $anggota->id }}">
                                                <button class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum Punya Anggota Keluarga!</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    @include('admin.layouts.partials.sweetalert')
    <script>
        $(function(){
            $('#dTable').DataTable({
                responsive:true
            })
        })
    </script>
@endpush
