<?php

namespace App\Http\Controllers;

use App\Enums\BookStatusEnum;
use App\Models\Gender;
use App\Repository\BookRepository;
use App\Services\BookService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
            return response()->view('errors.500', [], 500);
        }
    }

    public function show(Request $request, $bookID)
    {
        try {
            $book = $this->bookService->findById($bookID);
            $genders = Gender::all();
            if (!$book) {
                return response()->view('errors.404');
            }
            return response()->view('book.show', compact('book', 'genders'));
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function create()
    {
        $genders = Gender::all();
        return view('book.create', compact('genders'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title'  => ['required', 'string', 'min:3', 'max:255'],
                'author' => ['required', 'string', 'min:3', 'max:255'],
                'gender' => ['required'],
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }
            $fields = $request->only(['title', 'author', 'gender']);
            $fields['registration_number'] = uuid_create();
            $fields['status'] = BookStatusEnum::AVAILABLE->value;

            $create = $this->bookService->create($fields);
            if (!$create) {
                return back()->with('error', 'Something went wrong');
            }
            return redirect()->route('admin.book.index')->with('success', 'Book created successfully');
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function update(Request $request, $bookId)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title'  => ['required', 'string', 'min:3', 'max:255'],
                'author' => ['required', 'string', 'min:3', 'max:255'],
                'gender' => ['required'],
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }
            $bookExists = $this->bookService->findById($bookId);
            if (!$bookExists) {
                return response()->view('errors.404', '', 404);
            }
            $fields = $request->only(['title', 'author', 'gender']);
            $this->bookService->update($bookId, $fields);
            return back()->with('success', 'Book editado com sucesso!');
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function destroy(Request $request, $bookID)
    {
        try {
            $book = $this->bookService->findById($bookID);
            if (!$book) {
                return response()->view('errors.404', '', 404);
            }
            $this->bookService->delete($book->id);
            return redirect()->route('admin.book.index')->with('deleted', 'Livro excluido com sucesso!');
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response()->view('errors.500', [], 500);
        }
    }
}
