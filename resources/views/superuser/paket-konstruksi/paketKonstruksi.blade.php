@extends('superuser.base')

@section('moreCss')
    {{-- <link rel="stylesheet" href="{{ asset('css/tab.css') }}" type="text/css"> --}}
@endsection

@section('title')
    Dashboard
@endsection

@section('content')

    <section class="mt-content">

        <!-- Tab panes -->
        <div class="mt-4" style="min-height: 23vh">
            <!-- Tab panes -->
            {{-- @yield('contentUser') --}}


            <div class="table-container">
                <div class="header-table">
                    <p class="title-table fw-bold t-primary">Data Paket Konstruksi</p>
                    <a class="bt-primary-sm" id="addData"><i class='bx bx-plus'></i> Tambah Data</a>
                </div>

                <table id="table" class="table table-striped" style="width:100%">

                </table>
            </div>
        </div>

        <!-- Modal Tambah-->
        <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Konstruksi</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form" onsubmit="return Save()">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Paket</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="reference" class="form-label">No. Kontrak</label>
                                <input type="text" class="form-control" id="reference" name="reference" required>
                            </div>

                            <div class="mb-3 input-daterange">
                                <label for="date_contract" class="form-label">Tanggal Kontrak</label>
                                <input type="text" class="form-control " name="date_contract" required>
                            </div>

                            <div class="mb-3">
                                <label for="ppk" class="form-label">PPK</label>
                                <select class=" me-2 w-100 form-control" aria-label="select" id="ppk" name="ppk" required>
                                    <option value="">Pilih PPK</option>
                                    @foreach($ppk as $v)
                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="vendor" class="form-label">Penyedia Jasa</label>
                                <select class=" me-2 w-100 form-control" aria-label="select" id="vendor" name="vendor" required>
                                    <option value="">Pilih Penyedia Jasa</option>
                                    @foreach($vendor as $v)
                                        <option value="{{$v->user->id}}">{{$v->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group input-daterange">
                                <div class="me-2">
                                    <label for="start" class="form-label">Tanggal Mulai</label>
                                    <input type="text" class="form-control " name="start" required>
                                </div>


                                <div class="ms-2">
                                    <label for="finish" class="form-label">Tanggal Berakhir</label>
                                    <input type="text" class="form-control " name="finish" required>
                                </div>

                            </div>

                            <button type="submit" class="bt-primary mt-3">Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        var table;

        function Save() {
            saveData('Tambah Data Paket', 'form', null, afterSave)
            return false;
        }

        function afterSave() {
            $('#tambahdata').modal('hide');
            table.ajax.reload();
        }

        function datatable() {

            var url = window.location.pathname + '/datatable';
            table = $('#table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: url,
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    // debugger;
                    var numStart = this.fnPagingInfo().iStart;
                    var index = numStart + iDisplayIndexFull + 1;
                    // var index = iDisplayIndexFull + 1;
                    $("td:first", nRow).html(index);
                    return nRow;
                },
                columnDefs: [
                    {"title": "#", "searchable": false, "orderable": false, "targets": 0, "className": "text-center"},
                    {"title": "Paket", 'targets': 1, 'searchable': true, 'orderable': true, "className": "text-center"},
                    {
                        "title": "No. Kontrak",
                        'targets': 2,
                        'searchable': true,
                        'orderable': true,
                        "className": "text-center"
                    },
                    {
                        "title": "Tanggal Kontrak",
                        'targets': 3,
                        'searchable': true,
                        'orderable': true,
                        "className": "text-center"
                    },
                    {"title": "PPK", 'targets': 4, 'searchable': true, 'orderable': true, "className": "text-center"},
                    {
                        "title": "Penyedia Jasa",
                        'targets': 5,
                        'searchable': true,
                        'orderable': true,
                        "className": "text-center"
                    },
                    {"title": "Mulai", 'targets': 6, 'searchable': true, 'orderable': true, "className": "text-center"},
                    {
                        "title": "Selesai",
                        'targets': 7,
                        'searchable': true,
                        'orderable': true,
                        "className": "text-center"
                    },
                    {
                        "title": "Action",
                        'targets': 8,
                        'searchable': false,
                        'orderable': false,
                        "className": "text-center"
                    },
                ],

                columns: [
                    {
                        "className": '',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                    {data: 'name', name: 'name'},
                    {data: 'no_reference', name: 'no_reference'},
                    {
                        data: 'date', name: 'date',
                        "render": function (data) {
                            return moment(data).format('DD MMMM YYYY')
                        }
                    },
                    {data: 'ppk.name', name: 'ppk.name'},
                    {data: 'vendor.vendor.name', name: 'vendor.vendor.name'},
                    {
                        data: 'start_at', name: 'start_at', "render": function (data) {
                            return moment(data).format('DD MMMM YYYY')
                        }
                    },
                    {
                        data: 'finish_at', name: 'finish_at', "render": function (data) {
                            return moment(data).format('DD MMMM YYYY')
                        }
                    },
                    {
                        "data": 'id',
                        "width": '100',
                        "render": function (data, type, row, meta) {
                            return '<a href="/paket-konstruksi/detail/' + data + '" class="btn btn-sm btn-success btn-sm" style="border-radius: 50px" data-id="' + data + '" id="editData"><i class="bx bx-edit"></i></a>'
                        }
                    },
                ]
            })
        }

        $(document).ready(function () {
            $('#tambahdata').modal({
                backdrop: 'static',
                keyboard: false
            });
            datatable();
        });

        $('.input-daterange input').each(function () {
            $(this).datepicker({
                format: "dd-mm-yyyy"
            });
        });

        $(document).on('click', '#addData', function () {
            $('#tambahdata #form .form-control').val('');
            $('#tambahdata').modal('show');
        })
    </script>
@endsection
