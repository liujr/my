<?php
$redisClient = new \swoole_redis;
$redisClient->connect('127.0.0.1',6379,function(\swoole_redis,$result){
	echo "connect".PHP_EOL;
	var_dump($result);
});