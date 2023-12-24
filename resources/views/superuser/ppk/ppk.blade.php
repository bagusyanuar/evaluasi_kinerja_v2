@extends('superuser.base')

@section('moreCss')
    {{-- <link rel="stylesheet" href="{{ asset('css/tab.css') }}" type="text/css"> --}}
@endsection

@section('title')
    Dashboard
@endsection

@section('content')

    <section class="mt-content" >

        <!-- Tab panes -->
        <div class="mt-4" style="min-height: 23vh">
            <!-- Tab panes -->
            {{-- @yield('contentUser') --}}


            <div class="table-container">
                <div class="header-table">
                    <p class="title-table fw-bold t-primary ">Data PPK</p>
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
                        <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span> Data PPK</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form" onsubmit="return Save()">
                            @csrf
                            <input id="id" name="id" hidden>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama PPK</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <button type="submit" class="bt-primary">Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        var table, title;
        $(document).ready(function() {
            datatable()
        });


        $(document).on('click', '#addData, #editData', function() {
            $('#tambahdata #id').val($(this).data('id'));
            title = 'Tambah';
            if ($(this).data('id')){
                title = 'Edit';
            }
            $('#tambahdata #title').html(title);
            $('#tambahdata #name').val($(this).data('name'));

            $('#tambahdata').modal('show');
        })

        function Save() {
            saveData(title+' Data PPK','form',null,afterSave)
            return false;
        }

        function afterSave() {
            $('#tambahdata').modal('hide');
            datatable()
        }

        function datatable(){

            var url = window.location.pathname+'/datatable';
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
                    {"title": "#", "searchable": false, "orderable": false, "targets": 0,"className": "text-center", "width": "100"},
                    {"title": "Nama", 'targets': 1, 'searchable': true, 'orderable': true, "className": "text-center"},
                    {"title": "Action", 'targets': 2, 'searchable': false, 'orderable': false, "className": "text-center"},
                ],

                columns: [
                    {
                        "className": '',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    },
                    {data: 'name', name:  'name'},
                    {
                        "target": 2,
                        "data": 'id',
                        "width": '100',
                        "render": function (data, type, row, meta) {
                            return '<a href="#!" class="btn btn-sm btn-danger btn-sm me-2" style="border-radius: 50px" data-name="'+row.name+'"  data-id="' + data + '" id="deleteData"><i class="bx bx-trash-alt"></i></a>' +
                                '<a href="#!" class="btn btn-sm btn-success btn-sm" style="border-radius: 50px"  data-name="'+row.name+'" data-id="' + data + '" id="editData"><i class="bx bx-edit"></i></a>'
                        }
                    },
                ]
            })
        }
        $(document).on('click', '#deleteData', function () {
            deleteData($(this).data('name'), window.location.pathname+'/'+$(this).data('id')+'/delete', afterSave())
            return false
        })

    </script>
@endsection
