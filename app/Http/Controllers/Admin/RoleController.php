<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //
    public function index()
    {
        $roles = Role::paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy('group');
        // dd($permissions);
        return view('admin.role.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        try{
            $request->validate([
                'name' => 'required',
                'permission_ids' => 'required|array'
            ]);

            $dataCreate = $request->all();
            $dataCreate['guard_name'] = 'web';
            $role = Role::create($dataCreate);
            $role->permissions()->sync($dataCreate['permission_ids'] ?? []);

            return redirect()->route('admin.role.index')->with('success', 'Thêm mới role thành công');

        }catch (Exception $ex) {
            Log::error("ERROR => RoleController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Thêm mới role thất bại']);
        }

        return redirect()->back();

    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all()->groupBy('group');

        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update(RoleRequest $request, $id)
    {
        try{
            $request->validate([
                'name' => 'required',
                // 'permission_ids' => 'required|array'
            ]);


            $role = Role::findOrFail($id);
            $dataUpdate = $request->all();
            $dataUpdate['guard_name'] = 'web';
            $role->update($dataUpdate);
            $role->permissions()->sync($dataUpdate['permission_ids'] ?? []);

            return redirect()->back()->with('success', 'Cập nhật role thành công');
            
        } catch (ModelNotFoundException $ex) {
            Log::error("LỖI => RoleController@store => Không tìm thấy role: " . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Không tìm thấy role']);
        } catch (Exception $ex) {
            Log::error("ERROR => RoleController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Cập nhật role thất bại']);
        }

        return redirect()->back();

    }
        

    public function delete($id)
    {
        try{

            $role = Role::findOrFail($id);
            $role->delete();

            return redirect()->back()->with('success', 'Xóa role thành công');

        } catch (ModelNotFoundException $ex) {
            Log::error("LỖI => RoleController@store => Không tìm thấy role: " . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Không tìm thấy role']);
        } catch (Exception $ex) {
            Log::error("ERROR => RoleController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Xóa role thất bại']);
        }

        return redirect()->back();

    }
}

