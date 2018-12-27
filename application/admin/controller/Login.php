<?php
namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
	public function index(){
		if($_POST){

			if(!input("code"))  return error('图片校验码不能为空！');

	        if(!captcha_check(input("code"))) return json(error('图片校验码错误'));
	        $param = array(
	            'account'   => input("account"),
	            'password'  => input("password")
	        );
	        if(!$param['account']) return json(error('账号不能为空！'));
	        if(!$param['password']) return json(error('不能密码为空！'));
	        $LoginObj = new \logic\login\Login();
	        $res = $LoginObj->login($param);
	        if($res['code'] == 0) return $res;
	        $this->success('登录成功', '/admin/index/index');
	    }
	    $this->assign(get_defined_vars());
	    return $this->fetch();
	}

	public function loginout(){
		$LoginObj = new \logic\login\Login();
		$LoginObj->loginout();
		$this->success('退出成功', '/admin/login/index');
	}
}