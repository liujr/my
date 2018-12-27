<?php
namespace app\admin\controller;
use GatewayWorker\Gateway;
class Websocket extends Base
{
	public function index($page = 1,$limit=20){
		$param = array(
			'page'=>$page,
			'limit'=>$limit
			);
		$obj = new \logic\Websocket\Websocket();
		$lists = $obj->getlist($param);
		$this->assign(get_defined_vars());
		return $this->fetch();
	}

	public function send(){
		Gateway::$registerAddress = '127.0.0.1:1238';
        $arr = array('type'=>'say','msg'=>'好嗨呦','code'=>1);
        $aa = Gateway::sendToClient('7f0000010b5400000001',json_encode($arr));
       $aa = Gateway::getClientIdByUid(1);
       $arr = array('type'=>'say','msg'=>'好嗨呦222','code'=>1);
       $ae = Gateway::sendToUid('1',json_encode($arr));
        dump($ae);die;
    }
}