<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
class Base extends Controller
{
	public function __construct(){
		parent::__construct();
		$this->checkLogin();
	}

	public function checkLogin(){
		$usename = Session::get('name');
		if(!$usename) $this->redirect(url('/admin/login/index'));
	}
}