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
    <div class="lazy-backdrop" id="overlay-loading">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="spinner-border text-light" role="status">
            </div>
            <p class="text-light">Sedang Melakukan Perubahan Data....</p>
        </div>
    </div>
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
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center">
                            <p class="title-table fw-bold t-primary mb-0 me-2">{{ $sub_stage->name }} </p>
                            <a href="#" data-sub="{{ $sub_stage->id }}" class="btn-role-lock" style="color: white; border: solid 1px white; border-radius: 5px; padding: 2px 3px"><i class='bx bx-key'></i></a>
                        </div>
                        @if($sub_stage->roles !== null && $sub_stage->roles !== '')
                            <p class="fst-italic" style="font-size: 12px;">
                                {!! '(' !!}@foreach($sub_stage->roles as $vRoles)
                                    @if($loop->first && count($sub_stage->roles) > 1)
                                        {{ $vRoles }},
                                    @else
                                        {{ $vRoles }}
                                    @endif
                                @endforeach{!! ')' !!}
                            </p>
                        @endif
                    </div>
                    @if(count($sub_stage->indicators) > 0)
                        <div class="d-flex align-items-center">
                            <a class="bt-success-sm addIndicators" data-sub="{{ $sub_stage->id }}">
                                Tambah Indikator
                            </a>
                            <a href="#" class="bt-primary-sm btn-edit-sub-stage ms-2" data-sub="{{ $sub_stage->id }}">
                                Edit
                            </a>
                            <a href="#" class="bt-danger-sm btn-delete-sub-stage ms-2" data-sub="{{ $sub_stage->id }}">
                                Delete
                            </a>
                        </div>
                    @else
                        <div class="d-flex align-items-center">
                            <a href="#" class="bt-primary-sm btn-edit-sub-stage ms-2" data-sub="{{ $sub_stage->id }}">
                                Edit
                            </a>
                            <a href="#" class="bt-danger-sm btn-delete-sub-stage ms-2" data-sub="{{ $sub_stage->id }}">
                                Delete
                            </a>
                        </div>
                    @endif
                </div>
                <hr>
                @forelse($sub_stage->indicators as $indicator)
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="fw-bold mb-0">{{($loop->index + 1)}}. {{ $indicator->name }}</p>
                        <div class="d-flex align-items-center">
                            <a class="bt-success-xsm addSubIndicator" data-indicator="{{ $indicator->id }}"><i
                                    class='bx bx-plus'></i>
                                Tambah Sub Indikator
                            </a>
                            <a class="bt-primary-xsm btn-edit-indicator ms-2" data-indicator="{{ $indicator->id }}">
                                Edit
                            </a>
                            <a class="bt-danger-xsm btn-delete-indicator ms-2" data-indicator="{{ $indicator->id }}">
                                Hapus
                            </a>
                        </div>

                    </div>
                    <hr>
                    <div class="mb-3">
                        <table id="table-data-{{ $indicator->id }}"
                               class="display table table-striped w-100 table-data-sub-indicator mb-3">
                            <thead>
                            <tr>
                                <th class="text-center middle-header" width="5%">#</th>
                                <th class="middle-header">Nama Sub Indikator</th>
                                <th class="text-center middle-header" width="25%">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($indicator->sub_indicators as $sub_indicator)
                                <tr>
                                    <td class="text-center middle-header" width="5%">{{ $loop->index + 1 }}</td>
                                    <td class="middle-header">{{ $sub_indicator->name }}</td>
                                    <td class="text-center middle-header" width="25%">
                                        <a href="#"
                                           class="btn-edit-sub-indicator me-2 mb-1 btn-table-action bt-primary-xsm"
                                           data-id="{{ $sub_indicator->id }}">Edit</a>
                                        <a href="#" class="btn-delete-sub-indicator mb-1 btn-table-action bt-danger-xsm"
                                           data-id="{{ $sub_indicator->id }}">Hapus</a>
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
                    <a class="bt-primary-sm d-flex justify-content-center align-items-center addDataStage"
                       id="addDataStage"
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
    <div class="modal fade" id="editdatasubtahapan" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                        <input type="hidden" name="id-sub-stage-edit" value="" id="id-sub-stage-edit">
                        <div class="mb-3">
                            <label for="name-sub-stage-edit" class="form-label">Nama Sub Tahapan</label>
                            <input type="text" class="form-control" id="name-sub-stage-edit" name="name-sub-stage-edit"
                                   required>
                        </div>
                        <a href="#" class="bt-primary" id="btn-patch-sub-stage">Simpan</a>
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
    <div class="modal fade" id="editdataindicator" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span> Data Indikator</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data-indicator" method="post">
                        @csrf
                        <input type="hidden" name="id-indicator-edit" value="" id="id-indicator-edit">
                        <div class="mb-3">
                            <label for="name-indicator-edit" class="form-label">Nama Indikator</label>
                            <input type="text" class="form-control" id="name-indicator-edit" name="name-indicator-edit"
                                   required>
                        </div>
                        <a href="#" class="bt-primary" id="btn-patch-indicator">Simpan</a>
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
    <div class="modal fade" id="editdatasubindicator" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span> Data Sub Indikator</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data-sub-indicator" method="post">
                        @csrf
                        <input type="hidden" name="id-sub-indicator-edit" value="" id="id-sub-indicator-edit">
                        <div class="mb-3">
                            <label for="name-sub-indicator-edit" class="form-label">Nama Sub Indikator</label>
                            <input type="text" class="form-control" id="name-sub-indicator-edit"
                                   name="name-sub-indicator-edit" required>
                        </div>
                        <a href="#" class="bt-primary" id="btn-patch-sub-indicator">Simpan</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-role" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Role Sub Tahapan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data-sub-stage-role" method="post">
                        @csrf
                        <input type="hidden" name="sub-stage-id-role" value="" id="sub-stage-id-role">
                        <div class="form-group w-100 mb-3">
                            <label for="role" class="form-label d-block">Role Akses</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox"
                                       id="role-accessor-ppk"
                                       name="roles" value="accessorppk">
                                <label class="form-check-label menu-title"
                                       for="role-accessor-ppk">Asesor PPK</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox"
                                       id="role-accessor-stage"
                                       name="roles" value="accessorperancangan">
                                <label class="form-check-label menu-title"
                                       for="role-accessor-stage">Asesor Perancangan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox"
                                       id="role-accessor-stage"
                                       name="roles" value="accessorpengawasan">
                                <label class="form-check-label menu-title"
                                       for="role-accessor-stage">Asesor Pengawasan</label>
                            </div>
                        </div>
                        <hr>
                        <a href="#" class="bt-primary" id="btn-patch-sub-stage-role">Simpan</a>
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

        .lazy-backdrop {
            position: fixed;
            display: none;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            cursor: pointer;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('css/dropify/js/dropify.js') }}"></script>
    <script>
        let table;
        let path = '/{{ request()->path() }}';
        let mainPath = '{{ route('indicator.smkk.v2') }}';

        function blockLoading(state) {
            if (state) {
                $('#overlay-loading').css('display', 'flex')
            } else {
                $('#overlay-loading').css('display', 'none')
            }
        }

        function generateTableStage() {
            table = $('.table-data-sub-indicator').DataTable({
                'dom': 't'
            });
        }

        function eventEditSubStage() {
            $('.btn-edit-sub-stage').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.sub;
                editSubStageHandler(id)
            });
        }

        async function editSubStageHandler(id) {
            try {
                let url = mainPath + '/sub-stage/' + id;
                let response = await $.get(url);
                let data = response['data'];
                console.log(response);
                $('#id-sub-stage-edit').val(data['id']);
                $('#name-sub-stage-edit').val(data['name']);
                $('#editdatasubtahapan').modal('show');
            } catch (e) {
                console.log(e);
                Swal.fire({
                    title: 'Error',
                    text: e.responseJSON,
                    icon: 'error',
                    timer: 700
                })
            }
        }

        function eventEditSubIndicator() {
            $('.btn-edit-sub-indicator').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                editSubIndicatorHandler(id)
            });
        }

        async function editSubIndicatorHandler(id) {
            try {
                let url = mainPath + '/sub-indicators/' + id;
                let response = await $.get(url);
                let data = response['data'];
                console.log(response);
                $('#id-sub-indicator-edit').val(data['id']);
                $('#name-sub-indicator-edit').val(data['name']);
                $('#editdatasubindicator').modal('show');
            } catch (e) {
                console.log(e);
                Swal.fire({
                    title: 'Error',
                    text: e.responseJSON,
                    icon: 'error',
                    timer: 700
                })
            }
        }

        function eventEditIndicator() {
            $('.btn-edit-indicator').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.indicator;
                editIndicatorHandler(id)
            });
        }

        async function editIndicatorHandler(id) {
            try {
                let url = mainPath + '/indicators/' + id;
                let response = await $.get(url);
                let data = response['data'];
                console.log(response);
                $('#id-indicator-edit').val(data['id']);
                $('#name-indicator-edit').val(data['name']);
                $('#editdataindicator').modal('show');
            } catch (e) {
                console.log(e);
                Swal.fire({
                    title: 'Error',
                    text: e.responseJSON,
                    icon: 'error',
                    timer: 700
                })
            }
        }

        function eventPatchSubStage() {
            $('#btn-patch-sub-stage').on('click', function (e) {
                e.preventDefault();
                let id = $('#id-sub-stage-edit').val();
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin merubah data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        patchSubStageHandler(id);
                    }
                });
            })
        }

        function eventPatchRoleSubStage() {
            $('#btn-patch-sub-stage-role').on('click', function (e) {
                e.preventDefault();
                let id = $('#sub-stage-id-role').val();
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin merubah data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        patchSubStageRoleHandler(id);
                    }
                });
            })
        }

        function eventPatchSubIndicator() {
            $('#btn-patch-sub-indicator').on('click', function (e) {
                e.preventDefault();
                let id = $('#id-sub-indicator-edit').val();
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin merubah data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        patchSubIndicatorHandler(id);
                    }
                });
            })
        }

        function eventPatchIndicator() {
            $('#btn-patch-indicator').on('click', function (e) {
                e.preventDefault();
                let id = $('#id-indicator-edit').val();
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin merubah data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        patchIndicatorHandler(id);
                    }
                });
            })
        }

        function eventDeleteSubStage() {
            $('.btn-delete-sub-stage').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.sub;
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menghapus data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        destroySubStageHandler(id);
                    }
                });

            })
        }

        function eventDeleteSubIndicator() {
            $('.btn-delete-sub-indicator').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menghapus data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        destroySubIndicatorHandler(id);
                    }
                });

            })
        }

        function eventDeleteIndicator() {
            $('.btn-delete-indicator').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.indicator;
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menghapus data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        destroyIndicatorHandler(id);
                    }
                });

            })
        }

        async function patchSubStageHandler(id) {
            let url = mainPath + '/sub-stage/' + id;
            try {
                blockLoading(true);
                await $.post(url, {
                    _token: '{{csrf_token()}}',
                    name: $('#name-sub-stage-edit').val()
                });
                blockLoading(false);
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Berhasil Merubah Data...',
                    icon: 'success',
                    timer: 700
                }).then((response) => {
                    window.location.reload();
                })
            } catch (e) {
                blockLoading(false);
                console.log(e);
                Swal.fire({
                    title: 'Error',
                    text: e.responseJSON,
                    icon: 'error',
                    timer: 700
                })
            }
        }

        async function patchSubStageRoleHandler(id) {
            let url = mainPath + '/sub-stage/' + id + '/role';
            let tmpValRole = [];
            $('input[name=roles]:checked').each(function () {
                tmpValRole.push($(this).val())
            });
            try {
                blockLoading(true);
                await $.post(url, {
                    _token: '{{csrf_token()}}',
                    roles: tmpValRole
                });
                blockLoading(false);
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Berhasil Merubah Data...',
                    icon: 'success',
                    timer: 700
                }).then((response) => {
                    window.location.reload();
                })
            } catch (e) {
                blockLoading(false);
                console.log(e);
                Swal.fire({
                    title: 'Error',
                    text: e.responseJSON,
                    icon: 'error',
                    timer: 700
                })
            }
        }

        async function patchSubIndicatorHandler(id) {
            let url = mainPath + '/sub-indicators/' + id;
            try {
                blockLoading(true);
                await $.post(url, {
                    _token: '{{csrf_token()}}',
                    name: $('#name-sub-indicator-edit').val()
                });
                blockLoading(false);
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Berhasil Merubah Data...',
                    icon: 'success',
                    timer: 700
                }).then((response) => {
                    window.location.reload();
                })
            } catch (e) {
                blockLoading(false);
                console.log(e);
                Swal.fire({
                    title: 'Error',
                    text: e.responseJSON,
                    icon: 'error',
                    timer: 700
                })
            }
        }

        async function patchIndicatorHandler(id) {
            let url = mainPath + '/indicators/' + id;
            try {
                blockLoading(true);
                await $.post(url, {
                    _token: '{{csrf_token()}}',
                    name: $('#name-indicator-edit').val()
                });
                blockLoading(false);
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Berhasil Merubah Data...',
                    icon: 'success',
                    timer: 700
                }).then((response) => {
                    window.location.reload();
                })
            } catch (e) {
                blockLoading(false);
                console.log(e);
                Swal.fire({
                    title: 'Error',
                    text: e.responseJSON,
                    icon: 'error',
                    timer: 700
                })
            }
        }

        async function destroySubStageHandler(id) {
            let url = mainPath + '/sub-stage/' + id + '/delete';
            try {
                await $.post(url, {
                    _token: '{{csrf_token()}}',
                });
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Berhasil Menghapus Data...',
                    icon: 'success',
                    timer: 700
                }).then((response) => {
                    window.location.reload();
                })
            } catch (e) {
                console.log(e)
                Swal.fire({
                    title: 'Error',
                    text: e.responseJSON,
                    icon: 'error',
                    timer: 700
                })
            }
        }

        async function destroySubIndicatorHandler(id) {
            let url = mainPath + '/sub-indicators/' + id + '/delete';
            try {
                await $.post(url, {
                    _token: '{{csrf_token()}}',
                });
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Berhasil Menghapus Data...',
                    icon: 'success',
                    timer: 700
                }).then((response) => {
                    window.location.reload();
                })
            } catch (e) {
                console.log(e)
                Swal.fire({
                    title: 'Error',
                    text: e.responseJSON,
                    icon: 'error',
                    timer: 700
                })
            }
        }

        async function destroyIndicatorHandler(id) {
            let url = mainPath + '/indicators/' + id + '/delete';
            try {
                await $.post(url, {
                    _token: '{{csrf_token()}}',
                });
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Berhasil Menghapus Data...',
                    icon: 'success',
                    timer: 700
                }).then((response) => {
                    window.location.reload();
                })
            } catch (e) {
                console.log(e)
                Swal.fire({
                    title: 'Error',
                    text: e.responseJSON,
                    icon: 'error',
                    timer: 700
                })
            }
        }

        function eventSetRole() {
            $('.btn-role-lock').on('click', function (e) {
                e.preventDefault();
                let sub = this.dataset.sub;
                $('#sub-stage-id-role').val(sub);
                $('#modal-role').modal('show');
            });
        }
        $(document).ready(function () {
            $('#role').select2({
                width: 'resolve',
            });
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
            eventPatchRoleSubStage();
            eventEditSubStage();
            eventPatchSubStage();
            eventDeleteSubStage();
            eventEditIndicator();
            eventPatchIndicator();
            eventDeleteIndicator();
            eventEditSubIndicator();
            eventPatchSubIndicator();
            eventDeleteSubIndicator();
            eventSetRole();
        });
    </script>
@endsection
