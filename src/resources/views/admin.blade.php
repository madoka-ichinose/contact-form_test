@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}" />
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection 

@section('content')
<div class="admin-container">
    <h2>Admin</h2>
    
    <form method="GET" action="{{ route('admin.index') }}" class="search-form">
        <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
        <select name="gender">
            <option value="">性別</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
        </select>
        <select name="content">
            <option value="">お問い合わせの種類</option>
            @foreach (['商品のお届けについて', '商品の交換について', '商品トラブル', 'ショップへのお問い合わせ', 'その他'] as $category)
            <option value="{{ $category }}" {{ request('content') == $category ? 'selected' : '' }}>
                {{ $category }}
            </option>
            @endforeach
        </select>
        <input type="date" name="date" value="{{ request('date') }}">
        <button type="submit">検索</button>
        <button type="reset" onclick="window.location='{{ route('admin.index') }}'">リセット</button>
    </form>

    <div class="export-button-link__container">
        <div class="export-botton__container">
            <button class="export-button" onclick="window.location='{{ route('admin.export', request()->all()) }}'">エクスポート</button>
        </div>
         <div class="link">{{ $contacts->links() }}</div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>
                    @if ($contact->gender == 1)
                        男性
                    @elseif ($contact->gender == 2)
                        女性
                    @elseif ($contact->gender == 3)
                        その他
                    @else
                        不明
                    @endif
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ optional($contact->category)->content }}</td>
                <td>
                    <!-- 詳細ボタン -->
                    <button type="button" class="detail-button" data-bs-toggle="modal" data-bs-target="#contactModal{{ $contact->id }}">
                        詳細
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- 各モーダルをテーブル外に配置 -->
@foreach ($contacts as $contact)
<div class="modal fade" id="contactModal{{ $contact->id }}" tabindex="-1" aria-labelledby="contactModalLabel{{ $contact->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel{{ $contact->id }}">お問い合わせ詳細</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-body">
                <p><strong>お名前：</strong> {{ $contact->last_name }} {{ $contact->first_name }}</p>
                <p><strong>性別：</strong>
                    @if ($contact->gender == 1)
                        男性
                    @elseif ($contact->gender == 2)
                        女性
                    @elseif ($contact->gender == 3)
                        その他
                    @else
                        不明
                    @endif
                </p>
                <p><strong>メールアドレス：</strong> {{ $contact->email }}</p>
                <p><strong>電話番号：</strong> {{ $contact->tel }}</p>
                <p><strong>住所：</strong> {{ $contact->address }}</p>
                <p><strong>建物名：</strong> {{ $contact->building }}</p>
                <p><strong>お問い合わせの種類：</strong> {{ optional($contact->category)->content }}</p>
                <p><strong>お問い合わせ内容：</strong> {!! nl2br(e($contact->detail)) !!}</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('admin.contact.destroy', $contact->id) }}" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button btn btn-danger">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('js')
@endsection
