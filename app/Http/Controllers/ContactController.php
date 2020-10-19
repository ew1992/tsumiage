<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function confirm(Request $request)
    {
        //バリデーションを実行（結果に問題があれば処理を中断してエラーを返す）
        $request->validate([
            'email' => 'required|email',
            'title' => 'required',
            'body'  => 'required',
        ]);

        //フォームから受け取ったすべてのinputの値を取得
        $inputs = $request->all();

        //入力内容確認ページのviewに変数を渡して表示
        return view('contact.confirm', [
            'inputs' => $inputs,
        ]);
    }

    public function send(Request $request)
    {
    }
}
