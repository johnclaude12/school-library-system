<?php

namespace App\Repositories;

interface BookRepositoryInterface {

    public function getBooks();

    public function getBookByPaginated($perPage);

    public function getBook($id);

    public function deleteBook($id);
}
