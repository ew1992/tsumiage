<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use App\Facades\Calendar;
use App\Post;
use Auth;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{
    // 投稿
    public function tweet(Request $request)
    {
        $twitter = new TwitterOAuth(env('TWITTER_CLIENT_ID'),
                                    env('TWITTER_CLIENT_SECRET'),
                                    env('TWITTER_CLIENT_ID_ACCESS_TOKEN'),
                                    env('TWITTER_CLIENT_ID_ACCESS_TOKEN_SECRET'));
        
        $today = Calendar::getToday();
        $query = Post::query();
        $query->where('user_id', Auth::id());
        $query->whereDate('created_at', $today);
        $post = $query->first();

        $twitter->post("statuses/update", [
            "status" =>
                $post->stack_thing . PHP_EOL .
                $post->reflection_point . PHP_EOL .
                '#今日の積み上げ'
        ]);
    }
}