@extends('layout')

@section('content')
<div class="flex-center position-ref calendar_box">
  <a class="symbol" href="?ym={{ $prev }}">&lt;&lt;</a>
  <span class="month">{{ $month }}</span>
  <a class="symbol" href="?ym={{ $next }}">&gt;&gt;</a>

  <table class="table table-bordered">
    <thead>
      <tr class="calendar_tr">
        @foreach (['日', '月', '火', '水', '木', '金', '土'] as $dayOfWeek)
        <th class="calendar_th">{{ $dayOfWeek }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach ($weeks as $week)
        {!! $week !!}
      @endforeach  
    </tbody>
  </table>
  <p class="aste">＊・・・積み上げした日</p>
</div>
@endsection