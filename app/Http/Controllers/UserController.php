<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService(new UserRepository());
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
            return response('unexpected error', 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $userID)
    {
        try {
            $user = $this->userService->withRelations($userID, ['books']);
            if (!$user) {
                return response()->view('errors.404');
            }
            return response()->view('user.show', compact('user'));
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response('unexpected error', 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
                return response()->view('errors.404', '', 404);
            }
            $fields = $request->only(['name', 'email', 'document']);
            $fields['isAdmin'] = $request->has('isAdmin');
            $user = $this->userService->updateUser($userID, $fields);
            if (!$user) {
                return response()->view('errors.500', '', 500);
            }
            return response()->redirectToRoute('user.show', ['id' => $userID])->with(
                'success',
                'Perfil Editado com sucesso!'
            );
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response('unexpected error', 500);
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
                return response()->view('errors.404', '', 404);
            }
            $this->userService->delete($user->id);
            return redirect()->route('user.index');
        } catch (Exception $e) {
            Log::error("Exception error", [$e->getMessage()]);
            return response('unexpected error', 500);
        }
    }
}
