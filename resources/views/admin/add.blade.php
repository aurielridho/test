@extends('template')

@section('title', 'Admin | Add Product')

@section('content')
    <x-navbar />
    <div class="container-fluid w-100 d-flex justify-content-center align-items-center"
         style="min-height: 89vh">
        <div class="border p-4 rounded-2 shadow d-flex justify-content-center align-items-center" style="width: 67vw;
         height: 77vh">
            <div class="p-2 pb-0 pt-0 ps-0 border-end d-flex flex-column justify-content-between"
                 style="width: 34vw; height: 100%">
                <div class="mb-3" style="height: 30vh">
                    <h4 class="h4">Product Types</h4>
                    <div class="d-flex flex-wrap justify-content-left align-items-center gap-2 w-100">
                        @foreach($productTypes as $pt)
                            <div class="d-flex align-items-center justify-content-center ps-1 pe-1 border rounded-2
                            gap-2" style="height: 40px">
                                <h6>{{$pt->name}}</h6>

                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <form action="{{route('add_product_type')}}" method="post">
                        @csrf
                        <div class="">
                            <label for="name" class="form-label">Product Type Name</label>
                            <div class="d-flex">
                                <input type="text" name="name" class="form-control" id="name">
                                <button type="submit" class="btn btn-primary">+</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="ps-2" style="width: 33vw">
                <form action="{{isset($toedit) ? route('update_product') : route('add_product')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($toedit))
                        <input type="hidden"
                               name="id" value="{{$toedit->id}}">
                    @endif
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                               value="{{isset($toedit) ? $toedit->name : ""}}">
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Product Description</label>
                        <input type="text" name="desc" class="form-control" id="desc"
                               value="{{isset($toedit) ? $toedit->description : ""}}">
                    </div>
                    <label for="price" class="form-label">Product Price</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">$</span>
                        <input type="number" name="price" class="form-control"
                               value="{{isset($toedit) ? $toedit->price : ""}}">
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Product Stock</label>
                        <input type="number" name="stock" class="form-control" id="stock"
                               value="{{isset($toedit) ? $toedit->stock : ""}}">
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="type">Type</label>
                        <select class="form-select" name="type" id="type">
                            @foreach($productTypes as $pt)
                                <option value="{{$pt->id}}" {{isset($toedit) && $pt->id==$toedit->id ? "selected" : ""}}>
                                    {{$pt->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="image" id="image">
                        <label class="input-group-text" for="image">Image</label>
                    </div>
                    <div class="mb-3">
                        @if($errors->any())
                            <p class="text-danger">{{$errors->first()}}</p>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary w-100">{{isset($toedit)? "Update" : "Add"}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
