@extends('layout')

@section('content')
<div class="date">{{\Carbon\Carbon::today()->format('Y年m月d日')}}</div>
<div class="top_message">
    @if($errors -> any())
        @foreach($errors -> all() as $error)
            <p class="erro_message">{{ $error }}</p>
        @endforeach
    @elseif(session()->has('success_message'))
        <p class="success_message">{{ session()->get('success_message') }}</p>
        {{ session()->forget('success_message') }}
    @endif
</div>

@if($post == "none")
    <form method="post" class="post" action="{{ url('/posts') }}">
        {{ csrf_field() }}
        今日の積み上げ<br/>
        <textarea name="stack_thing" cols="50" rows="5"></textarea><br/>
        <br/>
        今日の反省/メモ<br/>
        <textarea name="reflection_point" cols="50" rows="5"></textarea><br/>
        <br/>
        <input type="checkbox" name="check" value="check"><label class="checkbox_label">非公開ボタン</label>
        <br/><br/><br/>
        <input type="submit" name="btn_submit" class="btn btn-info" value="登録する">
    </form>
@else
    <form method="post" class="post" action="{{ url('/posts', $post->id) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        今日の積み上げ<br/>
        <textarea name="stack_thing" cols="50" rows="5">{{ $post->stack_thing}}</textarea><br/>
        <br/>
        今日の反省/メモ<br/>
        <textarea name="reflection_point" cols="50" rows="5">{{ $post->reflection_point}}</textarea><br/>
        <br/>
        <input
            type="checkbox" name="check" value="check"
            @if($post->private_flag == true)
                checked="checked"
            @endif
        >
        <label class="checkbox_label">非公開ボタン</label>
        <br/><br/><br/>
        <input type="submit" name="btn_submit" class="btn btn-info" value="更新する">
    </form>
    <br>
    @if(!empty($userinfo->twitter_id))
        <a class="twitter-share-button" href="https://twitter.com/share?hashtags=今日の積み上げ&text=<?php echo $post->stack_thing; ?>" target="_blank" data-dnt="true">Tweet</a>
    @endif
@endif
@endsection