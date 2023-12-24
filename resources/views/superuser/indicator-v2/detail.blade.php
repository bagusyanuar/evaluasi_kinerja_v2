@extends('superuser.base')

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Ooops", 'internal server error...', "error")
        </script>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                title: 'Success',
                text: '{{ \Illuminate\Support\Facades\Session::get('success') }}',
                icon: 'success',
                timer: 700
            })
        </script>
    @endif
    <section class="mt-content">
        @if(count($stage->sub_stages) > 0)
            <div class="d-flex justify-content-between mb-3 align-items-center">
                <p class="mb-0 fw-bold">{{ $stage->name }}</p>
                <a class="bt-primary-sm d-flex justify-content-center align-items-center addDataStage"
                   style="min-width: 100px"><i class='bx bx-plus'></i> Tambah
                    Data Sub Tahapan</a>
            </div>
        @else
            <div class="d-flex justify-content-between mb-3 align-items-center">
                <p class="mb-0 fw-bold">{{ $stage->name }}</p>
            </div>
        @endif
        @forelse($stage->sub_stages as $sub_stage)
            <div class="table-container mb-3">
                <div class="header-table align-items-center">
                    <p class="title-table fw-bold t-primary mb-0">{{ $sub_stage->name }}</p>
                    @if(count($sub_stage->indicators) > 0)
                        <a class="bt-success-sm addIndicators" id="addData" data-sub="{{ $sub_stage->id }}"
                           style="min-width: 100px"><i class='bx bx-plus'></i>
                            Tambah Indikator
                        </a>
                    @endif
                </div>
                <hr>
                @forelse($sub_stage->indicators as $indicator)
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="fw-bold mb-0">{{($loop->index + 1)}}. {{ $indicator->name }}</p>
                        <a class="bt-success-xsm addSubIndicator" data-indicator="{{ $indicator->id }}"
                           style="min-width: 100px"><i class='bx bx-plus'></i>
                            Tambah Sub Indikator
                        </a>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <table id="table-data-{{ $indicator->id }}"
                               class="display table table-striped w-100 table-data-sub-indicator mb-3">
                            <thead>
                            <tr>
                                <th class="text-center middle-header" width="5%">#</th>
                                <th class="middle-header">Nama Sub Indikator</th>
                                <th class="text-center middle-header" width="15%">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($indicator->sub_indicators as $sub_indicator)
                                <tr>
                                    <td class="text-center middle-header" width="5%">{{ $loop->index + 1 }}</td>
                                    <td class="middle-header">{{ $sub_indicator->name }}</td>
                                    <td class="text-center middle-header" width="15%">
                                        <a href="#">Edit</a>
                                        <a href="#">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @empty
                    <div class="table-container d-flex align-items-center justify-content-center" style="height: 100px">
                        <div class="d-flex flex-column">
                            <p class="title-table fw-bold t-primary mb-3">Data Indicator Belum Tersedia</p>
                            <a class="bt-primary-sm d-flex justify-content-center align-items-center addIndicators"
                               data-sub="{{ $sub_stage->id }}"
                               style="min-width: 100px"><i class='bx bx-plus'></i> Tambah
                                Data Indikator</a>
                        </div>
                    </div>
                @endforelse

            </div>
        @empty
            <div class="table-container d-flex align-items-center justify-content-center" style="height: 400px">
                <div class="d-flex flex-column">
                    <p class="title-table fw-bold t-primary mb-3">Data Sub Tahapan Belum Tersedia</p>
                    <a class="bt-primary-sm d-flex justify-content-center align-items-center addDataStage" id="addDataStage"
                       style="min-width: 100px"><i class='bx bx-plus'></i> Tambah
                        Data Tahapan</a>
                </div>
            </div>
        @endforelse
    </section>
    <div class="modal fade" id="tambahdatasubtahapan" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span> Data Sub Tahapan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Sub Tahapan</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="bt-primary" id="btn-save">Simpan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="tambahdataindicator" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span> Data Indikator</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data-indicator" method="post" action="{{ route('indicator.smkk.v2.indicator') }}">
                        @csrf
                        <input type="hidden" name="sub-stage" value="" id="sub-stage-id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Indikator</label>
                            <input type="text" class="form-control" id="name-indicator" name="name" required>
                        </div>
                        <button type="submit" class="bt-primary" id="btn-save-indicator">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tambahdatasubindicator" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span> Data Sub Indikator</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data-sub-indicator" method="post"
                          action="{{ route('indicator.smkk.v2.sub-indicator') }}">
                        @csrf
                        <input type="hidden" name="indicator" value="" id="indicator-id">
                        <div class="mb-3">
                            <label for="name-sub-indicator" class="form-label">Nama Sub Indikator</label>
                            <input type="text" class="form-control" id="name-sub-indicator" name="name" required>
                        </div>
                        <button type="submit" class="bt-primary" id="btn-save-sub-indicator">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('moreCss')
    <link href="{{ asset('css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <link href="{{ asset('css/dropify/css/dropify.css') }}" rel="stylesheet">
    <style>
        .custom-card-link {
            text-decoration: none;
            color: white;
        }

        .custom-card-link:hover {
            text-decoration: none;
            color: white;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('css/dropify/js/dropify.js') }}"></script>
    <script>
        let table;
        let path = '/{{ request()->path() }}';

        function generateTableStage() {
            table = $('.table-data-sub-indicator').DataTable({
                'dom': 't'
            });
        }

        $(document).ready(function () {
            $('.addDataStage').on('click', function (e) {
                e.preventDefault();
                $('#tambahdatasubtahapan').modal('show');
            });

            $('.addIndicators').on('click', function (e) {
                e.preventDefault();
                let subStageID = this.dataset.sub;
                $('#sub-stage-id').val(subStageID);
                $('#tambahdataindicator').modal('show');
            });

            $('.addSubIndicator').on('click', function (e) {
                e.preventDefault();
                let indicatorID = this.dataset.indicator;
                $('#indicator-id').val(indicatorID);
                $('#tambahdatasubindicator').modal('show');
            });

            $('#btn-save').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menyimpan data sub tahapan?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        $('#form-data').submit()
                    }
                });
            });

            $('#btn-save-indicator').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menyimpan data indikator?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        $('#form-data-indicator').submit()
                    }
                });
            });

            $('#btn-save-sub-indicator').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menyimpan data sub indikator?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        $('#form-data-sub-indicator').submit()
                    }
                });
            });
            generateTableStage();

        });
    </script>
@endsection
