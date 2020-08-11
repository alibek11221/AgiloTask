<form action="{{$route}}" method="POST">
    @csrf
    @if($method)
        @method($method)
    @endif
    <div class="form-group">
        <label for="name">
            {{__('Name')}}
        </label>
        <input id="name" @if(isset($shift)) value="{{$shift->name}}" @endif class="form-control" type="text"
               name="name">
    </div>
    <div class="form-group">
        <button class="btn btn-success" type="submit">{{__('Save')}}</button>
    </div>
</form>
