<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category';

    protected $guarded = [];

    protected $appends = ['slug_cat_name'];

    public function getSlugCatNameAttribute(){
        return Str::slug($this->attributes['cat_name']);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category_product', 'product_id', 'p_category_id');
    }
}
