<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = ['transaction_id', 'product_id'];

    protected function setKeysForSaveQuery($query){
        return $query->where('transaction_id', $this->getAttribute('transaction_id'))
            ->where('product_id', $this->getAttribute('product_id'));
    }

    public function transactionHeader(){
        return $this->belongsTo(TransactionHeader::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
