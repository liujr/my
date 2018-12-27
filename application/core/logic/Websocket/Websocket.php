<?php
namespace logic\Websocket;
class Websocket {
	public function getlist($param){
		$list = D('Websocket','websocket')->getlist($param);
        return $list;
	}

	public function getInfo($id){
		if(!$id) return ['code'=>0,'msg'=>'缺少参数id'];
		$info = D('Menu','menu')->getinfo(['status'=>1,'id'=>$id]);
		if(empty($info)) return ['code'=>0,'msg'=>'数据不存在'];
		return ['code'=>1,'msg'=>'success','data'=>$info];
        
	}
}