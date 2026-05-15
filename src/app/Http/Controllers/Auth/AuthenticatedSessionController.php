<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function __construct(private AuthService $authService) {}

    // ログイン画面: ログインフォームを表示
    public function create(): View
    {
        return view('auth.login');
    }

    // ログイン処理: 認証成功後にセッションを再生成して日記一覧へリダイレクト
    public function store(LoginRequest $request): RedirectResponse
    {
        // LoginRequest 内でメールアドレス・パスワードの照合を行う
        $request->authenticate();

        // セッション固定攻撃を防ぐためにセッションIDを再生成
        $request->session()->regenerate();

        return redirect()->intended(route('diaries.index', absolute: false));
    }

    // ログアウト処理: セッション破棄・トークン再生成をサービスに委譲してトップへリダイレクト
    public function destroy(Request $request): RedirectResponse
    {
        $this->authService->logout($request);

        return redirect('/');
    }
}
