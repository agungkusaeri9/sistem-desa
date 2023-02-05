@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Pindahan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Pindahan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-3 btnAdd"><i
                                    class="fas fa-plus"></i> Tambah Data</a>
                            <div class="table-responsives">
                                <table class="table nowrap table-striped table-hover" id="dTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Alamat Tujuan</th>
                                            <th>Alasan</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="javascript:void(0)" method="post" id="myForm">
                    @csrf
                    <input type="number" id="id" name="id" hidden>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h6>Detail</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warga_id">Nama</label>
                                            <select name="warga_id" id="warga_id" class="form-control">
                                                <option value="" selected disabled>Pilih Warga</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="text" class="form-control" id="info_nik" disabled>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jk">Jenis Kelamin</label>
                                            <input type="text" class="form-control" id="info_jk" disabled>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="info_alamat">Alamat</label>
                                            <textarea disabled id="info_alamat" cols="30" rows="3" class="form-control"></textarea>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="rt">RT</label>
                                            <input type="text" class="form-control" id="info_rt" disabled>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="rw">RW</label>
                                            <input type="text" class="form-control" id="info_rw" disabled>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-12">
                                    <h6>Tujuan</h6>
                                   </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="alasan">Alasan</label>
                                            <textarea name="alasan" id="alasan" cols="30" rows="3" class="form-control"></textarea>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_tujuan">Alamat Tujuan</label>
                                            <textarea name="alamat_tujuan" id="alamat_tujuan" cols="30" rows="3" class="form-control"></textarea>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jalan">Jalan</label>
                                            <input type="text" class="form-control" name="jalan" id="jalan">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="desa_tujuan">Desa</label>
                                            <input type="text" class="form-control" name="desa_tujuan" id="desa_tujuan">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="rt">RT</label>
                                            <input type="text" class="form-control" name="rt" id="rt">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="rw">RW</label>
                                            <input type="text" class="form-control" name="rw" id="rw">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="kecamatan_tujuan">Kecamatan</label>
                                            <input type="text" class="form-control" name="kecamatan_tujuan" id="kecamatan_tujuan">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kabupaten">Kabupaten</label>
                                            <input type="text" class="form-control" name="kabupaten" id="kabupaten">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="provinsi">Provinsi</label>
                                            <input type="text" class="form-control" name="provinsi" id="provinsi">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal Pindah</label>
                                            <input type="date" class="form-control" name="tanggal" id="tanggal">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Terverifikasi</option>
                                                <option selected value="0">Tidak Terverifikasi</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugin/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .closeDelete:hover {
            cursor: pointer;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugin/select2/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(function() {
            window.roleId = "";
            let otable = $('#dTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('admin.warga-pindahan.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'alamat_tujuan',
                        name: 'alamat_tujuan'
                    },
                    {
                        data: 'alasan',
                        name: 'alasan'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('.btnAdd').on('click', function() {
                $('#warga_id').select2({
                    dropdownParent: $('#myModal'),
                    theme: 'bootstrap4'
                });

                // get warga
                let wargas = getWarga();
                $('#myModal #warga_id').empty();
                $('#myModal #warga_id').append(
                    `<option value="" disabled selected>Pilih Warga</option>`);
                wargas.forEach(warga => {
                    $('#myModal #warga_id').append(
                        `<option value="${warga.id}">${warga.nama}</option>`);

                });
                $('#myModal .modal-title').text('Tambah Data');
                $('#myModal').modal('show');
            })
            $('#myModal #myForm').on('submit', function(e) {
                e.preventDefault();
                let form = $('#myModal #myForm');
                $.ajax({
                    url: '{{ route('admin.warga-pindahan.store') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: form.serialize(),
                    success: function(response) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            text: response.message,
                            showConfirmButton: true,
                            timer: 1500
                        })
                        otable.ajax.reload();
                        $('#myModal').modal('hide');
                    },
                    error: function(response) {
                        let errors = response.responseJSON?.errors
                        $(form).find('.text-danger.text-small').remove()
                        if (errors) {
                            for (const [key, value] of Object.entries(errors)) {
                                $(`[name='${key}']`).parent().append(
                                    `<sp class="text-danger text-small">${value}</sp>`)
                                $(`[name='${key}']`).addClass('is-invalid')
                            }
                        }
                    }
                })
            })

            $('body').on('click', '.btnEdit', function() {
                let id = $(this).data('id');
                let warga_id = $(this).data('warga');

                // get warga
                let wargas = getWarga();
                $('#myModal #warga_id').empty();
                $('#myModal #warga_id').append(
                    `<option value="" disabled selected>Pilih Warga</option>`);
                wargas.forEach(warga => {
                    if (warga.id == warga_id) {
                        $('#myModal #warga_id').append(
                            `<option selected value="${warga.id}">${warga.nama}</option>`);
                    } else {
                        $('#myModal #warga_id').append(
                            `<option value="${warga.id}">${warga.nama}</option>`);
                    }
                });

                $.ajax({
                    url: '{{ route('admin.warga.getById') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        warga_id: warga_id
                    },
                    success: function(warga) {
                        if(warga.jenis_kelamin === 'L'){
                            jk = 'Laki-laki';
                        }else{
                            jk = 'Perempuan';
                        }
                       let tgl_lahir = new Date(warga.tanggal_lahir).toISOString().slice(0, 10);
                        $('#info_nik').val(warga.nik);
                        $('#info_jk').val(jk);
                        $('#info_tgl_lahir').val(tgl_lahir);
                        $('#info_alamat').val(warga.alamat);
                        $('#info_rt').val(warga.rt.nomor);
                        $('#info_rw').val(warga.rw.nomor);
                    }
                })
                // get pindahan
                $.ajax({
                    url: '{{ route('admin.warga-pindahan.getById') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        id: id
                    },
                    success: function(response) {

                       let tgl_pindahan = new Date(response.tanggal).toISOString().slice(0, 10);
                        $('#myModal #id').val(response.id);
                        $('#myModal #alasan').val(response.alasan);
                        $('#myModal #alamat_tujuan').val(response.alamat_tujuan);
                        $('#myModal #jalan').val(response.jalan);
                        $('#myModal #desa_tujuan').val(response.desa_tujuan);
                        $('#myModal #rt').val(response.rt);
                        $('#myModal #rw').val(response.rw);
                        $('#myModal #kecamatan_tujuan').val(response.kecamatan_tujuan);
                        $('#myModal #kabupaten').val(response.kabupaten);
                        $('#myModal #provinsi').val(response.provinsi);
                        $('#myModal #tanggal').val(tgl_pindahan);
                        $('#myModal #status').empty();
                if (response.status == 1) {
                    $('#myModal #status').append(
                        `<option selected value="1">Terverifikasi</option>
                            <option value="0">Tidak Terverifikasi</option>`);
                } else {
                    $('#myModal #status').append(
                        `<option value="1">Terverifikasi</option>
                            <option selected value="0">Tidak Terverifikasi</option>`);
                }
                    }
                })


                $("#myForm select[name=warga_id]").attr("readonly", true);
                $('#myModal .modal-title').text('Edit Data');
                $('#myModal').modal('show');
            })
            $('body').on('click', '.btnDelete', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let name = $(this).data('name');
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `${name} akan dihapus dan tidak bisa dikembalikan!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yakin'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url('admin/warga-pindahan/') }}' + '/' + id,
                            type: 'DELETE',
                            dataType: 'JSON',
                            success: function(response) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    text: response.message,
                                    showConfirmButton: true,
                                    timer: 1500
                                })
                                otable.ajax.reload();
                                $('#myModal').modal('hide');

                            },
                            error: function(response) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    text: response.responseJSON.errors.name,
                                    showConfirmButton: true,
                                    timer: 1500
                                })
                            }
                        })
                    }
                })
            })
            $('body').on('change', '#warga_id', function() {
                let warga_id = $(this).val();

                $.ajax({
                    url: '{{ route('admin.warga.getById') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        warga_id: warga_id
                    },
                    success: function(response) {
                        if(response.jenis_kelamin === 'L'){
                            jk = 'Laki-laki';
                        }else{
                            jk = 'Perempuan';
                        }
                       let tgl_lahir = new Date(response.tanggal_lahir).toISOString().slice(0, 10);
                        $('#info_nik').val(response.nik);
                        $('#info_jk').val(jk);
                        $('#info_tgl_lahir').val(tgl_lahir);
                        $('#info_alamat').val(response.alamat);
                        $('#info_rt').val(response.rt.nomor);
                        $('#info_rw').val(response.rw.nomor);
                    }
                })
            })

            let getWarga = function() {
                let da;
                $.ajax({
                    url: '{{ route('admin.warga.get') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    success: function(response) {
                        da = response;
                    }
                })
                return da;
            }

            $('#myModal').on('hidden.bs.modal', function() {
                let form = $('#myModal #myForm');
                $(form).find('.text-danger.text-small').remove();
                $(form).find('.form-control').removeClass('is-invalid');
                form.trigger('reset');
            })
        })
    </script>
@endpush
