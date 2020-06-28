<?php

namespace App\Services;

require '../vendor/autoload.php';

use App\Facades\Calendar;
use Carbon\Carbon;
use App\Post;
use App\User;
use Auth;


class PostinfoService
{
   //他ユーザーの登録内容取得
    public function getStatus()
    {
        $posts = [];
        $today = Calendar::getToday();

        $users = self::getUsers();

        foreach ($users as $user) {

            $post = \DB::table('posts')->where('user_id', '=', $user->id)
                ->whereDate('created_at', '=', $today)
                ->first();

            if ($post == null) {
                $posts[] = '積み上げなし';
            } elseif ($post->private_flag == true) {
                $posts[] = '積み上げ済み(非公開)';
            } else {
                $posts[] = '積み上げ済み';
            }
        }

        return $posts;
    }

    public function getUsers()
    {
        $users = User::orderBy('action_date', 'DESC')
            ->get()->all();
        
        return $users;
    }

    public function getUsers_ASC()
    {
        $users = User::orderBy('action_date', 'ASC')
            ->get()->all();
        
        return $users;
    }
}