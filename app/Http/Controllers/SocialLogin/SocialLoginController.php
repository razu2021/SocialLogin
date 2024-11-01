<?php

namespace App\Http\Controllers\SocialLogin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite; // use this one for socialite packagte 
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class SocialLoginController extends Controller
{
    //


    /*
    this function is goole login 
    only for login redirect 
     */
    public function authProviderRedirect($provider){
        if($provider){
            return Socialite::driver($provider)->redirect();
        }

        abort(400);

        
    }



    public function socialAuthentication($provider)
    {

        try {
                if($provider){
                    // Retrieve the Google user information
                    $social_user = Socialite::driver(driver: $provider)->user();
                    //dd($social_user);
                    // Check if the user already exists in the database by Google ID
                    $existUser = User::where('auth_user_id',$social_user->id)->first();
                    if($existUser){
                        Auth::login($existUser);
                        return redirect()->route('dashboard');
                    }else{
                    // stror new user data 
                    $newuserData = User::create(attributes: [
                        'name' => $social_user->name,
                        'email' => $social_user->email,
                        'auth_user_id' => $social_user->id,
                        'auth_provider_name' => $provider,
                        'avatar' => $social_user->avatar,
                        'password' => Hash::make('Password@123'),
                    ]);
                    //  here is our new user data and redirect in user dashboad 
                        if($newuserData){
                            Auth::login($newuserData);
                            return redirect()->route('dashboard');
                        }
                        
                    }
                    abort(404);

                }
                // end if 
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'An error occurred. Please try again.']);
        }

         
    } // function end

    //google login in system end here ----



    









    //controller end here
}
