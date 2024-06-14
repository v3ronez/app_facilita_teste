<?php

namespace App\Http\Controllers;

use App\Repository\BookRepository;
use App\Services\BookService;
use Exception;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    private BookService $bookService;

    public function __construct()
    {
        $this->bookService = new BookService(new BookRepository());
    }

    public function index()
    {
        try {
            $books = $this->bookService->getPaginateBootstrap();
            return response()->view('book.index', compact('books'));
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response('unexpected error', 500);
        }
    }
}
