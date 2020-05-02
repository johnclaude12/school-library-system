<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];

    public function book_category()
    {
        return $this->hasOne(BookCategory::class);
    }
}
