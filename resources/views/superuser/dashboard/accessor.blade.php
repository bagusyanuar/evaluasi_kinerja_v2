@if ($data == 'content')
    <div class="mb-3" style="padding-right: 30px; padding-left: 30px">
        {{-- <p class="fw-bold t-primary">Dashboard</p> --}}
        <div role="tablist" id="tablist">
            <div class="items-tab" id="menu-tab">
                <a class="card-tab  d-block c-text card-user"
                   id="user">
                    <div class="d-flex justify-content-between">
                        <i class='bx bx-user-circle icon-size-lg '></i>
                        <p class="number-card" id="vendor-count">0</p>
                    </div>
                    <div class="mt-2">
                        Data Penyedia Jasa
                    </div>
                </a>

                <a class="card-tab d-block c-text card-user"
                   id="package">
                    <div class="d-flex justify-content-between">
                        <i class='bx bx-building-house icon-size-lg'></i>
                        <p class="number-card" id="package-count">0</p>
                    </div>
                    <div class="mt-2">
                        Data Paket Konstruksi
                    </div>
                </a>

                <a class="card-tab d-block c-text card-user"
                   id="indicator">
                    <div class="d-flex justify-content-between">
                        <i class='bx bx-receipt icon-size-lg'></i>
                        <p class="number-card" id="claim-count">0</p>
                    </div>
                    <div class="mt-2">
                        Data Sanggahan
                    </div>
                </a>


            </div>
        </div>
    </div>
    <div style="padding-right: 30px; padding-left: 30px" class="mt-5">
        <div class="d-flex justify-content-between">
            <p class="fw-bold t-black">Data Penyedia Jasa</p>
            <form id="form" onsubmit="return cariVendor()" class="mb-0">
                <div class="input-group mb-3">
                <input class="form-control" type="text" name="name" id="txtCari"
                       style="border-top-right-radius: 0;border-bottom-right-radius: 0;"
                       value="{{ request('name') }}" placeholder="Cari Vendor">
                <button class="btn btn-primary me-3" style="border-top-left-radius: 0;border-bottom-left-radius: 0;"
                        type="submit"><i class='bx bx-search-alt-2'></i></button>
                </div>
            </form>

        </div>

        <div role="tablist" id="tablist">
            <div id="menu-vendor" class="row">

            </div>
        </div>
    </div>



@elseif($data == 'script')
    <script>
        $(document).ready(function () {
            getVendor();
            countClaim();
            $('#year-list').on('change', function () {
                getVendor();
            });
        });
        function elVendor(data) {
            return '<a href="/penilaian?vendor=' + data['id'] + '" class="card-vendor-2 d-block c-text card-user">' +
                'abcd' +
                '</a>';
        }
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
                let allVendor = data.length;
                let ongoing = 0;
                $.each(data, function (key, value) {
                    // vendor.append(elVendor(value));
                    ongoing += value['package_vendor_going'].length;
                    vendor.append(' <div class="items-tab col-xl-3 col-lg-6 col-sm-12 mb-4 mb-4"><a href="/penilaian/' + value[
                            'id'] +
                        '/vendor" class="card-vendor d-block c-text card-user" id="">\n' +
                        '                    <div class="d-flex justify-content-left">\n' +
                        '                        <div class="div-image"> <img src="' + value['image'] +
                        '" onerror="this.onerror=null; this.src=\'{{ asset('/images/noimage.png') }}\'"/> </div>\n' +
                        '<div class="d-flex flex-column w-100  justify-content-between" style="height: 130px"> ' +
                        ' <div class="w-100"><p  class="nama">' + value['vendor']['name'] +
                        '</p><p class="email">' + value['email'] + '</p>  </div>' +
                        '                    <h6 class="t-right number"> ' +
                        value['package_vendor_going'].length + ' </h6></div></div>\n' +
                        '                </a></div>')
                })
                $('#package-count').html(ongoing);
                $('#vendor-count').html(allVendor);
            })
        }
        async function countClaim() {
            try {
                let response = await $.get('/peringatan/count');
                let count = response['data'];
                $('#claim-count').html(count);
                console.log(response)
            } catch (e) {
                console.log(e)
            }
        }
    </script>
@endif