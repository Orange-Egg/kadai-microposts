{{-- お気に入りに加えられた投稿を表示する --}}

{{-- 共通化したもので記述 --}}
@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
        </aside>
        <div class="col-sm-8">
            {{-- タブ --}}
            @include('users.navtabs')
            {{-- お気に入り投稿一覧 --}}
            @include('microposts.microposts')
        </div>
    </div>
@endsection


