@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>{{__('Name')}}</th>
                <th><a class="btn btn-success" href="{{route('shift.create')}}">{{__('Create')}}</a></th>
            </tr>
            </thead>
            <tbody>
            @foreach( $shifts as $shift )
                <tr>
                    <td>{{$shift->id}}</td>
                    <td>{{$shift->name}}</td>
                    <td>
                        <a class="btn btn-primary"
                           href="{{route('shift.show', ['shift'=>$shift->id])}}">{{__('Show')}}</a>
                        <a class="btn btn-dark" href="{{route('shift.edit', ['shift'=>$shift->id])}}">{{__('Edit')}}</a>
                        <a class="btn btn-danger delete" onclick="del(this.href)"
                           href="{{route('shift.destroy', ['shift'=>$shift->id])}}">{{__('Delete')}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('javascritps')
    <script>
        function del(href) {
            fetch(href, {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'DELETE'
            }).then(() => window.location.reload());
        }

    </script>
@endsection
