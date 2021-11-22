<?php

namespace App\Modules\Admin\Controllers;

use App\Models\User;
use App\Modules\Admin\AdminController;
use App\Helpers\Sanitize;
use App\Helpers\SearchForm;
use Illuminate\Http\Request;

class UserController extends AdminController
{

    /**
     * Manage
     *
     * @return void
     */
    public function manage(){
        $data = [];
        $data['title'] = trans('user.manage');
        $data['datatableurl'] = route('admin.user.datatable');
        
        return view('Admin::manage', $data);
    }

    /**
     * datatable
     *
     * @param Request $request
     * @return void
     */
    public function datatable(Request $request){
        if (!$request->isXmlHttpRequest()) {
            die('Error');
        }

        $action = '
            <a class="btn btn-success btn-sm" href="' . route('admin.user.create') . '">' . trans('create') . '</a>
            <button type="button" class="btn btn-danger btn-sm btn-delete">' . trans('bulk_delete') . '</button>
        ';
        $data['thead'] = [
            '<div class="icheck-primary">
                <input class="check-all" type="checkbox" id="ids-all" name="ids[]" value="">
                <label for="ids-all"></label>
            </div>',
            '#',
            trans('name'),
            trans('email'),
            $action
        ];

        $sanitize = new Sanitize();
        $vdata = $sanitize->requestRun([
            'name' => 'string|trim',
            'email' => 'string|trim'
        ]);
        $builder = User::select('id', 'name', 'email');
        if ($vdata['name']) {
            $builder->where('name', 'like', '%' . $vdata['name'] . '%');
        }
        if ($vdata['email']) {
            $builder->where('email', 'like', '%' . $vdata['email'] . '%');
        }
        $pagination = $builder->paginate(PAGINATION_LIMIT);
        $items = $pagination->items();
        $itemsArr = [];
        foreach ($items as $item) {
            $row = [];
            $row[] = '<div class="icheck-primary">
                <input class="check-item" type="checkbox" id="ids-' . $item->id . '" name="ids[]" value="' . $item->id . '">
                <label for="ids-' . $item->id . '"></label>
            </div>';
            $row[] = $item->id;
            $row[] = $item->name;
            $row[] = $item->email;
            $row[] = '
                <a class="btn btn-warning" href="' . route('admin.user.edit', ['id' => $item->id]) . '">' . trans('edit') . '</a>
                <button type="button" class="btn btn-danger btn-delete-item">' . trans('delete') . '</button>
            ';
            array_push($itemsArr, $row);
        }
        $data['tbody'] = $itemsArr;
        $data['pagination'] = $pagination;
        $searchConfig = [
            'name' => [
                'type' => 'text',
                'placeholder' => trans('name'),
                'value' => $vdata['name']
            ],
            'email' => [
                'type' => 'text',
                'placeholder' => trans('email'),
                'value' => $vdata['email']
            ]
        ];
        $searchForm = new SearchForm();
        $data['searchform'] = $searchForm->form($searchConfig);
        
        return view('Admin::table', $data);
    }

    public function create(Request $request){
        $data = [];
        $data['title'] = trans('user.create');
        $data['item'] = [];
        
        return view('Admin::user.edit', $data);
    }

    public function store(Request $request){

    }

    public function edit(Request $request){

    }

    public function update(Request $request){

    }

    public function delete(Request $request){

    }

}
