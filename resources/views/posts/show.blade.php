@extends('layout')

@section('content')

<div class="date">{{\Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('Y年m月d日')}}</div>

@if($post == "none")
    <p>データなし</p>
@else
    <article>
        <p class="stack">今日の積み上げ</p>
        <p class="show_message">{{ $post->stack_thing }}</p>
        <br/>
        <br/>
        <p class="reflection">今日の反省/メモ</p>
        <p class="show_message">{{ $post->reflection_point }}</p>
    </article>
@endif

<br/><br/>
<div>

<a class="back_link" href="/calendar">一覧へ戻る</a>
</div>
@endsection