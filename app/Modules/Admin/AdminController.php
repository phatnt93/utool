<?php

namespace App\Modules\Admin;

use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    public function resJsonSuccess($msg = '', $data = []){
        return response()->json([
            'msg' => $msg,
            'data' => $data
        ]);
    }

    public function resJsonError($code = 400, $msg = ''){
        return response()->json(['msg' => $msg], $code);
    }
}
