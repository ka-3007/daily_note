<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiaryRequest;
use App\Http\Requests\UpdateDiaryRequest;
use App\Models\Diary;
use App\Services\DiaryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DiaryController extends Controller
{
    public function __construct(private DiaryService $diaryService) {}

    // 一覧画面: ログインユーザーの日記を5件ずつページネーションして表示（昇順/降順切り替え可）
    public function index(): View
    {
        $order = request('order', 'desc') === 'asc' ? 'asc' : 'desc';

        $diaries = $this->diaryService->getList(auth()->user(), $order);

        return view('diaries.index', compact('diaries', 'order'));
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

    // 投稿保存: バリデーション済みデータをサービスに渡して日記を登録
    public function store(StoreDiaryRequest $request): RedirectResponse
    {
        $this->diaryService->store(
            auth()->user(),
            $request->validated('content'),
            $request->file('image')
        );

        return redirect()->route('diaries.index')->with('success', '日記を投稿しました。');
    }

    // 編集画面: 本人の日記かを確認してから編集フォームを表示
    public function edit(Diary $diary): View
    {
        $this->authorize('update', $diary);

        return view('diaries.edit', compact('diary'));
    }

    // 更新保存: バリデーション済みデータをサービスに渡して日記を更新
    public function update(UpdateDiaryRequest $request, Diary $diary): RedirectResponse
    {
        $this->diaryService->update(
            $diary,
            $request->validated('content'),
            $request->file('image')
        );

        return redirect()->route('diaries.index')->with('success', '日記を更新しました。');
    }

    // 削除: 本人の日記かを確認してからサービスに削除を委譲
    public function destroy(Diary $diary): RedirectResponse
    {
        $this->authorize('delete', $diary);

        $this->diaryService->destroy($diary);

        return redirect()->route('diaries.index')->with('success', '日記を削除しました。');
    }
}
