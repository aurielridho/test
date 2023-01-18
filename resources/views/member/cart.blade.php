@extends('template')

@section('title', 'Cart')

@section('content')
    <x-navbar/>
    <div class="container-fluid d-flex flex-column justify-content-center">
        <div class="container mt-4 d-flex gap-5 justify-content-center">
            @if($totalItem != 0)
                <h2 class="h2 text-center">Total Item : {{$totalItem}}</h2>
                <h2 class="h2 text-center">Total Price : ${{$totalPrice}}</h2>
            @else
                <h2 class="h2 text-center">Cart Empty</h2>
            @endif

        </div>
        @if($totalItem!=0)
            <div class="container mt-2 d-flex gap-2" style="overflow-x: scroll">
                @foreach($carts as $p)
                    <div class="card" style="width: 18rem;height: 28rem">
                        <div class="position-relative" style="height: 15rem">
                            <img src="{{asset('storage/'.$p->product->image_url)}}" class="card-img-top border-bottom">
                            <form action="{{route('remove_from_cart')}}" method="post">
                                @csrf
                                <input type="hidden"
                                       name="id" value="{{$p->product_id}}">
                                <div class="position-absolute" style="right: 3%; bottom: 3%">
                                    <button class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title m-0">{{substr($p->product->name, 0, 25)}}</h5>
                                <p class="card-text m-0">Price: ${{$p->product->price}}</p>
                                <p class="card-text m-0">Stock: {{$p->product->stock}}</p>
                            </div>
                            <div>
                                <div>
                                    <div class="mb-3 d-flex gap-1">
                                        <form action="{{route('decrement')}}" method="post">
                                            @csrf
                                            <input type="hidden"
                                                   name="id" value="{{$p->product_id}}">
                                            <button class="btn btn-danger" type="submit">-</button>
                                        </form>
                                        <input type="number" class="form-control" value="{{$p->quantity}}" disabled>
                                        <form action="{{route('increment')}}" method="post">
                                            @csrf
                                            <input type="hidden"
                                                   name="id" value="{{$p->product_id}}">
                                            <button class="btn btn-primary" type="submit">+</button>
                                        </form>
                                    </div>
                                </div>
                                <p class="card-text fw-bold">Subtotal: ${{$p->quantity * $p->product->price}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="container mt-3 d-flex justify-content-center">
                <form action="{{route('checkout')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">Checkout</button>
                </form>
            </div>
        @endif
    </div>
@endsection
