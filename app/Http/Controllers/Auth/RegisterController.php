<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
//        $user = (new UserService())->create($request->toArray());
//
//        $authInfo = config('user.entities.'.$user->entity_type);
//        Auth::shouldUse($authInfo['guard']);
//        Auth::login($user);
//
//        return redirect()->to($authInfo['basePath']);
    }
}
