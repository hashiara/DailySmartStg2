<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;

class AddDataController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        $user = session('user');

        if (!$user || is_null($user)) {
            return view('profile.timeout');
        }

        $jsonString = Storage::disk('public')->get('city_in_prefecture.json');
        $jsons = json_decode($jsonString, true);

        return view('profile.edit', compact('user', 'jsons'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(UpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        if ($user) {

        }

        $user = session('user');
        $userModel = User::find($user->id);

        if ($userModel && $request) {
            // ユーザー情報の更新
            $userModel->fill($request->validated());
            $userModel->save();
    
            // 必要に応じてセッション情報を更新
            session(['user' => $userModel]);
    
            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        } else {
            return back()
                ->withInput()
                ->withErrors(['message' => 'セッションがタイムアウトしました。もう一度LineメッセージのURLからアクセスし直してください。']);
        }


        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        // $request->user()->save();

        // return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
