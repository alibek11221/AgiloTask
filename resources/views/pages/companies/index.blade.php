@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Users')}}</th>
                <th><a class="btn btn-success" href="{{route('company.create')}}">{{__('Create')}}</a></th>
            </tr>
            </thead>
            <tbody>
            @foreach( $companies as $company )
                <tr>
                    <td>{{$company->id}}</td>
                    <td>{{$company->name}}</td>
                    <td>
                        <ul class="list-group">
                            @if(count($company->users)>0)
                                @foreach($company->users as $user)
                                    <li class="list-group-item">{{$user->name}}</li>
                                @endforeach
                            @endif
                        </ul>
                    </td>
                    <td>
                        <a class="btn btn-primary"
                           href="{{route('company.show', ['company'=>$company->id])}}">{{__('Show')}}</a>
                        <a class="btn btn-dark"
                           href="{{route('company.edit', ['company'=>$company->id])}}">{{__('Edit')}}</a>
                        <a class="btn btn-danger delete" onclick="del(this.href)"
                           href="{{route('company.destroy', ['company'=>$company->id])}}">{{__('Delete')}}</a>
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
