@extends('layouts.app')

@section('content')

        <div class="card">
            <div class="card-header">My Profile</div>

            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-group">
                            @foreach($errors->all() as $error)


                                <li class="list-group-item text-danger">
                                    {{$error}}
                                </li>

                            @endforeach
                        </ul>
                    </div>
                @endif
              <form action="{{route('users.update-profile')}}" method="post">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                  </div>

                  <div class="form-group">
                      <label>About Me</label>
                      <textarea class="form-control" id="about" name="about" cols="5" rows="5">{{$user->about}}</textarea>
                  </div>

                  <button type="submit" class="btn btn-success"> Update Profile</button>


              </form>
            </div>
        </div>
@endsection
