<?php

namespace App\Models;

class Menu extends BaseModel
{
    protected $table = 'menu';
    protected $guarded      = [];
    public $timestamps = false;

    public function childs(){
        return $this->hasMany(Menu::class, 'parent', 'id');
    }

    public function mparent(){
        return $this->hasOne(Menu::class, 'id', 'parent');
    }

    public function renderRow($item, $prefix = ''){
        $row = [];
        $row[] = '<div class="icheck-primary">
            <input class="check-item" type="checkbox" id="ids-' . $item->id . '" name="ids[]" value="' . $item->id . '">
            <label for="ids-' . $item->id . '"></label>
        </div>';
        $row[] = $prefix . $item->name;
        $row[] = $item->route_uri;
        $row[] = '
            <a class="btn btn-warning btn-sm" href="' . route('admin.menu.edit', ['id' => $item->id]) . '">' . trans('edit') . '</a>
            <button type="button" class="btn btn-danger btn-sm btn-delete-item"  data-id="' . $item->id . '" data-href="' . route('admin.menu.delete') . '">' . trans('delete') . '</button>
        ';
        return $row;
    }

    public function hasChilds(){
        if (count($this->childs) > 0) {
            return true;
        }
        return false;
    }
}
