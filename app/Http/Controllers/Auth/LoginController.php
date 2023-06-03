<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo;


    public function redirectTo()
    {
        if(auth()->user()->hasRole('admin')){
            $this->redirectTo = '/admin/dashboard';
        }else if(auth()->user()->hasRole('teacher')){
            $this->redirectTo = '/teacher/dashboard';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $fieldData = $request->all();

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        //if (auth()->attempt(array('username' => $fieldData['username'], 'password' => $fieldData['password']), isset($fieldData['remember'])))
        if (auth()->attempt(['email' => $fieldData['email'], 'password' => $fieldData['password']])) {
            $userData = User::where('email', $fieldData['email'])->select('id', 'full_name','status')->first();
            $request->session()->put('userData', $userData);
            if(session()->get('userData.status') == 1){
                if(auth()->user()->hasRole('admin')){
                    return redirect()->intended(route('admin.dashboard.index'));
                }else if(auth()->user()->hasRole('teacher')){
                    return redirect()->intended(route('teacher.dashboard.index'));
                }
            }else{
                Session::flush();
                Auth::logout();
                return redirect()->back()->with('error', 'Your account is blocked!');
            }
        } else {
            return redirect()->back()->with('error', 'You provided wrong information!');
        }
    }

    public function registerTeacher(Request $request )
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($user->exists){
            $request->session()->put('userData', $user);
            auth()->login($user);
            return redirect()->intended(route('teacher.dashboard.index'));
        }else{
            //user not created
            return redirect()->back()->with('error', 'Your provided information wrong!');
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        
        Auth::logout();

        if ($request->is('admin/*')) {
            return redirect()->route('admin.login');
        }else if($request->is('teacher/*')){
            return redirect()->route('teacher.login');
        }

        return redirect('/');
    }
}