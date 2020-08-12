@extends('layouts.app')

@section('content')

    <h1>{{__('Name')}}-{{$event->name}}</h1>
    <h3>{{__('Type')}}-{{$event->type}}</h3>
    <h3>{{__('Cost')}}-{{$event->cost}}</h3>
    <h3>{{__('Date')}}-{{$event->date}}</h3>
    <h3>{{__('Company')}}-{{$event->company->name}}</h3>
    <h3>{{__('Shift')}}-{{$event->shift->name}}</h3>
    <h3>
        {{__('Users')}}-{{$event->user->name}}
    </h3>
@endsection
