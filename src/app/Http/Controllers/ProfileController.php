<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteProfileRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(private ProfileService $profileService) {}

    // プロフィール編集画面: 現在のユーザー情報をフォームに渡して表示
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // プロフィール更新: バリデーション済みデータをサービスに渡して保存
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->profileService->update($request->user(), $request->validated());

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // アカウント削除: パスワード確認後にサービスに削除を委譲してトップへリダイレクト
    public function destroy(DeleteProfileRequest $request): RedirectResponse
    {
        $this->profileService->destroy($request->user());

        return Redirect::to('/');
    }
}
