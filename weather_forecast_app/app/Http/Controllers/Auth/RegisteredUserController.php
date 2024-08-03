<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\RegisterdUserService;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(LoginRequest $request, RegisterdUserService $service)
    {
        $result = $service->registerUser($request);

        if (isset($result['success'])) {
            return redirect()->route('main.index');
        }

        return back()
            ->withInput()
            ->withErrors($result['error']);


        // if ($registerdUser) {
        //     session(['user' => $user]);
        //     return redirect()->route('profile.edit');
        // } else {
        //     return back()
        //         ->withInput()
        //         ->withErrors(['message' => '正常に登録できませんでした。']);
        // }
    }
}
