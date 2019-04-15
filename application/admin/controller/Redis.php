<?php
namespace app\admin\controller;
use think\Controller;
class Redis extends Controller
{
	
	public $redis;
	public function __construct(){
		$this->redis = new \Redis;
		$this->redis->connect('120.79.32.177',6379);
	}

	public function index(){
		echo 11;die;
	}


	//发布
	public function pub(){
		$redis = new \Redis;
		$redis->connect('127.0.0.1',6379);
		$res = $redis->publish('test','hello,world');
		dump($res);
	}

	//订阅
	public function sub(){
		$res = $this->redis->subscribe(array('test'), function($instance, $channelName, $message){
			dump($instance);
			dump($channelName);
			dump($message);
		});
	}




}