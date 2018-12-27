<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
 
/**
 * 调用数据层模型
 */
function D($name,$layer='',$model='data'){
    if( $layer !== '' ) $layer = $layer.'\\';
    $class = '\\'.$model.'\\'.$layer.$name;   
    return new $class;
}

/**
 *	递归重组节点信息为多维数组
 *	@param [type] $node [要处理的节点数组]
 *	@param integer $pid [父级id]
 *  @param integer $pidname [父级id的字段名称]
 *	@param integer $access [权限数组]
 *	@param integer $nid [指定节点的与权限对应的字段]
 *	@return [type]  [description]
 */

function nodeMerge($node,$pidname='pid',$pid=0,$access=null,$nid='id',$childrenName='children'){
	$arr=array();
	foreach($node as $v){
		if($v[$pidname]==$pid){
			if(is_array($access)){
				$v['isIn']=in_array($v[$nid],$access) ? 'checked':'';
			}
			$v[$childrenName] = nodeMerge($node,$pidname,$v[$nid],$access,$nid);
			$arr[]=$v;
		}
	}
	return $arr;
}

function error($msg){
	return ['code'=>0,'msg'=>$msg,'data'=>[]];
}

function success($msg,$data=array()){
	return ['code'=>1,'msg'=>$msg,'data'=>$data];
}

/**
 * 可以发送post请求
 */
function postRequest($url, $data)
{
    // php如何实现post请求？http协议 -- curl函数库
    $ch  =  curl_init (); // 1. 打开一个浏览器
    curl_setopt ( $ch ,  CURLOPT_URL , $url );// 2. 设置url地址
    // 这样请求后，会把内容直接的输出，有的时候我们时候希望把请求内容存放到一个变量里面
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true);
    // post 请求配置
    curl_setopt( $ch, CURLOPT_POST , true);
    curl_setopt( $ch, CURLOPT_POSTFIELDS , $data);
    // 但是需要注意：我们请求微信的接口的时候，微信提供的方式是https类型的接口，这个时候我们需要关闭一下openssl验证
    curl_setopt( $ch,  CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt( $ch,  CURLOPT_SSL_VERIFYPEER, false);
    $content = curl_exec ( $ch ); // 3. 发送请求，抓取URL并把它传递给浏览器
    curl_close ( $ch ); //4. 关闭cURL资源，并且释放系统资源
    return $content;
}
