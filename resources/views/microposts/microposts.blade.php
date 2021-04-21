@if (count($microposts) > 0)
    <ul class="list-unstyled">
        @foreach ($microposts as $micropost)
            <li class="media mb-3">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($micropost->user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $micropost->user->name, ['user' => $micropost->user->id]) !!}
                        <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                    </div>
                    <div>
                        {{-- 認証idとMicropostモデルのuser_idが一致すれば（ログインユーザ本人の場合のみ）、投稿削除ボタンを表示 --}}
                        @if (Auth::id() == $micropost->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        {{-- @endif --}}
                        {{-- ログインユーザ以外であれば、以下の処理を実行 --}}
                        @else
                            {{-- お気に入り投稿のidかを判定 --}}
                            {{-- お気に入り投稿であれば、unfavoriteボタンを表示 --}}
                            @if (Auth::user()->is_favorite($micropost->id))
                            {{-- はずすボタンのフォーム --}}
                                {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Unfavorite', ['class' => "btn btn-danger btn-sm"]) !!}
                                {!! Form::close() !!}
                            {{-- そうでなければ、favoriteボタンを表示 --}}
                            @else
                                {{-- お気に入りに加えるボタンのフォーム --}}
                                {!! Form::open(['route' => ['favorites.favorite', $micropost->id]]) !!}
                                {!! Form::submit('Favorite', ['class' => "btn btn-success btn-sm"]) !!}
                                {!! Form::close() !!}
                            @endif
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $microposts->links() }}
@endif