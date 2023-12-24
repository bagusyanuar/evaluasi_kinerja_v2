@if($data == 'content')

    <div class="table-container">
        <div class="header-table" >
            <p class="title-table fw-bold t-primary" >Data Hasil Evaluasi Paket</p>
        </div>
        <table id="table" class="table table-striped" style="width:100%">
        </table>
    </div>

@elseif($data == 'script')
    <script>
        var table;

        function datatable() {
            var url = 'penilaian/datatable';
            if (getParameter('vendor')){
                url = url+'/vendor/'+getParameter('vendor')
            }
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
                        "title": "Penyedia Jasa",
                        'targets': 3,
                        'searchable': true,
                        'orderable': true,
                        "className": "text-center"
                    },
                    {"title": "PPK", 'targets': 4, 'searchable': true, 'orderable': true, "className": "text-center"},
                    {"title": "Mulai", 'targets': 5, 'searchable': true, 'orderable': true, "className": "text-center"},
                    {"title": "Selesai", 'targets': 6, 'searchable': true, 'orderable': true, "className": "text-center"},
                    {
                        "title": "Action",
                        'targets': 7,
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
                    {data: 'name', name: 'name'},
                    {data: 'no_reference', name: 'no_reference'},
                    {data: 'vendor.vendor.name', name: 'vendor.vendor.name'},
                    {data: 'ppk.name', name: 'ppk.name'},
                    {
                        data: 'start_at', name: 'ppk.start_at',
                        render: function (data) {
                            return moment(data).format('DD MMMM YYYY')
                        }
                    },
                    {
                        data: 'finish_at', name: 'finish_at.name',
                        render: function (data) {
                            return moment(data).format('DD MMMM YYYY')
                        }
                    },
                    {
                        "data": 'id',
                        "width": '100',
                        "render": function (data, type, row, meta) {
                            return '<a href="/penilaian/detail/' + data + '" class="bt-primary-xsm" data-id="' + data + '" id="editData">Detail</a>'
                        }
                    },
                ]
            })
        }

        $(document).ready(function () {
            datatable()
        });

    </script>
@endif
