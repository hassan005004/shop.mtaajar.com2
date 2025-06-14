<?php

namespace App\Exports;


use App\Models\Products;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportProduct implements FromCollection,WithHeadings,ShouldAutoSize,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if(Auth::user()->type == 4)
        {
            $vendor_id = Auth::user()->vendor_id;
        }else{
            $vendor_id = Auth::user()->id;
        }
        return Products::with('multi_image')->where('vendor_id',$vendor_id)->get();
        
    }
    public function map($item): array
    {
        $newimages = [];
      
        if(!empty($item->multi_image))
        {
            foreach($item->multi_image as $image)
            {
               $newimages[] = $image->image;
            }
        }
        return[
            $item->category_id,
            $item->sub_category_id,
            $item->name,
            $item->price,
            $item->original_price,
            $item->tax,
            $item->sku,
            implode('|',$newimages),
            $item->qty,
            $item->low_qty,
            $item->min_order,
            $item->max_order,
            $item->stock_management,
            $item->video_url,
            $item->description,
            $item->additional_info,
        ];
    }
    public function headings(): array
    {
        return [
            'category_id',
            'sub_category_id',
            'product_name',
            'selling_price',
            'original_price',
            'tax',
            'sku',
            'image',
            'qty',
            'low_qty',
            'min_order',
            'max_order',
            'stock_management',
            'video_url',
            'description',
            'additional_description',
        ];
    }
}
