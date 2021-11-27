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

    public function getDisEna($data){
        if ($data) {
            return '<span class="badge bg-success">' . trans('enable') . '</span>';
        }
        return '<span class="badge bg-danger">' . trans('disable') . '</span>';
    }

    public function renderDisEna($data, $opts = []){
        $html = '<option ' . ($data == '1' ? 'selected' : '') . ' value="1">' . trans('enable') . '</option>';
        $html .= '<option ' . ($data == '0' ? 'selected' : '') . ' value="0">' . trans('disable') . '</option>';
        return $html;
    }
}
