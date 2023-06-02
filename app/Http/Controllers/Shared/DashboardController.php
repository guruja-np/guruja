<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->role->name == 'admin'){
            return self::adminDashboard();
        }else if(Auth::user()->role->name == 'teacher'){
            return self::teacherDashboard();
        }
        Auth::logout();
        abort('404');
    }

    public static function adminDashboard()
    {
        return view('admin.home');
    }

    public static function teacherDashboard()
    {
        return view('teacher.home');
    }
}
