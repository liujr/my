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
        $redis = new \Redis();
		$redis->connect('127.0.0.1',6379);
		$redis->subscribe(array('test'), function($redis, $channelName, $message){
			var_dump($channelName,$message);
		});
    }
}