@extends('layouts.app_admin')

@section('content')

<div class="admin_page_month">
    <a class="symbol" href="?ym={{ $prev }}">&lt;&lt;</a>
    <span class="month">{{ $month }}</span>
    <a class="symbol" href="?ym={{ $next }}">&gt;&gt;</a>
</div>
@if(!empty($twitter_url))
    <p class="user_name">ユーザー名: <a target="_blank" class="p_a" href="{{ $twitter_url }}">{{ $userinfo }}</a></p>
@else
    <p class="user_name">ユーザー名: {{ $userinfo }}</p>
@endif

@if($posts == "none")
    <p>データなし</>
@else
    @foreach ($posts as $post)
        <article class="post_box">
            <div>
                <p class="post_date">{{ date('Y年m月d日',strtotime($post->created_at)) }}</p>
                <br/>
                <p class="stack">今日の積み上げ</p>
                <p class="show_message">{{ $post->stack_thing }}</p>
                <br/>
                <p class="reflection">今日の反省点/メモ</p>
                <p class="show_message">{{ $post->reflection_point }}</p>
            </div>
        </article>
    @endforeach
@endif

<div class="back_button">
    <a class="back_link" href="{{ url('/admin/home') }}">一覧へ戻る</a>
</div>
@endsection