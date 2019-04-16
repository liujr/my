<?php

/**
* 
*/
class Redis
{
	
	public function __construct()
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

$objRedis = new Redis();