<?php

namespace App\Repositories\Eloquent;

use App\Model\Book;
use App\Model\BookCategory;
use App\Repositories\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface {

    public function getBookCategories()
    {
        return BookCategory::all();
    }

    public function getBooks()
    {
        return Book::all();
    }

    public function getBookByPaginated($perPage)
    {
        return Book::paginate($perPage);
    }

    public function getBook($id)
    {
        return Book::findOrFail($id);
    }

    public function updateBook($book)
    {
        $this->getBook($book['id'])->update($book);

        // return getBook result for response
        return $this->getBook($book['id']);
    }

    public function deleteBook($id)
    {
        return Book::where('id', $id)->delete();
    }
}
