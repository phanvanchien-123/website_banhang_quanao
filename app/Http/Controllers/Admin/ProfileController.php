<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    //
    use ImageHandler;

    public function index(){

        $user = User::where('id', Auth::user()->id);
        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request){
        try{
            $user = User::findOrFail(Auth::user()->id);
            $data = $request->except('avatar');

            $imagePath = $user->avatar;
            if ($request->hasFile('avatar')) {
                $imagePath = $this->updateImage($request->file('avatar'), $user->avatar, 'theme_admin/upload/user');
            }
            $data['avatar'] = $imagePath ;

            $user->update($data);

            return redirect()->back()->with(['success' => 'Thay đổi thông tin cá nhân thành công']);

        } catch (ModelNotFoundException $ex) {
            Log::error("LỖI => ProfileController@store => Không tìm thấy user: " . $ex->getMessage());
            return redirect()->back()->with(['error' => 'Không tìm thấy user']);
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
