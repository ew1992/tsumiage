@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">お問い合わせ</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">お名前</label>
                            {{ $inputs['name'] }}
                            <div class="col-md-6">
                                <input id="name" type="hidden" class="form-control" name="name" value="{{ $inputs['name'] }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>
                            {{ $inputs['email'] }}
                            <div class="col-md-6">
                                <input id="email" type="hidden" class="form-control" name="email" value="{{ $inputs['email'] }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="body" class="col-md-4 col-form-label text-md-right">お問い合わせ内容</label>
                            {!! nl2br(e($inputs['body'])) !!}
                            <div class="col-md-6">
                                <input id="body" type="hidden" class="form-control" name="body" value="{{ $inputs['body'] }}">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 mr-auto ml-auto">
                                <button type="submit" class="btn btn-danger register" name="action" value="back">
                                    入力内容修正
                                </button><br><br>
                                <button type="submit" class="btn btn-info register" name="action" value="submit">
                                    送信
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
