<?php
namespace app\admin\controller;
use think\console\Command;
use think\console\Input;
use think\console\Output;
class Cli extends Command
{

	protected function configure()
    {
        $this->setName('test')->setDescription('redis 发布订阅');
    }

    protected function execute(Input $input, Output $output)
    {
    	ini_set('default_socket_timeout',-1);//连接不超时
        $redis = new \Redis();
		$redis->connect('127.0.0.1',6379);
		//订阅单个
		/*$redis->subscribe(array('test'), function($redis, $channelName, $message){
			var_dump($channelName,$message);
		});*/

		//订阅规则，匹配所有开头的频道
		$redis->psubscribe(['chan:*'], function($redis, $pattern,$channelName, $message){
			var_dump($pattern,$message);
		});
    }
}