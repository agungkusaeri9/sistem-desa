@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Kartu Keluarga</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Kartu Keluarga</div>
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
                                            <th>No. Kartu Keluarga</th>
                                            <th>Nama Kepala Keluarga</th>
                                            <th>Alamat</th>
                                            <th>RT/RW</th>
                                            <th>Kode Pos</th>
                                            <th>Desa</th>
                                            <th style="min-width: 240px">Aksi</th>
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
                    <div class="modal-body">
                        @csrf
                        <input type="number" id="id" name="id" hidden>
                            <div class="form-group">
                                <label for="no_kartu_keluarga">No Kartu Keluarga</label>
                                <input type="number" class="form-control" name="no_kartu_keluarga" id="no_kartu_keluarga">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="3" rows="10"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="rw_id">RW</label>
                                <select name="rw_id" id="rw_id" class="form-control">
                                    <option value="" selected disabled>Pilih RW</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="rt_id">RT</label>
                                <select name="rt_id" id="rt_id" class="form-control">
                                    <option value="" selected disabled>Pilih RT</option>
                                </select>
                                <div class="invalid-feedback"></div>
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
                ajax: '{{ route('admin.kartu-keluarga.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'no_kartu_keluarga',
                        name: 'no_kartu_keluarga',
                    },
                    {
                        data: 'nama_kepala_keluarga',
                        name: 'nama_kepala_keluarga',
                    },
                    {
                        data: 'alamat',
                        name: 'alamat',
                    },
                    {
                        data: 'rt_rw',
                        name: 'rt_rw',
                    },
                    {
                        data: 'kode_pos',
                        name: 'kode_pos',
                    },
                    {
                        data: 'desa',
                        name: 'desa',
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
                // get rw
                let rws = getRw();
                $('#myModal #rw_id').empty();
                $('#myModal #rw_id').append(`<option selected disabled>Pilih RW</option>`);
                rws.forEach(rw => {
                    $('#myModal #rw_id').append(`<option value="${rw.id}">${rw.nomor}</option>`);
                });

                $('#rw_id').on('change', function() {
                    let rw_id = $(this).val();
                    // get rt
                    let rts = getRt(rw_id);
                    $('#myModal #rt_id').empty();
                    $('#myModal #rt_id').append(`<option selected disabled>Pilih RT</option>`);
                    rts.forEach(rt => {
                        $('#myModal #rt_id').append(
                            `<option value="${rt.id}">${rt.nomor}</option>`);
                    });
                })
                $('#myModal .modal-title').text('Tambah Data');
                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: true
                });
                $('#myModal').modal('show');
            })
            $('#myModal #myForm').on('submit', function(e) {
                e.preventDefault();
                let form = $('#myModal #myForm');
                $.ajax({
                    url: '{{ route('admin.kartu-keluarga.store') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: form.serialize(),
                    success: function(response) {
                       if(response.status === 'succcess')
                       {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            text: response.message,
                            showConfirmButton: true,
                            timer: 1500
                        })
                       }else{
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            text: response.message,
                            showConfirmButton: true,
                            timer: 1500
                        })
                       }
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
                let kartu_keluarga = getKartuKeluarga(id);
                $('#myForm #id').val(id);
                $('#myForm #no_kartu_keluarga').val(kartu_keluarga.no_kartu_keluarga);
                $('#myForm #alamat').val(kartu_keluarga.alamat);
                $('#myForm #nama_kepala_keluarga').val(kartu_keluarga.nama_kepala_keluarga);
                $('#myForm #kode_pos').val(kartu_keluarga.kode_pos);
                $('#myForm #desa').val(kartu_keluarga.desa);
                $('#myForm #kecamatan').val(kartu_keluarga.kecamatan);
                $('#myForm #kabupaten').val(kartu_keluarga.kabupaten);
                $('#myForm #provinsi').val(kartu_keluarga.provinsi);

                // get rw
                let rws = getRw();
                $('#myModal #rw_id').empty();
                $('#myModal #rw_id').append(`<option selected disabled>Pilih RW</option>`);
                rws.forEach(rw => {
                    if (rw.id == kartu_keluarga.rw_id) {
                        $('#myModal #rw_id').append(
                            `<option selected value="${rw.id}">${rw.nomor}</option>`);
                    } else {
                        $('#myModal #rw_id').append(
                            `<option value="${rw.id}">${rw.nomor}</option>`);
                    }
                });


                // get rt
                let rts = getRt(kartu_keluarga.rw_id);
                $('#myModal #rt_id').empty();
                $('#myModal #rt_id').append(`<option selected disabled>Pilih rt</option>`);
                rts.forEach(rt => {
                    if (rt.id == kartu_keluarga.rt_id) {
                        $('#myModal #rt_id').append(
                            `<option selected value="${rt.id}">${rt.nomor}</option>`);
                    } else {
                        $('#myModal #rt_id').append(
                            `<option value="${rt.id}">${rt.nomor}</option>`);
                    }
                });

                $('#rw_id').on('change', function() {
                    $('#myModal #rt_id').empty();
                    let rw_id = $(this).val();
                    // get rt
                    let rts = getRt(rw_id);
                    $('#myModal #rt_id').empty();
                    $('#myModal #rt_id').append(`<option selected disabled>Pilih RT</option>`);
                    rts.forEach(rt => {
                        if (rt.id == kartu_keluarga.rt_id) {
                            $('#myModal #rt_id').append(
                                `<option selected value="${rt.id}">${rt.nomor}</option>`
                            );
                        } else {
                            $('#myModal #rt_id').append(
                                `<option value="${rt.id}">${rt.nomor}</option>`);
                        }
                    });
                })
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
                            url: '{{ url('admin/kartu-keluarga/') }}' + '/' + id,
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

            let getRw = function() {
                let da;
                $.ajax({
                    url: '{{ route('admin.rw.get') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    success: function(response) {
                        da = response;
                    }
                })
                return da;
            }


            let getRt = function(rw_id) {
                let da;
                $.ajax({
                    url: '{{ route('admin.rt.get') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    data: {
                        rw_id: rw_id
                    },
                    success: function(response) {
                        da = response;
                    }
                })
                return da;
            }

            let getKartuKeluarga = function(id) {
                let da;
                $.ajax({
                    url: '{{ route('admin.kartu-keluarga.getById') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    data: {
                        id: id
                    },
                    success: function(response) {
                        da = response;
                    }
                })
                return da;
            }
            let getWarga = function(rt_id) {
                let da;
                $.ajax({
                    url: '{{ route('admin.warga.get-by') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        rt_id: rt_id,
                        where: 'rt_id'
                    },
                    async: false,
                    success: function(response) {
                        da = response;
                    }
                })
                return da;
            }

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

            $('#myModal').on('hidden.bs.modal', function() {
                let form = $('#myModal #myForm');
                $('#modalDetail').modal('hide');
                $(form).find('.text-danger.text-small').remove();
                $(form).find('.form-control').removeClass('is-invalid');
                form.trigger('reset');
            })

            $('#modalDetail').on('hidden.bs.modal', function() {
                $('#modalAddAnggotaKeluarga').modal('hide');
            })

            $('#modalAddAnggotaKeluarga').on('hidden.bs.modal', function() {
                $('#modalAddAnggotaKeluarga .warga-detail').html('');
                let form = $('#modalAddAnggotaKeluarga #fromAddAnggotaKeluarga');
                form.trigger('reset');
                $('#warga_id').val('');
                $('#modalAddAnggotaKeluarga').modal('hide');
            })


        })
    </script>
@endpush
