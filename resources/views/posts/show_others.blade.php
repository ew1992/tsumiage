@extends('layout')

@section('content')
<div class="date">{{\Carbon\Carbon::today()->format('Y年m月d日')}}</div>

<article>
    @if(!empty($post->twitter_url))
        <p class="user_name">ユーザー名: <a target="_blank" class="list_a" href="{{ $post->twitter_url }}">{{ $post->name }}</a></p>
    @else
        <p class="user_name">ユーザー名: {{ $post->name }}</p>
    @endif
    <br/><br/>
    <p class="stack">今日の積み上げ</p>
    <p class="show_message">{{$post->stack_thing}}</p>
    <br/>
    <br/>
    <p class="reflection">今日の反省/メモ</p>
    <p class="show_message">{{$post->reflection_point}}</p>
</article>

<div class="back_button">
    <a class="back_link" href="/list">一覧へ戻る</a>
</div>
@endsection