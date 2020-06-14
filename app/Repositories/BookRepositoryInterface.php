<?php

namespace App\Repositories;

interface BookRepositoryInterface {

    public function getBookCategories();

    public function getBooks();

    public function getTotalBooks();

    public function getBookByPaginated($perPage);

    public function getBook($id);

    public function addBookCategory($book);

    public function updateBook($book);

    public function deleteBook($id);
}
