<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = ['name', 'value', 'id_user', 'stock', 'description', 'file_path'];

    public function relUsers()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }

    public function relImage()
    {
        return $this->hasMany('App\ProductImage', 'product_id');
    }
}
