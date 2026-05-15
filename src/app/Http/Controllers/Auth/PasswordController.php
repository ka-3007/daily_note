<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;

class PasswordController extends Controller
{
    public function __construct(private AuthService $authService) {}

    // パスワード更新: バリデーション済みデータをサービスに渡してパスワードを変更
    public function update(UpdatePasswordRequest $request): RedirectResponse
    {
        $this->authService->updatePassword(
            $request->user(),
            $request->validated('password'),
        );

        return back()->with('status', 'password-updated');
    }
}
