<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    public function category_info()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id')->select('id', 'name', 'slug');
    }
    public function product_info()
    {
        return $this->hasOne('App\Models\Products', 'id', 'product_id')->select('id', 'name', 'slug');
    }
}
