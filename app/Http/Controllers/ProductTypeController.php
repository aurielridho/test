<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductTypeController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'name' => 'required|unique:product_types'
        ]);

        ProductType::query()->insert([
           'id' => Str::uuid(),
           'name' => $request->name
        ]);
        return redirect()->route('index_add');
    }

}
