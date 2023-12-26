@extends('superuser.base')

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Ooops", '{{ Illuminate\Support\Facades\Session::get('failed') }}', "error")
        </script>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                title: 'Success',
                text: '{{ Illuminate\Support\Facades\Session::get('success') }}',
                icon: 'success',
                timer: 700
            })
        </script>
    @endif
    <section class="mt-content">
        {{--        <div class="row">--}}
        {{--            <div class="col-3">--}}
        {{--                <a href="#" class="custom-card-link">--}}
        {{--                    <div class="custom-card d-flex flex-column align-items-center">--}}
        {{--                        <p class="mb-0">Tahapan</p>--}}
        {{--                    </div>--}}
        {{--                </a>--}}
        {{--            </div>--}}
        {{--            <div class="col-3">--}}
        {{--                <a href="#" class="custom-card-link">--}}
        {{--                    <div class="custom-card d-flex flex-column align-items-center">--}}
        {{--                        <p class="mb-0">Sub Tahapan</p>--}}
        {{--                    </div>--}}
        {{--                </a>--}}
        {{--            </div>--}}
        {{--            <div class="col-3">--}}
        {{--                <a href="#" class="custom-card-link">--}}
        {{--                    <div class="custom-card d-flex flex-column align-items-center">--}}
        {{--                        <p class="mb-0">Indikator</p>--}}
        {{--                    </div>--}}
        {{--                </a>--}}
        {{--            </div>--}}
        {{--            <div class="col-3">--}}
        {{--                <a href="#" class="custom-card-link">--}}
        {{--                    <div class="custom-card d-flex flex-column align-items-center">--}}
        {{--                        <p class="mb-0">Sub Indikator</p>--}}
        {{--                    </div>--}}
        {{--                </a>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <div class="table-container">
            <div class="header-table">
                <p class="title-table fw-bold t-primary mb-0">Data Tahapan SMKK V.2 </p>
                <a class="bt-primary-sm " id="addData" style="min-width: 100px"><i class='bx bx-plus'></i> Tambah
                    Data</a>
            </div>
            <table id="table-data" class="display table table-striped w-100">
                <thead>
                <tr>
                    <th class="text-center middle-header" width="5%">#</th>
                    <th class="middle-header">Nama Tahapan</th>
                    <th class="text-center middle-header" width="15%">Aksi</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </section>
    <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span> Data Tahapan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Tahapan</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="bt-primary" id="btn-save">Simpan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="editdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span> Data Tahapan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-data-edit" method="post" action="{{route('indicator.smkk.v2.patch')}}">
                        @csrf
                        <input type="hidden" id="id-edit" name="id-edit">
                        <div class="mb-3">
                            <label for="name-edit" class="form-label">Nama Tahapan</label>
                            <input type="text" class="form-control" id="name-edit" name="name-edit" required>
                        </div>
                        <button type="submit" class="bt-primary" id="btn-save-edit">Simpan</button>
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
            table = $('#table-data').DataTable({
                "aaSorting": [],
                "order": [],
                scrollX: true,
                processing: true,
                responsive: true,
                ajax: {
                    type: 'GET',
                    url: path,
                    'data': function (d) {

                    }
                },
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                    className: 'text-center',
                },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: null,
                        render: function (data) {
                            return '<a href="#" class="btn-detail me-2 btn-table-action bt-primary-xsm" data-id="' +
                                data['id'] + '">Detail</a>' +
                                '<a href="#" class="btn-edit me-2 btn-table-action bt-success-xsm" data-id="' + data['id'] +
                                '">Edit</a>' +
                                '<a href="#" class="btn-delete btn-table-action bt-danger-xsm" data-id="' + data[
                                    'id'] +
                                '">Delete</a>';
                        },
                        orderable: false,
                        className: 'text-center',
                    }
                ],
                columnDefs: [],
                paging: false,
                "fnDrawCallback": function (setting) {
                    eventDetail();
                    eventEdit();
                    deleteEvent();
                },
            });
        }

        function eventDetail() {
            $('.btn-detail').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                window.location.href = path + '/' + id + '/detail';
            });
        }

        function eventEdit() {
            $('.btn-edit').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                editHandler(id)
            });
        }

        async function editHandler(id) {
            try {
                let url = path + '/' + id + '/edit';
                let response = await $.get(url);
                let data = response['data'];
                console.log(response);
                $('#id-edit').val(data['id']);
                $('#name-edit').val(data['name']);
                $('#editdata').modal('show');
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

        function deleteEvent() {
            $('.btn-delete').on('click', function (e) {
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
                        destroy(id);
                    }
                });

            })
        }

        async function destroy(id) {
            let url = path + '/' + id + '/delete';
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

        $(document).ready(function () {
            $('#addData').on('click', function (e) {
                e.preventDefault();
                $('#tambahdata').modal('show');
            });

            $('#btn-save').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menyimpan data?",
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

            $('#btn-save-edit').on('click', function (e) {
                e.preventDefault();
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
                        $('#form-data-edit').submit()
                    }
                });
            });
            generateTableStage();

        });
    </script>
@endsection
