<?php

namespace App\Services;

use App\Models\Diary;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class DiaryService
{
    // ユーザーの日記一覧を取得（昇順/降順・ページネーション付き）
    public function getList(User $user, string $order): LengthAwarePaginator
    {
        return $user->diaries()
            // diary_number で昇順/降順ソート
            ->orderBy('diary_number', $order)
            // 5件ずつページネーション（クエリ文字列はページリンクに引き継ぐ）
            ->paginate(5)
            ->withQueryString();
    }

    // 日記を新規作成（画像がある場合は保存してパスを記録）
    public function store(User $user, string $content, ?UploadedFile $image): Diary
    {
        // 画像を storage/app/public/diaries/ に保存し、パスを取得（画像なしの場合は null）
        $imagePath = $image ? $image->store('diaries', 'public') : null;

        // 削除済みを含めた最大 diary_number に +1 して連番を採番する（番号の再利用防止）
        $nextNumber = $user->diaries()->withTrashed()->max('diary_number') + 1;

        // ユーザーに紐付けてDBに保存
        return $user->diaries()->create([
            'diary_number' => $nextNumber,
            'content'      => $content,
            'image_path'   => $imagePath,
        ]);
    }

    // 日記を更新（新しい画像がある場合は既存画像を削除してから保存）
    public function update(Diary $diary, string $content, ?UploadedFile $image): void
    {
        // 現在の画像パスを初期値として保持（画像変更がない場合はそのまま使う）
        $imagePath = $diary->image_path;

        if ($image) {
            // 既存画像をストレージから削除してから新しい画像を保存
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            // 新しい画像を保存してパスを更新
            $imagePath = $image->store('diaries', 'public');
        }

        // 本文と画像パスをDBに保存
        $diary->update([
            'content'    => $content,
            'image_path' => $imagePath,
        ]);
    }

    // 日記を削除（画像がある場合はストレージからも削除）
    public function destroy(Diary $diary): void
    {
        // 画像ファイルが存在する場合はストレージから先に削除
        if ($diary->image_path) {
            Storage::disk('public')->delete($diary->image_path);
        }

        // DBのレコードを論理削除（deleted_at に日時をセット）
        $diary->delete();
    }
}
