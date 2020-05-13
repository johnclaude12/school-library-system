<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
