@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Anggota</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.kartu-keluarga.index') }}">Kartu Keluarga</a>
                </div>
                <div class="breadcrumb-item"><a href="{{ route('admin.kartu-keluarga.show',$kk->id) }}">Detail</a>
                </div>
                <div class="breadcrumb-item">Tambah Anggota</div>
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
                                    id="no_kartu_keluarga" value="{{ $kk->no_kartu_keluarga }}">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" disabled cols="3" rows="10">{{ $kk->alamat }}</textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="rw">RW</label>
                                <input type="text" class="form-control" disabled value="{{ $kk->rw->nomor }}"
                                    name="rw" id="rw">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label for="rt">RT</label>
                                <input type="text" class="form-control" disabled value="{{ $kk->rt->nomor }}"
                                    name="rt" id="rt">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="nama_kepala_keluarga">Nama Kepala Keluarga</label>
                                <input type="text" class="form-control" disabled name="nama_kepala_keluarga"
                                    id="nama_kepala_keluarga" value="{{ $kk->nama_kepala_keluarga }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="kode_pos">Kode Pos</label>
                                <input type="number" class="form-control" disabled name="kode_pos" id="kode_pos"
                                    value="{{ $kk->kode_pos }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="desa">Desa</label>
                                <input type="text" class="form-control" disabled name="desa" id="desa"
                                    value="{{ $kk->desa }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <input type="text" class="form-control" disabled name="kecamatan" id="kecamatan"
                                    value="{{ $kk->kecamatan }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <input type="text" class="form-control" disabled name="kabupaten" id="kabupaten"
                                    value="{{ $kk->kabupaten }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <input type="text" class="form-control" disabled name="provinsi" id="provinsi"
                                    value="{{ $kk->provinsi }}">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h6>Tambah Anggota</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.kartu-keluarga.proses-tambah-anggota',$kk->no_kartu_keluarga) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="warga_id">Anggota Keluarga</span></label>
                                    <select name="warga_id" id="warga_id" class="form-control">
                                        <option value="" selected disabled>Pilih Anggota Keluarga</option>
                                        @foreach ($data_warga as $warga)
                                            <option value="{{ $warga->id }}">{{ $warga->nik . ' | ' . $warga->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="warga-detail">

                                </div>
                                <div class="form-group float-right">
                                    <button class="btn btn-primary">Tambah Anggota</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@push('scripts')
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/select2/js/select2.min.js') }}"></script>
    @include('admin.layouts.partials.sweetalert')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(function() {
            $('#warga_id').select2({
                theme: 'bootstrap4'
            });
            $('#warga_id').on('change', function() {
                let warga_id = $(this).val();
                // get detail warga
                let warga = getWargaById(warga_id);
                if(warga.jenis_kelamin === 'L')
                {
                    jk = 'Laki-laki';
                }else{
                    jk = 'Perempuan';
                }
                $('.warga-detail').html(`<div class="form-group">
                                <label for="">NIK</label>
                                <input type="text" class="form-control" value="${warga.nik}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" value="${warga.nama}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <input type="text" class="form-control" value="${jk}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" class="form-control" value="${warga.alamat}" disabled>
                            </div>`)
            })

            let getWargaById = function(warga_id) {
                let da;
                $.ajax({
                    url: '{{ route('admin.warga.getById') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    data: {
                        warga_id: warga_id
                    },
                    success: function(response) {
                        da = response;
                    }
                })
                return da;
            }
        })
    </script>
@endpush
