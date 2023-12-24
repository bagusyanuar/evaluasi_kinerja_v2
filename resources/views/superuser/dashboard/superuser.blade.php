@if($data == 'content')

    <div role="tablist" id="tablist">
        <div class="items-tab" id="menu-tab">
            <a class="card-tab  d-block c-text card-user" id="user">
                <div class="d-flex justify-content-between">
                    <i class='bx bx-user-circle icon-size-lg '></i>
                    <p class="number-card">0</p>
                </div>
                <div class="mt-2">
                    Data User
                </div>
            </a>

            <a class="card-tab d-block c-text card-user" id="ppk">
                <div class="d-flex justify-content-between">
                    <i class='bx bx-message-square-detail icon-size-lg'></i>
                    <p class="number-card">0</p>
                </div>
                <div class="mt-2">
                    Data PPK
                </div>
            </a>

            <a class="card-tab d-block c-text card-user" id="package">
                <div class="d-flex justify-content-between">
                    <i class='bx bx-building-house icon-size-lg'></i>
                    <p class="number-card">0</p>
                </div>
                <div class="mt-2">
                    Data Paket Konstruksi
                </div>
            </a>

            <a class="card-tab d-block c-text card-user" id="indicator">
                <div class="d-flex justify-content-between">
                    <i class='bx bx-doughnut-chart icon-size-lg'></i>
                    <p class="number-card">0</p>
                </div>
                <div class="mt-2">
                    Data Indikator
                </div>
            </a>


        </div>
    </div>



@elseif($data == 'script')
    <script>
        $(document).ready(function () {
            let tahun =  $('#year-list').val();
            getCount(tahun);
            $('#year-list').on('change', function () {
                let value = this.value;
                getCount(value);
            });
        });
        function getCount(tahun) {
            $.get('/get-count-dashboard?tahun='+tahun, function (data) {
                console.log(data)
                $('#tablist #indicator .number-card').html(data['indicator'])
                $('#tablist #package .number-card').html(data['package'])
                $('#tablist #ppk .number-card').html(data['ppk'])
                $('#tablist #user .number-card').html(data['user'])
            })
        }
    </script>
@endif