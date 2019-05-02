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
    require __DIR__ . '/../thinkphp/base.php';
});
$http->on('request',function($request,$response){
        //将swoole请求头信息转换为php的请求头
        if(isset($request->header)){
            foreach($request->header as $k=>$v){
                $_SERVER[strtoupper($k)] = $v;
            }
        }
        //将swoole请get信息转换为php的get
        if(isset($request->get)){
            foreach($request->get as $k=>$v){
                $_GET[$k] = $v;
            }
        }
        //将swoole请post信息转换为php的post
        if(isset($request->post)){
            foreach($request->post as $k=>$v){
                $_POST[$k] = $v;
            }
        }
        // 2. 执行应用
        think/App::run()->send();
		$response->cookie("singwa","xsssss",time()+1800);
		$response->end("sss" . json_encode($request->get));
});

$http->start();


 ?>