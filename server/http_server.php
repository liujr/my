<?php 

$http = new \swoole_http_server("0.0.0.0",8811);

$http->set(
	[
		'enable_static_handler'  =>true,
		'document_root' =>"/data/wwwroot/my/public",
        'worker_num' => 5,
	]
);
$http->on('WorkerStart',function(swoole_server $server,$worker_id){
    // 定义应用目录
    define('APP_PATH', __DIR__ . '/../application/');
    // 1. 加载基础文件
    require __DIR__ . '/base.php';
});
$http->on('request',function($request,$response){
		$response->cookie("singwa","xsssss",time()+1800);
		$response->end("sss" . json_encode($request->get));
});

$http->start();


 ?>