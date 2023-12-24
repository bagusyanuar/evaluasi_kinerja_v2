@extends('superuser.base')

@section('moreCss')
    {{-- <link rel="stylesheet" href="{{ asset('css/tab.css') }}" type="text/css"> --}}
    <link href="{{ asset('css/dropify/css/dropify.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <style>
        .dropify-wrapper {
            position: unset !important;
            border: unset !important;
        }

        td {
            font-size: unset !important;
        }

    </style>
@endsection


@section('content')


    <div class="" style=" margin: 160px 0">
        <div class="profile-card js-profile-card">
            <div class="profile-card__img ">
                {{-- <img src="https://img.okezone.com/content/2012/02/07/452/570827/2y210LhfJH.jpg" alt="profile card"> --}}
                <form id="form-edit-img">
                    @csrf
                    <div class="circle white div-img-profile"
                        style="border: 1px solid #E5E5E5;margin-left: auto; margin-right: auto;">
                        <input type="file" id="image" class="fotoprofile" data-min-height="10"
                            accept="image/jpeg, image/jpg, image/png" data-allowed-file-extensions="jpg jpeg png"
                            onchange="saveImg()" />
                    </div>
                </form>
            </div>

            <div class="profile-card__cnt js-profile-cnt">
                <div class="profile-card__name" id="name">Nama Perusahaan</div>
                <div class="profile-card__txt" id="email">Alamat Email</div>
                <div class="d-flex justify-content-center" style="">
                    <div class="d-none" style="width: 400px;" id="detail">
                        <table class="table table-borderless">
                        </table>
                    </div>
                </div>

                <hr style="border-top: 1px solid #f000;">
                <div class="profile-card-inf" id="cardCount" style="height: 91px">
                    {{-- <div class="profile-card-inf__item d-none" id="cardVendor"> --}}
                    {{-- <div class="profile-card-inf__title" id="vendor">0</div> --}}
                    {{-- <div class="profile-card-inf__txt">Penyedia Jasa</div> --}}
                    {{-- </div> --}}

                    {{-- <div class="profile-card-inf__item d-none" id="cardPackage"> --}}
                    {{-- <div class="profile-card-inf__title" id="package">0</div> --}}
                    {{-- <div class="profile-card-inf__txt">Proyek Berjalan</div> --}}
                    {{-- </div> --}}


                </div>
                <hr>

                <div class="profile-card-ctr">
                    <button class="profile-card__button button--blue js-message-btn" id="addData">Edit</button>
                </div>
            </div>

        </div>


        <!-- Modal Tambah-->
        <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title">Edit Profile</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formProfile" onsubmit="return saveProfile()">
                            @csrf
                            <input id="id" name="id" hidden>
                            <input id="roles" name="roles" hidden>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="nameForm" name="name">
                            </div>
                            <div id="ppkDiv"></div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="emailForm" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>
                            <div id="addDiv"></div>

                            <div class="mb-4"></div>
                            <button type="submit" class="bt-primary">Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

