<?php
/**
 * 菜单增删改查
 */
namespace data\menu;
use think\Db;
class Menu{

    /**
     * 获取一条菜单
     * @return [type] [description]
     */
    public function getinfo($param){
    	if(!empty($param['pid']))       $where['pid']       = $param['pid'];
        if(!empty($param['id']))    $where['id']    = $param['id'];
        if(!empty($param['status']))    $where['status']    = $param['status'];
        $info = Db::name('menu')->where($where)->find();
        return $info;
    }

    /**
    *获取菜单列表
    *@return array('list'=>'数据列表','total'=>'数据总数','page'=>'页码','limit'=>'每页数量')
    */
    public function getlist($param=array()){
        $page   = !empty($param['page'])?$param['page']:1;
        $limit  = !empty($param['limit'])?$param['limit']:20;

        $where = array();
        if(!empty($param['pid']))       $where['pid']       = $param['pid'];
        $where['status']    = 1;

        $list = Db::name('menu')->where($where)->order('sort asc,id asc')->page($page)->limit($limit)->select();
        $total = Db::name('menu')->where($where)->count();
        return array(
            'list'      => $list,
            'total'     => $total,
            'page'      => $page,
            'limit'     => $limit
        );
    }

    public function add($param){
    	$data = array(
            'pid'        => $param['pid'],
            'status'          => $param['status'],
            'menuurl'      => $param['menuurl'],
            'menuname'        => $param['menuname'],
            'icon'       => $param['icon'],
            'remark'     => $param['remark'],
            'sort'     => $param['sort'],
        );
        $result = Db::name('menu')->insert($data);
        return $result;
    }

    public function getcount($param){
    	if(!empty($param['pid']))       $where['pid']       = $param['pid'];
        if(!empty($param['status']))    $where['status']    = $param['status'];
        $num = Db::name('menu')->where($where)->count();
        return $num;
    }

    public function editstatus($id){
    	if(!empty($id))       $where['id']       = $id;
    	$res = Db::name('menu')->where($where)->update(['status'=>2]);
        return $res;
    }
}