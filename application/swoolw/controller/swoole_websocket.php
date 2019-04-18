<?php
$server = new \Swoole_WebSocket_Server("0.0.0.0", 8080);

$server->on('open', function (\Swoole_WebSocket_Server $server, $request) {
    echo "server: handshake success with fd{$request->fd}\n";
    swoole_timer_tick(3000,function($timer_id){
    	echo "每隔3秒输出：".$timer_id;
    });
});

$server->on('message', function (\Swoole_WebSocket_Server $server, $frame) {
	swoole_timer_after(5000, function() use ($server,$frame) {
	   $server->push($frame->fd, "我是五秒后返回的".$frame->fd);
	});
    $server->push($frame->fd, "服务端返回的数据 编号为：".$frame->fd);
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();