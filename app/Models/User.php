<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public $timestamps = false;


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPagination(Request $request){
        $page = intval($request->post('start'));
        $limit = intval($request->post('length'));
        $order = $request->post('order');
        $builder = User::select('*')
            ->offset($page * $limit);
        if ($order) {
            $orderArr = explode(' ', $order);
            $builder->orderBy(trim($orderArr[0]), trim($orderArr[1]));
        }
        $fdata = sanitize([
            'name' => 'string'
        ]);
        if ($fdata['name']) {
            $builder->where('name', 'like', '%' . $fdata['name'] . '%');
        }
        $builder->where('id', '<>', auth('admin')->id());
        $builder->where('is_deleted', 0);
        $pagination = $builder->paginate($limit);
        return $pagination;
    }

    public function renderRow($item){
        $row = [];
        $row[] = '<div class="icheck-primary">
            <input class="check-item" type="checkbox" id="ids-' . $item->id . '" name="ids[]" value="' . $item->id . '">
            <label for="ids-' . $item->id . '"></label>
        </div>';
        $row[] = $item->name;
        $row[] = $item->email;
        $row[] = common()->getDisEna($item->status);
        $row[] = '
            <a class="btn btn-warning btn-sm" href="' . route('admin.user.edit', ['id' => $item->id]) . '">' . trans('edit') . '</a>
            <button type="button" class="btn btn-danger btn-sm btn-delete-item"  data-id="' . $item->id . '" data-href="' . route('admin.user.delete') . '">' . trans('delete') . '</button>
        ';
        return $row;
    }
}
