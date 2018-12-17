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
