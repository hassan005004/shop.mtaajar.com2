<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['vendor_id', 'category_id', 'sub_category_id', 'name', 'slug', 'price', 'original_price', 'tax', 'description', 'additional_info'];
    public function extras()
    {
        return $this->hasMany('App\Models\Extra', 'product_id', 'id')->select('id', 'name', 'price', 'product_id');
    }
    public function product_image()
    {
        return $this->hasOne('App\Models\ProductImage', 'product_id', 'id')->select('*', \DB::raw("CONCAT('" . url('/storage/app/public/admin-assets/images/product/') . "/', image) AS image_url"))->orderBy('reorder_id');
    }
    public function multi_image()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id')->select('*', \DB::raw("CONCAT('" . url('/storage/app/public/admin-assets/images/product/') . "/', image) AS image_url"))->orderBy('reorder_id');
    }
    public function multi_variation()
    {
        return $this->hasMany('App\Models\Variation', 'product_id', 'id');
    }
    public function category_info()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    public function subcategory_info()
    {
        return $this->hasOne('App\Models\SubCategory', 'id', 'sub_category_id');
    }
    public function product_info()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
    public static function possibleVariants($groups, $prefix = '')
    {
        $result = [];
        $group  = array_shift($groups);
        foreach ($group as $selected) {
            if ($groups) {
                $result = array_merge($result, self::possibleVariants($groups, $prefix . $selected . '|'));
            } else {
                $result[] = $prefix . $selected;
            }
        }
        return $result;
    }
}
