@extends('superuser.base')

@section('moreCss')
    <link href="{{ asset('css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <link href="{{ asset('/css/dropzone.min.css') }}" rel="stylesheet"/>
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
    <style>
        body {
            background-color: #778797;
            font-family: "Segoe UI", sans-serif;
        }

        .lazy-backdrop {
            position: fixed;
            display: none;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            cursor: pointer;
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

        .dz-error-message {
            display: none !important;
        }

        .dropzone {
            min-height: 150px;
            border: 1px solid gray;
            background: transparent;
            padding: 20px 20px;
            border-radius: 5px;
        }

        .dz-remove {
            color: whitesmoke;
            text-decoration: none;
        }

        .dz-remove:hover {
            color: whitesmoke;
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <div class="lazy-backdrop" id="overlay-loading">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="spinner-border text-light" role="status">
            </div>
            <p class="text-light">Sedang Melakukan Perubahan Data....</p>
        </div>
    </div>
    <section class="container-fluid p-lg-3 p-xl-3">
        <div class=" row">
            <div class="col-xl-12 ">
                <div class="header-profile mb-3">
                    <div class=" row">
                        <div class="col-xl-12 col-lg-12 d-flex">
                            <div class="d-flex flex-column">
                                <div class="flex-grow-1">
                                    <p class="header-name secondary-color-text">{{ $package->name }}</p>
                                    <div class="header-qualified secondary-light-text">
                                        <span style="margin-right: 20px">Penyedia Jasa : </span>
                                        <span
                                            style="color: #DFA01E; font-weight: bold">{{ $package->vendor->vendor->name }}</span>
                                        |
                                        <span style="margin-right: 20px">PPK : </span>
                                        <span style="color: #DFA01E; font-weight: bold">{{ $package->ppk->name }}</span>
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
        <div class="table-container">
            <p class="fw-bold">Penilaian Tahapan : {{ $stage->name }}</p>
            <hr>
            <div id="panel-score">
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-upload" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Unggah Dokumen</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post"
                          enctype="multipart/form-data"
                          id="form-upload">
                        <input type="hidden" id="sub-indicator-id-file" name="sub-indicator-id-file">
                        @csrf
                        <div class="w-100 needsclick dropzone mb-3" id="document-dropzone"></div>
                        <button type="submit" class="bt-primary" id="btn-save-file">Simpan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-description" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keterangan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-description">
                        @csrf
                        <input type="hidden" id="sub-indicator-id-description" name="sub-indicator-id-description">
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="mb-0">
                                    <label for="ppk-description" class="form-label">Keterangan PPK</label>
                                    <textarea rows="3" class="form-control" id="ppk-description"
                                              name="ppk-description" {{ auth()->user()->roles[0] === 'accessorppk' ? '' : 'disabled' }}></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-0">
                                    <label for="balai-description" class="form-label">Keterangan Balai</label>
                                    <textarea rows="3" class="form-control" id="balai-description"
                                              name="balai-description" {{ auth()->user()->roles[0] === 'accessor' ? '' : 'disabled' }} ></textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="bt-primary" id="btn-save-description">Simpan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('/js/dropzone.min.js') }}"></script>
    <script>
        var path = '/{{ request()->path() }}';
        var packageID = '{{ $package->id }}';
        var uploadedDocumentMap = {};
        var myDropzone;
        var notePPK = '';
        var noteBalai = '';
        var uRoles = '{{ auth()->user()->roles[0] }}';

        Dropzone.autoDiscover = false;
        Dropzone.options.documentDropzone = {

            success: function (file, response) {
                $('#form').append('<input type="hidden" name="files[]" value="' + file.name + '">');
                console.log(response);
                uploadedDocumentMap[file.name] = response.name
            },
        };

        function blockLoading(state) {
            if (state) {
                $('#overlay-loading').css('display', 'flex')
            } else {
                $('#overlay-loading').css('display', 'none')
            }
        }

        function createLoadingSetScore() {
            return '<div class="d-flex flex-column align-items-center justify-content-center" style="height: 400px">' +
                '<div class="spinner-border text-light" role="status">' +
                '  <span class="visually-hidden">Loading...</span>' +
                '</div>' +
                '<p class="mb-0">Tunggu sebentar sedang melakukan perubahan data nilai...</p>' +
                '</div>';
        }

        function createLoadingGetScore() {
            return '<div class="d-flex flex-column align-items-center justify-content-center" style="height: 400px">' +
                '<div class="spinner-border text-light" role="status">' +
                '  <span class="visually-hidden">Loading...</span>' +
                '</div>' +
                '<p class="mb-0">Tunggu sebentar sedang mengambil data nilai...</p>' +
                '</div>';
        }

        async function getSubStageHandler() {
            let el = $('#panel-score');
            el.empty();
            el.append(createLoadingGetScore());
            try {
                let response = await $.get(path);
                el.empty();
                let sub_stages = response['sub_stages'];
                let scores = response['scores'];
                el.append(generateSubStageElement(sub_stages, scores));
                setEventButton();
                setEventUpload();
                setEventDownload();
                setEventDescription();
                console.log(response);
            } catch (e) {
                el.empty();
                console.log(e)
            }
        }

        function setEventButton() {
            $('.btn-set-score').on('click', function (e) {
                e.preventDefault();
                let subIndicatorID = this.dataset.sub;
                let score = this.dataset.score;
                setScoreHandler(subIndicatorID, score);
                console.log('score', subIndicatorID, score);
            })
        }

        function setEventUpload() {
            $('.btn-upload').on('click', function (e) {
                e.preventDefault();
                let subIndicatorID = this.dataset.sub;
                $('#sub-indicator-id-file').val(subIndicatorID);
                $('#modal-upload').modal('show');
            })
        }

        function setEventDownload() {
            $('.btn-download').on('click', function (e) {
                e.preventDefault();
                let asset = this.dataset.asset;
                window.open(asset, '_blank')
            })
        }

        function setEventDescription() {
            $('.btn-description').on('click', function (e) {
                e.preventDefault();
                let subIndicatorID = this.dataset.sub;
                $('#sub-indicator-id-description').val(subIndicatorID);
                getDataDescription(subIndicatorID);
            })
        }

        function setEventSaveDescription() {
            $('#btn-save-description').on('click', function (e) {
                e.preventDefault();
                setDescriptionHandler();
            })
        }

        async function getDataDescription(subIndicatorID) {
            try {
                let url = path + '/description?sub-indicator-id-description=' + subIndicatorID;
                let response = await $.get(url);
                let data = response['data'];
                if (data !== null) {
                    $('#balai-description').val(data['note_balai']);
                    $('#ppk-description').val(data['note_ppk']);
                } else {
                    $('#balai-description').val('');
                    $('#ppk-description').val('');
                }
                console.log(response);
                $('#modal-description').modal('show');
            } catch (e) {
                Swal.fire({
                    title: 'Ooops',
                    text: 'Terjadi Kesalahan Saat Mendapatkan Data Keterangan...',
                    icon: 'error',
                    timer: 700
                })
            }
        }

        async function setDescriptionHandler() {
            try {
                let url = path + '/description';
                blockLoading(true);
                let response = await $.post(url, {
                    _token: '{{csrf_token()}}',
                    sub_indicator_id_description: $('#sub-indicator-id-description').val(),
                    ppk_description: $('#ppk-description').val(),
                    balai_description: $('#balai-description').val(),
                });
                $('#modal-description').modal('hide');
                blockLoading(false);
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Berhasil Merubah Nilai...',
                    icon: 'success',
                    timer: 700
                });
                await getSubStageHandler();
                console.log(response);
            } catch (e) {
                blockLoading(false);
                if (e.status === 404) {
                    Swal.fire({
                        title: 'Ooops',
                        text: 'Nilai Belum Tersedia...',
                        icon: 'error',
                        timer: 700
                    });
                } else {
                    Swal.fire({
                        title: 'Ooops',
                        text: 'Gagal Merubah Nilai...',
                        icon: 'error',
                        timer: 700
                    });
                }
                console.log(e)
            }
        }

        async function setScoreHandler(subIndicatorID, score) {
            let el = $('#panel-score');
            el.empty();
            try {
                el.append(createLoadingSetScore());
                let response = await $.post(path, {
                    _token: '{{csrf_token()}}',
                    sub_indicator: subIndicatorID,
                    value: score,
                });
                el.empty();
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Berhasil Merubah Nilai...',
                    icon: 'success',
                    timer: 700
                });
                await getSubStageHandler();
                console.log(response);
            } catch (e) {
                el.empty();
                Swal.fire({
                    title: 'Ooops',
                    text: 'Gagal Merubah Nilai...',
                    icon: 'error',
                    timer: 700
                });
                console.log(e)
            }
        }

        function generateSubStageElement(data = [], scores = []) {
            let result = '';
            $.each(data, function (k, v) {
                let indicators = v['indicators'];
                let indicatorsElement = generateIndicatorsElement(indicators, scores);
                result += '<p class="title-table fw-bold t-primary mb-0 text-center">' + v['name'] + '</p>' +
                    '<hr>' + indicatorsElement;
            });
            return result;
        }

        function generateIndicatorsElement(data = [], scores = []) {
            let result = '';
            $.each(data, function (k, v) {
                let subIndicators = v['sub_indicators'];
                let tableSubIndicator = generateTableSubIndicator(subIndicators, scores);
                result += '<p class="title-table fw-bold mb-0">' + (k + 1) + '. ' + v['name'] + '</p>' +
                    '<hr>' + tableSubIndicator;
            });
            return result;
        }

        function generateTableSubIndicator(data = [], scores = []) {
            let tableBody = '';
            $.each(data, function (k, v) {
                //TODO set default action
                let elFile = '-';
                let elScore = '<div class="">' +
                    '<button class="bt-primary-xsm btn-file" data-bs-toggle="" aria-expanded="false" data-sub="' + v['id'] + '">Beri Nilai</button>' +
                    '<div class="dropdown-menu">' +
                    '<button class="dropdown-item btn-set-score" data-score="1" data-sub="' + v['id'] + '">Ada</button>' +
                    '<button class="dropdown-item btn-set-score" data-score="0" data-sub="' + v['id'] + '">Tidak</button>' +
                    '</div>' +
                    '</div>';

                let elDescription = '<button type="button" class="bt-primary-xsm btn-description" data-sub="' + v['id'] + '">Lihat</button>';

                if (uRoles === 'accessorppk') {
                    elFile = '<div class="dropdown">' +
                        '<button class="bt-primary-xsm btn-file" data-bs-toggle="dropdown" aria-expanded="false" data-sub="' + v['id'] + '">Unggah</button>' +
                        '<div class="dropdown-menu">' +
                        '<button class="dropdown-item btn-upload" data-sub="' + v['id'] + '">Upload</button>' +
                        '</div>' +
                        '</div>';
                }
                //TODO matching sub indicator with score
                let score = scores.find((o) => o['stage_sub_indicator_id'] === v['id']);
                console.log(score);
                if (score !== undefined) {
                    if (score['file'] !== null) {
                        if (uRoles === 'accessor') {
                            elFile = '<div class="dropdown">' +
                                '<button class="bt-primary-xsm btn-file" data-bs-toggle="dropdown" aria-expanded="false" data-sub="' + v['id'] + '">Unduh</button>' +
                                '<div class="dropdown-menu">' +
                                '<button class="dropdown-item btn-download" data-asset="' + score['file'] + '">Download</button>' +
                                '</div>' +
                                '</div>';
                        }

                        if (uRoles === 'accessorppk') {
                            elFile = '<div class="dropdown">' +
                                '<button class="bt-primary-xsm btn-file" data-bs-toggle="dropdown" aria-expanded="false" data-sub="' + v['id'] + '">Unduh / Ganti</button>' +
                                '<div class="dropdown-menu">' +
                                '<button class="dropdown-item btn-download" data-asset="' + score['file'] + '">Download</button>' +
                                '<button class="dropdown-item btn-upload" data-sub="' + v['id'] + '">Ganti File</button>' +
                                '</div>' +
                                '</div>';
                        }

                    }
                    let myScore = score['score'];
                    let classButtonScore = 'bt-primary-xsm';
                    let scoreText = 'Beri Nilai';
                    switch (myScore) {
                        case 0:
                            classButtonScore = 'bt-danger-xsm';
                            scoreText = 'Tidak Ada';
                            break;
                        case 1:
                            classButtonScore = 'bt-success-xsm';
                            scoreText = 'Ada';
                            break;
                        default:
                            break;
                    }

                    if (score['file'] !== null && uRoles === 'accessor') {
                        elScore = '<div class="dropdown">' +
                            '<button class="' + classButtonScore + ' btn-file" data-bs-toggle="dropdown" aria-expanded="false" data-sub="' + v['id'] + '">' + scoreText + '</button>' +
                            '<div class="dropdown-menu">' +
                            '<button class="dropdown-item btn-set-score" data-score="1" data-sub="' + v['id'] + '">Ada</button>' +
                            '<button class="dropdown-item btn-set-score" data-score="0" data-sub="' + v['id'] + '">Tidak</button>' +
                            '</div>' +
                            '</div>';
                    }

                    if (score['file'] !== null && uRoles !== 'accessor') {
                        elScore = '<div class="">' +
                            '<button class="' + classButtonScore + ' btn-file" data-bs-toggle="" aria-expanded="false" data-sub="' + v['id'] + '">' + scoreText + '</button>' +
                            '</div>';
                    }

                }
                tableBody += '<tr>' +
                    '<td class="text-center">' + (k + 1) + '</td>' +
                    '<td>' + v['name'] + '</td>' +
                    '<td class="text-center">' + elFile + '</td>' +
                    '<td class="text-center">' + elScore + '</td>' +
                    '<td class="text-center">' + elDescription + '</td>' +
                    '</tr>';
            });

            return '<table class="display table table-striped w-100 mb-3">' +
                '<thead>' +
                '<tr>' +
                '<th class="text-center middle-header" width="5%">#</th>' +
                '<th class="middle-header">Nama</th>' +
                '<th class="text-center middle-header" width="10%">File</th>' +
                '<th class="text-center middle-header" width="10%">Nilai</th>' +
                '<th class="text-center middle-header" width="10%">Keterangan</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' + tableBody + '</tbody>' +
                '</table>'
        }

        function generateSubIndicatorElement(data = []) {
            let result = '';
            $.each(data, function (k, v) {

            });
            return result;
        }

        function setUpDropzone() {
            let url = path + '/file';
            $("#document-dropzone").dropzone({
                url: url,
                maxFilesize: 5,
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                autoProcessQueue: false,
                paramName: "file",

                init: function () {
                    myDropzone = this;
                    $('#btn-save-file').on('click', function (e) {
                        e.preventDefault();
                        Swal.fire({
                            title: "Konfirmasi!",
                            text: "Apakah anda yakin melampirkan dokumen?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then((result) => {
                            if (result.value) {
                                blockLoading(true)
                                if (myDropzone.files.length > 0) {
                                    myDropzone.processQueue();
                                } else {
                                    blockLoading(false);
                                    Swal.fire({
                                        title: 'Ooops',
                                        text: 'Harap Melampirkan Data Dokumen...',
                                        icon: 'error',
                                        timer: 700
                                    }).then(() => {
                                        // window.location.reload();
                                    });
                                }
                            }
                        });
                    });
                    this.on('sending', function (file, xhr, formData) {
                        // Append all form inputs to the formData Dropzone will POST
                        var data = $('#form-upload').serializeArray();
                        $.each(data, function (key, el) {
                            formData.append(el.name, el.value);
                        });
                    });

                    this.on('success', function (file, response) {
                        blockLoading(false);
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Berhasil Melampirkan Gambar Bukti Transfer...',
                            icon: 'success',
                            timer: 700
                        }).then(() => {
                            window.location.reload();
                        });
                    });

                    this.on('error', function (file, response) {
                        blockLoading(false);
                        Swal.fire({
                            title: 'Ooops',
                            text: 'Gagal Menambahkan Dokumen...',
                            icon: 'error',
                            timer: 700
                        });
                        console.log(response);
                    });

                    this.on('addedfile', function (file) {
                        if (this.files.length > 1) {
                            this.removeFile(this.files[0]);
                        }
                    });
                },
            });
        }

        $(document).ready(function () {
            getSubStageHandler();
            setUpDropzone();
            setEventSaveDescription();
        })
    </script>
@endsection
