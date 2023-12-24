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
                text: 'Berhasil Menambahkan Data...',
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
                            let urlEdit = path + '/' + data['id'] + '/edit';
                            return '<a href="#" class="btn-detail me-2 btn-table-action" data-id="' +
                                data['id'] + '">Detail</a>' +
                                '<a href="' + urlEdit +
                                '" class="btn-edit me-2 btn-table-action" data-id="' + data['id'] +
                                '">Edit</a>' +
                                '<a href="#" class="btn-delete btn-table-action" data-id="' + data[
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
            generateTableStage();

        });
    </script>
@endsection
