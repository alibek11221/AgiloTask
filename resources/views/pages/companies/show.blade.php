@extends('layouts.app')

@section('content')
    <h1>{{$company->name}}</h1>
    <ul class="list-group">
        @if(count($company->users)>0)
            @foreach($company->users as $user)
                <li class="list-group-item">{{$user->name}}</li>
            @endforeach
        @endif
    </ul>
@endsection
