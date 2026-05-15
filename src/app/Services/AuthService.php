<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    // 新規ユーザーを登録してログインする
    public function register(string $name, string $email, string $password): User
    {
        // パスワードをハッシュ化してDBにユーザーを作成
        $user = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
        ]);

        // 登録イベントを発火（メール認証などのリスナーが紐付く場合に使われる）
        event(new Registered($user));

        // 作成したユーザーでログイン状態にする
        Auth::login($user);

        return $user;
    }

    // パスワードを更新する（新しいパスワードをハッシュ化して保存）
    public function updatePassword(User $user, string $newPassword): void
    {
        $user->update([
            'password' => Hash::make($newPassword),
        ]);
    }

    // ログアウト処理（セッション破棄・CSRFトークン再生成を含む）
    public function logout(Request $request): void
    {
        // webガードからログアウト
        Auth::guard('web')->logout();

        // セッションデータを全て破棄して不正な再利用を防ぐ
        $request->session()->invalidate();

        // CSRFトークンを再生成してリクエスト偽造を防ぐ
        $request->session()->regenerateToken();
    }
}
