<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\JsonResource;

class BookCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [];

        foreach ($this->items() as $item) {
            array_push($data,
                (object) [
                    'id' => $item->id,
                    'isbn' => $item->isbn,
                    'call_number' => $item->call_number,
                    'title' => $item->title,
                    'author' => $item->author,
                    'publisher' => $item->publisher,
                    'description' => $item->description,
                    'category_id' => $item->category_id,
                    'date_published' => $item->date_published,
                    'series' => $item->series,
                    'avail_copies' => $item->avail_copies,
                    'total_copies' => $item->total_copies,
                    'price' => $item->price
                ]
            );
        };

        return [
            'per_page' => $this->perPage(), //
            'last_page' => $this->lastPage(), //
            'total' => $this->total(), //
            'path' => $this->path(), //
            'first_page_url' => $this->firstItem(), //
            'last_page_url' => $this->lastPage(),
            'prev_page_url'  => $this->previousPageUrl(),
            'next_page_url'  => $this->nextPageUrl(), //
            'current_page' => $this->currentPage(), //
            'data' => $data
        ];
    }
}
