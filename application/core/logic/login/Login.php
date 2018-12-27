<?php
namespace logic\login;
use think\Session;
class Login {
	public function login($param){
		$res = D('Login','login')->getInfo(['account'=>$param['account']]);
		if(empty($res)) return error('不存在该账号');
		if( md5($param['password']) != $res['password'] ) return error('管理员或密码错误');
		Session::set('name',$res['account']);
		Session::set('userid',$res['id']);
		return success('登录成功');
	}

	public function loginout(){
		Session::set('name',null);
	}
}