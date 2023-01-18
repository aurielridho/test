@extends('template')

@section('title', 'Home')

@section('content')
    <x-navbar/>
    <div class="container-fluid w-100 m-0 p-0 d-flex flex-column justify-content-center align-items-center">

        <div id="carouselExampleControls" class="carousel slide position-relative" data-bs-ride="carousel">
            <div class="carousel-inner" style="height: 70vh; object-position: center; object-fit: cover;">
                <div class="carousel-item active">
                    <img src="{{asset('/storage/Carousel/1.jpg')}}" class="d-block w-100" style="object-fit: cover;
                    object-position: center">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('/storage/Carousel/2.jpg')}}" class="d-block w-100" style="object-fit: cover;
                    object-position: center">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('/storage/Carousel/3.jpg')}}" class="d-block w-100" style="object-fit: cover;
                    object-position: center">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('/storage/Carousel/4.jpg')}}" class="d-block w-100" style="object-fit: cover;
                    object-position: center">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('/storage/Carousel/5.jpg')}}" class="d-block w-100" style="object-fit: cover;
                    object-position: center">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            <div class="position-absolute w-100 d-flex justify-content-center " style="top: 93%">
                <a class="btn btn-dark fw-bold border p-3 fs-5" href="{{route('index_product')}}">Start Exploring</a>
            </div>
        </div>
        <div class="pt-5 pb-4 container d-flex flex-column justify-content-center align-items-center">
            <h1>Best Arts & Craft Collection in Town.</h1>
        </div>
    </div>

@endsection
