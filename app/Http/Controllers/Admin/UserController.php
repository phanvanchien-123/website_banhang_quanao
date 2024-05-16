<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use App\Http\Requests\UserRequest;
use Illuminate\Support\Carbon;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
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
            $data = $request->all();
            $data['password'] = Hash::make('123456');

            // Nếu tồn tại file avatar trong request
            // if ($request->hasFile('avatar')) {
            //     // Sử dụng Helper function để tải ảnh lên Cloudinary
            //     $imageUrl = CloudinaryHelper::uploadImage($request->file('avatar'));
            //     // $imageUrl = ProcessImage::dispatch()->upload($request->file('avatar'));
            //     dd($imageUrl);
            //     // Thêm đường dẫn của ảnh vào dữ liệu trước khi lưu
            //     $data['avatar'] = $imageUrl;
            // }

            $user = User::create($data);
            $user->roles()->sync($data['role_ids'] ?? []);


        } catch (Exception $ex) {
            Log::error("ERROR => UserController@store =>". $ex->getMessage());
            return redirect()->route('admin.user.create');
        }
        return redirect()->route('admin.user.index');


    }

    // protected function insertOrUpdateUserHasType($user, $type){
    //     $check = DB::table('user_has_type')
    //         ->where('user_id', $user->id)
    //         ->first();

    //     if ($check) {
    //         DB::table('user_has_type')
    //             ->where('user_id', $user->id)
    //             ->update([
    //                 'user_type_id' => $type,
    //                 'updated_at' => now(),
    //             ]);
    //     } else {
    //         DB::table('user_has_type')->insert([
    //             'user_type_id' => $type,
    //             'created_at' => now(),
    //             'user_id' => $user->id
    //         ]);
    //     }

    //     // $user->userHasType()->updateOrCreate(
    //     //     ['user_id' => $user->id],
    //     //     ['user_type_id' => $type, 'updated_at' => Carbon::now()]
    //     // );
    // }

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
        $user = User::findOrFail($id);

        $data = $request->all();
        // dd($data);
        $update = User::findOrFail($id);

        $update->update($data);
        $user->roles()->sync($data['role_ids'] ?? []);

        return redirect()->route('admin.user.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user, $id)
    {
        //
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.user.index');
    }
}
