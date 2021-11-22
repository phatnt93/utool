<?php
namespace App\Helpers;

class Common
{
    public function getYesNo($data){
        if ($data) {
            return '<span class="badge bg-success">' . trans('yes') . '</span>';
        }
        return '<span class="badge bg-danger">' . trans('no') . '</span>';
    }
}
