<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiaryRequest;
use App\Http\Requests\UpdateDiaryRequest;
use App\Models\Diary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DiaryController extends Controller
{
    // 一覧画面: ログインユーザーの日記を新しい順に5件ずつページネーションして表示
    public function index(): View
    {
        $diaries = auth()->user()
            ->diaries()
            ->latest()
            ->paginate(5);

        return view('diaries.index', compact('diaries'));
    }

    // 新規投稿画面: 投稿フォームを表示
    public function create(): View
    {
        return view('diaries.create');
    }

    // 詳細画面: 本人の日記かを確認してから詳細を表示（画像もここで表示）
    public function show(Diary $diary): View
    {
        $this->authorize('view', $diary);

        return view('diaries.show', compact('diary'));
    }

    // 投稿保存: バリデーション済みデータを受け取り、画像があれば保存してDBに登録
    public function store(StoreDiaryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            // 画像を storage/app/public/diaries/ に保存し、パスを取得
            $imagePath = $request->file('image')->store('diaries', 'public');
        }

        auth()->user()->diaries()->create([
            'content'    => $validated['content'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('diaries.index')->with('success', '日記を投稿しました。');
    }

    // 編集画面: 本人の日記かを確認してから編集フォームを表示
    public function edit(Diary $diary): View
    {
        $this->authorize('update', $diary);

        return view('diaries.edit', compact('diary'));
    }

    // 更新保存: 既存の画像があれば削除してから新しい画像を保存し、DBを更新
    public function update(UpdateDiaryRequest $request, Diary $diary): RedirectResponse
    {
        $validated = $request->validated();

        $imagePath = $diary->image_path;
        if ($request->hasFile('image')) {
            // 既存画像をストレージから削除してから新しい画像を保存
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('diaries', 'public');
        }

        $diary->update([
            'content'    => $validated['content'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('diaries.index')->with('success', '日記を更新しました。');
    }

    // 削除: 本人の日記かを確認し、画像があればストレージからも削除してDBのレコードを削除
    public function destroy(Diary $diary): RedirectResponse
    {
        $this->authorize('delete', $diary);

        if ($diary->image_path) {
            Storage::disk('public')->delete($diary->image_path);
        }

        $diary->delete();

        return redirect()->route('diaries.index')->with('success', '日記を削除しました。');
    }
}
