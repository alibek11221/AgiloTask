@extends('layouts.app')
@section('content')
    @guest
        <h1>Авторизуйтесь для получения доступа к CRUD операциям по всем сущностям</h1>
    @endguest
    @foreach($companies as $company)
        <h1>{{$company->name}}</h1>
        <table class="col-10 table table-bordered">
            <thead class="thead-light">
            <th scope="col" headers="0">Cмена</th>
            @for($i=0; $i<7;$i++)
                <th scope="col" headers="{{$i}}">
                    {{$days[$i]}}
                </th>
            @endfor
            </thead>
            <tbody>
            @foreach($shifts as $shift)
                <tr>
                    <?php $z = 0 ?>
                    <td>{{$shift->name}}</td>
                    @for($i=0; $i<7;$i++)
                        @foreach($company->events as $event)
                            @if($event->date == $days[$i] && $event->shift->id == $shift->id)
                                <td headers="{{$i}}">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Название {{$event->name}}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Стоимость {{$event->cost}}р</h6>
                                            <p class="card-text">Тип работ {{$event->type}} <br> Имя
                                                сотрудника {{$event->user->name}}</p>
                                        </div>
                                    </div>
                                </td>
                                <?php $z = 1 ?>
                            @endif
                        @endforeach
                        @if($z==0)
                            <td></td>
                        @else
                            <?php $z = 0 ?>
                        @endif
                    @endfor
                </tr>
            @endforeach
            </tbody>
        </table>
    @endforeach
@endsection
