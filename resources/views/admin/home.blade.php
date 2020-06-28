@extends('layouts.app_admin')

@section('content')

<div class="date">{{\Carbon\Carbon::today()->format('Y年m月d日')}}</div>

<table class="list">
    <tr class="list_tr">
        <th class="list_th">ユーザー名</th>
        <th class="list_th">本日の積み上げ状況</th>
    </tr>
    
    @foreach (array_map(null,$users, $posts) as [$user, $post])
        <tr class="list_tr">
            <td class="list_td"><a class="list_a" href="{{ action('Admin\HomeController@show',$user) }}">{{ $user->name}}</a></td>
            @if($post == '積み上げ済み'||$post == '積み上げ済み(非公開)')
                <td class="list_td">積み上げ済み</td>
            @else
                <td class="list_td">積み上げなし</td>
            @endif
        </tr>
    @endforeach
</table>

@endsection
