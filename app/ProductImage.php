<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'products_images';

    public function relImageProduct()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
