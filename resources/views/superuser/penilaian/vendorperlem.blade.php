@extends('superuser.base')
@section('moreCss')
    {{-- <link rel="stylesheet" href="{{ asset('css/tab.css') }}" type="text/css"> --}}
    <style>
        .card-vendor-2 {
            padding: 16px;
            -webkit-box-shadow: rgba(50, 50, 93, 0.01) 0px 2px 5px -1px, rgba(0, 0, 0, 0.1) 0px 1px 3px -1px;
            box-shadow: rgba(50, 50, 93, 0.01) 0px 2px 5px -1px, rgba(0, 0, 0, 0.1) 0px 1px 3px -1px;
            background-color: white;
            border-radius: 10px;
            height: 150px;
            cursor: pointer;
            -webkit-transition: all 300ms;
            transition: all 300ms;
        }
        .card-vendor-2:hover {
            box-shadow: #1F9CAC55 0px 7px 29px 0px;
        }
    </style>

@endsection
@section('content')
    <section class="mt-content">
        <div style="padding-right: 30px; padding-left: 30px" class="mt-5">
            <div class="d-flex justify-content-between">

                <p class="fw-bold t-black">Data Penyedia Jasa</p>
                <form id="form" onsubmit="return cariVendor()" class="mb-0">
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="name" id="txtCari"
                               style="border-top-right-radius: 0;border-bottom-right-radius: 0;"
                               value="{{ request('name') }}" placeholder="Cari Vendor">
                        <button class="btn btn-primary me-3"
                                style="border-top-left-radius: 0;border-bottom-left-radius: 0;"
                                type="submit"><i class='bx bx-search-alt-2'></i></button>
                    </div>
                </form>

            </div>

            <div role="tablist" id="tablist">
                <div id="menu-vendor" class="row">

                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            getVendor();
            $('#year-list').on('change', function () {
                getVendor();
            });
        });
        function cariVendor() {
            var form = $('#form').serialize();
            getVendor(form)
            return false
        }
        function getVendor(form) {
            var vendor = $('#menu-vendor');
            let tahun = $('#year-list').val();
            vendor.empty();
            $.get('/vendor?tahun=' + tahun, form, function (data) {
                console.log(data);
                let allVendor = data.length;
                let ongoing = 0;
                $.each(data, function (key, value) {
                    // vendor.append(elVendor(value));
                    ongoing += value['package_vendor_going'].length;
                    vendor.append(' <div class="col-md-3 col-sm-6 mb-4"><a href="/perlem/' + value[
                            'id'] +
                        '/vendor" class="card-vendor d-block c-text card-user" id="">\n' +
                        '                    <div class="d-flex justify-content-left w-100">\n' +
                        '                        <div class="div-image"> <img src="' + value['image'] +
                        '" onerror="this.onerror=null; this.src=\'{{ asset('/images/noimage.png') }}\'"/> </div>\n' +
                        '<div class="d-flex flex-column w-100  justify-content-between" style="height: 130px"> ' +
                        ' <div class="w-100"><p  class="nama">' + value['vendor']['name'] +
                        '</p><p class="email">' + value['email'] + '</p>  </div>' +
                        '                    <h6 class="t-right number"> ' +
                        value['package_vendor_going'].length + ' </h6></div></div>\n' +
                        '                </a></div>')
                })
            })
        }
    </script>
@endsection