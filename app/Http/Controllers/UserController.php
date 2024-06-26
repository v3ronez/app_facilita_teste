<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use App\Services\BookService;
use App\Services\LoanService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private UserService $userService;
    private BookService $bookService;
    private LoanService $loanService;
    private BookRepository $bookRepository;

    public function __construct()
    {
        $this->bookRepository = new BookRepository();
        $this->userService = new UserService(new UserRepository());
        $this->bookService = new BookService($this->bookRepository);
        $this->loanService = new LoanService($this->bookRepository);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = $this->userService->getPaginateBootstrap();
            return response()->view('user.index', compact('users'));
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $userID)
    {
        try {
            $user = $this->userService->withRelations($userID, ['books']);
            $books = Book::all();
            if (!$user) {
                return response()->view('errors.404');
            }
            return response()->view('user.show', compact('user', 'books'));
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $userID)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'     => ['required', 'string', 'min:3', 'max:255'],
                'document' => ['required', 'regex:^(\d{3}\.\d{3}\.\d{3}-\d{2}|\d{11})$^'],
                'email'    => ['required', 'email'],
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }
            $userExists = $this->userService->findById($userID);
            if (!$userExists) {
                return response()->view('errors.404', [], 404);
            }
            $fields = $request->only(['name', 'email', 'document']);
            $fields['isAdmin'] = $request->has('isAdmin');
            $user = $this->userService->updateUser($userID, $fields);
            if (!$user) {
                return response()->view('errors.500', '', 500);
            }
            return back()->with(
                'success',
                'Perfil Editado com sucesso!'
            );
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $user = $this->userService->findById($id);
            if (!$user) {
                return response()->view('errors.404', [], 404);
            }
            $this->userService->delete($user->id);
            return redirect()->route('admin.user.index')->with('deleted', 'Usúario excluido com sucesso!');
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response()->view('errors.500', [], 500);
        }
    }
}
