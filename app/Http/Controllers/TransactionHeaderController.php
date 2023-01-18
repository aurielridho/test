<?php

namespace App\Http\Controllers;

use App\Models\TransactionHeader;
use Illuminate\Http\Request;

class TransactionHeaderController extends Controller
{
    public function index(){
        $transactionHeaders = TransactionHeader::paginate(25)->withQueryString();

        foreach($transactionHeaders as $key => $th){
            $totalPrice = 0;
            foreach($th->transactionDetails as $td){
                $totalPrice+=$td->product->price * $td->quantity;
            }
            $transactionHeaders[$key]['subtotal'] = $totalPrice;
        }
        return view('admin.transaction', compact('transactionHeaders'));
    }
}
