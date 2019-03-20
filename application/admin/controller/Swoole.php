<?php
namespace app\admin\controller;

class Swoole extends Base
{
    private $client;
    public function connect() {
        if( !$this->client->connect("127.0.0.1", 9501 , 1) ) {
            echo "Error: {$fp->errMsg}[{$fp->errCode}]\n";
        }
        $message = $this->client->recv();
        echo "Get Message From Server:{$message}\n";

        fwrite(STDOUT, "请输入消息：");  
        $msg = trim(fgets(STDIN));
        $this->client->send( $msg );
    }

    public function index(){
        $this->client = new swoole_client(SWOOLE_SOCK_TCP);
        $this->connect();
    }

    

}
