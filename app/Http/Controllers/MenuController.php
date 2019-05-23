<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /*
     * @content 菜单添加页面
     */
    public function menu()
    {
        $res=Menu::Menus(0);
        return view('admin/menu',compact('res'));
    }

    /*
     * @content 菜单添加执行
     * */
    public function menuAdd(Request $request)
    {
        $name = $request->name;
        $key = $request->key;
        $type = $request->type;
        $url = $request->url;
        $pid = $request->pid;
        $len=Menu::MenuConut($pid);
        $second = Menu::MenuSecond($pid);
        if($pid == 0 && $len>=3){
            return ("<script>alert('一级分类已上限!');location.href='/admin/menu';</script>");
        }else if($pid == 0 && mb_strlen($name)>=5){
            return ("<script>alert('菜单名称长度有限!');location.href='/admin/menu';</script>");
        }else if($pid == 0 && $second >=5){
            return ("<script>alert('该分类下的二级分类以上限!');location.href='/admin/menu';</script>");
        }
        if($len >= 5){
            return ("<script>alert('二级分类已上限!');location.href='/admin/menu';</script>");
        }else if(mb_strlen($name)>=7){
            return ("<script>alert('二级分类名称长度上限!');location.href='/admin/menu';</script>");
        }
        $data = $request->post();
        unset($data['_token']);
        $res = Menu::insert($data);
        if($res){
            return ("<script>alert('添加成功');location.href='/admin/menulist';</script>");
        }else{
            return ("<script>alert('添加失败!');location.href='/admin/menu';</script>");
        }
    }

    /*
     * @content 菜单列表
     */
    public function menulist()
    {
        $menu = Menu::Menus(0);
        return view('admin/menulist',compact('menu'));
    }

    /*
     * @content 获取二级分类
     * */
    public function getmenu(Request $request,$id)
    {
        $data = Menu::Menus($id);

        return $data;
    }

    /*
     * @content 删除菜单
     * */
    public function forbidden($id)
    {
        $second = Menu::MenuConut($id);
        if(!empty($second)){
            return (['code'=>2,'msg'=>'该分类下有二级分类!']);
        }else{
            $res = Menu::where(['m_id'=>$id])->update(['status'=>2]);
            if($res){
                return (['code'=>1,'msg'=>'删除成功']);
            }else{
                return (['code'=>2,'msg'=>'删除失败!']);
            }
        }
    }
}
