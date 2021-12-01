<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\AdminController;

class IndexController extends AdminController
{
    public function index(){
        $data = [];
        $data['title'] = trans('dashboard');
        return view('Admin::dashboard', $data);
    }

    public function error(){
        $data = [];
        return view('Admin::error', $data);
    }
}
