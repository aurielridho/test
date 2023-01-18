<nav class="navbar navbar-expand-lg bg-light shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('index_home')}}">Group 3</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('index_home')}}"
                        >Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{\Illuminate\Support\Facades\Route::getCurrentRoute() == 'index_product' ? "active" :
                        ""}}" href="{{route('index_product')}}">Products</a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->role == 'Admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index_add')}}">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index_view_transaction')}}">View Transactions</a>
                    </li>
                @endif
            </ul>
            <form action="{{route('search')}}" method="get" class="d-flex" role="search">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg></button>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="rounded-circle border-3" src="{{asset('/storage/default.png')}}" style="width:
                             40px; height: 40px; object-fit: cover">

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><p class="dropdown-item text-end">Hi, {{\Illuminate\Support\Facades\Auth::user()->name}}</p></li>
                        <li><hr class="dropdown-divider"></li>
                        @if(\Illuminate\Support\Facades\Auth::user()->role=='Member')
                            <li><a class="dropdown-item text-end" href="{{route('index_cart')}}">Cart</a></li>
                        @endif
                        <li>
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item text-end">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
