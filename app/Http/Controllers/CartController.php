<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index(){
        $carts = Cart::query()->where('user_id', '=', Auth::user()->id)->get();
        $totalItem = Cart::query()->where('user_id', '=', Auth::user()->id)->sum('quantity');
        $totalPrice = 0;
        foreach($carts as $c){
            $totalPrice += $c->product->price * $c->quantity;
        }
        return view('member.cart', compact('carts', 'totalPrice', 'totalItem'));
    }

    public function addToCart(Request $request){
        $find = Cart::query()->where('user_id', '=', Auth::user()->id)->where('product_id', '=', $request->id)->first();
        if($find != null){
            return redirect()->back();
        }

        Cart::query()->insert([
            'user_id' => Auth::user()->id,
            'product_id' => $request->id,
            'quantity' => 1,
            'created_at' => now()
        ]);
        return redirect()->back();
    }

    public function removeFromCart(Request $request){
        $find = Cart::query()->where('user_id', '=', Auth::user()->id)->where('product_id', '=', $request->id)->first();
        if($find == null){
            return redirect()->back();
        }
        Cart::query()->where('user_id', '=', Auth::user()->id)->where('product_id', '=', $request->id)->delete();
        return redirect()->back();
    }

    public function incrementQuantity(Request $request){
        $id = $request->id;
        $quantity = Cart::query()->select('quantity')
            ->where('user_id', '=', Auth::user()->id)
            ->where('product_id', '=', $id)->first();
        $stock = Product::query()->select('stock')->where('id', '=', $id)->first();
        if($quantity->quantity == $stock->stock){
            return redirect()->back();
        }
        Cart::query()->where('user_id', '=', Auth::user()->id)
            ->where('product_id', '=', $id)
            ->update([
               'quantity' => $quantity->quantity+1,
                'updated_at' => now()
            ]);
        return redirect()->back();
    }

    public function decrementQuantity(Request $request){
        $id = $request->id;
        $quantity = Cart::query()->select('quantity')
            ->where('user_id', '=', Auth::user()->id)
            ->where('product_id', '=', $id)->first();
        if($quantity->quantity == 1){
            Cart::query()->where('user_id', '=', Auth::user()->id)->where('product_id', '=', $request->id)->delete();
            return redirect()->back();
        }
        Cart::query()->where('user_id', '=', Auth::user()->id)
            ->where('product_id', '=', $id)
            ->update([
                'quantity' => $quantity->quantity-1,
                'updated_at' => now()
            ]);
        return redirect()->back();
    }

    public function checkout(){
        $carts = Cart::query()->where('user_id', '=', Auth::user()->id)->get();
        $newID = Str::uuid();
        TransactionHeader::query()->insert([
            'id' => $newID,
            'user_id' => Auth::user()->id,
            'transaction_date' => now(),
            'created_at' => now()
        ]);

        foreach($carts as $c){
            TransactionDetail::query()->insert([
                'transaction_id' => $newID,
                'product_id' => $c->product_id,
                'quantity' => $c->quantity
            ]);
        }

        Cart::query()->where('user_id', '=', Auth::user()->id)->delete();

        return redirect()->route('index_product')->with('success', 'Checkout Successful!');
    }
}
