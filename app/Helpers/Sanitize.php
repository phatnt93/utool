<?php
namespace App\Helpers;

class Sanitize
{
    /**
     * Define filter list:
     * string
     * email
     * encoded
     * float
     * int
     * special_chars
     * full_special_chars
     * url
     * urlencode
     * htmlencode
     * trim
     * slug
     * lower_case
     * upper_case
     */

    public function requestRun($params = []){
        $res = [];
        foreach ($params as $key => $param) {
            $fnArr = array_filter(explode('|', $param));
            $data = request($key);
            foreach ($fnArr as $fn) {
                if (method_exists($this, $fn)) {
                    $data = $this->{$fn}($data);
                }
            }
            $res[$key] = $data;
        }
        return $res;
    }

    public function run($data = [], $params = []){
        $res = [];
        foreach ($params as $key => $param) {
            $fnArr = array_filter(explode('|', $param));
            $dtval = array_key_exists($key, $data) ? $data[$key] : null;
            foreach ($fnArr as $fn) {
                if (method_exists($this, $fn)) {
                    $dtval = $this->{$fn}($dtval);
                }
            }
            $res[$key] = $dtval;
        }
        return $res;
    }

    private function string($data){
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    private function email($data){
        return filter_var($data, FILTER_SANITIZE_EMAIL);
    }

    private function encoded($data){
        return filter_var($data, FILTER_SANITIZE_ENCODED);
    }

    private function float($data){
        return filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT);
    }

    private function int($data){
        return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
    }

    private function special_chars($data){
        return filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    private function full_special_chars($data){
        return filter_var($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    private function url($data){
        return filter_var($data, FILTER_SANITIZE_URL);
    }

    private function urlencode($data){
        return urlencode($data);
    }

    private function htmlencode($data){
        return htmlentities($data);
    }

    private function trim($data){
        return trim($data);
    }

    private function slug($data){
        return $data;
    }

    private function lower_case($data){
        return strtolower($data);
    }

    private function upper_case($data){
        return strtoupper($data);
    }

}
