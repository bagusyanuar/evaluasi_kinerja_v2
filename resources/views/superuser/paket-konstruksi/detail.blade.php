@extends('superuser.base')

@section('moreCss')
    {{-- <link rel="stylesheet" href="{{ asset('css/tab.css') }}" type="text/css"> --}}
@endsection

@section('title')
    Dashboard
@endsection

@section('content')
    <section class="mt-content">

        <div class="mt-4" style="min-height: 23vh">
            <div class="header-table">
                <p class="title-table">Detail Paket Konstruksi</p>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="table-container">
                        <form id="form" onsubmit="return SavePackage()">
                            @csrf
                            <input hidden id="id" name="id" value="{{ $data->id }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Paket</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="reference" class="form-label">No. Kontrak</label>
                                <input type="text" class="form-control" id="reference" name="reference"
                                    value="{{ $data->no_reference }}">
                            </div>
                            <div class="mb-3 input-daterange">
                                <label for="date_contract" class="form-label">Tanggal Kontrak</label>
                                <input type="text" class="form-control " name="date_contract" required
                                    value="{{ date('d-m-Y', strtotime($data->date)) }}">
                            </div>
                            <div class="mb-3">
                                <label for="ppk" class="form-label">PPK</label>
                                <select class=" me-2 w-100 form-control" aria-label="select" id="ppk" name="ppk">
                                    @foreach ($ppk as $v)
                                        <option value="{{ $v->id }}"
                                            {{ $data->ppk->id == $v->id ? 'selected' : '' }}>{{ $v->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="vendor" class="form-label">Penyedia Jasa</label>
                                <select class=" me-2 w-100 form-control" aria-label="select" id="vendor" name="vendor">
                                    @foreach ($vendor as $v)
                                        <option value="{{ $v->user->id }}"
                                            {{ $data->vendor->id == $v->user->id ? 'selected' : '' }}>{{ $v->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 input-daterange">
                                <label for="start" class="form-label">Tanggal Mulai</label>
                                <input type="text" class="form-control " name="start"
                                    value="{{ date('d-m-Y', strtotime($data->start_at)) }}" required>
                            </div>
                            <div class="mb-3 input-daterange">
                                <label for="finish" class="form-label">Tanggal Berakhir</label>
                                <input type="text" class="form-control " name="finish"
                                    value="{{ date('d-m-Y', strtotime($data->finish_at)) }}" required>
                            </div>
                            <hr />
                            <div class="mt-3">
                                <button type="submit" class="bt-primary-sm mt-3"><i class='bx bx-plus'></i> Ubah
                                    Data</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="table-container">
                        <div class="header-table">
                            <p class="title-table">Addendum Paket</p>
                            <a class="bt-primary-sm" id="addData"><i class='bx bx-plus'></i> Tambah</a>
                        </div>
                        <table id="table" class="table table-striped" style="width:100%">
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span> Data Addendum</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-addendum" onsubmit="return SaveAddendum()">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $data->id }}">
                            <input hidden id="id" name="id">
                            {{-- <input type="hidden" name="package_id" value="abc"> --}}
                            <div class="mb-3">
                                <label for="addendum_reference" class="form-label">No. Addendum</label>
                                <input type="text" class="form-control" id="addendum_reference" name="addendum_reference">
                            </div>

                            <div class="mb-3 input-daterange">
                                <label for="date_addendum" class="form-label">Tanggal Addendum</label>
                                <input type="text" class="form-control" id="date_addendum" name="date_addendum" required>
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

        function SavePackage() {
            saveData('Edit Data Paket Kontruksi', 'form', null, afterSavePackage)
            return false;
        }

        function afterSavePackage() {

        }

        function SaveAddendum() {
            saveData('Tambah Data Addendum', 'form-addendum', '/paket-konstruksi/addendum/add', afterSave)
            return false;
        }

        function afterSave() {
            $('#tambahdata').modal('hide');
            table.ajax.reload();
        }

        function datatable() {

            var url = '/paket-konstruksi/addendum-datatable/{{ $data->id }}';
            table = $('#table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: url,
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    // debugger;
                    var numStart = this.fnPagingInfo().iStart;
                    var index = numStart + iDisplayIndexFull + 1;
                    // var index = iDisplayIndexFull + 1;
                    $("td:first", nRow).html(index);
                    return nRow;
                },
                columnDefs: [{
                        "title": "#",
                        "searchable": false,
                        "orderable": false,
                        "targets": 0,
                        "className": "text-center"
                    },
                    {
                        "title": "No. Addendum",
                        'targets': 1,
                        'searchable': true,
                        'orderable': true,
                        "className": "text-center"
                    },
                    {
                        "title": "Tanggal Addendum",
                        'targets': 2,
                        'searchable': true,
                        'orderable': true,
                        "className": "text-center"
                    },
                    {
                        "title": "Action",
                        'targets': 3,
                        'searchable': false,
                        'orderable': false,
                        "className": "text-center"
                    },
                ],

                columns: [{
                        "className": '',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                    {
                        data: 'no_reference',
                        name: 'no_reference'
                    },
                    {
                        data: 'date_addendum',
                        name: 'date_addendum',
                        "render": function(data) {
                            return moment(data).format('DD MMMM YYYY')
                        }
                    },
                    {
                        "data": 'id',
                        "width": '100',
                        "render": function(data, type, row, meta) {
                            return '<a href="#!" class="btn btn-sm btn-success btn-sm" data-date="' +
                                moment(row.date_addendum).format('DD-MM-YYYY') + '" data-no="' + row
                                .no_reference + '" style="border-radius: 50px" data-id="' + data +
                                '" id="editData"><i class="bx bx-edit"></i></a>'
                        }
                    },
                ]
            })
        }

        $(document).ready(function() {

            $('#tambahdata').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('.input-daterange input').each(function() {
                $(this).datepicker({
                    format: "dd-mm-yyyy"
                });
            });
            datatable();
        })

        $(document).on('click', '#addData, #editData', function() {
            $('#tambahdata #id').val($(this).data('id'));
            $('#tambahdata #addendum_reference').val($(this).data('no'));
            $('#tambahdata #date_addendum').val($(this).data('date'));
            var title = 'Tambah';
            if ($(this).data('id')) {
                title = 'Edit'
            }
            $('#title').html(title);
            $('#tambahdata').modal('show');
        })
    </script>
@endsection
