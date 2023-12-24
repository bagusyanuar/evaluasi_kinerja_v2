@extends('superuser.base')

@section('moreCss')
    {{-- <link rel="stylesheet" href="{{ asset('css/tab.css') }}" type="text/css"> --}}
@endsection



@section('content')

    <section class="___class_+?0___ mt-content">
		
        <div class="mt-4  table-container" style="min-height: 23vh">
            <div class="header-table">
                <div>
                <p class="title-table fw-bold t-primary mb-0">Data Indikator </p>
                <span class="badge bg-danger">Total Bobot : <span id="sumBobot"></span></span>
				<span class="badge bg-success">Bobot Penyedia Jasa : 5 %</span>
				<span class="badge bg-success">Bobot PPK : 55 % </span>
				<span class="badge bg-success">Bobot Balai : 40 % </span>
            </div>
                <div>
                    <form class="d-flex">
                        <input class="form-control" type="text" name="cari"
                               style="border-top-right-radius: 0;border-bottom-right-radius: 0;"
                               value="{{ request('cari') }}" placeholder="Cari master indikator">
                        <button class="btn btn-primary me-3" style="border-top-left-radius: 0;border-bottom-left-radius: 0;"
                                type="submit"><i class='bx bx-search-alt-2'></i></button>
                        {{-- <a class="btn btn-primary" href="/indikator"><i class='bx bx-reset'></i></a> --}}
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
                            <div class="mb-3">
                                <label for="weight" class="form-label">Bobot</label>
                                <input type="text" class="form-control" id="weight" name="weight" required value="0">
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
        var title, idSubIndikator, idIndikator;
        $(document).ready(function () {
            getSum();
            getMainIndicator()
            currency('weight')
        });

        $(document).on('keypress', '#textNameSub', function (e) {

            if (e.which === 13) {
                var idIndikator = $(this).data('id-indikator');
                var name = $(this).val();
                var id = $(this).data('id');
                //
                saveSubIndicator(idIndikator, id, name)
            }
        })

        $(document).on('click', '#addSubIndikaor', function () {
            $('.trInput').remove();
            var id = $(this).data('id');
			var options = '';
			  $.get('/indikator/get-perlem', function (data) {				
					$.each(data, function(index, value) {
						options += '<option value="' + value.id + '" text="' + value.name + '" />';
					});
			  });
			  
            $('#table' + id + ' tr:last').after('<tr id="trInput" class="trInput">' +
                '                                   <td colspan="2"><input id="textNameSub" data-id-indikator="' + id + '" type="text" class="form-control" name="name" value="" required></td>' +
               		                                   
				'<td class="text-center"><select class="form-control" id="perlem"> <option value="">Pilih Kategori</option><option value="1">Kualitas dan Kuantitas</option><option value="2">Biaya</option><option value="3">Waktu</option><option value="4">Layanan</option></select></td>' +
                
				
				'									<td class="text-center"><a class="btn btn-sm btn-success me-2"  style="border-radius: 50px; width: 50px" data-id-indikator="' +
                id + '" id="saveSubIndicator"><i class=\'bx bxs-save\'></i></a>' +
                '                                   <a class="btn btn-sm btn-danger"  style="border-radius: 50px; width: 50px" data-id-indikator="' +
                id + '" id="clearInputSubIndikator"><i class=\'bx bx-window-close\'></i></a></td>' +
                '                                </tr>');
            $('#trInput [name="name"]').focus();
        })

        $(document).on('click', '#clearInputSubIndikator', function () {
            $('.trInput').remove();
        })

        $(document).on('click', '#editSubIndikator', function () {
            var $item = $(this).closest("tr")
            idSubIndikator = $(this).data('id');
            idIndikator = $(this).data('id-indikator')
            $item.html('' +
                '                                   <td colspan="2"><input type="text" class="form-control" name="name" value="' +
                $(this).data('name') + '" required></td>' + 
				'<td class="text-center"><input id="text" data-id-indikatorperlem="" type="text" class="form-control" name="name" value="" required></td>' +
                
                '                                   <td class="text-center"><a class="btn btn-sm btn-success me-2"  style="border-radius: 50px; width: 50px" data-id="' +
                idSubIndikator + '" data-id-indikator="' + idIndikator +
                '" id="saveSubIndicator"><i class=\'bx bxs-save\'></i></a>' +
                '                                   <a class="btn btn-sm btn-danger"  style="border-radius: 50px; width: 50px" data-id-indikator="' +
                idIndikator +
                '" id="clearEditInputSubIndikator"><i class=\'bx bx-window-close\'></i></a></td>' +
                '                                ');

        })

        $(document).on('click', '#clearEditInputSubIndikator', function () {

            getSubIndikator($(this).data('id-indikator'))
        })

        $(document).on('click', '#saveSubIndicator', function () {
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

            var idIndikator = $(this).data('id-indikator');
            var name = $('[name="name"]').val();
            var id = $(this).data('id');
			var perlem=  document.getElementById('perlem').value;

            saveSubIndicator(idIndikator, id, name, perlem)
        })

        function saveSubIndicator(idIndikator, id, name, perlem) {
            var data = {
                '_token': '{{ csrf_token() }}',
                'id': id,
                'name': name,
				'perlem': perlem
            }
            saveDataObject(title + ' Data Sub Indikator', data, window.location.pathname + '/' + idIndikator,
                afterSaveSub)
            return false;
        }

        function afterSaveSub(data) {
            $('.trInput').remove();

            getSubIndikator(data['data'])
        }

        function getMainIndicator() {
            var filter = {
                'cari': '{{ request('cari') }}'
            }

            $.get('/indikator/get-all', filter, function (data) {
                $('#rowIndikator').empty();
                $.each(data, function (key, value) {
                    var name = value['name'];

                    $('#rowIndikator').append('<div class="col-sm-12  ">\n' +
                        '                        <div class="card-indikator table-container">\n' +
                        '                            <div class="header-indikator">\n' +
                        '                                <div class="row"><p class="mb-0 fw-bold">' +name + ' <span class="badge bg-primary">Bobot : ' + value['weight'] + '</span> </p>'+
                       
                        '                                      ' +
                        '                                 </div>' +
                        '                               <div> '+
                            '<span><a class="bt-primary-xsm me-1" title="Edit Master Indikator" data-weight="' +
                        value['weight'] + '" data-name="' + name + '"  data-id="' + value['id'] +
                        '" id="editData"><i class=\'bx bx-edit-alt\'></i> edit </a></span>\n' +
                        '    <a class="bt-success-xsm " data-id="' + value['id'] + '"  id="addSubIndikaor"><i class="bx bx-plus" ></i>Tambah Sub</a> \n' +
                        '                                <a class="bt-danger-xsm " data-name="'+name+'" data-id="' + value['id'] + '"  id="deleteIndikator"><i class="bx bx-x"></i></a> \n' +
                        '                            </div>\n' +
                        '                            </div>\n' +
                        '                            <div class="body-indikator">\n' +
                        '                                <table class="table" id="table' + value['id'] +
                        '">\n' +
                        '                                    <thead>\n' +
                        '                                    <tr>\n' +
                        '                                       <th colspan="2" style="width: 65%">Sub Indikator</th>\n' +
                        '                                        <th class="text-center" >Indikator Perlem 4</th>\n' +
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
						var perlem= v.indicator_perlem !== null ? v.indicator_perlem.name : 'Pilih Indikator';
                        $('#tbody' + value['id']).append(' <tr>\n' +
                            '                                        <td>' + parseInt(k + 1) +
                            '                                        <td>' + v['name'] +
                            '</td>\n' +
							'										 <td  class="text-center">' + perlem +
                            '</td>\n' +
                            '                                        <td class="text-center" style="width: 150px;"><a href="#!" class="btn btn-sm btn-danger btn-sm me-2" style="border-radius: 50px; width: 50px" data-name="' + v['name'] + '" data-indikator="' + value['id'] + '" data-id="' + v['id'] +
                            '" id="deleteSubIndikator"><i class="bx bx-trash-alt"></i></a>' +
                            '                                             <a href="#!" class="btn btn-sm btn-success btn-sm" style="border-radius: 50px; width: 50px" data-name="' +
                            v['name'] + '"  data-id-indikator="' + value['id'] +
                            '"  data-id="' + v['id'] +
                            '" id="editSubIndikator"><i class="bx bx-edit"></i></a></td>\n' +
                            '                                    </tr>')
                    })

                })
            })
        }

        function getSubIndikator(id) {
            $.get('/indikator/' + id + '/sub', function (data) {
				var perlem= data.indicator_perlem !== null ? data.indicator_perlem.name : 'Pilih Indikator';
                $('#tbody' + id).empty();
                $.each(data, function (k, v) {
                    $('#tbody' + v['indicator_id']).append(' <tr>\n' +
                        '                                        <td >' + parseInt(k + 1) + '</td>\n' +
                        '                                        <td>' + v['name'] + '</td>\n' +
						'										 <td  class="text-center">' + perlem +
                            '</td>\n' +
                        '                                        <td class="text-center"><a href="#!" class="btn btn-sm btn-danger btn-sm me-2" style="border-radius: 50px; width: 50px" data-indikator="' + id + '" data-name="' + v['name'] + '"  data-id="' +
                        v['id'] + '" id="deleteSubIndikator"><i class="bx bx-trash-alt"></i></a>' +
                        '                                             <a href="#!" class="btn btn-sm btn-success btn-sm" style="border-radius: 50px; width: 50px"  data-id="' +
                        v['id'] + '" data-name="' + v['name'] + '"  data-id-indikator="' + v[
                            'indicator_id'] +
                        '" id="editSubIndikator"><i class="bx bx-edit"></i></a></td>\n' +
                        '                                    </tr>')
                })
            })
        }

        $(document).on('click', '#deleteSubIndikator', function () {
            deleteData($(this).data('name'), window.location.pathname + '/' + $(this).data('indikator') + '/sub/' + $(this).data('id') + '/delete', getSubIndikator)
            return false;
        })

        $(document).on('click', '#deleteIndikator', function () {
            deleteData($(this).data('name'), window.location.pathname + '/' + $(this).data('id') + '/delete')
            return false;
        })

        $(document).on('click', '#addData, #editData', function () {
            $('#tambahdata #id').val($(this).data('id'));
            $('#tambahdata #name').val($(this).data('name'));
            $('#tambahdata #weight').val($(this).data('weight') ?? '0.');
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
