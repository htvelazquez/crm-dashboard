<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback () {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login', ['message' => 'Exception']);
        }

        $existingUser = User::where('email', $user->email)->first();

        if($existingUser){
            $sqlRole = "SELECT name, uri
            FROM permissions
            INNER JOIN roles
            ON (permissions.role_id = roles.id)
            WHERE user_id = $existingUser->id
            ORDER BY role_id
            LIMIT 1";

            $role = DB::select($sqlRole);

            if (count($role) > 0) {
                auth()->login($existingUser, true);
                return redirect()->to($role[0]->uri);
            }
        } else {
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->avatar          = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
        }

        return redirect()->route('login', ['message' => "This email doesn't have permission to access."]);
    }

    public function login(Request $request) {
        $message = $request->message;
        return view('login', ['message' => $message]);
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

    public function forbidden() {
        if (Auth::check()) {
            $userId = Auth::user()->id;
        }

        return view('forbidden');
    }
}
