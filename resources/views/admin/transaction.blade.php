@extends('template')

@section('title', 'Admin | View Transactions')

@section('content')
    <x-navbar/>
    <div class="container-fluid p-2">
        <table class="table table-hover">
            <thead>
            <tr class="table-dark">
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">User ID</th>
                <th scope="col">Product ID</th>
                <th scope="col">Quantity</th>
                <th scope="col">Sub Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactionHeaders as $th)


                @for($i=0;$i<sizeof($th->transactionDetails);$i++)
                    <tr>
                        <th scope="row">{{$i+1}}</th>
                        <td>{{$th->transaction_date}}</td>
                        <td>{{$th->user_id}}</td>
                        <td>{{$th->transactionDetails[$i]->product_id}}</td>
                        <td>{{$th->transactionDetails[$i]->quantity}}</td>
                        <td>${{$th->transactionDetails[$i]->quantity *
                        $th->transactionDetails[$i]->product->price}}</td>
                    </tr>
                @endfor
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>${{$th->subtotal}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div>
            {{$transactionHeaders->links()}}
        </div>
    </div>
@endsection
