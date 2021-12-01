<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class Role extends BaseModel
{
    use HasFactory;
    protected $table = 'role';
    protected $guarded      = [];
    public $timestamps = false;

    public function getPagination(Request $request){
        $page = intval($request->post('start'));
        $limit = intval($request->post('length'));
        $order = $request->post('order');
        $builder = Role::select('*')
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
        $row[] = $item->description;
        $row[] = common()->getDisEna($item->status);
        $row[] = '
            <a class="btn btn-info btn-sm" href="' . route('admin.role.permission', ['id' => $item->id]) . '">' . trans('permission') . '</a>
            <a class="btn btn-warning btn-sm" href="' . route('admin.role.edit', ['id' => $item->id]) . '">' . trans('edit') . '</a>
            <button type="button" class="btn btn-danger btn-sm btn-delete-item"  data-id="' . $item->id . '" data-href="' . route('admin.role.delete') . '">' . trans('delete') . '</button>
        ';
        return $row;
    }
}
