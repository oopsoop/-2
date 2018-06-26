<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;

use Illuminate\Support\Facades\Redis;


class RedisController extends Controller
{
    public function testRedis()
    {

            Redis::set('name', 'oopsoop');
            $values = Redis::get('name');
            dd($values);
    }
}
