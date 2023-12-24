@extends('superuser.base')

@section('moreCss')
    <style>
        .banner-information {
            height: 160px;
            width: 100%;
            background-color: #1F9CAC;
        }
        .banner-information .banner-image {
            border-radius: 50%;
            margin-right: 30px;
        }
        .banner-information .banner-name {
            font-size: 30px;
            color: white;
            margin-bottom: 0px;
        }
        .banner-information .banner-qualified {
            font-size: 20px;
            color: white;
            margin-top: 0;
        }
        .banner-information .active-package-panel {
            width: 120px;
            height: 60px;
            background-color: #F7C232;
            border-radius: 10px;
            padding: 5px 5px;
            margin-bottom: 20px;
        }
        .package-choice {
            padding: 10px 20px;
        }
    </style>

@endsection


@section('content')
    <body>
    <style>
        body {
            background-color: #778797;
            font-family: "Segoe UI", sans-serif;
        }
        .card-panel {
            background-color: #1D3752;
            border-radius: 10px;
            box-shadow: 0 8px 60px -10px rgba(13, 28, 39, 0.6);
            padding: 30px 40px;
        }
        .back-panel-2 {
            background-color: #344b63;
        }
        .table-container {
            margin-bottom: 20px
        }
        .header-profile {
            background-color: #1D3752;
            border-radius: 10px;
            box-shadow: 0 8px 60px -10px rgba(13, 28, 39, 0.6);
            padding: 30px 40px;
        }
        .secondary-color-text {
            color: #008B93;
        }
        .secondary-light-text {
            color: #a5afba;
        }
        .primary-light-text {
            color: #e8ebee;
        }
        .color-accent {
            background-color: #DFA01E;
        }
        .header-profile-right {
            border-left: 1px solid #7c7c7c;
        }
        .header-image {
            border-radius: 50%;
            margin-right: 30px;
            /*border: 4px solid #FFC43A;*/
        }
        .header-name {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 0;
        }
        .header-qualified {
            font-size: 16px;
        }
        .header-info {
            display: flex;
            align-items: start;
        }
    </style>

    <section class="container-fluid p-lg-3 p-xl-3">
        <div class=" row">
            <div class="col-xl-12 ">
                <div class="header-profile mb-5">
                    <div class=" row">
                        <div class="col-xl-12 col-lg-12 d-flex">
                            <div class="d-flex flex-column">
                                <div class="flex-grow-1">
                                    <p class="header-name secondary-color-text">{{ $data->name }}</p>
									<div class="header-qualified secondary-light-text">
                                        <span style="margin-right: 20px">Penyedia Jasa : </span>
                                        <span style="color: #DFA01E; font-weight: bold">{{ $data->vendor->vendor->name }}</span> |
										<span style="margin-right: 20px">PPK : </span>
                                        <span style="color: #DFA01E; font-weight: bold">{{ $data->ppk->name }}</span>
                                    </div>
									<div class="header-qualified secondary-light-text">
                                        
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
		
		<div class="row">
			<div class="col-xl-12 col-lg-12">
				<div role="tablist" class="mb-3">

                    <div class="items-tab" id="menu-tab">
                        <a class="card-tab d-block c-text card-user active" id="smkk" data-roles="smkk">
                            <div class="d-flex justify-content-between">
                                <i class='bx bx-message-square-edit'></i>
                            </div>
                            <div class="mt-2">
                                Penilaian SMKK
                            </div>
                        </a>

                        <a class="card-tab d-block c-text card-user" id="sml" data-roles="sml">
                            <div class="d-flex justify-content-between">
                                <i class='bx bx-message-square-edit'></i>
                            </div>
                            <div class="mt-2">
                                Penilaian SML
                            </div>
                        </a>

                        <a class="card-tab d-block c-text card-user" id="atj" data-roles="atj">
                            <div class="d-flex justify-content-between">
                                <i class='bx bx-message-square-edit'></i>
                            </div>
                            <div class="mt-2">
                                Administrasi Teknik Jalan
                            </div>
                        </a>

                        <a class="card-tab d-block c-text card-user" id="komulatif" data-roles="komulatif">
                            <div class="d-flex justify-content-between">
                                <i class='bx bx-message-square-edit'></i>
                            </div>
                            <div class="mt-2">
                                Komulatif
                            </div>
                        </a>
                    </div>
                </div>
				
				<div class="row">
					<div class="col-12" id="content-detail-nilai">
                        <div class="card-panel back-panel-2 table-container">
                            <p class="fw-bold t-black" id="penilaian-title">Detail Penilaian</p>
                            <hr>
                            <div id="result-container">
                            </div>
                        </div>
                    </div>
				</div>
				<div class="row">
					<div class="col-12" id="content-detail-nilai2">
                        <div class="card-panel back-panel-2 table-container" >
                            <p class="fw-bold t-black" id="penilaian-title2">Detail Penilaian 2</p>
                            <hr>
                            <div id="result-container2">
                            </div>
                        </div>
                    </div>
				</div>
				<div class="row">
					<div class="col-12" id="content-detail-nilai3">
                        <div class="card-panel back-panel-2 table-container" >
                            <p class="fw-bold t-black" id="penilaian-title3">Detail Penilaian 3</p>
                            <hr>
                            <div id="result-container3">
                            </div>
                        </div>
                    </div>
				</div>
				<div class="row">
					<div class="col-12" id="content-detail-nilai4">
                        <div class="card-panel back-panel-2 table-container">
                            <p class="fw-bold t-black" id="penilaian-title4">Detail Penilaian 4</p>
                            <hr>
                            <div id="result-container4">
                            </div>
                        </div>
                    </div>
				</div>
				<div class="row">
					<div class="col-12" id="content-detail-nilai5">
                        <div class="card-panel back-panel-2 table-container">
                            <p class="fw-bold t-black" id="penilaian-title5">Detail Penilaian 5</p>
                            <hr>
                            <div id="result-container5">
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		
        <div class="modal fade" id="modalfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span> Upload File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form" onsubmit="return Save()">
                            @csrf
                            <input id="id" name="id" hidden>
                            <input id="packageid" name="packageid" hidden>
                            <input id="tbl" name="tbl" hidden>
                            
							
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Sub Indikator</label>
                                <p class="fw-bold" id="fileNameSub"></p>
                               
                            </div>
                            <div class="mb-3">
                                <label for="weight" class="form-label">File</label>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            <button type="submit" class="bt-primary">Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="modalHistory" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="history-container">
                        <div class="d-flex align-items-center justify-content-center w-100">
                            <div class="spinner-grow spinner-grow-sm text-info mr-2" role="status"
                                 style="margin-right: 10px">
                            </div>
                            <div class="spinner-grow spinner-grow-sm text-info mr-2" role="status"
                                 style="margin-right: 10px">
                            </div>
                            <div class="spinner-grow spinner-grow-sm text-info mr-2" role="status"
                                 style="margin-right: 10px">
                            </div>
                            <div class="spinner-grow spinner-grow-sm text-info mr-2" role="status"
                                 style="margin-right: 10px">
                            </div>
                            <div class="spinner-grow spinner-grow-sm text-info mr-2" role="status">
                            </div>
                        </div>
                        <div class="text-center">
                            <span>Sedang Mengunduh Riwayat Perubahan Terakhir....</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalCatatan" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="note-container">
                        <form id="form-note" onsubmit="return SaveNote()">
                            @csrf
                            <input type="hidden" name="id-note" id="id-note" value="">
                            <div class="mb-3">
                                <label for="note" class="form-label">Catatan</label>
                                <textarea class="form-control" id="note" name="note"></textarea>
                            </div>
                            <button type="submit" class="bt-primary">Simpan</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalCatatan" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="note-container">
                        <form id="form-note" onsubmit="return SaveNote()">
                            @csrf
                            <input type="hidden" name="id-note" id="id-note" value="">
                            <div class="mb-3">
                                <label for="note" class="form-label">Catatan</label>
                                <textarea class="form-control" id="note" name="note"></textarea>
                            </div>
                            <button type="submit" class="bt-primary">Simpan</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalCatatanLihat" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="note" class="form-label">Catatan</label>
                            <p id="note-see"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalFileRequired" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="title"></span>Pemberian Nilai Kurang
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: justify">Pemberian Nilai Di Bawah <span
                                style="font-weight: bold">Cukup</span> Wajib Melampirkan File Atau Mengisi Catatan
                            Penilaian</p>
                        <form id="form-score-with-file" onsubmit="return setScoreWFile()" enctype="multipart/form-data">
                            @csrf
                            <input id="value-score" name="value" hidden>
                            <input id="package-score" name="package" hidden>
                            <input id="sub_indicator_score" name="sub_indicator" hidden>
                            <input id="index-score" name="index" hidden>
                            <div class="mb-3">
                                <label for="weight" class="form-label">File Lampiran</label>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Catatan</label>
                                <textarea class="form-control" id="note" name="note"></textarea>
                            </div>
                            <button type="submit" class="bt-primary">Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
    </body>

