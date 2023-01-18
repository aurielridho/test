<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(){
        return view('home');
    }

    public function index_products(){
        if(!Auth::user()->role=='Admin'){
            $products = Product::query()->where('stock', '!=', 0)->paginate(8)->withQueryString();
        }else{
            $products = Product::paginate(8)->withQueryString();
        }
        for($i=0;$i<sizeof($products);$i++){
            $is_added = Cart::query()->where('product_id', '=', $products[$i]->id)->where('user_id', '=', Auth::user()->id)->first() != null;
            $products[$i]['is_added'] = $is_added;
        }
        return view('product', compact('products'));
    }

    public function search(Request $request){
        $search = $request->search;
        if(!Auth::user()->role=='Admin'){
            $products = Product::query()->where('stock', '!=', 0)->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('description', 'LIKE','%'.$search.'%')
                ->paginate(8)->withQueryString();
        }else{
            $products = Product::query()->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('description', 'LIKE','%'.$search.'%')
                ->paginate('8')->withQueryString();
        }
        return view('product', compact('products', 'search'));
    }

    public function index_add(){
        $productTypes = ProductType::all();
        return view('admin.add', compact('productTypes'));
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required|integer|min:1',
            'stock' => 'required|integer|min:1|max:999',
            'type' => 'required|exists:product_types,id',
            'image' => 'required|mimes:jpg,png,jpeg|max:10240'
        ]);

        $image_path = $request->file('image')->store('Product', 'public');

        $newProduct = new Product();
        $newProduct->id = Str::uuid();
        $newProduct->name = $request->input('name');
        $newProduct->description = $request->input('desc');
        $newProduct->price = $request->input('price');
        $newProduct->stock = $request->input('stock');
        $newProduct->product_type_id = $request->input('type');
        $newProduct->image_url = $image_path;
        $newProduct->created_at = now();
        $newProduct->save();

        return redirect()->route('index_product')->with('success', 'Product Added Successfully!');
    }

    public function index_update($id){
        $productTypes = ProductType::all();
        $toedit = Product::query()->where('id', '=', $id)->first();
        return view('admin.add', compact('productTypes', 'toedit'));
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required|integer|min:1',
            'stock' => 'required|integer|min:1|max:999',
            'type' => 'required|exists:product_types,id',
            'image' => 'mimes:jpg,png,jpeg|max:10240'
        ]);

        if($request->input('image')!=null){
            $image_path = $request->file('image')->store('Product', 'public');

            Product::query()->where('id', '=', $request->input('id'))->update([
                'name' => $request->input('name'),
                'description' => $request->input('desc'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'product_type_id' => $request->input('type'),
                'image_url' => $image_path,
                'updated_at' => now()
            ]);
        }else{
            Product::query()->where('id', '=', $request->input('id'))->update([
                'name' => $request->input('name'),
                'description' => $request->input('desc'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'product_type_id' => $request->input('type'),
                'updated_at' => now()
            ]);
        }

        return redirect()->route('index_product')->with('success', 'Product Updated Successfully!');
    }
}
