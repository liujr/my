<?php 

$http = new \swoole_http_server("0.0.0.0",8811);

$http->set(
	[
		'enable_static_handler'  =>true,
		'document_root' =>"/data/wwwroot/my/public"
	]

);

$http->on('request',function($request,$response){
		$response->cookie("singwa","xsssss",time()+1800);
		$response->end("sss" . json_encode($request->get));
});

$http->start();


 ?>