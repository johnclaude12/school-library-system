<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\BookRepositoryInterface;
use App\Http\Resources\BookCategory\BookCategoryCollection;

class BookCategoryController extends Controller
{
    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        return response()->json([
            "message" => "success",
            "data" => BookCategoryCollection::collection($this->bookRepository->getBookCategories()),
            "status" => true,
        ], Response::HTTP_OK);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $book_category = $this->bookRepository->addBookCategory($request);

        return response()->json([
            "status" => true,
            "data" => $book_category,
            "message" => "Book Category Successfully created."
        ], Response::HTTP_CREATED);
    }

    public function show(BookCategory $bookCategory)
    {
        //
    }

    public function edit(BookCategory $bookCategory)
    {
        //
    }

    public function update(Request $request, BookCategory $bookCategory)
    {
        //
    }

    public function destroy(BookCategory $bookCategory)
    {
        //
    }
}
