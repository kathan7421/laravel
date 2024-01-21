<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';



    protected $fillable = ['category_id','name', 'small_description', 'description', 'original_price', 'selling_price', 'image', 'qty', 'tax', 'trending', 'status', 'meta_title', 'meta_description', 'meta_keywords'];
    public function getImageAttribute($value)
    {
        return ($value) ? config('app.url')."/storage/app/public/images/product/".$value : config('app.url')."/storage/images/noimage.png";
    }
}
