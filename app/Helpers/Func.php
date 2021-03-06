<?php 

if (!function_exists('ria')) {
    function ria($key = '', $arr = [], $default = ''){
        if (is_object($arr) && property_exists($arr, $key)) {
            return $arr->{$key};
        }
        if (is_array($arr) && array_key_exists($key, $arr)) {
            return $arr[$key];
        }
        return $default;
    }
}

if (!function_exists('common')) {
    function common($params = []){
        $common = new \App\Helpers\Common();
        return $common;
    }
}

if (!function_exists('sanitize')) {
    function sanitize($params = [], $type = 'requestRun'){
        $sanitize = new \App\Helpers\Sanitize();
        return $sanitize->{$type}($params);
    }
}

if (!function_exists('init_datatable')) {
    function init_datatable($colsname = [], $table = '', $opts = []){
        if ($table == '' || count($colsname) == 0) {
            return '';
        }
        $tableHtml = '<div class="datatable-wrap"><table id="dtable-' . $table . '" class="table table-bordered table-hover"><thead><tr>';
        foreach ($colsname as $col) {
            $tableHtml .= '<th>' . $col . '</th>';
        }
        $tableHtml .= '</tr></thead><tbody></tbody></table></div>';
        return $tableHtml;
    }
}

if (!function_exists('admin_acc_can')) {
    // Write function admin_acc_can('admin.user.manage') in function to check permission
    // Permission::actionsAdmin()
    function admin_acc_can($key = '', $user_id = null){
        // Check account can access
        if ($user_id) {
            $user = App\Models\User::where('id', $user_id)->first();
        }else{
            $user = auth('admin')->user();
        }
        if ($user->isSuperAdmin()) {
            return true;
        }
        $isAllow = $user->checkPermission($key);
        // If denied then redirect to error page
        if (!$isAllow) {
            header('location: /admin/error');
            exit;
        }
    }
}

if (!function_exists('web_acc_can')) {
    // Write function web_acc_can('admin.user.manage') in function to check permission
    // Permission::actionsAdmin()
    function web_acc_can($key = '', $user_id = null){
        // Check account can access
        // if ($user_id) {
        //     $user = App\Models\User::where('id', $user_id)->first();
        // }else{
        //     $user = auth('admin')->user();
        // }
        // if ($user->isSuperAdmin()) {
        //     return true;
        // }
        // $isAllow = $user->checkPermission($key);
        // // If denied then redirect to error page
        // if (!$isAllow) {
        //     header('location: /admin/error');
        //     exit;
        // }
    }
}

if (!function_exists('api_acc_can')) {
    // Write function api_acc_can('admin.user.manage') in function to check permission
    // Permission::actionsAdmin()
    function api_acc_can($key = '', $user_id = null){
        // Check account can access
        // if ($user_id) {
        //     $user = App\Models\User::where('id', $user_id)->first();
        // }else{
        //     $user = auth('admin')->user();
        // }
        // if ($user->isSuperAdmin()) {
        //     return true;
        // }
        // $isAllow = $user->checkPermission($key);
        // // If denied then redirect to error page
        // if (!$isAllow) {
        //     header('location: /admin/error');
        //     exit;
        // }
    }
}