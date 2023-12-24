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
                                    <p class="header-name secondary-color-text">{{ $data->name }}</p>
                                    <div class="header-qualified secondary-light-text">
                                        <span style="margin-right: 20px">Penyedia Jasa : </span>
                                        <span
                                            style="color: #DFA01E; font-weight: bold">{{ $data->vendor->vendor->name }}</span>
                                        |
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
        <div class="table-container">
            <table id="table-data" class="display table table-striped w-100">
                <thead>
                <tr>
                    <th class="text-center middle-header" width="5%">#</th>
                    <th class="middle-header">Nama Tahapan</th>
                    <th class="text-center middle-header" width="15%">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stages as $stage)
                    <tr>
                        <td class="text-center middle-header" width="5%">{{ $loop->index + 1 }}</td>
                        <td class="middle-header">{{ $stage->name }}</td>
                        <td class="text-center middle-header" width="15%">
                            <a href="{{ route('score.smkk-v2.score', ['id' => $data->id, 'stage_id' => $stage->id]) }}" class="bt-primary-xsm">Penilaian</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
