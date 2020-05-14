<?php

namespace App\Http\Controllers\Api;

use App\Model\Book;
use App\Model\BookCategory;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Book\BookCollection;
use App\Http\Resources\BookCategory\BookCategoryCollection;
use App\Http\Requests\Book\BookEntryRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $book_categories = BookCategory::all();
        $books = Book::paginate(5);

        return response()->json([
            "status" => true,
            'message' => "success",
            "data" => [
                "book_categories" => BookCategoryCollection::collection($book_categories),
                "books" => new BookCollection($books)
            ]
        ]);
    }

    public function store(BookEntryRequest $request)
    {
        $status = "error";
        $message = "Book failed to create.";
        $code = Response::HTTP_CONFLICT;
        $data = $request->all();

        $request['avail_copies'] = $request->total_copies;
        $book = Book::create($request->all());

        if ($book) {
            $status = "success";
            $message = "Book successfully created.";
            $code = Response::HTTP_CREATED;
            $data = $book;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $book
        ], $code);
    }

    public function show(Book $book)
    {

    }

    public function update(Request $request, Book $book)
    {

    }

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Book deleted successfully.',
        ], Response::HTTP_OK);
    }
}
