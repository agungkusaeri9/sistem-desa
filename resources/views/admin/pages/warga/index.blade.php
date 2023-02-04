@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Warga</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Warga</div>
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
                                            <th>KK</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th style="min-width: 220px">Aksi</th>
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
    <div class="modal fade" id="myModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="number" class="form-control" name="nik" id="nik">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" id="nama">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="3" rows="10"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="agama_id">Agama</label>
                                <select name="agama_id" id="agama_id" class="form-control">
                                    <option value="" selected disabled>Pilih Agama</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="pendidikan_id">Pendidikan</label>
                                <select name="pendidikan_id" id="pendidikan_id" class="form-control">
                                    <option value="" selected disabled>Pilih Pendidikan</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan_id">Pekerjaan</label>
                                <select name="pekerjaan_id" id="pekerjaan_id" class="form-control">
                                    <option value="" selected disabled>Pilih Pekerjaan</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="rw_id">RW</label>
                                <select name="rw_id" id="rw_id" class="form-control">
                                    <option value="" selected disabled>Pilih RW</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="rt_id">RT</label>
                                <select name="rt_id" id="rt_id" class="form-control">
                                    <option value="" selected disabled>Pilih RT</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="golongan_darah">Golongan Darah</label>
                                <select name="golongan_darah" id="golongan_darah" class="form-control">
                                    <option value="" selected disabled>Pilih Golongan Darah</option>
                                </select>
                                <div class="invalid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="status_hubungan">Status Hubungan</label>
                                <select name="status_hubungan" id="status_hubungan" class="form-control">
                                    <option value="" selected disabled>Pilih Status Hubungan</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="status_perkawinan">Status Perkawinan</label>
                                <select name="status_perkawinan" id="status_perkawinan" class="form-control">
                                    <option value="" selected disabled>Pilih Status Perkawinan</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_kawin">Tanggal Kawin</label>
                                <input type="date" class="form-control" name="tanggal_kawin" id="tanggal_kawin">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="kewarganegaraan">Kewarganegaraan</label>
                                <select name="kewarganegaraan" id="kewarganegaraan" class="form-control">
                                    <option value="" selected disabled>Pilih Kewarganegaraan</option>
                                    <option value="WNI">WNI</option>
                                    <option value="WNA">WNA</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="no_paspor">Nomor Paspor</label>
                                <input type="number" class="form-control" name="no_paspor" id="no_paspor">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="no_kitap">Nomor Kitap</label>
                                <input type="number" class="form-control" name="no_kitap" id="no_kitap">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="nama_ayah">Nama Ayah</label>
                                <input type="text" class="form-control" name="nama_ayah" id="nama_ayah">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <label for="nama_ibu">Nama Ibu</label>
                                <input type="text" class="form-control" name="nama_ibu" id="nama_ibu">
                                <div class="invalid-feedback"></div>
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
                ajax: '{{ route('admin.warga.data') }}',
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
                        data: 'no_kartu_keluarga',
                        name: 'no_kartu_keluarga'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
                    },
                    {
                        data: 'tempat_lahir',
                        name: 'tempat_lahir'
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
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
                $('#myModal .modal-title').text('Tambah Data');
                // get agama
                let agamas = getAgama();
                $('#myModal #agama_id').empty();
                $('#myModal #agama_id').append(`<option selected disabled>Pilih Agama</option>`);
                agamas.forEach(agama => {
                    $('#myModal #agama_id').append(
                        `<option value="${agama.id}">${agama.nama}</option>`);
                });

                // get pendidikan
                let pendidikans = getPendidikan();
                $('#myModal #pendidikan_id').empty();
                $('#myModal #pendidikan_id').append(`<option selected disabled>Pilih Pendidikan</option>`);
                pendidikans.forEach(pendidikan => {
                    $('#myModal #pendidikan_id').append(
                        `<option value="${pendidikan.id}">${pendidikan.nama}</option>`);
                });

                // get pekerjaan
                let pekerjaans = getPekerjaan();
                $('#myModal #pekerjaan_id').empty();
                $('#myModal #pekerjaan_id').append(`<option selected disabled>Pilih Pekerjaan</option>`);
                pekerjaans.forEach(pekerjaan => {
                    $('#myModal #pekerjaan_id').append(
                        `<option value="${pekerjaan.id}">${pekerjaan.nama}</option>`);
                });

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

                 // get status hubungan
                 let status_hubungan = ['Anak','Suami','Istri','Anak','Menantu','Cucu','Orang Tua','Mertua','Famili Lain','Pembantu'];
                $('#myModal #status_hubungan').empty();
                $('#myModal #status_hubungan').append(`<option selected disabled>Pilih Status Hubungan</option>`);
                status_hubungan.forEach(sb => {
                    $('#myModal #status_hubungan').append(
                        `<option value="${sb}">${sb}</option>`);
                });

                 // get golongan Darah
                 let golongan_darah = ['A','B','AB','O'];
                $('#myModal #golongan_darah').empty();
                $('#myModal #golongan_darah').append(`<option selected disabled>Pilih Golongan Darah</option>`);
                golongan_darah.forEach(gd => {
                    $('#myModal #golongan_darah').append(
                        `<option value="${gd}">${gd}</option>`);
                });

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
                    url: '{{ route('admin.warga.store') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: form.serialize(),
                    success: function(response) {
                        let sicon;
                        if (response.status === 'success') {
                            sicon = 'success';
                        } else {
                            sicon = 'error';
                        }
                        Swal.fire({
                            position: 'center',
                            icon: sicon,
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
                let name = $(this).data('nama');
                // get warga detail
                let warga = getWargaById(id);
                $('#myForm #id').val(id);
                $('#myForm #nik').val(warga.nik);
                $('#myForm #nama').val(warga.nama);
                $('#myForm #nama').val(warga.nama);
                $('#myForm #tempat_lahir').val(warga.tempat_lahir);
                $('#myForm #tanggal_lahir').val(warga.tgl_lahir);
                $('#myForm #alamat').val(warga.alamat);
                $('#myForm #golongan_darah').val(warga.golongan_darah);
                $('#myForm #status_hubungan').val(warga.status_hubungan);
                $('#myForm #tanggal_kawin').val(warga.tanggal_kawin);
                $('#myForm #kewarganegaraan').val(warga.kewarganegaraan);
                $('#myForm #no_paspor').val(warga.no_paspor);
                $('#myForm #no_kitap').val(warga.no_kitap);
                $('#myForm #nama_ayah').val(warga.nama_ayah);
                $('#myForm #nama_ibu').val(warga.nama_ibu);

                // jenis kelamin
                $('#myModal #jenis_kelamin').empty();
                $('#myModal #jenis_kelamin').append(`<option disabled>Pilih Pekerjaan</option>`);
                if (warga.jenis_kelamin === 'L'){
                    $('#myModal #jenis_kelamin').append(`<option selected value="L">Laki-laki</option>`);
                    $('#myModal #jenis_kelamin').append(`<option value="P">Perempuan</option>`);
                }else{
                    $('#myModal #jenis_kelamin').append(`<option value="L">Laki-laki</option>`);
                    $('#myModal #jenis_kelamin').append(`<option selected value="P">Perempuan</option>`);
                }

                // kewarganegaraan
                $('#myModal #kewarganegaraan').empty();
                $('#myModal #kewarganegaraan').append(`<option disabled>Pilih Kewarganegaraan</option>`);
                if (warga.kewarganegaraan === 'WNI'){
                    $('#myModal #kewarganegaraan').append(`<option selected value="WNI">WNI</option>`);
                    $('#myModal #kewarganegaraan').append(`<option value="WNA">WNA</option>`);
                }else{
                    $('#myModal #kewarganegaraan').append(`<option value="WNI">WNI</option>`);
                    $('#myModal #kewarganegaraan').append(`<option  selected value="WNA">WNA</option>`);
                }

                 // get agama
                 let agamas = getAgama();
                $('#myModal #agama_id').empty();
                $('#myModal #agama_id').append(`<option selected disabled>Pilih Agama</option>`);
                agamas.forEach(agama => {
                   if(agama.id == warga.agama_id)
                   {
                    $('#myModal #agama_id').append(
                        `<option selected value="${agama.id}">${agama.nama}</option>`);
                   }else{
                    $('#myModal #agama_id').append(
                        `<option value="${agama.id}">${agama.nama}</option>`);
                   }
                });

                 // get pendidikan
                 let pendidikans = getPendidikan();
                $('#myModal #pendidikan_id').empty();
                $('#myModal #pendidikan_id').append(`<option selected disabled>Pilih Pendidikan</option>`);
                pendidikans.forEach(pendidikan => {
                   if(pendidikan.id == warga.pendidikan_id)
                   {
                    $('#myModal #pendidikan_id').append(
                        `<option selected value="${pendidikan.id}">${pendidikan.nama}</option>`);
                   }else{
                    $('#myModal #pendidikan_id').append(
                        `<option value="${pendidikan.id}">${pendidikan.nama}</option>`);
                   }
                });

                // get pekerjaan
                let pekerjaans = getPekerjaan();
                $('#myModal #pekerjaan_id').empty();
                $('#myModal #pekerjaan_id').append(`<option selected disabled>Pilih Pekerjaan</option>`);
                pekerjaans.forEach(pekerjaan => {
                   if(pekerjaan.id == warga.pekerjaan_id)
                   {
                    $('#myModal #pekerjaan_id').append(
                        `<option selected value="${pekerjaan.id}">${pekerjaan.nama}</option>`);
                   }else{
                    $('#myModal #pekerjaan_id').append(
                        `<option value="${pekerjaan.id}">${pekerjaan.nama}</option>`);
                   }
                });

                let status_hubungan = ['Anak','Suami','Istri','Anak','Menantu','Cucu','Orang Tua','Mertua','Famili Lain','Pembantu'];
                $('#myModal #status_hubungan').empty();
                $('#myModal #status_hubungan').append(`<option selected disabled>Pilih Status Hubungan</option>`);
                status_hubungan.forEach(shb => {
                   if(shb == warga.status_hubungan)
                   {
                    $('#myModal #status_hubungan').append(
                        `<option selected value="${shb}">${shb}</option>`);
                   }else{
                    $('#myModal #status_hubungan').append(
                        `<option value="${shb}">${shb}</option>`);
                   }
                });
                // get rw
                let rws = getRw();
                $('#myModal #rw_id').empty();
                $('#myModal #rw_id').append(`<option selected disabled>Pilih RW</option>`);
                rws.forEach(rw => {
                   if(rw.id == warga.rw_id)
                   {
                    $('#myModal #rw_id').append(`<option selected value="${rw.id}">${rw.nomor}</option>`);
                   }else{
                    $('#myModal #rw_id').append(`<option value="${rw.id}">${rw.nomor}</option>`);
                   }
                });

                 // get rw
                let rts = getRt(warga.rw_id);
                $('#myModal #rt_id').empty();
                $('#myModal #rt_id').append(`<option selected disabled>Pilih rt</option>`);
                rts.forEach(rt => {
                   if(rt.id == warga.rt_id)
                   {
                    $('#myModal #rt_id').append(`<option selected value="${rt.id}">${rt.nomor}</option>`);
                   }else{
                    $('#myModal #rt_id').append(`<option value="${rt.id}">${rt.nomor}</option>`);
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
                       if(rt.id == warga.rt_id)
                       {
                        $('#myModal #rt_id').append(
                            `<option selected value="${rt.id}">${rt.nomor}</option>`);
                       }else{
                        $('#myModal #rt_id').append(
                            `<option value="${rt.id}">${rt.nomor}</option>`);
                       }
                    });
                })

                 // status perkawinan
                 let status_perkawinans = ['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'];
                 $('#myModal #status_perkawinan').empty();
                $('#myModal #status_perkawinan').append(`<option disabled>Pilih Status Perkawinan</option>`);
                status_perkawinans.forEach(status_perkawinan => {
                   if(status_perkawinan === warga.status_perkawinan)
                   {
                    $('#myModal #status_perkawinan').append(`<option selected value="${status_perkawinan}">${status_perkawinan}</option>`);
                   }else{
                    $('#myModal #status_perkawinan').append(`<option value="${status_perkawinan}">${status_perkawinan}</option>`);
                   }
                });

                 // status golongan darah
                 let golongan_darah = ['A','B','AB','O'];
                 $('#myModal #golongan_darah').empty();
                $('#myModal #golongan_darah').append(`<option disabled>Pilih Golongan Darah</option>`);
                golongan_darah.forEach(golongan_darah => {
                   if(golongan_darah === warga.golongan_darah)
                   {
                    $('#myModal #golongan_darah').append(`<option selected value="${golongan_darah}">${golongan_darah}</option>`);
                   }else{
                    $('#myModal #golongan_darah').append(`<option value="${golongan_darah}">${golongan_darah}</option>`);
                   }
                });


                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: true
                });
                $('#myModal .modal-title').text('Edit Data');
                $('#myModal').modal('show');
            })

            $('body').on('click', '.btnDetail', function(){
                let id = $(this).data('id');
                let name = $(this).data('nama');
                // get warga detail
                let warga = getWargaById(id);
                $('#myForm #id').val(id);
                $('#myForm #nik').val(warga.nik);
                $('#myForm #nama').val(warga.nama);
                $('#myForm #nama').val(warga.nama);
                $('#myForm #tempat_lahir').val(warga.tempat_lahir);
                $('#myForm #tanggal_lahir').val(warga.tgl_lahir);
                $('#myForm #alamat').val(warga.alamat);
                $('#myForm #golongan_darah').val(warga.golongan_darah);
                $('#myForm #status_hubungan').val(warga.status_hubungan);
                $('#myForm #tanggal_kawin').val(warga.tanggal_kawin);
                $('#myForm #kewarganegaraan').val(warga.kewarganegaraan);
                $('#myForm #no_paspor').val(warga.no_paspor);
                $('#myForm #no_kitap').val(warga.no_kitap);
                $('#myForm #nama_ayah').val(warga.nama_ayah);
                $('#myForm #nama_ibu').val(warga.nama_ibu);

                // jenis kelamin
                $('#myModal #jenis_kelamin').empty();
                $('#myModal #jenis_kelamin').append(`<option disabled>Pilih Pekerjaan</option>`);
                if (warga.jenis_kelamin === 'L'){
                    $('#myModal #jenis_kelamin').append(`<option value="L">Laki-laki</option>`);
                    $('#myModal #jenis_kelamin').append(`<option value="P">Perempuan</option>`);
                }else{
                    $('#myModal #jenis_kelamin').append(`<option value="L">Laki-laki</option>`);
                    $('#myModal #jenis_kelamin').append(`<option value="P">Perempuan</option>`);
                }

                 // get agama
                 let agamas = getAgama();
                $('#myModal #agama_id').empty();
                $('#myModal #agama_id').append(`<option selected disabled>Pilih Agama</option>`);
                agamas.forEach(agama => {
                   if(agama.id == warga.agama_id)
                   {
                    $('#myModal #agama_id').append(
                        `<option selected value="${agama.id}">${agama.nama}</option>`);
                   }else{
                    $('#myModal #agama_id').append(
                        `<option value="${agama.id}">${agama.nama}</option>`);
                   }
                });

                 // get pendidikan
                 let pendidikans = getPendidikan();
                $('#myModal #pendidikan_id').empty();
                $('#myModal #pendidikan_id').append(`<option selected disabled>Pilih Pendidikan</option>`);
                pendidikans.forEach(pendidikan => {
                   if(pendidikan.id == warga.pendidikan_id)
                   {
                    $('#myModal #pendidikan_id').append(
                        `<option selected value="${pendidikan.id}">${pendidikan.nama}</option>`);
                   }else{
                    $('#myModal #pendidikan_id').append(
                        `<option value="${pendidikan.id}">${pendidikan.nama}</option>`);
                   }
                });

                // get pekerjaan
                let pekerjaans = getPekerjaan();
                $('#myModal #pekerjaan_id').empty();
                $('#myModal #pekerjaan_id').append(`<option selected disabled>Pilih Pekerjaan</option>`);
                pekerjaans.forEach(pekerjaan => {
                   if(pekerjaan.id == warga.pekerjaan_id)
                   {
                    $('#myModal #pekerjaan_id').append(
                        `<option selected value="${pekerjaan.id}">${pekerjaan.nama}</option>`);
                   }else{
                    $('#myModal #pekerjaan_id').append(
                        `<option value="${pekerjaan.id}">${pekerjaan.nama}</option>`);
                   }
                });

                // get rw
                let rws = getRw();
                $('#myModal #rw_id').empty();
                $('#myModal #rw_id').append(`<option selected disabled>Pilih RW</option>`);
                rws.forEach(rw => {
                   if(rw.id == warga.rw_id)
                   {
                    $('#myModal #rw_id').append(`<option selected value="${rw.id}">${rw.nomor}</option>`);
                   }else{
                    $('#myModal #rw_id').append(`<option value="${rw.id}">${rw.nomor}</option>`);
                   }
                });

                 // get rw
                let rts = getRt(warga.rw_id);
                $('#myModal #rt_id').empty();
                $('#myModal #rt_id').append(`<option selected disabled>Pilih rt</option>`);
                rts.forEach(rt => {
                   if(rt.id == warga.rt_id)
                   {
                    $('#myModal #rt_id').append(`<option selected value="${rt.id}">${rt.nomor}</option>`);
                   }else{
                    $('#myModal #rt_id').append(`<option value="${rt.id}">${rt.nomor}</option>`);
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
                       if(rt.id == warga.rt_id)
                       {
                        $('#myModal #rt_id').append(
                            `<option selected value="${rt.id}">${rt.nomor}</option>`);
                       }else{
                        $('#myModal #rt_id').append(
                            `<option value="${rt.id}">${rt.nomor}</option>`);
                       }
                    });
                })

                 // status perkawinan
                 let status_perkawinans = ['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'];
                 $('#myModal #status_perkawinan').empty();
                $('#myModal #status_perkawinan').append(`<option disabled>Pilih Pekerjaan</option>`);
                status_perkawinans.forEach(status_perkawinan => {
                   if(status_perkawinan === warga.status_perkawinan)
                   {
                    $('#myModal #status_perkawinan').append(`<option selected value="${status_perkawinan}">${status_perkawinan}</option>`);
                   }else{
                    $('#myModal #status_perkawinan').append(`<option value="${status_perkawinan}">${status_perkawinan}</option>`);
                   }
                });

                 // status golongan darah
                 let golongan_darah = ['A','B','AB','O'];
                 $('#myModal #golongan_darah').empty();
                $('#myModal #golongan_darah').append(`<option disabled>Pilih Golongan Darah</option>`);
                golongan_darah.forEach(golongan_darah => {
                   if(golongan_darah === warga.golongan_darah)
                   {
                    $('#myModal #golongan_darah').append(`<option selected value="${golongan_darah}">${golongan_darah}</option>`);
                   }else{
                    $('#myModal #golongan_darah').append(`<option value="${golongan_darah}">${golongan_darah}</option>`);
                   }
                });

                let status_hubungan = ['Anak','Suami','Istri','Anak','Menantu','Cucu','Orang Tua','Mertua','Famili Lain','Pembantu'];
                $('#myModal #status_hubungan').empty();
                $('#myModal #status_hubungan').append(`<option selected disabled>Pilih Status Hubungan</option>`);
                status_hubungan.forEach(shb => {
                   if(shb == warga.status_hubungan)
                   {
                    $('#myModal #status_hubungan').append(
                        `<option selected value="${shb}">${shb}</option>`);
                   }else{
                    $('#myModal #status_hubungan').append(
                        `<option value="${shb}">${shb}</option>`);
                   }
                });

                 // kewarganegaraan
                 $('#myModal #kewarganegaraan').empty();
                $('#myModal #kewarganegaraan').append(`<option disabled>Pilih Kewarganegaraan</option>`);
                if (warga.kewarganegaraan === 'WNI'){
                    $('#myModal #kewarganegaraan').append(`<option selected value="WNI">WNI</option>`);
                    $('#myModal #kewarganegaraan').append(`<option value="WNA">WNA</option>`);
                }else{
                    $('#myModal #kewarganegaraan').append(`<option value="WNI">WNI</option>`);
                    $('#myModal #kewarganegaraan').append(`<option  selected value="WNA">WNA</option>`);
                }

                $("#myModal input").attr("disabled", true);
                $("#myModal textarea").attr("disabled", true);
                $('#myModal .modal-title').text('Detail Data');
                $('#myModal .modal-footer').addClass('d-none');
                $('#myModal').modal('show');
            })

            $('body').on('click', '.btnDelete', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let name = $(this).data('nama');
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
                            url: '{{ url('admin/warga/') }}' + '/' + id,
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

            let getAgama = function() {
                let da;
                $.ajax({
                    url: '{{ route('admin.agama.get') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    success: function(response) {
                        da = response;
                    }
                })
                return da;
            }

            let getPendidikan = function() {
                let da;
                $.ajax({
                    url: '{{ route('admin.pendidikan.get') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    success: function(response) {
                        da = response;
                    }
                })
                return da;
            }

            let getPekerjaan = function() {
                let da;
                $.ajax({
                    url: '{{ route('admin.pekerjaan.get') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    success: function(response) {
                        da = response;
                    }
                })
                return da;
            }

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
                $("#myModal input").attr("disabled", false);
                $("#myModal textarea").attr("disabled", false);
                $('#myModal .modal-footer').removeClass('d-none');
                $(form).find('.text-danger.text-small').remove();
                $(form).find('.form-control').removeClass('is-invalid');
                form.trigger('reset');
            })
        })
    </script>
@endpush
