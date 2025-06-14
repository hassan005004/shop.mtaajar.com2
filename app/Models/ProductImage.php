<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    protected $fillable = ['vendor_id','category_id','sub_category_id','name','slug','price','original_price','tax','description','additional_info'];
}