@endsection


@section('script')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script type="text/javascript">
        var package_id = '{{ $data->id }}';
		var roles = '{{ auth()->user()->roles[0] }}';
        var index = 'vendor';
		
		
	//GANTI MENU
        var header = document.getElementById("menu-tab");
        var btns = header.getElementsByClassName("card-tab");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function () {
                var current = $('.card-tab.active')
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active ";
            });
        }
	
	  function getCurrentDateString(date) {
            return date.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            })
        }
	 function elMainIndicator(key, value) {
            return '<tr class="bg-prim-light" id="indicator-' + key + '">' +
                '<th>' + (key + 1) + '</th>' +
                '<th >' + value['name'] + '</th>' +
                '<th style="min-width: 110px">File</th>' +
				'<th style="min-width: 110px" >Nilai</th>' +
                '</tr>'
        }
	 function elMainIndicator2(key, value) {
            return '<tr class="bg-prim-light" id="indicator2-' + key + '">' +
                '<th>' + (key + 1) + '</th>' +
                '<th >' + value['name'] + '</th>' +
                '<th style="min-width: 110px">File</th>' +
				'<th style="min-width: 110px" >Nilai</th>' +
                '</tr>'
        }
	 function elMainIndicator3(key, value) {
            return '<tr class="bg-prim-light" id="indicator3-' + key + '">' +
               '<th>' + (key + 1) + '</th>' +
                '<th >' + value['name'] + '</th>' +
                '<th style="min-width: 110px">File</th>' +
				'<th style="min-width: 110px" >Nilai</th>' +
                '</tr>'
        }
	 function elMainIndicator4(key, value) {
            return '<tr class="bg-prim-light" id="indicator4-' + key + '">' +
              '<th>' + (key + 1) + '</th>' +
                '<th >' + value['name'] + '</th>' +
                '<th style="min-width: 110px">File</th>' +
				'<th style="min-width: 110px" >Nilai</th>' +
                '</tr>'
        }
	 function elMainIndicator5(key, value) {
            return '<tr class="bg-prim-light" id="indicator5-' + key + '">' +
               '<th>' + (key + 1) + '</th>' +
                '<th >' + value['name'] + '</th>' +
                '<th style="min-width: 110px">File</th>' +
				'<th style="min-width: 110px" >Nilai</th>' +
                '</tr>'
        }
		
	 function elFileDropdown(hasFile = false, hasAccess = false, hasScore = false, link, name,scoreid, id, packageid, tbl) {
             
			let type1 = '<div class="dropdown-menu">' +
                '<a class="dropdown-item" type="button" data-link="' + link + '" id="download">Download</a>' +
                '<a class="dropdown-item" type="button" data-subname="' + name + '"  data-scoreid="' + scoreid + '" data-id="' + id +
                '" data-packageid="' + packageid + '"  data-tbl="' + tbl + '" id="upload">Ganti File</a>' +
                '</div>';
            let type2 = '<div class="dropdown-menu">' +
                '<a class="dropdown-item" type="button" data-link="' + link + '" id="download">Download</a>' +
                '</div>';
            let type3 = '<div class="dropdown-menu">' +
                '<a class="dropdown-item" type="button" data-subname="' + name + '" data-scoreid="' + scoreid + '" data-id="' + id +
                '" data-packageid="' + packageid + '"  data-tbl="' + tbl + '"  id="upload">Upload File</a>' +
                '</div>';
            if (hasAccess) {
                if (!hasFile && !hasScore) {
                    return '<a class="bt-primary-xsm"  style="cursor: pointer"  data-bs-toggle="dropdown" aria-expanded="false">Unggah</a>' +
                        type3;
                }  else {
                    return '<a class="bt-primary-xsm"  style="cursor: pointer"  data-bs-toggle="dropdown" aria-expanded="false">Unduh / Ganti</a>' +
                        type1;
                }
            } else {
                if (!hasFile) {
                    return '<a class="bt-primary-xsm"  style="cursor: pointer"  data-bs-toggle="dropdown" aria-expanded="false">-</a>';
                } else {
                    return '<a class="bt-primary-xsm"  style="cursor: pointer"  data-bs-toggle="dropdown" aria-expanded="false">Unduh</a>' +
                        type2;
                }
            }
        }
	 function elSubIndicator(mainKey, key, value,tbl) {
            const {
                single_score,
                id
            } = value;
            const availableScore = ['Tidak ada', 'Tidak Sempurna', 'Ya Ada'];
            const availableBtnClass = ['bt-primary-xsm', 'b-buruk-light-xsm', 'b-bagus-light-xsm'];
		
            let score = single_score !== null ? single_score['score'] !== null ? availableScore[single_score['score']] : 'Beri Nilai' : '-';
            let hasScore = single_score !== null;
            let file_text = single_score !== null ? single_score['file'] !== null ? 'Download' : 'Upload File' : '-';
            let hasFile = single_score !== null ? single_score['file'] !== null : false;
            let hasNote = single_score !== null ? single_score['note'] !== null : false;
            let note = single_score !== null ? single_score['note'] : '';
            let file_Id = single_score !== null ? single_score['file'] !== null ? 'download' : 'upload' : '-';
            let file_link = single_score !== null ? single_score['file'] : 'Upload File';
            let update_at = single_score !== null ? new Date(single_score['updated_at']) : null;
            let last_update = single_score !== null ? getCurrentDateString(update_at) : '-';
            let button_upload = single_score !== null ? single_score['file'] !== null ?
                '<a class="bt-primary-xsm ms-2" data-subname="' + value['name'] + '" data-link="' + file_link +
                '" data-scoreid="' + single_score['id'] + '" id="upload">Upload File</a>' : '' : '';
            let scoreid = single_score !== null ? single_score['id'] : '';
			let packageid = package_id;
            let dropdown_active = '';
            let el_dropdown = '';
            let hasAccess = false;
            let attrib = '';
            let btn_class = single_score !== null ? single_score['score'] !== null ? availableBtnClass[single_score['score']] : 'bt-primary-xsm' : 'bt-primary-xsm';
                dropdown_active = 'dropdown';
                hasAccess = true;
                attrib = 'data-bs-toggle="dropdown" aria-expanded="false"';
                el_dropdown =
                    '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <button class="dropdown-item nilai" type="button" data-value="2" data-subin="' +
                    id + '">Ya Ada</button>\n' +
                    '<button class="dropdown-item nilai" type="button" data-value="1" data-subin="' + id +
                    '">Tidak Sempurna</button>\n' +
                    '<button class="dropdown-item nilai" type="button" data-value="" data-subin="' + id +
                    '">Tidak Ada</button>' +
                    '</div>';
          
            return '<tr class="primary-light-text" id="tr' + scoreid + '">' +
                '<td class="primary-light-text">' + mainKey + '.' + (key + 1) + '</td>\n' +
                '<td><div class="primary-light-text">' + value['name'] + '' +
                '</div></td>\n' +
                '<td>' + elFileDropdown(hasFile, hasAccess, hasScore, file_link, value['name'], scoreid, id, packageid, tbl) + '</td>\n' +
				'<td><div class="dropdown"><a class="' + btn_class +
                ' dropup "  style="cursor: pointer"  ' + attrib + '>' + score + '</a>\n' +
                el_dropdown +
                '</div></td>\n' +
				'</tr>';
        }	
		
		$(document).on('click', '#download', function () {
            $(this).attr('target', '_blank')
            $(this).attr('href', $(this).data('link'));
        });
        $(document).on('click', '#upload', function () {
            $('#modalfile #fileNameSub').html($(this).data('subname'))
			$('#modalfile #scoreid').html($(this).data('scoreid'))
			$('#modalfile #tbl').val($(this).data('tbl'))
            $('#modalfile #id').val($(this).data('id'))
            $('#modalfile #packageid').val($(this).data('packageid'))
            $('#modalfile #file').val('')
            $('#modalfile').modal('show')
        }) 
		function Save() {
            saveData('Upload File', 'form', '/smkk/upload', afterSaveFile)
            return false;
        }
		function afterSaveFile(data) {
			let tbl = $('#modalfile #tbl').val();
            $('#modalfile').modal('hide')
            if ((tbl === 'rksmkk') || (tbl === 'rkkkonsultan') || (tbl === 'rkkkontraktor') || (tbl === 'rmpkpm') || (tbl === 'rmllp')){
				getScoreSmkk();
				getScoreRkkkonsultan();
				getScoreRkkkontraktor();
				getScoreRmpkpm();
				getScoreRmllp();
			}
			if ((tbl === 'rkpplkontraktor') || (tbl === 'rkpplpengawasan') || (tbl === 'rkpplperencanaan')){
				getScoreRkpplkontraktor();
				getScoreRkpplperencanaan();
				getScoreRkpplpengawasan();
			} 
			if (tbl === 'atj'){
				getScoreAtj();
			}
            // getHistoryScore(index);
        }
	function elSubIndicator2(mainKey, key, value, tbl) {
            const {
                single_score,
                id
            } = value;
            const availableScore = ['Tidak ada', 'Tidak Sempurna', 'Ya Ada'];
            const availableBtnClass = ['bt-primary-xsm', 'b-buruk-light-xsm', 'b-bagus-light-xsm'];
            let score = single_score !== null ? availableScore[single_score['score']] : 'Beri Nilai';
            let hasScore = single_score !== null;
            let file_text = single_score !== null ? single_score['file'] !== null ? 'Download' : 'Upload File' : '-';
            let hasFile = single_score !== null ? single_score['file'] !== null : false;
            let hasNote = single_score !== null ? single_score['note'] !== null : false;
            let note = single_score !== null ? single_score['note'] : '';
            let file_Id = single_score !== null ? single_score['file'] !== null ? 'download' : 'upload' : '-';
            let file_link = single_score !== null ? single_score['file'] : 'Upload File';
            let update_at = single_score !== null ? new Date(single_score['updated_at']) : null;
            let last_update = single_score !== null ? getCurrentDateString(update_at) : '-';
            let button_upload = single_score !== null ? single_score['file'] !== null ?
                '<a class="bt-primary-xsm ms-2" data-subname="' + value['name'] + '" data-link="' + file_link +
                '" data-scoreid="' + single_score['id'] + '" id="upload">Upload File</a>' : '' : '';
            let scoreid = single_score !== null ? single_score['id'] : '';
			let packageid = package_id;
            let dropdown_active = '';
            let el_dropdown = '';
            let hasAccess = false;
           // let hasHistory = score_history.length > 0;
            let attrib = '';
            let btn_class = single_score !== null ? availableBtnClass[single_score['score']] : 'bt-primary-xsm';
                dropdown_active = 'dropdown';
                hasAccess = true;
                attrib = 'data-bs-toggle="dropdown" aria-expanded="false"';
                el_dropdown =
                    '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <button class="dropdown-item nilai2" type="button" data-value="2" data-subin="' +
                    id + '">Ya Ada</button>\n' +
                    '<button class="dropdown-item nilai2" type="button" data-value="1" data-subin="' + id +
                    '">Tidak Sempurna</button>\n' +
                    '<button class="dropdown-item nilai2" type="button" data-value="" data-subin="' + id +
                    '">Tidak Ada</button>' +
                    '</div>';
          
            return '<tr class="primary-light-text" id="tr' + scoreid + '">' +
                '<td class="primary-light-text">' + mainKey + '.' + (key + 1) + '</td>\n' +
                '<td><div class="primary-light-text">' + value['name'] + '' +
                '</div></td>\n' +
				'<td>' + elFileDropdown(hasFile, hasAccess, hasScore, file_link, value['name'], scoreid, id, packageid, tbl) + '</td>\n' +
                '<td><div class="dropdown"><a class="' + btn_class +
                ' dropup "  style="cursor: pointer"  ' + attrib + '>' + score + '</a>\n' +
                el_dropdown +
                '</div></td>\n' +
				'</tr>';
        }	
	
	function elSubIndicator3(mainKey, key, value, tbl) {
            const {
                single_score,
                id
            } = value;
            const availableScore = ['Tidak ada', 'Tidak Sempurna', 'Ya Ada'];
            const availableBtnClass = ['bt-primary-xsm', 'b-buruk-light-xsm', 'b-bagus-light-xsm'];
            let score = single_score !== null ? availableScore[single_score['score']] : 'Beri Nilai';
            let hasScore = single_score !== null;
            let file_text = single_score !== null ? single_score['file'] !== null ? 'Download' : 'Upload File' : '-';
            let hasFile = single_score !== null ? single_score['file'] !== null : false;
            let hasNote = single_score !== null ? single_score['note'] !== null : false;
            let note = single_score !== null ? single_score['note'] : '';
            let file_Id = single_score !== null ? single_score['file'] !== null ? 'download' : 'upload' : '-';
            let file_link = single_score !== null ? single_score['file'] : 'Upload File';
            let update_at = single_score !== null ? new Date(single_score['updated_at']) : null;
            let last_update = single_score !== null ? getCurrentDateString(update_at) : '-';
            let button_upload = single_score !== null ? single_score['file'] !== null ?
                '<a class="bt-primary-xsm ms-2" data-subname="' + value['name'] + '" data-link="' + file_link +
                '" data-scoreid="' + single_score['id'] + '" id="upload">Upload File</a>' : '' : '';
            let scoreid = single_score !== null ? single_score['id'] : '';
			let packageid = package_id;
            let dropdown_active = '';
            let el_dropdown = '';
            let hasAccess = false;
           // let hasHistory = score_history.length > 0;
            let attrib = '';
            let btn_class = single_score !== null ? availableBtnClass[single_score['score']] : 'bt-primary-xsm';
                dropdown_active = 'dropdown';
                hasAccess = true;
                attrib = 'data-bs-toggle="dropdown" aria-expanded="false"';
                el_dropdown =
                    '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <button class="dropdown-item nilai3" type="button" data-value="2" data-subin="' +
                    id + '">Ya Ada</button>\n' +
                    '<button class="dropdown-item nilai3" type="button" data-value="1" data-subin="' + id +
                    '">Tidak Sempurna</button>\n' +
                    '<button class="dropdown-item nilai3" type="button" data-value="" data-subin="' + id +
                    '">Tidak Ada</button>' +
                    '</div>';
          
            return '<tr class="primary-light-text" id="tr' + scoreid + '">' +
                '<td class="primary-light-text">' + mainKey + '.' + (key + 1) + '</td>\n' +
                '<td><div class="primary-light-text">' + value['name'] + '' +
                '</div></td>\n' +
				'<td>' + elFileDropdown(hasFile, hasAccess, hasScore, file_link, value['name'], scoreid, id, packageid, tbl) + '</td>\n' +
                '<td><div class="dropdown"><a class="' + btn_class +
                ' dropup "  style="cursor: pointer"  ' + attrib + '>' + score + '</a>\n' +
                el_dropdown +
                '</div></td>\n' +
                '</tr>';
        }	
	function elSubIndicator4(mainKey, key, value, tbl) {
            const {
                single_score,
                id
            } = value;
            const availableScore = ['Tidak ada', 'Tidak Sempurna', 'Ya Ada'];
            const availableBtnClass = ['bt-primary-xsm', 'b-buruk-light-xsm', 'b-bagus-light-xsm'];
            let score = single_score !== null ? availableScore[single_score['score']] : 'Beri Nilai';
            let hasScore = single_score !== null;
            let file_text = single_score !== null ? single_score['file'] !== null ? 'Download' : 'Upload File' : '-';
            let hasFile = single_score !== null ? single_score['file'] !== null : false;
            let hasNote = single_score !== null ? single_score['note'] !== null : false;
            let note = single_score !== null ? single_score['note'] : '';
            let file_Id = single_score !== null ? single_score['file'] !== null ? 'download' : 'upload' : '-';
            let file_link = single_score !== null ? single_score['file'] : 'Upload File';
            let update_at = single_score !== null ? new Date(single_score['updated_at']) : null;
            let last_update = single_score !== null ? getCurrentDateString(update_at) : '-';
            let button_upload = single_score !== null ? single_score['file'] !== null ?
                '<a class="bt-primary-xsm ms-2" data-subname="' + value['name'] + '" data-link="' + file_link +
                '" data-scoreid="' + single_score['id'] + '" id="upload">Upload File</a>' : '' : '';
            let scoreid = single_score !== null ? single_score['id'] : '';
            let dropdown_active = '';
			let packageid = package_id;
            let el_dropdown = '';
            let hasAccess = false;
           // let hasHistory = score_history.length > 0;
            let attrib = '';
            let btn_class = single_score !== null ? availableBtnClass[single_score['score']] : 'bt-primary-xsm';
                dropdown_active = 'dropdown';
                hasAccess = true;
                attrib = 'data-bs-toggle="dropdown" aria-expanded="false"';
                el_dropdown =
                    '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <button class="dropdown-item nilai4" type="button" data-value="2" data-subin="' +
                    id + '">Ya Ada</button>\n' +
                    '<button class="dropdown-item nilai4" type="button" data-value="1" data-subin="' + id +
                    '">Tidak Sempurna</button>\n' +
                    '<button class="dropdown-item nilai4" type="button" data-value="" data-subin="' + id +
                    '">Tidak Ada</button>' +
                    '</div>';
          
            return '<tr class="primary-light-text" id="tr' + scoreid + '">' +
                '<td class="primary-light-text">' + mainKey + '.' + (key + 1) + '</td>\n' +
                '<td><div class="primary-light-text">' + value['name'] + '' +
                '</div></td>\n' +
				'<td>' + elFileDropdown(hasFile, hasAccess, hasScore, file_link, value['name'], scoreid, id, packageid, tbl) + '</td>\n' +
                '<td><div class="dropdown"><a class="' + btn_class +
                ' dropup "  style="cursor: pointer"  ' + attrib + '>' + score + '</a>\n' +
                el_dropdown +
                '</div></td>\n' +
                '</tr>';
        }	
	
	function elSubIndicator5(mainKey, key, value, tbl) {
            const {
                single_score,
                id
            } = value;
            const availableScore = ['Tidak ada', 'Tidak Sempurna', 'Ya Ada'];
            const availableBtnClass = ['bt-primary-xsm', 'b-buruk-light-xsm', 'b-bagus-light-xsm'];
            let score = single_score !== null ? availableScore[single_score['score']] : 'Beri Nilai';
            let hasScore = single_score !== null;
            let file_text = single_score !== null ? single_score['file'] !== null ? 'Download' : 'Upload File' : '-';
            let hasFile = single_score !== null ? single_score['file'] !== null : false;
            let hasNote = single_score !== null ? single_score['note'] !== null : false;
            let note = single_score !== null ? single_score['note'] : '';
            let file_Id = single_score !== null ? single_score['file'] !== null ? 'download' : 'upload' : '-';
            let file_link = single_score !== null ? single_score['file'] : 'Upload File';
            let update_at = single_score !== null ? new Date(single_score['updated_at']) : null;
            let last_update = single_score !== null ? getCurrentDateString(update_at) : '-';
            let button_upload = single_score !== null ? single_score['file'] !== null ?
                '<a class="bt-primary-xsm ms-2" data-subname="' + value['name'] + '" data-link="' + file_link +
                '" data-scoreid="' + single_score['id'] + '" id="upload">Upload File</a>' : '' : '';
            let scoreid = single_score !== null ? single_score['id'] : '';
            let dropdown_active = '';
			let packageid = package_id;
            let el_dropdown = '';
            let hasAccess = false;
           // let hasHistory = score_history.length > 0;
            let attrib = '';
            let btn_class = single_score !== null ? availableBtnClass[single_score['score']] : 'bt-primary-xsm';
                dropdown_active = 'dropdown';
                hasAccess = true;
                attrib = 'data-bs-toggle="dropdown" aria-expanded="false"';
                el_dropdown =
                    '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <button class="dropdown-item nilai5" type="button" data-value="2" data-subin="' +
                    id + '">Ya Ada</button>\n' +
                    '<button class="dropdown-item nilai5" type="button" data-value="1" data-subin="' + id +
                    '">Tidak Sempurna</button>\n' +
                    '<button class="dropdown-item nilai5" type="button" data-value="" data-subin="' + id +
                    '">Tidak Ada</button>' +
                    '</div>';
          
            return '<tr class="primary-light-text" id="tr' + scoreid + '">' +
                '<td class="primary-light-text">' + mainKey + '.' + (key + 1) + '</td>\n' +
                '<td><div class="primary-light-text">' + value['name'] + '' +
                '</div></td>\n' +
				 '<td>' + elFileDropdown(hasFile, hasAccess, hasScore, file_link, value['name'], scoreid, id, packageid, tbl) + '</td>\n' +
                '<td><div class="dropdown"><a class="' + btn_class +
                ' dropup "  style="cursor: pointer"  ' + attrib + '>' + score + '</a>\n' +
                el_dropdown +
                '</div></td>\n' +
                '</tr>';
        }	
	function elTable() {
            return '<table class="table" style="width:100%">' +
                '<tbody id="table"></tbody>' +
                '</table>';
        }
	function elTable2() {
            return '<table class="table" style="width:100%">' +
                '<tbody id="table2"></tbody>' +
                '</table>';
        }	
	function elTable3() {
            return '<table class="table" style="width:100%">' +
                '<tbody id="table3"></tbody>' +
                '</table>';
        }	
	function elTable4() {
            return '<table class="table" style="width:100%">' +
                '<tbody id="table4"></tbody>' +
                '</table>';
        }	
	function elTable5() {
            return '<table class="table" style="width:100%">' +
                '<tbody id="table5"></tbody>' +
                '</table>';
        }		
	
	 async function getScoreSmkk() {
            let el = $('#result-container');
			let tbl= 'rksmkk';
            try {
                el.empty();
                let response = await $.get('/smkk/results?package=' + package_id);

                let data = response['data']['indicator'];
                el.append(elTable());
                let table = $('#table');
                $.each(data, function (k, v) {
                    table.append(elMainIndicator(k, v));
                    let elMain = $('#indicator-' + k);
                    let sub = '';
					
                    $.each(v['sub_indicator'], function (kSub, vSub) {
                        sub += elSubIndicator((k + 1), kSub, vSub, tbl);
                    });
                    elMain.after(sub);
                });
                 $('.nilai').on('click',  function () {
                    let value = this.dataset.value;
                    let sub_indicator = this.dataset.subin;
                    console.log(value, sub_indicator, package_id);
                    setScore(sub_indicator, value);

                });
				
                console.log(response)
            } catch (e) {
                console.log(e);
            }
        }
		
	 async function getScoreRkkkonsultan() {
            let el2 = $('#result-container2');
			let tbl= 'rkkkonsultan';
            try {
                el2.empty();
                let response2 = await $.get('/smkk/resultsrkkkonsultan?package=' + package_id);
                let data = response2['data']['indicator'];
                el2.append(elTable2());
                let table2 = $('#table2');
               
                $.each(data, function (m, n) {
                    table2.append(elMainIndicator2(m, n));
                    let elMain2 = $('#indicator2-' + m);
                    let sub2 = '';
                    $.each(n['sub_indicator'], function (mSub, nSub) {
                        sub2 += elSubIndicator2((m + 1), mSub, nSub, tbl);
                    });
                    elMain2.after(sub2);
                });
                $('.nilai2').on('click',  function () {
                    let value = this.dataset.value;
                    let sub_indicator = this.dataset.subin;
                    console.log(value, sub_indicator, package_id);
                    setScoreRkkkonsultan(sub_indicator, value);

                });
                console.log(response2)
            } catch (e) {
                console.log(e);
            }
        }
	
	async function getScoreRkkkontraktor() {
            let el3 = $('#result-container3');
			let tbl= 'rkkkontraktor';
            try {
                el3.empty();
                let response3 = await $.get('/smkk/resultsrkkkontraktor?package=' + package_id);
                let data = response3['data']['indicator'];
                el3.append(elTable3());
                let table3 = $('#table3');
                $.each(data, function (k, v) {
                    table3.append(elMainIndicator3(k, v));
                    let elMain3 = $('#indicator3-' + k);
                    let sub3 = '';
                    $.each(v['sub_indicator'], function (kSub, vSub) {
                        sub3 += elSubIndicator3((k + 1), kSub, vSub, tbl);
                    });
                    elMain3.after(sub3);
                });
                $('.nilai3').on('click',  function () {
                    let value = this.dataset.value;
                    let sub_indicator = this.dataset.subin;
                    console.log(value, sub_indicator, package_id);
                    setScoreRkkkontraktor(sub_indicator, value);

                });
                console.log(response3)
            } catch (e) {
                console.log(e);
            }
        }
	
	async function getScoreRmpkpm() {
            let el4 = $('#result-container4');
			let tbl= 'rmpkpm';
            try {
                el4.empty();
                let response4 = await $.get('/smkk/resultsrmpkpm?package=' + package_id);
                let data = response4['data']['indicator'];
                el4.append(elTable4());
                let table4 = $('#table4');
                $.each(data, function (k, v) {
                    table4.append(elMainIndicator4(k, v));
                    let elMain4 = $('#indicator4-' + k);
                    let sub4 = '';
                    $.each(v['sub_indicator'], function (kSub, vSub) {
                        sub4 += elSubIndicator4((k + 1), kSub, vSub, tbl);
                    });
                    elMain4.after(sub4);
                });
                $('.nilai4').on('click',  function () {
                    let value = this.dataset.value;
                    let sub_indicator = this.dataset.subin;
                    console.log(value, sub_indicator, package_id);
                    setScoreRmpkpm(sub_indicator, value);

                });
                console.log(response4)
            } catch (e) {
                console.log(e);
            }
        }
	
	async function getScoreRmllp() {
            let el5 = $('#result-container5');
			let tbl= 'rmllp';
            try {
                el5.empty();
                let response5 = await $.get('/smkk/resultsrmllp?package=' + package_id);
                let data = response5['data']['indicator'];
                el5.append(elTable5());
                let table5 = $('#table5');
                $.each(data, function (k, v) {
                    table5.append(elMainIndicator5(k, v));
                    let elMain5 = $('#indicator5-' + k);
                    let sub5 = '';
                    $.each(v['sub_indicator'], function (kSub, vSub) {
                        sub5 += elSubIndicator5((k + 1), kSub, vSub, tbl);
                    });
                    elMain5.after(sub5);
                });
                $('.nilai5').on('click',  function () {
                    let value = this.dataset.value;
                    let sub_indicator = this.dataset.subin;
                    console.log(value, sub_indicator, package_id);
                    setScoreRmllp(sub_indicator, value);

                });
                console.log(response5)
            } catch (e) {
                console.log(e);
            }
        }
	
	async function getScoreRkpplkontraktor() {
            let el = $('#result-container');
			let tbl= 'rkpplkontraktor';
            try {
                el.empty();
                let response = await $.get('/smkk/resultsrkpplkontraktor?package=' + package_id ) ;
                let data = response['data']['indicator'];
                el.append(elTable());
                let table = $('#table');
                $.each(data, function (k, v) {
                    table.append(elMainIndicator(k, v));
                    let elMain = $('#indicator-' + k);
                    let sub = '';
                    $.each(v['sub_indicator'], function (kSub, vSub) {
                        sub += elSubIndicator((k + 1), kSub, vSub,tbl);
                    });
                    elMain.after(sub);
                });
                $('.nilai').on('click',  function () {
                    let value = this.dataset.value;
                    let sub_indicator = this.dataset.subin;
                    console.log(value, sub_indicator, package_id);
                    setScoreRkpplkontraktor(sub_indicator, value);

                });
                console.log(response)
            } catch (e) {
                console.log(e);
            }
        }
		
	async function getScoreRkpplperencanaan() {
            let el2 = $('#result-container2');
			let tbl= 'rkpplperencanaan';
            try {
                el2.empty();
                let response2 = await $.get('/smkk/resultsrkpplperencanaan?package=' + package_id ) ;
                let data = response2['data']['indicator'];
                el2.append(elTable2());
                let table2 = $('#table2');
                $.each(data, function (k, v) {
                    table2.append(elMainIndicator2(k, v));
                    let elMain2 = $('#indicator2-' + k);
                    let sub2 = '';
                    $.each(v['sub_indicator'], function (kSub, vSub) {
                        sub2 += elSubIndicator2((k + 1), kSub, vSub, tbl);
                    });
                    elMain2.after(sub2);
                });
                $('.nilai2').on('click',  function () {
                    let value = this.dataset.value;
                    let sub_indicator = this.dataset.subin;
                    console.log(value, sub_indicator, package_id);
                    setScoreRkpplperencanaan(sub_indicator, value);

                });
                console.log(response2)
            } catch (e) {
                console.log(e);
            }
        }
	
	async function getScoreRkpplpengawasan() {
            let el3 = $('#result-container3');
			let tbl= 'rkpplpengawasan';
            try {
                el3.empty();
                let response3 = await $.get('/smkk/resultsrkpplpengawasan?package=' + package_id ) ;
                let data = response3['data']['indicator'];
                el3.append(elTable3());
                let table3 = $('#table3');
                $.each(data, function (k, v) {
                    table3.append(elMainIndicator3(k, v));
                    let elMain3 = $('#indicator3-' + k);
                    let sub3 = '';
                    $.each(v['sub_indicator'], function (kSub, vSub) {
                        sub3 += elSubIndicator3((k + 1), kSub, vSub, tbl);
                    });
                    elMain3.after(sub3);
                });
                $('.nilai3').on('click',  function () {
                    let value = this.dataset.value;
                    let sub_indicator = this.dataset.subin;
                    console.log(value, sub_indicator, package_id);
                    setScoreRkpplpengawasan(sub_indicator, value);

                });
                console.log(response3)
            } catch (e) {
                console.log(e);
            }
        }
	
	async function getScoreAtj() {
            let el = $('#result-container');
			let tbl= 'atj';
            try {
                el.empty();
                let response = await $.get('/smkk/resultsatj?package=' + package_id ) ;
                let data = response['data']['indicator'];
                el.append(elTable());
                let table = $('#table');
                $.each(data, function (k, v) {
                    table.append(elMainIndicator(k, v));
                    let elMain = $('#indicator-' + k);
                    let sub = '';
                    $.each(v['sub_indicator'], function (kSub, vSub) {
                        sub += elSubIndicator((k + 1), kSub, vSub, tbl);
                    });
                    elMain.after(sub);
                });
                $('.nilai').on('click',  function () {
                    let value = this.dataset.value;
                    let sub_indicator = this.dataset.subin;
                    console.log(value, sub_indicator, package_id);
                    setScoreAtj(sub_indicator, value);

                });
                console.log(response)
            } catch (e) {
                console.log(e);
            }
        }
	async function setScore(sub, value) {
            try {
                let response = await $.post('/smkk/setscore', {
                    _token: '{{csrf_token()}}',
                    sub_indicator: sub,
                    value: value,
                    index: index,
                    roles: roles,
                    package: package_id
                });
				console.log('tetst respons ', response)
                await getScoreSmkk();

                   
            }catch (e) {
                console.log(response)
            }
        }
	async function setScoreRkkkonsultan(sub, value) {
            try {
                let response = await $.post('/smkk/setscorerkkkonsultan', {
                    _token: '{{csrf_token()}}',
                    sub_indicator: sub,
                    value: value,
                    index: index,
                    package: package_id
                });
				console.log('tetst respons ', response)
                await getScoreRkkkonsultan();

                   
            }catch (e) {
                console.log(response)
            }
        }	
	async function setScoreRkkkontraktor(sub, value) {
            try {
                let response = await $.post('/smkk/setscorerkkkontraktor', {
                    _token: '{{csrf_token()}}',
                    sub_indicator: sub,
                    value: value,
                    index: index,
                    package: package_id
                });
				console.log('tetst respons ', response)
                await getScoreRkkkontraktor();

                   
            }catch (e) {
                console.log(response)
            }
        }	
	async function setScoreRmpkpm(sub, value) {
            try {
                let response = await $.post('/smkk/setscorermpkpm', {
                    _token: '{{csrf_token()}}',
                    sub_indicator: sub,
                    value: value,
                    index: index,
                    package: package_id
                });
				console.log('tetst respons ', response)
                await getScoreRmpkpm();

                   
            }catch (e) {
                console.log(response)
            }
        }	
	async function setScoreRmllp(sub, value) {
            try {
                let response = await $.post('/smkk/setscorermllp', {
                    _token: '{{csrf_token()}}',
                    sub_indicator: sub,
                    value: value,
                    index: index,
                    package: package_id
                });
				console.log('tetst respons ', response)
                await getScoreRmllp();

                   
            }catch (e) {
                console.log(response)
            }
        }
	async function setScoreRkpplkontraktor(sub, value) {
            try {
                let response = await $.post('/smkk/setscorerkpplkontraktor', {
                    _token: '{{csrf_token()}}',
                    sub_indicator: sub,
                    value: value,
                    index: index,
                    package: package_id
                });
				console.log('tetst respons ', response)
                await getScoreRkpplkontraktor();

                   
            }catch (e) {
                console.log(response)
            }
        }
	async function setScoreRkpplpengawasan(sub, value) {
            try {
                let response = await $.post('/smkk/setscorerkpplpengawasan', {
                    _token: '{{csrf_token()}}',
                    sub_indicator: sub,
                    value: value,
                    index: index,
                    package: package_id
                });
				console.log('tetst respons ', response)
                await getScoreRkpplpengawasan();

                   
            }catch (e) {
                console.log(response)
            }
        }
	async function setScoreRkpplperencanaan(sub, value) {
            try {
                let response = await $.post('/smkk/setscorerkpplperencanaan', {
                    _token: '{{csrf_token()}}',
                    sub_indicator: sub,
                    value: value,
                    index: index,
                    package: package_id
                });
				console.log('tetst respons ', response)
                await getScoreRkpplperencanaan();

                   
            }catch (e) {
                console.log(response)
            }
        }
	async function setScoreAtj(sub, value) {
            try {
                let response = await $.post('/smkk/setscoreatj', {
                    _token: '{{csrf_token()}}',
                    sub_indicator: sub,
                    value: value,
                    index: index,
                    package: package_id
                });
				console.log('tetst respons ', response)
                await getScoreAtj();

                   
            }catch (e) {
                console.log(response)
            }
        }
	 $(document).ready(function () {
			//getScore('smkk');
			getScoreSmkk();
			getScoreRkkkonsultan();
			getScoreRkkkontraktor();
			getScoreRmpkpm();
			getScoreRmllp(); 
			$('#content-detail-nilai2').removeClass('d-none');
			$('#content-detail-nilai3').removeClass('d-none');
			$('#content-detail-nilai4').removeClass('d-none');
			$('#content-detail-nilai5').removeClass('d-none');
			$('#content-detail-nilai2').addClass('d-block');
			$('#content-detail-nilai3').addClass('d-block');
			$('#content-detail-nilai4').addClass('d-block');
			$('#content-detail-nilai5').addClass('d-block');
			$('#penilaian-title').html('RK SMKK');
			$('#penilaian-title2').html('RKK KONSULTANSI KONSTRUKSI PENGAWASAN (Konsultan)');
			$('#penilaian-title3').html('RKK PEKERJAAN KONSTRUKSI (Kontraktor)');	
			$('#penilaian-title4').html('RENCANA MUTU PEKERJAAN KONSTRUKSI dan PROGRAM MUTU');	
			$('#penilaian-title5').html('RENCANA MANAJEMEN LALU LINTAS PEKERJAAN (RMLLP)');	
			
            // chart();
            $('.card-user').on('click', function () {
                index = this.dataset.roles;
                if (this.dataset.roles == 'smkk') {
                    getScoreSmkk();
                    getScoreRkkkonsultan();
					getScoreRkkkontraktor();
					getScoreRmpkpm();
					getScoreRmllp();
					$('#content-detail-nilai2').removeClass('d-none');
					$('#content-detail-nilai3').removeClass('d-none');
					$('#content-detail-nilai4').removeClass('d-none');
					$('#content-detail-nilai5').removeClass('d-none');
					$('#content-detail-nilai2').addClass('d-block');
					$('#content-detail-nilai3').addClass('d-block');
					$('#content-detail-nilai4').addClass('d-block');
					$('#content-detail-nilai5').addClass('d-block');
					$('#penilaian-title').html('RK SMKK');
					$('#penilaian-title2').html('RKK KONSULTANSI KONSTRUKSI PENGAWASAN (Konsultan)');
					$('#penilaian-title3').html('RKK PEKERJAAN KONSTRUKSI (Kontraktor)');	
					$('#penilaian-title4').html('RENCANA MUTU PEKERJAAN KONSTRUKSI dan PROGRAM MUTU');	
					$('#penilaian-title5').html('RENCANA MANAJEMEN LALU LINTAS PEKERJAAN (RMLLP)');	
					
                    //getLastUpdate(index);
                } if (this.dataset.roles == 'sml') {
                    getScoreRkpplkontraktor();
                    getScoreRkpplperencanaan();
                    getScoreRkpplpengawasan();
					$('#content-detail-nilai2').removeClass('d-none');
					$('#content-detail-nilai3').removeClass('d-none');
					$('#content-detail-nilai4').removeClass('d-none');
					$('#content-detail-nilai5').removeClass('d-none');
					$('#content-detail-nilai2').addClass('d-block');
					$('#content-detail-nilai3').addClass('d-block');
					 $('#content-detail-nilai4').addClass('d-none');
					 $('#content-detail-nilai5').addClass('d-none');
					$('#penilaian-title').html('RENCANA KERJA PENGELOLAAN & PEMANTAUAN LINGKUNGAN HIDUP (RKPPL) KONTRAKTOR');
					$('#penilaian-title2').html('RENCANA KERJA PENGELOLAAN & PEMANTAUAN LINGKUNGAN HIDUP (RKPPL) PERENCANAAN');
					$('#penilaian-title3').html('RENCANA KERJA PENGELOLAAN & PEMANTAUAN LINGKUNGAN HIDUP (RKPPL) PENGAWASAN');
					 //getLastUpdate(index);
                } if (this.dataset.roles == 'atj') {
                    getScoreAtj();
					$('#content-detail-nilai2').removeClass('d-none');
					$('#content-detail-nilai3').removeClass('d-none');
					$('#content-detail-nilai4').removeClass('d-none');
					$('#content-detail-nilai5').removeClass('d-none');
					$('#content-detail-nilai2').addClass('d-none');
					$('#content-detail-nilai3').addClass('d-none');
					$('#content-detail-nilai4').addClass('d-none');
					$('#content-detail-nilai5').addClass('d-none');
					$('#penilaian-title').html('ADMINISTRASI TEKNIK JALAN');
                    //getLastUpdate(index);
                } else {
                    //getAllCumulative();
                }
            });
        })
		
		
    </script>
@endsection