@extends('template')

@section('title', 'Our Products')

@section('content')
    <x-navbar/>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="container mt-3 mb-3">
        @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'search')
            @if(sizeof($products)==0)
                <h3 class="h3 mt-2 text-center">No Result Found For {{\Illuminate\Support\Facades\Request::input
                ('search')}}</h3>
            @else
                <h3 class="h3 mt-2">Showing Result(s) For {{\Illuminate\Support\Facades\Request::input
                ('search')}}</h3>
            @endif
        @endif
    </div>
    <div class="mt-2 container d-flex flex-wrap justify-content-center align-items-center gap-2">

        @foreach($products as $p)
            <div class="card" style="width: 18rem;height: 30rem">
                <div class="position-relative" style="height: 15rem">
                    <img src="{{asset('storage/'.$p->image_url)}}" class="card-img-top border-bottom">
                    <div class="position-absolute" style="right: 3%; bottom: 3%">
                        <span class="badge text-bg-secondary">{{$p->productType->name}}</span>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <p class="card-text">{{substr($p->name, 0, 25)}}</p>
                        <h5 class="card-title fw-bold">${{$p->price}}</h5>
                        <p class="card-text">{{substr($p->description, 0, 50)}}{{strlen($p->description)>50 ? "...": ""}}</p>
                    </div>
                    <div>
                        @if($p->stock < 5)
                            <p class="card-text text-danger">{{$p->stock}} item(s) left.</p>
                        @else
                            <p class="card-text">Stock: {{$p->stock}}</p>
                        @endif
                        @if(\Illuminate\Support\Facades\Auth::user()->role == 'Member')
                            <div class="w-100">
                                @if(!$p->is_added)
                                    <form action="{{route('add_to_cart')}}" method="post">
                                        @csrf
                                        <input type="hidden"
                                               name="id" value="{{$p->id}}">
                                        <button type="submit" class="btn btn-primary w-100">Add To Cart</button>
                                    </form>
                                @else
                                    <form action="{{route('remove_from_cart')}}" method="post">
                                        @csrf
                                        <input type="hidden"
                                               name="id" value="{{$p->id}}">
                                        <button type="submit" class="btn btn-danger w-100">Cancel</button>
                                    </form>
                                @endif
                            </div>
                        @elseif(\Illuminate\Support\Facades\Auth::user()->role == 'Admin')
                                <div class="w-100">
                                    <a href="{{route('index_update', $p->id)}}" class="btn btn-primary">Edit</a>
                                </div>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
        <div class="w-100 d-flex justify-content-left">
            <div class="ms-5 ps-3 w-50">
                {{$products->links()}}
            </div>
        </div>
    </div>


@endsection
