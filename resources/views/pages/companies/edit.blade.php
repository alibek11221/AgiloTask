@extends('layouts.app')

@section('content')
    @include('pages.companies.inc.form')
@endsection
@section('javascritps')
    <script>
        $('select').selectpicker();
    </script>
@endsection
