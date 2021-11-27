<?php

namespace App\Modules\Admin\Controllers;

use App\Models\User;
use App\Modules\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends AdminController
{

    public function manage(Request $request){
        $data = [];
        $data['title'] = trans('user.manage');
        $data['datatableurl'] = route('admin.user.datatable');
        
        return view('Admin::user.manage', $data);
    }

    public function datatable(Request $request){
        $menu = new User();
        $pagination = $menu->getPagination($request);
        $items = $pagination->items();
        $rows = [];
        foreach ($items as $item) {
            array_push($rows, $item->renderRow($item));
        }
        $data = [
            'draw' => intval($request->post('draw')),
            'recordsTotal' => $pagination->total(),
            'recordsFiltered' => $pagination->total(),
            'data' => $rows
        ];
        return response()->json($data);
    }

    public function create(Request $request){
        $data = [];
        $data['title'] = trans('user.create');
        $data['action'] = 'create';
        $data['item'] = [
            'name' => old('name'),
            'email' => old('email')
        ];
        return view('Admin::user.edit', $data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255|string',
            'email' => 'required|max:255|email|unique:App\Models\User,email',
            'password' => 'required|confirmed|min:3'
        ]);
        if ($validator->fails()) {
            return redirect(route('admin.user.create'))
                        ->withErrors($validator)
                        ->withInput();
        }
        $vdata = $validator->validated();
        $vdata['password'] = Hash::make($vdata['password']);
        $vdata['created_at'] = date('Y-m-d H:i:s');
        $vdata['updated_at'] = date('Y-m-d H:i:s');
        $vdata['status'] = 1;
        $vdata['is_deleted'] = 0;
        try {
            $id = User::insertGetId($vdata);
            $request->session()->flash('alert-success', trans('success'));
        } catch (\Throwable $th) {
            $request->session()->flash('alert-error', $th->getMessage());
        }
        return redirect(route('admin.user.create'));
    }

    public function edit(Request $request, $id){
        $item = User::where('id', $id)
            ->where('id', '<>', auth('admin')->id())
            ->where('is_deleted', 0)
            ->first();
        if (!$item) {
            $request->session()->flash('alert-error', trans('not_found', ['obj' => trans('user')]));
            return redirect(route('admin.user'));
        }
        $data = [];
        $data['title'] = trans('user.edit');
        $data['action'] = 'edit';
        $data['item'] = $item->toArray();
        return view('Admin::user.edit', $data);
    }

    public function update(Request $request, $id){
        $rules = [
            'name' => 'required|min:3|max:255|string',
            'status' => 'in:0,1'
        ];
        $hasPass = $request->post('password');
        if ($hasPass) {
            $rules['password'] = 'required|confirmed|min:3';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        $vdata = $validator->validated();
        $params = [
            'name' => $vdata['name'],
            'status' => $vdata['status'],
            'updated_at' => date('Y-m-d H:i:s')
        ];
        if ($hasPass) {
            $params['password'] = Hash::make($vdata['password']);
        }
        try {
            $item = User::where('id', $id)
                ->where('id', '<>', auth('admin')->id())
                ->where('is_deleted', 0)
                ->update($params);
            $request->session()->flash('alert-success', trans('success'));
        } catch (\Throwable $th) {
            $request->session()->flash('alert-error', $th->getMessage());
        }
        return back();
    }

    public function delete(Request $request){
        try {
            $ids = array_filter(explode(',', $request->post('id')));
            $ids = (count($ids) == 0 ? [-1] : $ids);
            $items = User::whereIn('id', $ids)
                    ->where('id', '<>', auth('admin')->id())
                    ->where('is_deleted', 0)
                    ->get();
            foreach ($items as $item) {
                // Delete
                $item->is_deleted = 1;
                $item->save();
            }
            return $this->resJsonSuccess(trans('success'));
        } catch (\Throwable $th) {
            return $this->resJsonError(400, $th->getMessage());
        }
    }

}
