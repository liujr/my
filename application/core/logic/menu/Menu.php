<?php
namespace logic\menu;
class Menu {
	public function get_menu_list(){
		$param = array(
            'page'  => 1,
            'limit' => 99999,
        );
		$list = D('Menu','menu')->getlist($param);
        return $list;
	}

	public function getInfo($id){
		if(!$id) return ['code'=>0,'msg'=>'缺少参数id'];
		$info = D('Menu','menu')->getinfo(['status'=>1,'id'=>$id]);
		if(empty($info)) return ['code'=>0,'msg'=>'数据不存在'];
		return ['code'=>1,'msg'=>'success','data'=>$info];
        
	}

	public function add($param){
		if(!$param['menuname']) return ['code'=>0,'msg'=>'请输入菜单名称'];
		if($param['pid'] !=0 && !$param['menuurl']) return ['code'=>0,'msg'=>'请输入菜单节点'];
		$info = D('Menu','menu')->add($param);
        if(!$info) return ['code'=>0,'msg'=>'添加失败'];
        return ['code'=>1,'msg'=>'添加成功'];
	}

	public function getcount($id){
		if(!$id) return ['code'=>0,'msg'=>'缺少参数id'];
		$num = D('Menu','menu')->getcount(['status'=>1,'pid'=>$id]);
        return $num;
	}

	public function del($id){
		if(!$id) return ['code'=>0,'msg'=>'缺少参数id'];
		$res = D('Menu','menu')->editstatus($id);
		if($res === false) return ['code'=>0,'msg'=>'修改失败'];
        return ['code'=>1,'msg'=>'修改成功'];
	}
}