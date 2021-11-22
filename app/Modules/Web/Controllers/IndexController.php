<?php

namespace App\Modules\Web\Controllers;

use App\Modules\Web\WebController;

class IndexController extends WebController
{
    public function index(){
        echo '<pre>';
        var_dump('Web - Index action');
        die();
    }
}
