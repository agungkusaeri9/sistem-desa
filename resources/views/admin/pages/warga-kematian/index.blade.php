@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Kematian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Kematian</div>
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
                                <table class="table table-striped table-hover" id="dTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Tanggal Meninggal</th>
                                            <th>Penyebab</th>
                                            <th>Tempat Meninggal</th>
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
                    <div class="modal-body row">
                        @csrf
                        <input type="number" id="id" name="id" hidden>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="warga_id">Nama</label>
                                <select name="warga_id" id="warga_id" class="form-control">
                                    <option value="" selected disabled>Pilih Warga</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal Meninggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="penyebab">Penyebab</label>
                                <textarea name="penyebab" id="penyebab" cols="30" rows="3" class="form-control"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                            <label for="tempat_meninggal">Tempat Meninggal</label>
                            <input type="text" class="form-control" name="tempat_meninggal" id="tempat_meninggal">
                            <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option  value="1">Terverifikasi</option>
                                    <option selected value="0">Tidak Terverifikasi</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-center mb-3">Detail Warga</h6>
                            <ul class="list-group detail-group" id="detail-warga">
                                <li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>NIK</span>
                                    <span class="md-nik">-</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>Nama</span>
                                    <span>-</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>Alamat</span>
                                    <span>-</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>RT</span>
                                    <span>-</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>RW</span>
                                    <span>-</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">

                                </li>
                            </ul>
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
                ajax: '{{ route('admin.warga-kematian.data') }}',
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
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'penyebab',
                        name: 'penyebab'
                    },
                    {
                        data: 'tempat_meninggal',
                        name: 'tempat_meninggal'
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
                    url: '{{ route('admin.warga-kematian.store') }}',
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
                let tanggal = $(this).data('tanggal');
                let status = $(this).data('status');
                let tempat = $(this).data('tempat');
                let penyebab = $(this).data('penyebab');
                let warga_id = $(this).data('warga');
                let tgl = new Date(tanggal).toISOString().slice(0, 10);
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
                // get warga
                $.ajax({
                    url: '{{ route('admin.warga.getById') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        warga_id: warga_id
                    },
                    success: function(response) {
                        $('#myModal .detail-group').empty();
                        $('#myModal .detail-group').append(`<li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>NIK</span>
                                    <span class="ml-4">${response.nik}</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>Nama</span>
                                    <span class="ml-4">${response.nama}</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>Alamat</span>
                                    <span class="ml-4">${response.alamat}</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>RT</span>
                                    <span class="ml-4">${response.rt.nomor}</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>RW</span>
                                    <span class="ml-4">${response.rw.nomor}</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">

                                </li>`);
                    }
                })

                $('#myModal #status').empty();
                    if (status == 1) {
                        $('#myModal #status').append(
                            `<option selected value="1">Terverifikasi</option>
                            <option value="0">Tidak Terverifikasi</option>`);
                    } else {
                        $('#myModal #status').append(
                            `<option value="1">Terverifikasi</option>
                            <option selected value="0">Tidak Terverifikasi</option>`);
                    }
                $("#myForm select[name=warga_id]").attr("readonly", true);
                $('#myForm #id').val(id);
                $('#myForm #tanggal').val(tgl);
                $('#myForm #penyebab').val(penyebab);
                $('#myForm #tempat_meninggal').val(tempat);
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
                            url: '{{ url('admin/warga-kematian/') }}' + '/' + id,
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
                        $('#myModal .detail-group').empty();
                        $('#myModal .detail-group').append(`<li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>NIK</span>
                                    <span class="ml-4">${response.nik}</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>Nama</span>
                                    <span class="ml-4">${response.nama}</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>Alamat</span>
                                    <span class="ml-4">${response.alamat}</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>RT</span>
                                    <span class="ml-4">${response.rt.nomor}</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">
                                    <span>RW</span>
                                    <span class="ml-4">${response.rw.nomor}</span>
                                </li>
                                <li class="list-inline-item my-2 d-flex justify-content-between">

                                </li>`);
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
