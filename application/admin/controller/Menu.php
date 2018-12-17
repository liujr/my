<?php
namespace app\admin\controller;
use think\Controller;
class Menu extends Controller
{
    public function lists()
    {
    	$Menu = new \logic\menu\Menu();
    	$menulist = $Menu -> get_menu_list();
    	$menulist['list'] = nodeMerge($menulist['list']);
    	$this->assign(get_defined_vars());
        return $this->fetch();
    }

    public function add($pid = 0){
    	$Menu = new \logic\menu\Menu();
        if($pid==0){
            $menuinfo['menuname'] = '顶级节点';
        }else{
            $menuinfo = $Menu->getInfo($pid)['data'];
        }
        if(request()->isPost()){
	        $param = array(
	            'pid'       => input('pid'),
	            'menuname'  => input('menuname'),
	            'icon'      => input('icon'),
	            'remark'    => input('remark'),
	            'sort'      => input('sort'),
	            'status'    => 1,
	            'menuurl'   =>input('menuurl'),
	        );
	        $result = $Menu->add($param);
	        if($result['code']==0) return json($result);
	        if($result['code']==1)return json($result);
        }
        $this->assign(get_defined_vars());
        return $this->fetch();
    }

    public function del($id){
    	$Menu = new \logic\menu\Menu();
		$menuinfo = $Menu->getInfo($id);
		if($menuinfo['code']==0) return json($menuinfo);
		$num = $Menu->getcount($menuinfo['data']['id']);
		if($num >0) return json(['code'=>0,'msg'=>'存在下级节点不能删除']);
		$res = $Menu->del($id);
		if($res['code']==0) return json($res);
	    if($res['code']==1)return json($res);
    }
}
