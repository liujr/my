<?php
namespace app\admin\controller;
use think\Controller;
use think\Console;
class Redis extends Controller
{
	
	public $redis;
	public function __construct(){
        $output = Console::call('test' );

        $this->redis = new \Redis;
		$this->redis->connect('120.79.32.177',6379);
	}

	public function index(){
		echo 11;die;
	}


	//发布redis
	public function redis(){
		$res = $this->redis->publish('chan:redis','学习redis');
		dump($res);
	}
	//发布php
	public function php(){
		$res = $this->redis->publish('chan:php','学习php');
		dump($res);
	}
	//发布javascript
	public function javascript(){
		$res = $this->redis->publish('chan:javascript','学习javascript');
		dump($res);
	}
	//发布redis
	public function swoole(){
		$res = $this->redis->publish('chan:swoole','学习swoole');
		dump($res);
	}




}