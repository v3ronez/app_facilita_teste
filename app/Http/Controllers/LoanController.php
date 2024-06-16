<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use App\Services\LoanService;
use Exception;

class LoanController extends Controller
{
    private LoanService $loanService;

    public function __construct()
    {
        $this->loanService = new LoanService(new UserRepository());
    }

    public function create()
    {
        try {
            return false;
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response()->view('errors.500', [], 500);
        }
    }
}
