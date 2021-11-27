<?php
namespace App\Modules\Admin\Controllers;

use App\Models\Menu;
use App\Modules\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends AdminController
{
    public function manage(Request $request){
        $data = [];
        $data['title'] = trans('menu.manage');
        $data['datatableurl'] = route('admin.menu.datatable');
        
        return view('Admin::menu.manage', $data);
    }

    public function datatable(Request $request){
        $menu = new Menu();
        $pagination = $menu->getPagination($request);
        $items = $pagination->items();
        $rows = [];
        foreach ($items as $item) {
            $row = $item->renderRow($item, '');
            array_push($rows, $row);
            $childs = $item->childs;
            foreach ($childs as $child) {
                $row = $item->renderRow($child, '--- ');
                array_push($rows, $row);
            }
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
        $data['title'] = trans('menu.create');
        $data['action'] = 'create';
        $data['parents'] = Menu::select('id', 'name')->where('parent', 0)->get();
        $data['item'] = [
            'name' => old('name'),
            'route_uri' => old('route_uri'),
            'sort' => old('sort', 0),
            'parent' => old('parent', 0)
        ];
        return view('Admin::menu.edit', $data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string|unique:App\Models\Menu,name',
            'route_uri' => 'required|max:255|string|unique:App\Models\Menu,route_uri',
            'sort' => 'numeric',
            'parent' => 'numeric'
        ]);
        if ($validator->fails()) {
            return redirect(route('admin.menu.create'))
                        ->withErrors($validator)
                        ->withInput();
        }
        $vdata = $validator->validated();
        $vdata['is_menu'] = 1;
        $vdata['created_at'] = date('Y-m-d H:i:s');
        $vdata['updated_at'] = date('Y-m-d H:i:s');
        try {
            $id = Menu::insertGetId($vdata);
            $request->session()->flash('alert-success', trans('success'));
        } catch (\Throwable $th) {
            $request->session()->flash('alert-error', $th->getMessage());
        }
        return redirect(route('admin.menu.create'));
    }

    public function edit(Request $request, $id){
        $item = Menu::where('id', $id)->first();
        if (!$item) {
            $request->session()->flash('alert-error', trans('not_found', ['obj' => trans('menu')]));
            return redirect(route('admin.menu'));
        }
        $data = [];
        $data['title'] = trans('menu.edit');
        $data['action'] = 'edit';
        $data['parents'] = Menu::select('id', 'name')->where('parent', 0)->where('id', '<>', $id)->get();
        $data['item'] = $item->toArray();
        return view('Admin::menu.edit', $data);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string|unique:App\Models\Menu,name,' . $id,
            'route_uri' => 'required|max:255|string|unique:App\Models\Menu,route_uri,' . $id,
            'sort' => 'numeric',
            'parent' => 'numeric'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        $vdata = $validator->validated();
        $vdata['updated_at'] = date('Y-m-d H:i:s');
        try {
            $item = Menu::where('id', $id)->update($vdata);
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
            $menus = Menu::whereIn('id', $ids)
                    ->get();
            foreach ($menus as $menu) {
                // Delete
                $menu->delete();
                // Update child
                $childs = $menu->childs;
                foreach ($childs as $child) {
                    $child->parent = 0;
                    $child->save();
                }
            }
            return $this->resJsonSuccess(trans('success'));
        } catch (\Throwable $th) {
            return $this->resJsonError(400, $th->getMessage());
        }
    }

}
