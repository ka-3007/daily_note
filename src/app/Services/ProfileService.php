<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileService
{
    // プロフィール情報を更新（メールアドレスが変更された場合は認証済みフラグをリセット）
    public function update(User $user, array $validated): void
    {
        // バリデーション済みの値をユーザーモデルに一括セット
        $user->fill($validated);

        // メールアドレスが変更された場合、メール認証済みフラグをリセット（再認証が必要になる）
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // 変更内容をDBに保存
        $user->save();
    }

    // アカウントを削除（ログアウト → ユーザー削除 → セッション破棄）
    public function destroy(User $user): void
    {
        // 先にログアウトしてセッションとの紐付けを解除
        Auth::logout();

        // ユーザーレコードをDBから削除
        $user->delete();

        // セッションデータを全て破棄して不正な再利用を防ぐ
        Session::invalidate();

        // CSRFトークンを再生成してリクエスト偽造を防ぐ
        Session::regenerateToken();
    }
}
