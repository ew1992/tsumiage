@extends('layout')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <section class="home-section">
            <h1>今日行ったことを積み上げよう</h1>
            <h2>『#今日の積み上げ』は今日行った作業を記録・共有出来るアプリです</h2>
            <a href="/register" class="registerbtn">
                <div class="btn btn-warning btn-lg">新規登録</div>
            </a>
        </section>
        {{-- <section class="home-section">
            <h2>『#今日の積み上げ』で出来ること</h2>
        </section> --}}
        <section class="home-section">
            <div class="flexcontainer">
                <div class="flexitem">
                    <img class="top-img" alt="No_image" src="{{ asset('/img/top.png') }}">
                </div>
                <div class="flexitem">
                    <div class="subheading">
                        <p>今日の積み上げ内容・反省点を記録</p>
                    </div>
                    <div class="subheading">
                        <p>他ユーザーの積み上げ内容の確認</p>
                    </div>
                    <div class="subheading">
                        <p>SNSへシェア</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="home-section">
            <div class="flexcontainer">
                <div class="flexitem item1">
                    <img class="top-img" alt="No_image" src="{{ asset('/img/calendar.png') }}">
                </div>
                <div class="flexitem item2">
                    <h2>積み上げ日の確認</h2>
                    <h3>積み上げした日をカレンダー上で確認出来ます</h3>
                </div>
            </div>
        </section>
        <section class="home-section">
            <div class="flexcontainer">
                <div class="flexitem">
                    <img class="top-img" alt="No_image" src="{{ asset('/img/twitter.jpg') }}">
                </div>
                <div class="flexitem">
                    <h2>SNSでシェア</h2>
                    <h3>Twitterと連携させることで積み上げ内容をシェア出来ます</h3>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('footer')
<footer>
    <small class="footer">© 2020 #今日の積み上げ All rights reserved.</small>
</footer>
@endsection
