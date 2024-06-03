<?php

namespace App\Http\Controllers\Admin;


use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ImageHandler;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::paginate(10);
        // dd($users);
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::all()->groupBy('group');
        $roleActive = [];
        return view('admin.user.create',compact('roles','roleActive'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        //
        try {
            $data = $request->except('avatar');
            $data['password'] = Hash::make('123456');

            $imagePath = $this->uploadImage($request->file('avatar'), 'theme_admin/upload/user');
            $data['avatar'] = $imagePath ;    


            $user = User::create($data);
            $user->roles()->sync($data['role_ids'] ?? []);

            return redirect()->route('admin.user.index')->with('success', 'Thêm mới user thành công');

        } catch (Exception $ex) {
            Log::error("ERROR => UserController@store =>". $ex->getMessage());
            return redirect()->back()->with('error', 'Thêm mới user thất bại');
        }

        return redirect()->back();


    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user,$id)
    {
        //
        $user = User::findOrFail($id);
        $roles = Role::all()->groupBy('group');
        $roleActive = DB::table('model_has_roles')->where('model_id', $id)->pluck('role_id')->toArray() ;
        // dd($user);
        return view('admin.user.edit',compact('user','roles','roleActive'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user, $id)
    {
        //
        try{
            $user = User::findOrFail($id);
            $data = $request->except('avatar');
            $imagePath = $user->avatar;

            if ($request->hasFile('avatar')) {
                $imagePath = $this->updateImage($request->file('avatar'), $user->avatar, 'theme_admin/upload/user');
            }
            $data['avatar'] = $imagePath ;
        

            $user->update($data);
            $user->roles()->sync($data['role_ids'] ?? []);

            return redirect()->back()->with(['success' => 'Cập nhật user thành công']);

        } catch (ModelNotFoundException $ex) {
            Log::error("LỖI => UserController@store => Không tìm thấy user: " . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Không tìm thấy user']);
        } catch (Exception $ex) {
            Log::error("ERROR => UserController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Cập nhật user thất bại']);
        }

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user, $id)
    {
        //
        try{
            $user = User::findOrFail($id);
            $this->deleteImage($user->avatar);

            $user->delete();

            return redirect()->back()->with(['success' => 'Xóa user thành công']);

        } catch (ModelNotFoundException $ex) {
            Log::error("LỖI => UserController@store => Không tìm thấy user: " . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Không tìm thấy user']);
        } catch (Exception $ex) {
            Log::error("ERROR => UserController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Xóa user thất bại']);
        }

        return redirect()->back();
    }
}
