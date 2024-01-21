<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'name', 'image', 'slug', 'description', 'status', 'meta_title', 'meta_description', 'meta_keywords'];


    public function getImageAttribute($value)
    {
        return ($value) ? config('app.url')."/storage/app/public/images/category/".$value : config('app.url')."/storage/images/noimage.png";
    }


    // public function getImageAttribute($value)
    // {
    //     return ($value) ? config('global.storage_url')."/images/".$value : config('global.image')."noimage.png"  ;
    // }
}
