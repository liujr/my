<?php
$urlarr = [
	'https://wiki.swoole.com/wiki/page/p-redis.html',
	'https://www.baidu.com',
	'http://www.w3school.com.cn/jsref/met_doc_write.asp',
	'http://admin.mmrui.cn/admin/index/index',
	'http://admin.jilisi.com/passport/login',
	'http://store.btobvip.com/index/index'
];

for($i = 0; $i<6; $i++){
	//创建子进程
	$process = new \swoole_process(function(\swoole_process $pro) use($i,$urlarr){
		$res = curlData($urlarr[$i]);
		echo $res.PHP_EOL;
	},true);
	$pid = $process->start();
	$works[$pid] = $process;
}
foreach ($works as $key => $value) {
	echo $value->read(); 
}

function curlData($url){
	sleep(1);

	return $url.'success'.PHP_EOL;
}
