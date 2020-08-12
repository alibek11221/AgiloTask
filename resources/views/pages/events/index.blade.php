@extends('layouts.app')
@section('content')
        <table class="table table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Type')}}</th>
                <th>{{__('Cost')}}</th>
                <th>{{__('Date')}}</th>
                <th>{{__('Company')}}</th>
                <th>{{__('Shift')}}</th>
                <th>{{__('Users')}}</th>
                <th><a class="btn btn-success" href="{{route('event.create')}}">{{__('Create')}}</a></th>
            </tr>
            </thead>
            <tbody>
            @foreach( $events as $event )
                <tr>
                    <td>{{$event->id}}</td>
                    <td>{{$event->name}}</td>
                    <td>{{$event->type}}</td>
                    <td>{{$event->cost}}</td>
                    <td>{{$event->date}}</td>
                    <td>{{$event->company->name}}</td>
                    <td>{{$event->shift->name}}</td>
                    <td>
                        {{$event->user->name}}
                    </td>
                    <td>
                        <a class="btn btn-primary"
                           href="{{route('event.show', ['event'=>$event->id])}}">{{__('Show')}}</a>
                        <a class="btn btn-dark"
                           href="{{route('event.edit', ['event'=>$event->id])}}">{{__('Edit')}}</a>
                        <a class="btn btn-danger delete" onclick="del(this.href)"
                           href="{{route('event.destroy', ['event'=>$event->id])}}">{{__('Delete')}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
