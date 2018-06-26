<?php

namespace App\Http\Controllers\Home;

use App\Tool\Validate\ValidateCode;

use Illuminate\Http\Request;
use App\Http\Controllers\Home\Controller;
use App\Tool\UUID;
class ValidateController extends Controller
{
    public function create(Request $request)
    {
//        dd(public_path() );
        $validateCode = new ValidateCode;
//        $request->session()->put('validate_code', $validateCode->getCode());
        return $validateCode->doimg();
    }

    public function get_uid()
    {
        $uuid = UUID::create('oopsoop');
        return $uuid;
    }
}
