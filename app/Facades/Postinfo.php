<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\PostinfoService;

class Postinfo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PostinfoService::class;
    }
}