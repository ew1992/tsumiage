@extends('layout')

@section('content')

<div class="date">{{\Carbon\Carbon::today()->format('Y年m月d日')}}</div>

<table class="list">
    <tr class="list_tr">
        <th class="list_th">ユーザー名</th>
        <th class="list_th">本日の積み上げ状況</th>
    </tr>

    @foreach (array_map(null,$users, $posts) as [$user, $post])
        <tr class="list_tr">
            @if(!empty($user->twitter_url))
            <td class="list_td"><a target="_blank" class="list_a" href="{{ $user->twitter_url }}">{{ $user->name }}</a></td>
            @else
            <td class="list_td">{{ $user->name }}</td>
            @endif

            @if($post == '積み上げ済み')
                <td class="list_td"><a class="list_a" href="{{ action('PostsController@show_others',$user) }}">{{ $post }}</a></td>
            @elseif($post == '積み上げ済み(非公開)')
                <td class="list_td">{{ $post }}</td>
            @else
                <td class="list_td">{{ $post }}</td>
            @endif
        </tr>
    @endforeach
</table>

<div class="back_button">
    <a class="back_link" href="/">入力画面へ戻る</a>
</div>

@endsection