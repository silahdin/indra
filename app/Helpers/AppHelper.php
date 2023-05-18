<?php
use DB;

function getSetting()
{
    $setting = DB::table('setting')
    ->where('id', 1)
    ->first();

    return $setting;
}

/*namespace App\Helpers;
use DB;

class AppHelper
{
    public function setting(){
        $setting = DB::table('setting')
        ->where('id', 1)
        ->first();

        return $setting;
    }

     public static function instance()
     {
         return new AppHelper();
     }
}*/