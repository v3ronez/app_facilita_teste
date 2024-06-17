<?php

namespace App\Http\Controllers;

use App\Enums\LoanStatusEnum;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use App\Services\LoanService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoanController extends Controller
{
    private LoanService $loanService;
    private BookRepository $bookRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->bookRepository = new BookRepository();
        $this->loanService = new LoanService($this->bookRepository);
    }


    public function index(Request $request)
    {
        $users = $this->userRepository->getPaginateBootstrap();
        return view('loan.index', compact('users'));
    }

    public function store(Request $request, string $userID)
    {
        try {
            $user = $this->userRepository->findById($userID);
            if (!$user) {
                return response()->view('errors.404', [], 404);
            }
            $book = $this->bookRepository->findById($request->get('book_id'));
            if (!$book) {
                return response()->view('errors.404', [], 404);
            }
            $this->loanService->attach($user, $book);
            return back()->with(
                'success',
                'Perfil Editado com sucesso!'
            );
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function update(Request $request, string $userID)
    {
        try {
            $user = $this->userRepository->findById($userID);
            if (!$user) {
                return response()->view('errors.404', [], 404);
            }
            $book = $this->bookRepository->findById($request->get('book_id'));
            if (!$book) {
                return response()->view('errors.404', [], 404);
            }
            $status = LoanStatusEnum::from(strtolower($request->get('loan_status')));
            $this->loanService->changeLoanStatus($user, $book, $status);
            return back()->with(
                'success',
                'Perfil Editado com sucesso!'
            );
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::error("Exception error", [$e->getMessage()]);
            return response()->view('errors.500', [], 500);
        }
    }
}
