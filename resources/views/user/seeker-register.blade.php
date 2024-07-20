@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-4">
        <div class="col-md-6">
            <h1>Looking for a job?</h1>
            <h3>Please create an account</h3>
            <img src="{{asset('image/right_arrow.png')}}" width="230" height="200" alt="Register image">
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Register</div>
                <form action="{{route('store.seeker')}}" method="post">@csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Full name</label>
                        <input type="text" name="name" class="form-control">
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control">
                        @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                        @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-primary" type="submit">Register</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection