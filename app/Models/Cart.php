<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Cart extends Model
{
    use HasFactory;

    protected $primaryKey = ['user_id', 'product_id'];
    public $incrementing = false;

    protected function setKeysForSaveQuery($query){
        return $query->where('user_id', $this->getAttribute('user_id'))
            ->where('product_id', $this->getAttribute('product_id'));
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
