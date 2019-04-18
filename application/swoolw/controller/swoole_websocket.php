<?php
$server = new \Swoole_WebSocket_Server("0.0.0.0", 8080);

$server->on('open', function (\Swoole_WebSocket_Server $server, $request) {
    echo "server: handshake success with fd{$request->fd}\n";
});

$server->on('message', function (\Swoole_WebSocket_Server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "服务端返回的数据 编号为：".$frame->fd);
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();