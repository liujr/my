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
        $msg = '你好';
        $this->client->send( $msg );
    }

    public function index(){
        $this->client = new \swoole_client(SWOOLE_SOCK_TCP);
        $this->connect();
    }

    

}
