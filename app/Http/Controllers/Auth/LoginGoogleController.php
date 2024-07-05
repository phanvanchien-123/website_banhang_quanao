<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Carts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginGoogleController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
          
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            // dd($user);
            $finduser = User::where('email', $user->email)->first();
            if($finduser){
         
                Auth::login($finduser);
        
                return redirect()->route('home');
         
            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        // 'google_id'=> $user->id,
                        'password' => encrypt('123456dummy'),
                        'type' => 'USR',

                    ]);
                // Carts::create([
                //     'user_id' => $newUser->id,
                // ]);
         
                Auth::login($newUser);
        
                return redirect()->route('home');
            }
        
        } catch (Exception  $e) {
            dd($e->getMessage());
        }
    }

}
