@extends('template')

@section('title', 'Register')

@section('content')
    <div class="container-fluid m-0 p-0 d-flex vh-100 justify-content-center align-items-center" style="background: url({{asset('storage/Auth/cover-img.jpg')}}); background-position: center; background-repeat: no-repeat; background-size: cover">
        <div class="container p-4 rounded-2 shadow" style="width: 30vw;background-color: rgba(255, 255, 255, .15);
    backdrop-filter: blur(5px);">
            <form method="post" action="{{route('register')}}">
                @csrf
                <div class="mb-2">
                    <h2 class="h2">Create an Account.</h2>
                </div>
                <div class="form-floating mb-2">
                    <input type="text" name="name" class="form-control rounded-3" id="name"
                           placeholder="Enter Your Name...">
                    <label for="name" class="form-label">Name</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="email" name="email" class="form-control rounded-3" id="email"
                    placeholder="Enter Your Email Address...">
                    <label for="email" class="form-label">Email address</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" name="password" class="form-control rounded-3" id="password"
                    placeholder="Enter Your Password...">
                    <label for="password" class="form-label">Password</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" name="confirm" class="form-control rounded-3" id="confirm"
                    placeholder="Enter Your Password...">
                    <label for="confirm" class="form-label">Confirm Password</label>
                </div>
                <div class="mb-2 form-check">
                    <input class="form-check-input" name="terms" type="checkbox" value="0" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        I Agree to the terms and conditions.
                    </label>
                </div>
                @if($errors->any())
                    <p class="text-danger text-left">{{$errors->first()}}</p>
                @endif
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </div>
                <hr>
                <div class="mb-3">
                    <p>Already Have an Account ? <a class="link-primary" href="{{route('index_login')}}">Log In Here.</a></p>
                </div>
            </form>
        </div>
    </div>

@endsection
