<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facades\Postinfo;
use App\Facades\Calendar;
use App\User;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //他ユーザーの登録内容取得
    public function getList()
    {
        return view('admin.home', ['users' => Postinfo::getUsers(), 'posts' => Postinfo::getStatus()]);
    }

    public function getUsersList()
    {
        return view('admin.delete', ['users' => Postinfo::getUsers_ASC()]);
    }

    public function show(User $user)
    {
        $firstday = Calendar::getYm_firstday();
        $lastday = Calendar::getYm_lastday();
        $posts = \DB::table('posts')
            ->select('posts.stack_thing','posts.reflection_point','posts.user_id','posts.created_at','users.id','users.name')
            ->leftjoin('users', 'users.id', '=', 'posts.user_id')
            ->where('user_id', '=', $user->id)
            ->whereDate('posts.created_at', '>=', $firstday)
            ->whereDate('posts.created_at', '<=', $lastday)
            ->orderBy('posts.created_at','DESC')
            ->get();
        
        $userinfo = $user->name;
        $twitter_url = $user->twitter_url;
        
        //データ有無確認
        if (!empty($posts)) {
            return view('admin.show', [
                'posts' => $posts,
                'month' => Calendar::getMonth(),
                'prev'  => Calendar::getPrev(),
                'next'  => Calendar::getNext(),
                'userinfo' => $userinfo,
                'twitter_url' => $twitter_url
            ]);
        } else {
            $posts = "none";
            return view('admin.show', [
                'posts' => $posts
            ]);
        }
    }

    public function destroy($id){
        $posts = Post::where('user_id',$id);
        if(!empty($posts)){
            $posts->delete();
        }

        $user = User::findOrFail($id);
        if(!empty($user)){
            $user->delete();
            return redirect('admin/delete')->with('message','ユーザー削除しました。');
        }else{
            return redirect('admin/delete')->with('message','ユーザー削除に失敗しました。');
        }
    }
}
