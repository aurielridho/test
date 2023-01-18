@extends('template')

@section('title', 'Login')

@section('content')
    @if ($message = Session::get('success'))
        <div class="position-absolute w-100 alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="position-absolute w-100 alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="container-fluid m-0 p-0 d-flex vh-100 justify-content-center align-items-center" style="background: url({{asset('storage/Auth/cover-img.jpg')}}); background-position: center; background-repeat: no-repeat; background-size: cover">
        <div class="container p-4 rounded-2 shadow" style="width: 30vw;background-color: rgba(255, 255, 255, .15);
    backdrop-filter: blur(5px);">
            <form method="post" action="{{route('login')}}">
                @csrf
                <div class="mb-3">
                    <h2 class="h2">Have an Account ?</h2>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control rounded-3" id="email"
                           placeholder="Enter Your Email Address...">
                    <label for="email" class="form-label">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control rounded-3" id="password"
                           placeholder="Enter Your Password...">
                    <label for="password" class="form-label">Password</label>
                </div>
                @if($errors->any())
                    <p class="text-danger text-left">{{$errors->first()}}</p>
                @endif
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100">Log In</button>
                </div>
                <hr>
                <div class="mb-3">
                    <p>Not a member ? <a class="link-primary" href="{{route('index_register')}}">Sign Up Here.</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
