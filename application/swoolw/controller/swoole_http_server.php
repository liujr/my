<?php

$http = new \swoole_http_server("0.0.0.0",8811);

$http->on('request',function($requset,$response){
	$response->end('<h1>qwertyuio</h1>');
});

$http->start();