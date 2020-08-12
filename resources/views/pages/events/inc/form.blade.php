<form action="{{$route}}" method="POST">
    @csrf
    @if(isset($method))
        @method($method)
    @endif
    <div class="form-group">
        <label for="name">
            {{__('Name')}}
        </label>
        <input id="name" @if(isset($event)) value="{{$event->name}}" @else value="{{old('name')}}" @endif class="form-control" type="text"
               name="name">
    </div>
    <div class="form-group">
        <label for="type">
            {{__('Type')}}
        </label>
        <input id="type" @if(isset($event)) value="{{$event->type}}" @else value="{{old('type')}}" @endif class="form-control" type="text"
               name="type">
    </div>
    <div class="form-group">
        <label for="cost">
            {{__('Cost')}}
        </label>
        <input id="cost" @if(isset($event)) value="{{$event->cost}}" @else value="{{old('cost')}}" @endif class="form-control" type="number"
               name="cost">
    </div>
    <div class="form-group">
        <label for="date">
            {{__('Date')}}
        </label>
        <input id="date" @if(isset($event)) value="{{$event->date}}" @else value="{{old('date')}}" @endif class="form-control" type="date"
               name="date">
    </div>
    <div class="form-group">
        <label for="company">
            {{__('Company')}}
        </label>
        <select id="company" name="company" >
            @foreach($companies as $company)
                <option @if(isset($event) && $event->company->id == $company->id) selected @elseif(old('company')==$company) selected @endif value="{{$company->id}}">{{$company->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="user">
            {{__('User')}}
        </label>
        <select id="user" name="user">
            @foreach($users as $user)
                <option @if(isset($event) && $event->user->id == $user->id) selected @elseif(old('user')==$user) selected @endif  value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="shift">
            {{__('Shift')}}
        </label>
        <select id="shift" name="shift">
            @foreach($shifts as $shift)
                <option @if(isset($event) && $event->shift->id == $shift->id) selected @elseif(old('shift')==$shift) selected @endif value="{{$shift->id}}">{{$shift->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-success" type="submit">{{__('Save')}}</button>
    </div>
</form>
