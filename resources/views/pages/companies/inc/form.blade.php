<form action="{{$route}}" method="POST">
    @csrf
    @if(isset($method))
        @method($method)
    @endif
    <div class="form-group">
        <label for="name">
            {{__('Name')}}
        </label>
        <input id="name" @if(isset($company)) value="{{$company->name}}" @endif class="form-control" type="text"
               name="name">
    </div>
    <div class="form-group">
        <label for="users">
            {{__('Users')}}
        </label>
        <select id="users" name="users[]" multiple>
            @foreach($users as $user)
                <option @if(isset($company) && $company->users->contains($user->id)) selected @endif value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-success" type="submit">{{__('Save')}}</button>
    </div>
</form>
