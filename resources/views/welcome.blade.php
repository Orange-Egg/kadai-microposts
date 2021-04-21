{{-- ログイン認証後一番最初に表示されるページ --}}
@extends('layouts.app')

@section('content')
    {{-- 認証できていればユーザの詳細ページを表示 --}}
    @if (Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                {{-- ユーザ情報 --}}
                {{-- Ch.10で共通化したViewを@includeする --}}
                @include('users.card')
            </aside>
            <div class="col-sm-8">
                {{-- タブ --}}
                @include('users.navtabs')
                {{-- 投稿フォーム --}}
                @include('microposts.form')
                {{-- @include して投稿一覧を表示 --}}
                @include('microposts.microposts')
            </div>
        </div>
    {{-- そうでなければユーザ登録ページへ遷移 --}}
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection