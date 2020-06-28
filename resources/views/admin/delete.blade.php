@extends('layouts.app_admin')

@section('content')

<div class="date">ユーザー削除画面</div>

@if(session('message'))
    <p class="success_message">{{ session('message') }}</p>
@endif

<table class="list">
    <tr class="list_tr">
        <th class="list_th">ユーザー名</th>
        <th class="list_th">最終更新日時</th>
        <th class="list_th">削除ボタン</th>
    </tr>
    
    @foreach ($users as $user)
        <tr class="list_tr">
            <td class="list_td"><a class="list_a" href="{{ action('Admin\HomeController@show',$user) }}">{{ $user->name}}</a></td>
        <td class="list_td">{{ $user->action_date ->format('Y/m/d　H:m:s')}}</td>
            <td class="list_td">
                <form id="form_{{$user->id}}" action="{{ action('Admin\HomeController@destroy',$user->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <a class="user_delete" href="#" data-id="{{ $user->id }}" onclick="deleteUser(this)"><i class="far fa-trash-alt"></i></a>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<div class="back_button">
    <a class="back_link" href="home">一覧へ戻る</a>
</div>

<script>
    function deleteUser(e) {
      'use strict';
     
      if (confirm('本当にユーザー削除してよろしいですか?')) {
        document.getElementById('form_' + e.dataset.id).submit();
      }
    }
</script>

@endsection
