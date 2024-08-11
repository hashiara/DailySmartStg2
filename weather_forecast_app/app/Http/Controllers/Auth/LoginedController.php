<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class LoginedController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('main.index', compact('user'));
    }

    /**
     * Display the login view.
     */
    public function urlError()
    {
        return view('auth.url-error');
    }

    /**
     * Display the login view.
     */
    public function create(Request $request, $userId)
    {
        $users = User::all();
        $user = $users->where('user_id', $userId)->first();

        if ($user) {
            session(['user' => $user]);
            return redirect()->route('profile.edit');
        }

        return view('auth.register', compact('userId'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(RegisterRequest $request)
    {
        // ログイン認証情報が残っていればデータ登録画面に遷移
        if ($request->authenticate()) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // バリデーションルールを定義
        $rules = [
            'user_id' => ['required_without:name', 'max:255'],
            'name' => ['required_without:user_id', 'max:255'],
            'password' => ['required', 'min:8'],
        ];

        // リクエストの入力をバリデート
        $credentials = $request->validate($rules);

        // 資格情報を設定する
        $authCredentials = [
            'password' => $credentials['password'],
        ];

        // user_id または name が提供されている場合、それを認証資格情報に追加する
        if (!empty($credentials['user_id'])) {
            $authCredentials['user_id'] = $credentials['user_id'];
        }
        if (!empty($credentials['name'])) {
            $authCredentials['name'] = $credentials['name'];
        }

        // 資格情報に基づいて認証を試みる
        if (Auth::attempt($authCredentials)) {
            // 認証成功
            return redirect('profile');
        } else {
            // 認証失敗: エラーメッセージと共にログインページにリダイレクト
            return redirect('login')
                ->withInput()
                ->withErrors(['message' => 'LineユーザーID、ニックネームまたはパスワードが正しくありません。']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    // アカウント削除
    public function delete(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            Auth::logout();
            User::find($user->id)->delete();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');
        }

        return view('auth.login');
    }
}
