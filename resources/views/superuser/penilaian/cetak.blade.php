<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .report-title {
            font-size: 14px;
            font-weight: bolder;
        }

        .f-bold {
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0cm;
            right: 0cm;
            height: 2cm;
        }

    </style>
</head>

<body>
    <div>
        <img src="{{ public_path('/images/kop.png') }}" width="100%">
        {{-- <p>Sistem Evaluasi Kinerja Penyedia Jasa </p> --}}
    </div>



    <div style="background-color: #D6DCE5">
        <table>
            <tr>
                <td rowspan="11" style="width: 150px">
                    <img src="{{ public_path($vendor->image) }}" height="100" width="100"
                        style="border-radius: 50%; margin-left: 25px;"
                        onerror="this.onerror=null;this.src='{{ asset('/images/noimage.png') }}';" />
                </td>
            </tr>

            <tr>
                <td style="font-weight: bold; width: 200px">Penyedia jasa</td>
                <td style="font-weight: bold">: {{ $vendor->vendor->name }}</td>
            </tr>

            <tr>
                <td>Alamat</td>
                <td>: {{ $vendor->vendor->address }}</td>
            </tr>

            <tr>
                <td>IUJK</td>
                <td>: {{ $vendor->vendor->iujk }}</td>
            </tr>

            <tr>

                <td>NPWP</td>
                <td>: {{ $vendor->vendor->npwp }}</td>
            </tr>

            <tr>

                <td style="font-weight: bold">Paket Pekerjaan</td>
                <td style="font-weight: bold">: {{ $package !== null ? $package->name : '-' }}</td>
            </tr>

            <tr>

                <td>No. Kontrak</td>
                <td>: {{ $package !== null ? $package->no_reference : '-' }}</td>
            </tr>

            <tr>
                <td>Pengguna Jasa</td>
                <td>: {{ $package !== null ? $package->ppk->name : '-' }}</td>
            </tr>

            <tr>

                <td>Tanggal Mulai</td>
                <td>: {{ $package !== null ? $package->start_at : '-' }}</td>
            </tr>

            <tr>

                <td>Tanggal Selesai</td>
                <td>: {{ $package !== null ? $package->finish_at : '-' }}</td>
            </tr>

        </table>
    </div>

    <div style="margin-top: 20px">
        <p
            style="background-color: #222A35; color: white; font-size: 20px; font-weight: bold; padding: 5px; text-align: center">
            HASIL PENILAIAN KINERJA</p>
    </div>

    <table style="width: 100%">
        <tr>
            <td style="40%; border: 1px solid #ccc; text-align: center;">
                <p style="font-weight: bold">Nilai Kinerja Komulatif</p>
                <p style="font-size: 30px; font-weight: bold">{{ $cumulative['cumulative'] }}</p>


                @if ($cumulative['text'] == 'Kurang')
                    <p style="text-align: center; font-weight: bold; color: orange;">{{ $cumulative['text'] }}
                    </p>

                @elseif($cumulative['text'] == "Sangat Kurang")
                    <p style="text-align: center; font-weight: bold; color: red;">{{ $cumulative['text'] }}
                    </p>
                @elseif($cumulative['text'] == "Cukup")
                    <p style="text-align: center; font-weight: bold; color: yellow;">{{ $cumulative['text'] }}
                    </p>
                @elseif($cumulative['text'] == "Sangat Baik")
                    <p style="text-align: center; font-weight: bold; color: cyan;">{{ $cumulative['text'] }}
                    </p>
                @else
                    <p style="text-align: center; font-weight: bold; color: green;">{{ $cumulative['text'] }}
                    </p>

                @endif

                <p>Update Terakhir Penilaian:</p>
                <p style="font-weight: bold">{{ $cumulativeLast }}</p>
            </td>
            <td style="60%; text-align: center; border: 1px solid #ccc">
                <img src="{{ $html }}" width="250" >
            </td>
        </tr>
    </table>

    <div style="margin-top: 20px"></div>

    <table style="width: 100%">
        <tr>
            <td>
                <p style="font-size: 14px; background-color: #D9D9D9; margin-bottom: 0; text-align: center; color: red">
                    PENILAIAN</p>
                <p
                    style="font-size: 14px; font-weight: bold; background-color: #D9D9D9; margin-bottom: 10px; text-align: center; color: red">
                    MANDIRI</p>
                <p style="font-size: 30px; font-weight: bold; text-align: center; margin-bottom: 0;">
                    {{ $vendorCumulative['cumulative'] }}</p>



                @if ($vendorCumulative['text'] == 'Kurang')
                    <p style="text-align: center; font-weight: bold; color: orange;">{{ $vendorCumulative['text'] }}
                    </p>

                @elseif($vendorCumulative['text'] == "Sangat Kurang")
                    <p style="text-align: center; font-weight: bold; color: red;">{{ $vendorCumulative['text'] }}
                    </p>
                @elseif($vendorCumulative['text'] == "Cukup")
                    <p style="text-align: center; font-weight: bold; color: yellow;">{{ $vendorCumulative['text'] }}
                    </p>
                @elseif($vendorCumulative['text'] == "Sangat Baik")
                    <p style="text-align: center; font-weight: bold; color: cyan;">{{ $vendorCumulative['text'] }}
                    </p>
                @else
                    <p style="text-align: center; font-weight: bold; color: green;">{{ $vendorCumulative['text'] }}
                    </p>

                @endif

                <p style="background-color: #D9D9D9; margin-bottom: 0; text-align: center;">Update Terakhir :</p>
                <p style="background-color: #D9D9D9; margin-bottom: 0; text-align: center; font-weight: bold">
                    {{ $vendorCumulative['last']->updated_at }}</p>
            </td>
            <td>
                <div style="width: 5px"></div>
            </td>
            <td>
                <p style="font-size: 14px; background-color: #D9D9D9; margin-bottom: 0; text-align: center; color: red">
                    PENILAIAN</p>
                <p
                    style="font-size: 14px;font-weight: bold; background-color: #D9D9D9;  margin-bottom: 10px; text-align: center; color: red">
                    PPK</p>
                <p style="font-size: 30px; font-weight: bold; text-align: center; margin-bottom: 0;">
                    {{ $ppkCumulative['cumulative'] }}</p>
                @if ($ppkCumulative['text'] == 'Kurang')
                    <p style="text-align: center; font-weight: bold; color: orange;">{{ $ppkCumulative['text'] }}</p>

                @elseif($ppkCumulative['text'] == "Sangat Kurang")
                    <p style="text-align: center; font-weight: bold; color: red;">{{ $ppkCumulative['text'] }}
                    </p>
                @elseif($ppkCumulative['text'] == "Cukup")
                    <p style="text-align: center; font-weight: bold; color: yellow;">{{ $ppkCumulative['text'] }}
                    </p>
                @elseif($ppkCumulative['text'] == "Sangat Baik")
                    <p style="text-align: center; font-weight: bold; color: cyan;">{{ $ppkCumulative['text'] }}
                    </p>
                @else
                    <p style="text-align: center; font-weight: bold; color: green;">{{ $ppkCumulative['text'] }}
                    </p>

                @endif
                <p style="background-color: #D9D9D9; margin-bottom: 0; text-align: center;">Update Terakhir :</p>
                <p style="background-color: #D9D9D9; margin-bottom: 0; text-align: center; font-weight: bold">
                    {{ $ppkCumulative['last']->updated_at }}</p>
            </td>
            <td>
                <div style="width: 5px"></div>
            </td>
            <td>
                <p style="font-size: 14px; background-color: #D9D9D9; margin-bottom: 0; text-align: center; color: red">
                    PENILAIAN</p>
                <p
                    style="font-size: 14px; font-weight: bold; background-color: #D9D9D9 ;margin-bottom: 10px; text-align: center; color: red">
                    BAIAI</p>
                <p style="font-size: 30px; font-weight: bold; text-align: center; margin-bottom: 0;">
                    {{ $officeCumulative['cumulative'] }}</p>
                @if ($officeCumulative['text'] == 'Kurang')
                    <p style="text-align: center; font-weight: bold; color: orange;">{{ $officeCumulative['text'] }}
                    </p>

                @elseif($officeCumulative['text'] == "Sangat Kurang")
                    <p style="text-align: center; font-weight: bold; color: red;">{{ $officeCumulative['text'] }}
                    </p>
                @elseif($officeCumulative['text'] == "Cukup")
                    <p style="text-align: center; font-weight: bold; color: yellow;">{{ $officeCumulative['text'] }}
                    </p>
                @elseif($officeCumulative['text'] == "Sangat Baik")
                    <p style="text-align: center; font-weight: bold; color: cyan;">{{ $officeCumulative['text'] }}
                    </p>
                @else
                    <p style="text-align: center; font-weight: bold; color: green;">{{ $officeCumulative['text'] }}
                    </p>

                @endif
                <p style="background-color: #D9D9D9; margin-bottom: 0; text-align: center;">Update Terakhir :</p>
                <p style="background-color: #D9D9D9; margin-bottom: 0; text-align: center; font-weight: bold">
                    {{ $officeCumulative['last']->updated_at }}</p>
            </td>
        </tr>
    </table>

    <table style="width: 100%">
        <tr style="">
            <td style="vertical-align:top">
                <div class="sangat_kurang " style="margin-top: 30px">
                    <p style="font-weight: bold; ">Kinerja Sangat Kurang</p>
                    @foreach ($vendorCumulative['very_bad'] as $v)
                        <p style="font-size: 1rem">{{ $v->subIndicator->name }}</p>
                    @endforeach
                </div>
            </td>
            <td>
                <div style="width: 5px"></div>
            </td>
            <td style="vertical-align:top">
                <div class="sangat_kurang" style="margin-top: 30px">
                    <p style="font-weight: bold">Kinerja Sangat Kurang</p>
                    @foreach ($ppkCumulative['very_bad'] as $v)
                        <p style="font-size: 1rem">{{ $v->subIndicator->name }}</p>
                    @endforeach
                </div>
            </td>
            <td style="vertical-align:top">
                <div style="width: 5px"></div>
            </td>
            <td>
                <div class="sangat_kurang " style="margin-top: 30px">
                    <p style="font-weight: bold">Kinerja Sangat Kurang</p>
                    @foreach ($officeCumulative['very_bad'] as $v)
                        <p style="font-size: 1rem">{{ $v->subIndicator->name }}</p>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr style="vertical-align:top; margin-top: 20px">
            <td>
                <div class="kurang  " style="margin-top: 30px">
                    <p style="font-weight: bold">Kinerja Kurang</p>
                    @foreach ($vendorCumulative['bad'] as $v)
                        <p style="font-size: 1rem">{{ $v->subIndicator->name }}</p>
                    @endforeach
                </div>
            </td>
            <td>
                <div style="width: 5px"></div>
            </td>
            <td>
                <div class="kurang  " style="margin-top: 30px">
                    <p style="font-weight: bold">Kinerja Kurang</p>
                    @foreach ($ppkCumulative['bad'] as $v)
                        <p style="font-size: 1rem">{{ $v->subIndicator->name }}</p>
                    @endforeach
                </div>
            </td>
            <td>
                <div style="width: 5px"></div>
            </td>
            <td>
                <div class="kurang  " style="margin-top: 30px">
                    <p style="font-weight: bold">Kinerja Kurang</p>
                    @foreach ($officeCumulative['bad'] as $v)
                        <p style="font-size: 1rem">{{ $v->subIndicator->name }}</p>
                    @endforeach
                </div>
            </td>
        </tr>


        


        
    </table>

    {{-- <div id="detail_penilaian_mandiri" class="row">




    </div>
    <div id="detail_penilaian_ppk" class="row">




    </div>

    <div id="detail_penilaian_balai" class="row">




    </div> --}}

</body>

</html>