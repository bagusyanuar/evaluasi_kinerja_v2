<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Evaluasi Kinerja | {{ auth()->user()->roles[0] }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bona+Nova:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/myStyle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/shimer.css') }}" type="text/css">
    {{-- <link rel="stylesheet" href="{{ asset('css/boxicon.min.css') }}" type="text/css"> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="{{ asset('js/swal.js') }}"></script>
    @yield('moreCss')
</head>

<body id="body-pd"
    class="bg-color {{ auth()->user()->roles[0] == 'superuser' || auth()->user()->roles[0] == 'admin' ? 'body-pd' : '' }}"
    style="{{ auth()->user()->roles[0] == 'superuser' || auth()->user()->roles[0] == 'admin' ? '' : 'padding-left: 16px' }}; ">
    <header
        class="header {{ auth()->user()->roles[0] == 'superuser' || auth()->user()->roles[0] == 'admin' ? 'body-pd' : '' }}"
        id="header" style="justify-content: space-between">
        {{-- <div class="header_toggle"><i class='bx bx-menu bx-x' id="header-toggle"></i></div> --}}

		@if (Request::is('smkk') || Request::is('smkk/*'))
        <div class="d-flex">
		  <a href="/" >
            <img src="{{ asset('/images/Logo3.png') }}" height="50px" style="margin-right: 30px" />
			</a>
            <div id="brodcum" style="display: flex; align-items: center; "></div>
        </div>
		@elseif (Request::is('sekejap') || Request::is('penilaian/*'))
			<div class="d-flex">
		  <a href="/" >
            <img src="{{ asset('/images/Logo2.png') }}" height="50px" style="margin-right: 30px" />
			</a>
            <div id="brodcum" style="display: flex; align-items: center; "></div>
        </div>
		@else
			<div class="d-flex">
		  <a href="/" >
            <img src="{{ asset('/images/Logo2_new.png') }}" height="50px" style="margin-right: 30px" />
			</a>
            <div id="brodcum" style="display: flex; align-items: center; "></div>
        </div>
		@endif
        <div class="d-flex align-items-center" style="justify-content: space-between">
            <div class="me-3">
                <select class="select-paket" id="year-list" style="background-color: #34506e; border-color: #1d3752;">
                    <option value="">Pilih Tahun</option>
                    @foreach (getPackageYear() as $v)
                        <option value="{{ $v }}" {{ $v == getCurrentYear() ? 'selected' : '' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div class="btn-group">
                <a class="t-black klikable me-3" id="dropdownMenuClickableInside" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <i class='bx bx-bell bx-sm'></i>
                    <div id="badge"></div>

                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
                    <p class="title-notif">Pemberitahuan</p>
                    <div id="notif">

                    </div>

                    <a class="lihatsemuanotif" href="/peringatan">Lihat Semua</a>
                </div>
            </div>


            <div class="dropdown show ">
                <a class="dropdown-toggle t-black" href="#" id="dropdownMenuLink" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    Hi, {{ auth()->user()->username }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" type="button" href="/profile">Profile</a>
                    <a class="dropdown-item" type="button" href="/logout">logout</a>
                </div>
            </div>

        </div>
    </header>
    @if (auth()->user()->roles[0] == 'superuser' || auth()->user()->roles[0] == 'admin')
        <div class="l-navbar showside" id="nav-bar">
            <nav class="nav">
                <div><a href="#" class="nav_logo">
                        {{-- <i class='bx bx-layer nav_logo-icon'></i> --}}
                        <span class="nav_logo-name">Evaluasi Kinerja</span> </a>

                   <div id="sidebar" class="nav_list">
                        <a href="/" id="dashboard" class="nav_link "> <i class='bx bx-grid-alt nav_icon'></i>
                            <span class="nav_name">Dashboard</span> </a>
                        @if (auth()->user()->roles[0] == 'superuser' || auth()->user()->roles[0] == 'admin')
                            <a href="/users" id="users" class="nav_link"> <i class='bx bx-user nav_icon'></i>
                                <span class="nav_name">Users</span> </a>
                            <a href="/ppk" id="ppk" class="nav_link"> <i
                                    class='bx bx-message-square-detail nav_icon'></i> <span
                                    class="nav_name">PPK</span> </a>
                            <a href="/paket-konstruksi" id="paket-konstruksi" class="nav_link"> <i
                                    class='bx bx-building-house'></i>
                                <span class="nav_name">Paket Konstruksi</span> </a>
                            <a href="/indikator" id="indikator" class="nav_link"> <i
                                    class='bx bx-doughnut-chart'></i>
                                <span class="nav_name">Indikator SEKEJAP</span> </a>
							<a href="/indikator-smkk" id="indikatorsmkk" class="nav_link"> <i
                                    class='bx bx-doughnut-chart'></i>
                                <span class="nav_name">Indikator SMKK</span> </a>
                           <a href="{{ route('indicator.smkk.v2') }}" id="indikatorsmkkv2" class="nav_link {{ request()->is('indikator-smkk-v2*') ? 'active' : '' }}"> <i
                                    class='bx bx-doughnut-chart'></i>
                                <span class="nav_name">Indikator SMKK V.2</span> </a>
                        @endif
                        <a href="/penilaian" id="penilaian" class="nav_link"> <i
                                class='bx bxs-bar-chart-square'></i>
                            <span class="nav_name">Penilaian</span> </a>
						<a href="/perlem" id="penilaianperlem" class="nav_link"> <i
                                class='bx bxs-bar-chart-square'></i>
                            <span class="nav_name">Penilaian Perlem 4</span> </a>
						<a href="/smkk" id="smkk" class="nav_link"> <i
                                class='bx bxs-bar-chart-square'></i>
                            <span class="nav_name">Penilaian SMKK</span> </a>
                       <a href="{{ route('score.smkk-v2') }}" id="smkkv2" class="nav_link"> <i
                                class='bx bxs-bar-chart-square'></i>
                            <span class="nav_name">Penilaian SMKK V.2</span> </a>

                        {{-- <a href="/hist" id="alert" class="nav_link"> <i class='bx bxs-bar-chart-square'></i>
                    <span class="nav_name">Alert</span> </a> --}}

                    </div>
                </div>

                {{-- <a href="/logout" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                class="nav_name">SignOut</span>
        </a> --}}
            </nav>
        </div>
    @endif
    <!--Container Main start-->
    <section>

        @yield('content')

    </section>
    <!--Container Main end-->


    <script src="{{ asset('bootstrap/js/jquery.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/myStyle.js') }}"></script>
    {{-- <script src="{{ asset('js/sidebar.js') }}"></script> --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('js/currency.js') }}"></script>
    <script src="{{ asset('js/dialog.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>

    {{-- <script src="{{ asset('js/myStyle.js') }}"></script> --}}
    <script>
		function checkSessionYear() {
            let value = sessionStorage.getItem('year');
            if (value === null || value === undefined) {
                let year = $('#year-list').val();
                sessionStorage.setItem('year', year);
            }else {
                $('#year-list').val(value);
            }
            $('#year-list').on('change', function () {
                sessionStorage.setItem('year', this.value);
            });
        }

        $(document).ready(function() {
			checkSessionYear();
            broadcum()
            showNotif();
            notifUnread()
        })
        function showNotif() {
            $.get('/show-notif?limit=5', function(data) {
                $('#notif').empty();
                if (data) {
                    console.log('anuu ', data);
                    $.each(data, function(key, value) {
                        const {
                            id,
                            type
                        } = value;
                        var read = value['is_read'] === 0 ? 'isRead' : '';
                        var img = value['sender']['image'] ?? '';
                        var senderName = value['sender']['vendor'] ? value['sender']['vendor']['name'] :
                            value['sender']['data']['name'];
                        var tipeRole = type ?? 'vendor';
                        $('#notif').append('<div>\n' +
                            '                        <a class="notifdiv ' + read +
                            '" href="/peringatan/' + tipeRole + '/' + id + '">\n' +
                            '                            <div class="div-image">\n' +
                            '                                <img\n' +
                            '                                    src="' + img +
                            '" onerror="this.onerror=null; this.src=\'{{ asset('/images/noimage.png') }}\'"/>\n' +
                            '                            </div>\n' +
                            '                            <div class="div-content">\n' +
                            '                                <div class="div-header">\n' +
                            '                                    <p class="nama t-black">' +
                            senderName + '</p>\n' +
                            '                                    <p class="tanggal " >' +
                            moment(value['updated_at']).format('LLL') + '</p>\n' +
                            '                                </div>\n' +
                            '                                    <p class="title mb-1 mt-2 t-active" style="font-size: .8rem; font-weight: bold">' +
                            value['title'] + '</p>\n' +
                            '                                <p class="sub-indikator">\n' +
                            '                                    ' + value['description'] + '\n' +
                            '                                </p>\n' +
                            '                            </div>\n' +
                            '                        </a>\n' +
                            '                        <hr class="hr-notif">\n' +
                            '                    </div>')
                    })
                }
            })
        }
        function notifUnread() {
            $.get('/show-notif-unread', function(data) {
                if (data > 0) {
                    $('#badge').html(
                        '<span class="position-absolute top-0  translate-middle badge rounded-pill bg-danger" style="left: 63% !important;">' +
                        data + '</span>')
                }
            })
        }
        function broadcum() {
            var brod;
            if (lok1) {
                brod =
                    "<a href='/' class='me-1'><span><i class='bx bx-home me-1 t-text-color2'></i></span> Dashboard</a> <i class='bx bx-chevron-right me-1 c-text'></i> <a class='me-1' href='/" +
                    lok1 + "'>" + lok1 +
                    "</a>"
                if (lok2) {
                    brod = brod + " <i class='bx bx-chevron-right me-1 c-text'></i> <a class='me-1' href='/" + lok1 +
                        "/" + lok2 +
                        "/" + lok3 +
                        "'>" + lok2 + "</a>"
                }
            }
            $('#brodcum').html(brod);
        }
        jQuery.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": oSettings._iDisplayLength === -1 ?
                    0 : Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": oSettings._iDisplayLength === -1 ?
                    0 : Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
    </script>
    @yield('script')
</body>
</html>
