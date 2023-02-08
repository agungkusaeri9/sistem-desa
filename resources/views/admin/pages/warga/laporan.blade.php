@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Laporan Data Warga</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Laporan Data Warga</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('admin.laporan.warga.export') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="tahun" id="tahun">
                                                    <option value="" selected>Semua</option>
                                                    @for ($i = 2022; $i <= 2025; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                    <option value="" selected>Semua</option>
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="rw_id" class="col-sm-2 col-form-label">RW</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="rw_id" id="rw_id">
                                                    <option value="" selected>Semua</option>
                                                    @foreach ($data_rw as $rw)
                                                        <option value="{{ $rw->id }}">{{ $rw->nomor }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="rt_id" class="col-sm-3 col-form-label">RT</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="rt_id" id="rt_id">
                                                    <option value="" selected>Semua</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col">
                                    <button name="export_pdf" value="export_pdf" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Export Pdf</button>
                                    <button name="export_excel" value="export_excel" class="btn btn-info"><i class="fas fa-file-excel"></i> Export Excel</button>
                                   </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $('#rw_id').on('change', function() {
                let rw_id = $(this).val();
                let data_rt = getRt(rw_id);
                $('#rt_id').empty();
                $('#rt_id').append(`<option selected disabled>Semua</option>`);
                data_rt.forEach(rt => {
                    $('#rt_id').append(
                            `<option value="${rt.id}">${rt.nomor}</option>`);
                });
            })

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
        })
    </script>
@endpush