@section('script')
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/browser-image-compression@latest/dist/browser-image-compression.js"></script>
    <script src="{{ asset('css/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('js/handler_image.js') }}"></script>
    <script>
        var roles, image, icon, name, username, email, id;
        var phone, kualifikasi, npwp, iujk, address;

        $(document).ready(function() {
            roles = '{{ auth()->user()->roles[0] }}'
            getProfile();
            package()
            setImg()
        })

        function setImg() {
            icon = $('.fotoprofile').dropify({
                showRemove: false,
                messages: {
                    'default': "<i class='bx bx-image-add'></i>",
                    'replace': "<i class='bx bx-image-add'></i>",
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                },
                tpl: {
                    clearButton: '',
                    filename: '<p class="dropify-filename"><span class="dropify-filename-inner hide"></span></p>',

                }
            });
            // $('.dropify-wrapper').height(200);

        }

        $(document).on('click', '#addData, #editData', function() {
            $('#nameForm').val(name)
            $('#roles').val(roles)
            $('#id').val(id)
            $('#emailForm').val(email)
            $('#username').val(username)
            $('#tambahdata #password_confirmation').val('********');
            $('#tambahdata #password').val('********');
            $('#addDiv').empty()

            if (roles === 'vendor') {
                $('#addDiv').append(' <div class="mb-3">\n' +
                        '                                <label for="phone" class="form-label">Phone</label>\n' +
                        '                                <input type="text" class="form-control" id="phone" name="phone" value="' +
                        phone + '">\n' +
                        '                            </div>')
                    .append(' <div class="mb-3">\n' +
                        '                                <label for="npwp" class="form-label">NPWP</label>\n' +
                        '                                <input type="text" class="form-control" id="npwp" name="npwp" value="' +
                        npwp + '">\n' +
                        '                            </div>')
                    .append(' <div class="mb-3">\n' +
                        '                                <label for="iujk" class="form-label">IUJK</label>\n' +
                        '                                <input type="text" class="form-control" id="iujk" name="iujk" value="' +
                        iujk + '">\n' +
                        '                            </div>')
                    .append(' <div class="mb-3">\n' +
                        '                                <label for="address" class="form-label">Alamat</label>\n' +
                        '                                <textarea class="form-control" id="address" name="address">' +
                        address + '</textarea>\n' +
                        '                            </div>')
            }

            $('#tambahdata').modal('show');
        })

        function saveProfile() {
            saveData('Update Profile', 'formProfile', null, afterSave)
            return false;
        }

        function afterSave() {
            $('#tambahdata').modal('hide');
            getProfile();
        }

        function getProfile() {
            $.get(window.location.pathname + '/show', function(data) {
                $('#detail').addClass('d-none')
                if (data) {
                    name = data[roles]['name']
                    username = data['username']
                    email = data['email']
                    id = data['id']
                    $('#name').html(name)
                    $('#email').html(email)
                    phone = '', kualifikasi = '', npwp = '', iujk = '', address = '';
                    if (roles === 'vendor') {
                        $('#detail').removeClass('d-none')
                        $('#detail table').empty()
                        phone = data[roles]['phone'] ?? '-';
                        kualifikasi = data[roles]['kualifikasi'] ?? '-';
                        npwp = data[roles]['npwp'] ?? '-';
                        iujk = data[roles]['iujk'] ?? '-';
                        address = data[roles]['iujk'] ?? '-';
                        $('#detail table').append('<tr>' +
                                '<td >Phone</td>' +
                                '<td>:</td>' +
                                '<td>' + phone + '</td>' +
                                '</tr>')
                            .append('<tr>' +
                                '<td>Kualifikasi</td>' +
                                '<td>:</td>' +
                                '<td>' + kualifikasi + '</td>' +
                                '</tr>')
                            .append('<tr>' +
                                '<td>NPWP</td>' +
                                '<td>:</td>' +
                                '<td>' + npwp + '</td>' +
                                '</tr>')
                            .append('<tr>' +
                                '<td>IUJK</td>' +
                                '<td>:</td>' +
                                '<td>' + iujk + '</td>' +
                                '</tr>')
                            .append('<tr>' +
                                '<td>Alamat</td>' +
                                '<td>:</td>' +
                                '<td>' + address + '</td>' +
                                '</tr>')
                    }

                    image = data['image']
                    icon = icon.data('dropify');
                    icon.resetPreview();
                    icon.clearElement();
                    icon.settings.defaultFile = image;
                    icon.destroy();
                    icon.init();
                }
            })
        }

        function package() {
            $.get(window.location.pathname + '/package', function(data) {
                $('#cardCount').empty()
                if (data) {
                    if (data['vendor']) {
                        $('#cardCount').append(
                            '<a class="" style="cursor:pointer; color: black"><div class="profile-card-inf__item    mx-2" style="border-radius: 20px">\n' +
                            '                        <div class="profile-card-inf__title">' + data['vendor'] +
                            '</div>\n' +
                            '                        <div class="profile-card-inf__txt">Vendor</div>\n' +
                            '                    </div></a>')
                    }

                    if (data['packagePast'] || data['packageGoing']) {
                        var url = '#',
                            urlpast = '#'
                        var target;
                        if (roles === 'vendor') {
                            urlpast = '/?st=past';
                            url = '/';
                            target = 'target="_blank"'
                        }
                        $('#cardCount').append('<a class=""  ' + target + ' href="' + url +
                            '" style="cursor:pointer; color: black"><div class="profile-card-inf__item   mx-2" style="border-radius: 20px">\n' +
                            '                        <div class="profile-card-inf__title">' + data[
                                'packageGoing'] + '</div>\n' +
                            '                        <div class="profile-card-inf__txt">Proyek Berjalan</div>\n' +
                            '                    </div></a>')
                        $('#cardCount').append('<a class="" ' + target + ' href="' + urlpast +
                            '" style="cursor:pointer; color: black"><div class="profile-card-inf__item  mx-2" style="border-radius: 20px;" >\n' +
                            '                        <div class="profile-card-inf__title">' + data[
                                'packagePast'] + '</div>\n' +
                            '                        <div class="profile-card-inf__txt">Proyek Selesai</div>\n' +
                            '                    </div></a>')

                    }

                }
            })
        }

        async function saveImg() {
            // var a = $("#img-account").val();
            // alert(a);
            var form_data = new FormData($('#form-edit-img')[0]);
            let image1 = await handleImageUpload($('#image'));
            form_data.append('profile', image1, image1.name);
            $.ajax({
                type: "POST",
                data: form_data,
                url: window.location.pathname + '/update-image',
                async: true,
                processData: false,
                contentType: false,
                headers: {
                    'Accept': "application/json"
                },
                success: function(data, textStatus, xhr) {
                    console.log(data);

                    if (xhr.status === 200) {
                        swal("Picture Updated", {
                            icon: "success",
                            buttons: false,
                            timer: 1000
                        }).then((dat) => {
                            // window.location.reload()
                        });
                    } else {
                        swal(data['msg'])
                    }
                    console.log(data);
                },

                complete: function(xhr, textStatus) {
                    $('#progressbar').remove();
                },
                error: function(error, xhr, textStatus) {
                    // console.log("LOG ERROR", error.responseJSON.errors);
                    // console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
                    $('#progressbar div').removeClass('bg-success').addClass('bg-danger');
                    console.log(xhr.status);
                    console.log(textStatus);
                    console.log(error.responseJSON);
                    swal(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error
                            .responseJSON.errors)[0]][0] : error.responseJSON['message'] ? error
                        .responseJSON['message'] : error.responseJSON['msg'])
                }
            })
            // document.getElementById('form-edit-img').action = "";
            // document.getElementById('form-edit-img').method = "POST";
            // document.getElementById('form-edit-img').enctype = "multipart/form-data";
            // document.getElementById('form-edit-img').submit();
        }
    </script>
@endsection
