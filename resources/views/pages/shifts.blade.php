@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>{{__('Name')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $shifts as $shift )
                <tr>
                    <td>{{$shift->id}}</td>
                    <td>{{$shift->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
