<?php

namespace App\Http\Controllers\Api;

use App\Model\Book;
use App\Model\BookCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Book\BookCollection;
use App\Http\Resources\Book\BookResource;
use App\Http\Resources\BookCategory\BookCategoryCollection;
use App\Http\Requests\Book\BookEntryRequest;
use App\Repositories\BookRepositoryInterface;

class BookController extends Controller
{
    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->middleware('auth:api');
    }

    public function index()
    {
        $book_categories = BookCategory::all();
        $books = $this->bookRepository->getBookByPaginated(5);

        return response()->json([
            "status" => true,
            'message' => "success",
            "data" => [
                "book_categories" => BookCategoryCollection::collection($book_categories),
                "books" => new BookCollection($books)
            ]
            ], Response::HTTP_OK);
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

    public function show($id)
    {
        $book = $this->bookRepository->getBook($id);

        return response()->json([
            'message' => 'success',
            'status' => true,
            'data' => new BookResource($book)
        ], Response::HTTP_OK);
    }

    public function update(Request $request)
    {
        unset($request['category']); // remove category attribute from request
        $book = $this->bookRepository->updateBook($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Book updated successfully.',
            'data' => new BookResource($book)
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->bookRepository->deleteBook($id);

        return response()->json([
            'status' => true,
            'message' => 'Book deleted successfully.',
        ], Response::HTTP_OK);
    }

    public function TotalBooks() {
        $total_counts = $this->bookRepository->getTotalBooks();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $total_counts
        ], Response::HTTP_OK);
    }
}
