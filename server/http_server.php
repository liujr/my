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
    define('IS_CLI',false);
    // 定义应用目录
    define('APP_PATH', __DIR__ . '/../application/');
    // 1. 加载基础文件
    require __DIR__ . '/../thinkphp/base.php';
});
$http->on('request',function($request,$response) use($http){
       //因为这些全局变量会在进程的内存里面不变，所有每次请求到来先清空值。
        if($request->server['request_uri'] == '/favicon.ico') {
            $response->status(404);
            $response->end();
            return ;
        }
        $_SERVER  =  [];
        if(isset($request->server)) {
            foreach($request->server as $k => $v) {
                $_SERVER[strtoupper($k)] = $v;
            }
        }
        if(isset($request->header)) {
            foreach($request->header as $k => $v) {
                $_SERVER[strtoupper($k)] = $v;
            }
        }

        $_GET = [];
        if(isset($request->get)) {
            foreach($request->get as $k => $v) {
                $_GET[$k] = $v;
            }
        }
        $_FILES = [];
        if(isset($request->files)) {
            foreach($request->files as $k => $v) {
                $_FILES[$k] = $v;
            }
        }
        $_POST = [];
        if(isset($request->post)) {
            foreach($request->post as $k => $v) {
                $_POST[$k] = $v;
            }
        }

        ob_start();
        try {
            
            // 执行应用并响应
            think\App::run()->send();
        }catch (\Exception $e) {
            // todo
            echo $e->getMessage();
        }

        $res = ob_get_contents();
        ob_end_clean();
        $response->end($res);
});

$http->start();


 ?>