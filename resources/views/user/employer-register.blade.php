@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-4">
        <div class="col-md-6">
            <h1>Looking for an employee?</h1>
            <h3>Please create an account</h3>
            <img src="{{asset('image/right_arrow.png')}}" width="230" height="200" alt="Register image">
        </div>
        <div class="col-md-6">
            <div class="card" id="card">
                <div class="card-header">Employee Registration</div>
                <form action="{{route('store.employer')}}" method="post" id="registrationForm">@csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Full name</label>
                        <input type="text" name="name" class="form-control" required>
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" required>
                        @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" required>
                        @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-primary" type="submit" id="btnRegister">Register</button>
                    </div>
                </div>
                </form>
            </div>
            <!-- <div id="message">

            </div> -->
        </div>
    </div>
</div>

<!-- <script>
    let url = "{{route('store.employer')}}";
    document.getElementById('btnRegister').addEventListener("click", (e) => {
        let form = document.getElementById("registrationForm");
        let messageDiv = document.getElementById('message');
        let card = document.getElementById('card');
        messageDiv.innerHTML = '';
        let formData = new FormData(form);

        let button = event.target;
        button.disabled = true;
        button.innerHTML = 'Sending email...';

        fetch(url, {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '@csrf'
            },
            body: formData
        })
        .then((response) => {
            if(response.ok) {
                return response.json();
            } else {
                throw new Error('ERROR');
            }
        })
        .then((data) => {
            button.innerHTML = 'Register';
            button.disabled = false;
            messageDiv.innerHTML = '<div class="alert alert-success">Register was successful. Please check your email to verify the account.</div>';
            card.style.display = 'none';
        })
        .catch((error) => {
            button.innerHTML = 'Register';
            button.disabled = false;
            messageDiv.innerHTML = '<div class="alert alert-danger">Something went wrong, please try again.</div>';
        });
    });
</script> -->

@endsection