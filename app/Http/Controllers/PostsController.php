<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use Carbon\Carbon;
use App\Http\Requests\PostRequest;
use App\Facades\Calendar;
use App\Facades\Postinfo;
use App\Post;
use App\User;
use Auth;
use DB;

class PostsController extends Controller
{

    // ログイン時のみアクセス可
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    // カレンダー日付取得
    public function getCalendar()
    {
        return view('posts.calendar', [
            'weeks'         => Calendar::getWeeks(),
            'month'         => Calendar::getMonth(),
            'prev'          => Calendar::getPrev(),
            'next'          => Calendar::getNext(),
        ]);
    }

    public function index()
    {
        // システム日付のログインユーザーの登録内容取得
        $today = Calendar::getToday();
        $query = Post::query();
        $query->where('user_id', Auth::id());
        $query->whereDate('created_at', $today);
        $post = $query->first();
        $userid = Auth::id();
        $userinfo = DB::table('users')->where('id', Auth::id())->first();

        //データ有無確認
        if (!empty($post)) {
            return view('posts.index', ['post' => $post, 'userid' => $userid, 'userinfo' => $userinfo]);
        } else {
            $post = "none";
            return view('posts.index', ['post' => $post, 'userid' => $userid, 'userinfo' => $userinfo]);
        }
    }

    //新規登録処理
    public function create(PostRequest $request)
    {
        $post = new Post();
        $post->stack_thing = nl2br($request->stack_thing);
        if(!empty($request->reflection_point)){
            $post->reflection_point = nl2br($request->reflection_point);
        }
        $post->user_id = Auth::id();

        if ($request->check == 'check') {
            $post->private_flag = true;
        } else {
            $post->private_flag = false;
        }

        $post->save();

        self::save_actionDate();

        session(['success_message' => '登録しました。']);

        return redirect('/');
    }

    public function show($date)
    {
        // 選択日付のログインユーザーの登録内容取得
        $query = Post::query();
        $query->where('user_id', Auth::id());
        $query->whereDate('created_at', $date);
        $post = $query->first();

        //データ有無確認
        if (!empty($post)) {
            return view('posts.show', ['post' => $post, 'date' => $date]);
        } else {
            $post = "none";
            return view('posts.show', ['post' => $post, 'date' => $date]);
        }
    }

    //登録内容の更新処理
    public function update(PostRequest $request, Post $post)
    {
        if(date('Y-m-d',strtotime($post->created_at)) == Carbon::today()->format('Y-m-d')){
            $post->stack_thing = $request->stack_thing;
            $post->reflection_point = $request->reflection_point;

            if ($request->check == 'check') {
                $post->private_flag = true;
            } else {
                $post->private_flag = false;
            }
            $post->save();

            self::save_actionDate();

            session(['success_message' => '更新しました。']);

            return redirect('/');
        } else{
            return redirect('/');
        }
        
    }

    //他ユーザーの登録内容取得
    public function getList()
    {
        return view('posts.list', ['users' => Postinfo::getUsers(), 'posts' => Postinfo::getStatus()]);
    }

    public function show_others(User $user)
    {
        $today = Calendar::getToday();
        $post = \DB::table('posts')
            ->leftjoin('users', 'users.id', '=', 'posts.user_id')
            ->where('user_id', '=', $user->id)
            ->whereDate('posts.created_at', '=', $today)
            ->first();

        if ($post->private_flag == true || $post == null) {
            return redirect('/list');
        }

        return view('posts.show_others', ['post' => $post]);
    }

    public function save_actionDate()
    {
        $user = User::where('id', '=', Auth::id())->first();
        $user->action_date = Carbon::now();
        $user->save();
    }
}
