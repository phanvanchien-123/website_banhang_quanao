<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Ward;
use App\Models\District;
use App\Models\Province;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    //
    use ImageHandler;

    public function index(){

        $user = User::findOrFail(auth()->user()->id);
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();

        // dd($user);

        $viewData = [
            'user' => $user,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
        ];

        return view('admin.profile.index', $viewData);
    }

    public function update(Request $request){
        try{
            $user = Auth::user();
            $data = $request->except('avatar');

            $imagePath = $user->avatar;
            if ($request->hasFile('avatar')) {
                $imagePath = $this->updateImage($request->file('avatar'), $user->avatar, 'theme_admin/upload/user');
            }
            $data['avatar'] = $imagePath ;

            $fieldsToUpdate = [];
            foreach ($data as $key => $value) {
                if ($value !== null) {
                    $fieldsToUpdate[$key] = $value;
                }
            }
        
            $user->update($fieldsToUpdate);
            
            return redirect()->back()->with(['success' => 'Thay đổi thông tin cá nhân thành công']);

        } catch (Exception $ex) {
            Log::error("ERROR => ProfileController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Thay đổi thông tin cá nhân thất bại']);
        }
    }

    public function changePassword(Request $request)
    {
        try{

            $request->validate([
                'oldPassWord' => 'required',
                'newPassWord' => 'required',
                'confirmPassWord' => 'required|same:newPassWord',
            ]);

            $user = auth()->user();

            if (!Hash::check($request->oldPassWord, $user->password)) {
                throw ValidationException::withMessages([
                    'oldPassWord' => 'Mật khẩu cũ không đúng.',
                ]);
            }

            $user->update([
                'password' => Hash::make($request->newPassWord),
            ]);

            return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công!');
            
        }catch (Exception $ex) {
            Log::error("ERROR => ProfileController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'Thay đổi Mật khẩu thất bại']);
        }
    }
}
