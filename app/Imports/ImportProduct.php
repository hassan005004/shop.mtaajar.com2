<?php

namespace App\Imports;
use App\Models\ProductImage;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ImportProduct implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        try {
           
            foreach ($rows as $row) {
                
                $item = new Products();
                $item->category_id = $row['category_id'];
                $item->sub_category_id = $row['sub_category_id'];
                $item->vendor_id = Auth::user()->id;
                $item->slug = Str::slug($row['product_name'] . ' ', '-') . '-' . Str::random(5);
                $item->name = $row['product_name'];
                $item->price = $row['selling_price'];
                $item->original_price = $row['original_price'];
                $item->tax = $row['tax'];
                $item->sku = $row['sku'];
                $item->description = $row['description'];
                $item->additional_info = $row['additional_description'];
                $item->video_url = $row['video_url'];
                $item->stock_management = $row['stock_management'];
                $item->qty =  $row['stock_management'] == 1 ? $row['qty'] : 0;
                $item->min_order = $row['stock_management'] == 1 ? $row['min_order'] : 0;
                $item->max_order = $row['stock_management'] == 1 ? $row['max_order'] : 0;
                $item->low_qty = $row['stock_management'] == 1 ? $row['low_qty'] : 0;
                $item->is_imported = 1;
                $item->save();
              
                if ($row['image'] != "" && $row['image'] != null) {
                    $images = explode('|', $row['image']);
                    foreach ($images as $image) {
                        $productimage = new ProductImage();
                        $url =  strtok($image, '?');
                        $filename = basename($url);
                        $productimage->product_id = $item->id;
                        $productimage->image = preg_replace('/\s+/', '', $filename);
                        $productimage->is_imported = 1;
                        $productimage->save();
                    }
                }
              
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
        
    }
    public function headingRow(): int
    {
        return 1;
    }
}
