<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    public $timestamps = false;

    public function category()
    {
        return $this->hasMany(Category::class, 'id', 'category_id');
    }
}
