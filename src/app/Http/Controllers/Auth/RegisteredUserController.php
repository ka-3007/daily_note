<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function __construct(private AuthService $authService) {}

    // 新規登録画面: 登録フォームを表示
    public function create(): View
    {
        return view('auth.register');
    }

    // 新規登録処理: バリデーション済みデータをサービスに渡してユーザーを作成・ログイン
    public function store(RegisterUserRequest $request): RedirectResponse
    {
        $this->authService->register(
            $request->validated('name'),
            $request->validated('email'),
            $request->validated('password'),
        );

        return redirect(route('diaries.index', absolute: false));
    }
}
