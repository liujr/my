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
		$this->redis->set("aaa","111");
		dump($this->redis->get("aaa"));

	}


}