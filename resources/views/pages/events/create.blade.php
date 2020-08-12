@extends('layouts.app')

@section('content')
    @include('pages.events.inc.form')
@endsection
@section('javascritps')
    <script>
        $('select').selectpicker();
    </script>
@endsection
