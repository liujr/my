<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function center(){
    	return $this->fetch();
    }

    public function ajaxmenulist(){
    	$Menu = new \logic\menu\Menu();
    	$list = $Menu -> get_menu_list();
    	$menulist = nodeMerge($list['list']);
    	return json( array( 'code'=> 1,'msg'=>'请求1111成功','data'=>$menulist));
    }
}
