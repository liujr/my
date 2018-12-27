<?php
namespace app\admin\controller;
use think\Controller;
class Menu extends Base
{
    public function lists()
    {
    	$Menu = new \logic\menu\Menu();
    	$menulist = $Menu -> get_menu_list();
    	$menulist['list'] = nodeMerge($menulist['list']);
    	$this->assign(get_defined_vars());
        return $this->fetch();
    }

    public function add($pid = 0){
    	$Menu = new \logic\menu\Menu();
        if($pid==0){
            $menuinfo['menuname'] = '顶级节点';
        }else{
            $menuinfo = $Menu->getInfo($pid)['data'];
        }
        if(request()->isPost()){
	        $param = array(
	            'pid'       => input('pid'),
	            'menuname'  => input('menuname'),
	            'icon'      => input('icon'),
	            'remark'    => input('remark'),
	            'sort'      => input('sort'),
	            'status'    => 1,
	            'menuurl'   =>input('menuurl'),
	        );
	        $result = $Menu->add($param);
	        if($result['code']==0) return json($result);
	        if($result['code']==1)return json($result);
        }
        $this->assign(get_defined_vars());
        return $this->fetch();
    }

    public function del($id){
    	$Menu = new \logic\menu\Menu();
		$menuinfo = $Menu->getInfo($id);
		if($menuinfo['code']==0) return json($menuinfo);
		$num = $Menu->getcount($menuinfo['data']['id']);
		if($num >0) return json(['code'=>0,'msg'=>'存在下级节点不能删除']);
		$res = $Menu->del($id);
		if($res['code']==0) return json($res);
	    if($res['code']==1)return json($res);
    }

    public function aaa(){
    /*$requestData= "{'OrderCode':'','ShipperCode':'YD','LogisticCode':'3908772151355'}";
    
    $datas = array(
        'EBusinessID' => '1294391',
        'RequestType' => '1002',
        'RequestData' => urlencode($requestData) ,
        'DataType' => '2',
    );
    $appkey = '835b39f3-73aa-4422-b3d6-d2d5ebd4a0ce';
    $url = 'http://api.kdniao.com/Ebusiness/EbusinessOrderHandle.aspx';
    $datas['DataSign'] = $this->encrypt($requestData,$appkey);*/
    $url = 'http://api.kdniao.com/Ebusiness/EbusinessOrderHandle.aspx';
    $data = Array(
            /*'EBusinessID'=>'1294391',
            'RequestType'=>'1002',
            'RequestData'=>'%7B%27OrderCode%27%3A%27%27%2C%27ShipperCode%27%3A%27YD%27%2C%27LogisticCode%27%3A%273908772151355%27%7D',
            'DataType'=> '2',
            'DataSign' =>'OGJmYjk4Mzk4ODFjODAzYzllM2E0NTVhYzVkY2FiNjA%3D',*/

            'RequestType'=>'1002',
            'RequestData' =>'%7B%27OrderCode%27%3A%27%27%2C%27ShipperCode%27%3A%27YD%27%2C%27LogisticCode%27%3A%273908772151355%27%7D',
            'DataType' => '2',
            'DataSign' => 'OGJmYjk4Mzk4ODFjODAzYzllM2E0NTVhYzVkY2FiNjA%3D',
            'EBusinessID' =>1294391,

        );
    
    $result=$this->sendPost($url, $data);   
    
    //根据公司业务处理返回的信息......
    
  dump($result);
}

public function encrypt($data, $appkey) {

    return urlencode(base64_encode(md5($data.$appkey)));
}

public function sendPost($url, $datas) {
    $temps = array();   
    foreach ($datas as $key => $value) {
        $temps[] = sprintf('%s=%s', $key, $value);      
    }   
    $post_data = implode('&', $temps);
    $url_info = parse_url($url);
    if(empty($url_info['port']))
    {
        $url_info['port']=80;   
    }
    $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
    $httpheader.= "Host:" . $url_info['host'] . "\r\n";
    $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
    $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
    $httpheader.= "Connection:close\r\n\r\n";
    $httpheader.= $post_data;
    $fd = fsockopen($url_info['host'], $url_info['port']);
    fwrite($fd, $httpheader);
    $gets = "";
    $headerFlag = true;
    while (!feof($fd)) {
        if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
            break;
        }
    }
    while (!feof($fd)) {
        $gets.= fread($fd, 128);
    }
    fclose($fd);  
    
    return $gets;
}

}
