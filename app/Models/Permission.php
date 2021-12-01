<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Permission extends BaseModel
{
    use HasFactory;
    protected $table = 'permission';
    protected $guarded      = [];
    public $timestamps = false;

    public static function actionsAdmin(){
        $actions = [
            'admin' => [
                trans('admin'),
                'user' => [
                    trans('user'),
                    'manage' => trans('manage'),
                    'create' => trans('create'),
                    'edit' => trans('edit'),
                    'delete' => trans('delete')
                ],
                'role' => [
                    trans('role'),
                    'manage' => trans('manage'),
                    'create' => trans('create'),
                    'edit' => trans('edit'),
                    'delete' => trans('delete'),
                    'permission' => trans('permission')
                ],
            ]
        ];
        return $actions;
    }

    public static function savePermission($role_id, $permission){
        $permission = ($permission ? $permission : []);
        $item = Permission::where('role_id', $role_id)->first();
        if ($item) {
            $item->description = implode(',', $permission);
            return $item->save();
        }else{
            return Permission::create([
                'role_id' => $role_id,
                'description' => implode(',', $permission)
            ]);
        }
    }
}
