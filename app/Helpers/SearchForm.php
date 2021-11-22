<?php 
namespace App\Helpers;

class SearchForm {

    public function form($params = []){
        $html = '';
        foreach ($params as $key => $param) {
            $m = 'get' . ucfirst($param['type']);
            if (method_exists($this, $m)) {
                $html .= $this->{$m}($key, $param);
            }
        }
        return $html;
    }

    public function getText($name, $param = []){
        return "
            <div class='form-group mr-1'>
                <input type='text' class='form-control' id='" . $name . "' name='" . $name . "' placeholder='" . ($param['placeholder'] ? $param['placeholder'] : '') . "' value='" . ($param['value'] ? $param['value'] : '') . "'>
            </div>
        ";
    }

    public function getSelect($name, $param = []){
        // return "
        //     <div class='form-group mr-1'>
        //         <input type='text' class='form-control' id='" . $name . "' name='" . $name . "' placeholder='" . ($param['placeholder'] ? $param['placeholder'] : '') . "' value='" . ($param['value'] ? $param['value'] : '') . "'>
        //     </div>
        // ";
    }
}