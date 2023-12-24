@extends('superuser.base')

@section('content')
    <section class="mt-content">

        <div class="row">
            <div class="offset-1 col-2">
                <p class="fw-bold" style="color: gray">Pemberitahuan</p>

                <div id="bcukup" class="tombol-notif active">
                    <div>
                        <i class='bx bx-meh-alt bx-md mb-2 t-cukup'></i>
                        <p class="t-cukup">Penilaian Cukup</p>
                    </div>
                </div>

                <div id="bkurang" class="tombol-notif">
                    <div>
                        <i class='bx bx-sad bx-md mb-2 t-kurang'></i>
                        <p class="t-kurang">Penilaian Kurang</p>
                    </div>
                </div>

            </div>
            <div class="col-8  mt-5">
                <div class="card-notif table-container" style="border-radius: 30px">
                    <div id="cardNotif">

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

    <script>
        var score = 'medium';
        $(document).ready(function () {
            showNotifAll();
        })

        $("#bcukup").click(function () {
            score = 'medium';
            $("#bcukup").addClass("active");
            $("#bkurang").removeClass("active");
            showNotifAll()
        });
        $("#bkurang").click(function () {
            score = 'bad';
            $("#bkurang").addClass("active");
            $("#bcukup").removeClass("active");
            showNotifAll()
        });

        function showNotifAll() {
            $.get('/show-notif?score='+score, function (data) {
                $('#cardNotif').empty()
                if (data[0]) {
                    $.each(data, function (key, value) {
                        const {id, type} = value;
                        var read = value['is_read'] === 0 ? 'isRead' : '';
                        var img = value['sender']['image'] ?? '';
                        var senderName = value['sender']['vendor'] ? value['sender']['vendor']['name'] : value['sender']['data']['name'];
                        var tipeRole = type ?? 'vendor';
                        $('#cardNotif').append('<div>\n' +
                            '                        <a class="notifdiv  ' + read + '" style="width: 100%" href="/peringatan/' + tipeRole + '/' + id + '">\n' +
                            '                            <div class="div-image">\n' +
                            '                                <img\n' +
                            '                                    src="' + img + '" onerror="this.onerror=null; this.src=\'{{ asset('/images/noimage.png') }}\'"/>\n' +
                            '                            </div>\n' +
                            '                            <div class="div-content">\n' +
                            '                                <div class="div-header">\n' +
                            '                                    <p class="nama t-black">' + senderName + '</p>\n' +
                            '                                    <p class="tanggal " style="color: gray">'+moment(value['updated_at']).format('LLL')+ '</p>\n' +
                            '                                </div>\n' +
                            '                                    <p class="title mb-1 mt-2 t-active" style="font-size: .8rem; font-weight: bold">' + value['title'] + '</p>\n' +
                            '                                <p class="sub-indikator">' + value['description'] + '</p>\n' +
                            '                            </div>\n' +
                            '                        </a>\n' +
                            '                        <hr class="hr-notif">\n' +
                            '                    </div>')
                    })
                }else{
                    $('#cardNotif').append('<h5 class="text-center">Tidak ada data</h5>')
                }
            })
        }
    </script>
@endsection
