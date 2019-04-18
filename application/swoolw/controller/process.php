<?php
$process = new \swoole_process(function(\swoole_process $pro){
	echo 111;
},false);

$pid = $process->start();
echo $pid.PHP_EOL;