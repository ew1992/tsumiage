<?php

namespace App\Services;

require '../vendor/autoload.php';

use Carbon\Carbon;
use App\Post;
use Auth;


class CalendarService
{
    /**
     * カレンダーデータを返却する
     *
     * @return array
     */
    public function getWeeks()
    {
        $weeks = [];
        $week = '';

        $dt = new Carbon(self::getYm_firstday());
        $day_of_week = $dt->dayOfWeek;     // 曜日
        $days_in_month = $dt->daysInMonth; // その月の日数

        // 第 1 週目に空のセルを追加
        $week .= str_repeat('<td class="calendar_td"></td>', $day_of_week);

        for ($day = 1; $day <= $days_in_month; $day++, $day_of_week++) {
            $date = self::getYm() . '-' . $day;

            $query = Post::query();
            $query -> where('user_id',Auth::id());
            $query -> whereDate('created_at',$date);
            $post = $query -> first();

            $url = action('PostsController@show', $date);

            if (Carbon::now()->format('Y-m-j') === $date) {
                if(!empty($post)){
                    $week .= '<td class="today calendar_td">' .'<a class="date_link" href="'.$url.'">'.$day.'</a><p class="asterisk">*</p>';
                }else{
                    $week .= '<td class="today calendar_td">' .'<a class="date_link" href="'.$url.'">'.$day.'</a>';
                }               
            } else {
                if(!empty($post)){
                    $week .= '<td class="data_exist calendar_td">' .'<a class="date_link" href="'.$url.'">'.$day.'</a><p class="asterisk">*</p>';
                }else{
                    $week .= '<td class="calendar_td">' .'<a class="date_link" href="'.$url.'">'.$day.'</a>';
                }
            }
            $week .= '</td>';

            // 週の終わり、または月末
            if (($day_of_week % 7 === 6) || ($day === $days_in_month)) {
                if ($day === $days_in_month) {
                    $week .= str_repeat('<td class="calendar_td"></td>', 6 - ($day_of_week % 7));
                }
                $weeks[] = '<tr class="calendar_tr">' . $week . '</tr>';
                $week = '';
            }
        }
        return $weeks;
    }

    /**
     * month 文字列を返却する
     *
     * @return string
     */
    public function getMonth()
    {
        return Carbon::parse(self::getYm_firstday())->format('Y年n月');
    }

    /**
     * prev 文字列を返却する
     *
     * @return string
     */
    public function getPrev()
    {
        return Carbon::parse(self::getYm_firstday())->subMonthsNoOverflow()->format('Y-m');
    }

    /**
     * next 文字列を返却する
     *
     * @return string
     */
    public function getNext()
    {
        return Carbon::parse(self::getYm_firstday())->addMonthNoOverflow()->format('Y-m');
    }

    /**
     * GET から Y-m フォーマットを返却する
     *
     * @return string
     */
    public static function getYm()
    {
        if (isset($_GET['ym'])) {
            return $_GET['ym'];
        }
        return Carbon::now()->format('Y-m');
    }

    /**
     * 2019-09-01 のような月初めの文字列を返却する
     *
     * @return string
     */
    public static function getYm_firstday()
    {
        return self::getYm() . '-01';
    }

    public static function getYm_lastday()
    {
        if (isset($_GET['ym'])) {
            $setYear = mb_substr($_GET['ym'],0,4);
            $setMonth = mb_substr($_GET['ym'],5,2);
            return Carbon::create($setYear, $setMonth, 1)->lastOfMonth();
        }
        return Carbon::now()->lastOfMonth();
    }

    public function getToday()
    {
        return Carbon::today()->format('Y-m-d');
    }
}