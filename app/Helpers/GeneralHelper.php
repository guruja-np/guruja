<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

if (!\function_exists('getMenu')) {
    function getMenu()
    {
        if (true) {
            $menuList = File::get(storage_path('app/menu.json'));
            //$roles = json_decode(Auth::user()->roles()->pluck('name'));
            //$role = reset($roles);
            $menus = json_decode($menuList);
            if (property_exists($menus, 'admin')) {
                $menu = $menus->admin->menu;
            } else if (property_exists($menus, 'teacher')) {
                $menu = $menus->teacher->menu;
            } else {
                throw new Exception('Role Menu not Assigned');
            }
            return json_encode($menu);
        }
        return abort(403, 'User is not logged');
    }
}

if(!\function_exists('strInitials')){
    function strInitials($word){
        preg_match_all('/(?<=\b)\w/iu',$word,$matches);
        return mb_strtoupper(implode('',$matches[0]));
    }
}

/*
function getTotalCartItem()
{
    return Cart::where('user_id',session()->get('userData.id'))->count();    
}
*/

function getUserImage()
{
    return User::select('id','name')->where('id',session()->get('userData.id'))->get()->first();    
}