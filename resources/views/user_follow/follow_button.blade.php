{{-- これを@include すると、フォローボタンを表示できる --}}
{{-- フォロー時はアンフォローボタンが表示される --}}
{{-- idがユーザ登録されているかを判定 --}}
@if (Auth::id() != $user->id)
    {{-- フォローしているユーザのidか判定 --}}
    @if (Auth::user()->is_following($user->id))
        {{-- アンフォローボタンのフォーム --}}
        {!! Form::open(['route' => ['user.unfollow', $user->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfollow', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {{-- フォローボタンのフォーム --}}
        {!! Form::open(['route' => ['user.follow', $user->id]]) !!}
            {!! Form::submit('Follow', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif