<?php
//连接swoole tcp 服务
$cli = new \swoole_client(SWOOLE_SOCK_TCP);

if(!$cli->connect('127.0.0.1','9501')){
	echo "连接失败";
	exit;
}

//php cli常量
fwrite(STDOUT, '请输入消息：');
$msg = trim(fgets(STDIN));

//发送消息给tcp server服务器
$cli->send($msg);

//接收来自server的数据
$res = $cli->recv();
echo $res;