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
@endsection

@section('content')
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
@endsection

@section('script')
    <script>
        var path = '/{{ request()->path() }}';
        var packageID = '{{ $package->id }}';

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
                await getSubStageHandler();
                console.log(response);
            }catch (e) {
                el.empty();
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
                let elFile = '<div class="dropdown">' +
                    '<button class="bt-primary-xsm btn-file" data-bs-toggle="dropdown" aria-expanded="false" data-sub="' + v['id'] + '">Unggah</button>' +
                    '<div class="dropdown-menu">' +
                    '<button class="dropdown-item">Upload</button>' +
                    '</div>' +
                    '</div>';
                let elScore = '<div class="dropdown">' +
                    '<button class="bt-primary-xsm btn-file" data-bs-toggle="dropdown" aria-expanded="false" data-sub="' + v['id'] + '">Beri Nilai</button>' +
                    '<div class="dropdown-menu">' +
                    '<button class="dropdown-item btn-set-score" data-score="1" data-sub="' + v['id'] + '">Ada</button>' +
                    '<button class="dropdown-item btn-set-score" data-score="0" data-sub="' + v['id'] + '">Tidak</button>' +
                    '</div>' +
                    '</div>';

                let elDescription = '<button type="button" class="bt-primary-xsm">Lihat</button>';

                //TODO matching sub indicator with score
                let score = scores.find((o) => o['stage_sub_indicator_id'] === v['id']);
                console.log(score);
                if (score !== undefined) {
                    if (score['file'] !== null) {
                        elFile = '<div class="dropdown">' +
                            '<button class="bt-primary-xsm btn-file" data-bs-toggle="dropdown" aria-expanded="false" data-sub="' + v['id'] + '">Unduh / Ganti</button>' +
                            '<div class="dropdown-menu">' +
                            '<button class="dropdown-item">Download</button>' +
                            '<button class="dropdown-item">Ganti File</button>' +
                            '</div>' +
                            '</div>';
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
                    elScore = '<div class="dropdown">' +
                        '<button class="' + classButtonScore + ' btn-file" data-bs-toggle="dropdown" aria-expanded="false" data-sub="' + v['id'] + '">' + scoreText + '</button>' +
                        '<div class="dropdown-menu">' +
                        '<button class="dropdown-item btn-set-score" data-score="1" data-sub="' + v['id'] + '">Ada</button>' +
                        '<button class="dropdown-item btn-set-score" data-score="0" data-sub="' + v['id'] + '">Tidak</button>' +
                        '</div>' +
                        '</div>';
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

        $(document).ready(function () {
            getSubStageHandler();
        })
    </script>
@endsection
