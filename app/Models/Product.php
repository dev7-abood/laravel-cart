<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['slug_name', 'price'];

    public function getSlugNameAttribute(){
        return Str::slug($this->attributes['name']);
    }

    public function getPriceAttribute(){
       return round($this->attributes['price']);
    }

}
