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
            return response('unexpected error', 500);
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
            return redirect()->route('book.index')->with('success', 'Book created successfully');
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response('unexpected error', 500);
        }
    }
}
