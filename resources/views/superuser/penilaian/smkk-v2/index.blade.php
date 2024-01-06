@extends('superuser.base')

@section('moreCss')
    {{-- <link rel="stylesheet" href="{{ asset('css/tab.css') }}" type="text/css"> --}}

@endsection

@section('title')
    Penilaian SMKK V2
@endsection

@section('content')
    <section class="" style="margin-top: 100px">
        <div class="mt-4" style="min-height: 23vh">
            <div class="table-container">
                <div class="header-table">
                    <p class="title-table fw-bold t-primary">Data Paket Kontruksi</p>
                </div>

                <table id="table" class="table table-striped" style="width:100%">
                </table>
            </div>
        </div>
    </section>
@endsection

@section('script')


    <script>
        var table;
        let tahun = $('#year-list').val();
        var path = '/{{ request()->path() }}';

        function generateTablePackage() {
            table = $('#table').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: path,
                    'data': function (d) {
                        return $.extend(
                            {},
                            d,
                            {
                                'year': $('#year-list').val(),
                            },
                        );
                    }
                },
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    // debugger;
                    var numStart = this.fnPagingInfo().iStart;
                    var index = numStart + iDisplayIndexFull + 1;
                    // var index = iDisplayIndexFull + 1;
                    $("td:first", nRow).html(index);
                    return nRow;
                },
                columnDefs: [
                    {
                        "title": "#",
                        "searchable": false,
                        "orderable": false,
                        "targets": 0,
                        "className": "text-center",
                        "width": "100"
                    },
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
                        data: 'date', name: 'date', render: function (data) {
                            return moment(data).format('DD MMMM YYYY')
                        }
                    },
                    {data: 'ppk.name', name: 'ppk.name'},
                    {data: 'vendor.vendor.name', name: 'vendor.vendor.name'},
                    {
                        data: 'start_at', name: 'start_at', render: function (data) {
                            return moment(data).format('DD MMMM YYYY')
                        }
                    },
                    {
                        data: 'finish_at', name: 'finish_at', render: function (data) {
                            return moment(data).format('DD MMMM YYYY')
                        }
                    },
                    {
                        "data": 'id',
                        "width": '100',
                        "render": function (data, type, row, meta) {
                            let url = path + '/' + data;
                            return '<a href="' + url + '" class="bt-primary-xsm" data-id="' + data + '" id="editData">Detail</a>'
                        }
                    },
                ]
            })
        }

        $(document).ready(function () {
            generateTablePackage();
            $('#year-list').on('change', function () {
                table.ajax.reload();
            });
        });
    </script>
@endsection
