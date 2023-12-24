@extends('superuser.base')

@section('moreCss')
    {{-- <link rel="stylesheet" href="{{ asset('css/tab.css') }}" type="text/css"> --}}
@endsection



@section('content')

    <section class="___class_+?0___ mt-content">
<a class="btn btn-success" href="/indikator-smkk">RK SMKK</a>
		<a class="btn btn-success" href="/indikator-rkkkonsultan">RKK Konsultan</a>
		<a class="btn btn-success" href="/indikator-rkkkontraktor">RKK Kontraktor</a>
		<a class="btn btn-success" href="/indikator-rmpkpm">RMPKPM</a>
		<a class="btn btn-success" href="/indikator-rmllp">RMLLP</a>
		<a class="btn btn-success" href="/indikator-rkpplkontraktor">RKPPL Kontraktor</a>
		<a class="btn btn-success" href="/indikator-rkpplpengawasan">RKPPL Pengawasan</a>
		<a class="btn btn-success" href="/indikator-rkpplperencanaan">RKPPL Perencanaan</a>
		<a class="btn btn-success" href="/indikator-atj">ATJ</a>
        <div class="mt-4  table-container" style="min-height: 23vh">
            <div class="header-table">
                <div>
                <p class="title-table fw-bold t-primary mb-0">Data Indikator RKK Konsultan</p>
            </div>
                <div>
                    <form class="d-flex">
                        <input class="form-control" type="text" name="cari"
                               style="border-top-right-radius: 0;border-bottom-right-radius: 0;"
                               value="{{ request('cari') }}" placeholder="Cari master indikator">
                        <button class="btn btn-primary me-3" style="border-top-left-radius: 0;border-bottom-left-radius: 0;"
                                type="submit"><i class='bx bx-search-alt-2'></i></button>
                        {{-- <a class="btn btn-primary" href="/indikator-rkkkonsultan"><i class='bx bx-reset'></i></a> --}}
                        <a class="bt-primary-sm " id="addData" style="min-width: 100px"><i class='bx bx-plus'></i> Tambah Data</a>

                    </form>
                </div>
            </div>

            <div class="___class_+?8___">
                <div class="row" id="rowIndikator">
                </div>
            </div>
        </div>

        <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span> Data Indikator</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form" onsubmit="return Save()">
                            @csrf
                            <input id="id" name="id" hidden>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Indikator</label>
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
        var title, idSubIndikatorRkkkonsultan, idIndikatorRkkkonsultan;
        $(document).ready(function () {
           // getSum();
            getRkkkonsultanIndicator()
           
        });

        $(document).on('keypress', '#textNameSub', function (e) {

            if (e.which === 13) {
                var idIndikatorRkkkonsultan = $(this).data('id-indikator');
                var name = $(this).val();
                var id = $(this).data('id');
                //
                saveSubIndicatorRkkkonsultan(idIndikatorRkkkonsultan, id, name)
            }
        })

        $(document).on('click', '#addSubIndikatorRkkkonsultan', function () {
            $('.trInput').remove();
            var id = $(this).data('id');
            $('#table' + id + ' tr:last').after('<tr id="trInput" class="trInput">' +
                '                                   <td colspan="2"><input id="textNameSub" data-id-indikator="' + id + '" type="text" class="form-control" name="name" value="" required></td>' +
                '                                   <td class="text-center"><a class="btn btn-sm btn-success me-2"  style="border-radius: 50px; width: 50px" data-id-indikator="' +
                id + '" id="saveSubIndicatorRkkkonsultan"><i class=\'bx bxs-save\'></i></a>' +
                '                                   <a class="btn btn-sm btn-danger"  style="border-radius: 50px; width: 50px" data-id-indikator="' +
                id + '" id="clearInputSubIndikatorRkkkonsultan"><i class=\'bx bx-window-close\'></i></a></td>' +
                '                                </tr>');
            $('#trInput [name="name"]').focus();
        })
		
		
        $(document).on('click', '#clearInputSubIndikatorRkkkonsultan', function () {
            $('.trInput').remove();
        })

        $(document).on('click', '#editSubIndikatorRkkkonsultan', function () {
            var $item = $(this).closest("tr")
            idSubIndikatorRkkkonsultan = $(this).data('id');
            idIndikatorRkkkonsultan = $(this).data('id-indikator')
            $item.html('' +
                '                                   <td colspan="2"><input type="text" class="form-control" name="name" value="' +
                $(this).data('name') + '" required></td>' + 
				
                '                                   <td class="text-center"><a class="btn btn-sm btn-success me-2"  style="border-radius: 50px; width: 50px" data-id="' +
                idSubIndikatorRkkkonsultan + '" data-id-indikator="' + idIndikatorRkkkonsultan +
                '" id="saveSubIndicatorRkkkonsultan"><i class=\'bx bxs-save\'></i></a>' +
                '                                   <a class="btn btn-sm btn-danger"  style="border-radius: 50px; width: 50px" data-id-indikator="' +
                idIndikatorRkkkonsultan +
                '" id="clearEditInputSubIndikatorRkkkonsultan"><i class=\'bx bx-window-close\'></i></a></td>' +
                '                                ');

        })

        $(document).on('click', '#clearEditInputSubIndikatorRkkkonsultan', function () {

            getSubIndikator($(this).data('id-indikator'))
        })

        $(document).on('click', '#saveSubIndicatorRkkkonsultan', function () {
            var title = 'Tambah';
            if ($(this).data('id')) {
                title = 'Edit'
            }
            if ($('#trInput [name="name"]').val() === '') {
                swal("Nama sub indikator harus disisi", {
                    icon: "warning",
                    buttons: false,
                    timer: 2000
                })
                return false
            }

            var idIndikatorRkkkonsultan = $(this).data('id-indikator');
            var name = $('[name="name"]').val();
            var id = $(this).data('id');
			
            saveSubIndicatorRkkkonsultan(idIndikatorRkkkonsultan, id, name)
        })

        function saveSubIndicatorRkkkonsultan(idIndikatorRkkkonsultan, id, name) {
            var data = {
                '_token': '{{ csrf_token() }}',
                'id': id,
                'name': name,
				
            }
            saveDataObject(title + ' Data Sub Indikator', data, window.location.pathname + '/' + idIndikatorRkkkonsultan,
                afterSaveSub)
            return false;
        }

        function afterSaveSub(data) {
            $('.trInput').remove();

            getSubIndikatorRkkkonsultan(data['data'])
        }

        function getRkkkonsultanIndicator() {
            var filter = {
                'cari': '{{ request('cari') }}'
            }

            $.get('/indikator-rkkkonsultan/get-rkkkonsultan', filter, function (data) {
               $('#rowIndikator').empty();
                $.each(data, function (key, value) {
                    var name = value['name'];

                    $('#rowIndikator').append('<div class="col-sm-12  ">\n' +
                        '                        <div class="card-indikator table-container">\n' +
                        '                            <div class="header-indikator">\n' +
                        '                                <div class="row"><p class="mb-0 fw-bold">' +name + '</span> </p>'+
                       
                        '                                      ' +
                        '                                 </div>' +
                        '                               <div> '+
                            '<span><a class="bt-primary-xsm me-1" title="Edit Master Indikator" data-name="' + name + '"  data-id="' + value['id'] +
                        '" id="editData"><i class=\'bx bx-edit-alt\'></i> edit </a></span>\n' +
                        '    <a class="bt-success-xsm " data-id="' + value['id'] + '"  id="addSubIndikatorRkkkonsultan"><i class="bx bx-plus" ></i>Tambah Sub</a> \n' +
                        '                                <a class="bt-danger-xsm " data-name="'+name+'" data-id="' + value['id'] + '"  id="deleteIndikatorRkkkonsultan"><i class="bx bx-x"></i></a> \n' +
                        '                            </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="body-indikator">\n' +
                        '                                <table class="table" id="table' + value['id'] +
                        '">\n' +
                        '                                    <thead>\n' +
                        '                                    <tr>\n' +
                        '                                       <th colspan="2" style="width: 85%">Sub Indikator</th>\n' +
                        '                                        <th class="text-center"  colspan="2">Aksi</th>\n' +
                        '                                    </tr>\n' +
                        '                                    </thead>\n' +
                        '                                    <tbody id="tbody' + value['id'] + '">\n' +
                        '                                    </tbody>\n' +
                        '                                </table>\n' +
                        '                            </div>\n' +
                        '                        </div>\n' +
                        '                    </div>');
                    $.each(value['sub_indicator'], function (k, v) {
                        $('#tbody' + value['id']).append(' <tr>\n' +
                            '                                        <td>' + parseInt(k + 1) +
                            '                                        <td>' + v['name'] +
                            '</td>\n' +
                            '                                        <td class="text-center" style="width: 150px;"><a href="#!" class="btn btn-sm btn-danger btn-sm me-2" style="border-radius: 50px; width: 50px" data-name="' + v['name'] + '" data-indikator="' + value['id'] + '" data-id="' + v['id'] +
                            '" id="deleteSubIndikatorRkkkonsultan"><i class="bx bx-trash-alt"></i></a>' +
                            '                                             <a href="#!" class="btn btn-sm btn-success btn-sm" style="border-radius: 50px; width: 50px" data-name="' +
                            v['name'] + '"  data-id-indikator="' + value['id'] +
                            '"  data-id="' + v['id'] +
                            '" id="editSubIndikatorRkkkonsultan"><i class="bx bx-edit"></i></a></td>\n' +
                            '                                    </tr>')
                    })

                })
            })
        }

        function getSubIndikatorRkkkonsultan(id) {
            $.get('/indikator-rkkkonsultan/' + id + '/sub', function (data) {
				 $('#tbody' + id).empty();
                $.each(data, function (k, v) {
                    $('#tbody' + v['indicator_id']).append(' <tr>\n' +
                        '                                        <td >' + parseInt(k + 1) + '</td>\n' +
                        '                                        <td>' + v['name'] + '</td>\n' +
													 
                        '                                        <td class="text-center"><a href="#!" class="btn btn-sm btn-danger btn-sm me-2" style="border-radius: 50px; width: 50px" data-indikator="' + id + '" data-name="' + v['name'] + '"  data-id="' +
                        v['id'] + '" id="deleteSubIndikatorRkkkonsultan"><i class="bx bx-trash-alt"></i></a>' +
                        '                                             <a href="#!" class="btn btn-sm btn-success btn-sm" style="border-radius: 50px; width: 50px"  data-id="' +
                        v['id'] + '" data-name="' + v['name'] + '"  data-id-indikator="' + v[
                            'indicator_id'] +
                        '" id="editSubIndikatorRkkkonsultan"><i class="bx bx-edit"></i></a></td>\n' +
                        '                                    </tr>')
                })
            })
        }

        $(document).on('click', '#deleteSubIndikatorRkkkonsultan', function () {
            deleteData($(this).data('name'), window.location.pathname + '/' + $(this).data('indikator') + '/sub/' + $(this).data('id') + '/delete', getSubIndikatorRkkkonsultan)
            return false;
        })

        $(document).on('click', '#deleteIndikatorRkkkonsultan', function () {
            deleteData($(this).data('name'), window.location.pathname + '/' + $(this).data('id') + '/delete')
            return false;
        })

        $(document).on('click', '#addData, #editData', function () {
            $('#tambahdata #id').val($(this).data('id'));
            $('#tambahdata #name').val($(this).data('name'));
          //  $('#tambahdata #weight').val($(this).data('weight') ?? '0.');
            title = 'Tambah';
            if ($(this).data('id')) {
                title = 'Edit'
            }
            $('#tambahdata #title').html(title);
            $('#tambahdata').modal('show');
        });

        function getSum() {
            $.get(window.location.pathname+'/get-sum', function (data) {
                $('#sumBobot').html(data);
            })
        }

        function Save() {
            saveData(title + ' Data Main Indikator', 'form')
            return false;
        }

        function afterSave() {

        }
    </script>
@endsection
