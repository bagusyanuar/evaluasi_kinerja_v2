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
        @if (auth()->user()->roles[0] == 'superuser' || auth()->user()->roles[0] == 'admin')
            @include('superuser.dashboard.superuser', ['data' => 'content'])
            @include('superuser.dashboard.table', ['data' => 'content'])
        @elseif(auth()->user()->roles[0] == 'accessor' || auth()->user()->roles[0] == 'accessorppk')

            @include('superuser.dashboard.accessor',['data' => 'content'])
        @else
            @include('superuser.dashboard.vendor',['data' => 'content'])
        @endif

    </section>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @if (auth()->user()->roles[0] == 'superuser' || auth()->user()->roles[0] == 'admin')
        @include('superuser.dashboard.superuser', ['data' => 'script'])
        @include('superuser.dashboard.table', ['data' => 'script'])
    @elseif(auth()->user()->roles[0] == 'accessor' || auth()->user()->roles[0] == 'accessorppk')
        @include('superuser.dashboard.accessor',['data' => 'script'])
    @else
        @include('superuser.dashboard.vendor',['data' => 'script'])
    @endif

    <script>
        var roles, textRoles;
        var table;
        $(document).ready(function() {
            // chart()
            // cahar11()
            roles = 'superuser';
            textRoles = 'Superuser'
        });
    </script>
@endsection
