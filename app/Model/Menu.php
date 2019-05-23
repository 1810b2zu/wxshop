<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $table="menu";
    public $timestamps=false;
    /*
     * @content 查询分类
     * */
    public static function Menus($pid){
        $res = Menu::where(['pid'=>$pid,'status'=>1])->get();

        return $res;
    }
    /*
     * @content 查询总条数
     * */
    public static function MenuConut($pid)
    {
        $count=Menu::where(['pid'=>$pid])->count();

        return $count;
    }
    /*
     * @content 查询二级分类
     * */
    public static function MenuSecond($pid)
    {
        $second = Menu::where(['m_id'=>$pid])->count();

        return $second;
    }
}
