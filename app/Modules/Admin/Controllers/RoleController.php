<?php
namespace App\Modules\Admin\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Modules\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends AdminController
{
    public function manage(Request $request){
        $data = [];
        $data['title'] = trans('role.manage');
        
        return view('Admin::role.manage', $data);
    }

    public function datatable(Request $request){
        $role = new Role();
        $pagination = $role->getPagination($request);
        $items = $pagination->items();
        $rows = [];
        foreach ($items as $item) {
            $row = $item->renderRow($item);
            array_push($rows, $row);
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
        $data['title'] = trans('role.create');
        $data['action'] = 'create';
        $data['item'] = [
            'name' => old('name'),
            'description' => old('description')
        ];
        return view('Admin::role.edit', $data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string|unique:App\Models\Role,name',
            'description' => 'nullable|max:255|string'
        ]);
        if ($validator->fails()) {
            return redirect(route('admin.role.create'))
                        ->withErrors($validator)
                        ->withInput();
        }
        $vdata = $validator->validated();
        $vdata['created_by'] = auth('admin')->id();
        $vdata['status'] = 1;
        try {
            $id = Role::insertGetId($vdata);
            $request->session()->flash('alert-success', trans('success'));
        } catch (\Throwable $th) {
            $request->session()->flash('alert-error', $th->getMessage());
        }
        return redirect(route('admin.role.create'));
    }

    public function edit(Request $request, $id){
        $item = Role::where('id', $id)->first();
        if (!$item) {
            $request->session()->flash('alert-error', trans('not_found', ['obj' => trans('role')]));
            return redirect(route('admin.role'));
        }
        $data = [];
        $data['title'] = trans('role.edit');
        $data['action'] = 'edit';
        $data['item'] = $item->toArray();
        return view('Admin::role.edit', $data);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string|unique:App\Models\Role,name,' . $id,
            'description' => 'nullable|max:255|string',
            'status' => 'numeric',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        $vdata = $validator->validated();
        try {
            $item = Role::where('id', $id)->update($vdata);
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
            $items = Role::whereIn('id', $ids)
                    ->get();
            foreach ($items as $item) {
                // Delete
                $item->deleteSafe();
            }
            return $this->resJsonSuccess(trans('success'));
        } catch (\Throwable $th) {
            return $this->resJsonError(400, $th->getMessage());
        }
    }

    public function permission(Request $request, $id){
        if ($request->method() == 'POST') {
            if (Permission::savePermission($id, $request->post('permission'))) {
                $request->session()->flash('alert-success', trans('success'));
            }else{
                $request->session()->flash('alert-error', trans('error'));
            }
        }

        $data = [];
        $data['title'] = trans('role.permission');
        $data['actions'] = Permission::actionsAdmin();
        $permissionChecked = Permission::where('role_id', $id)->first();
        $data['permissionChecked'] = ($permissionChecked ? array_filter(explode(',', $permissionChecked->description)) : []);
        $data['role_id'] = $id;
        return view('Admin::role.permission', $data);
    }
}
