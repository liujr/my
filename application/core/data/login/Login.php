<?php
/**
 * 登录
 */
namespace data\login;
use think\Db;
class Login{

    /**
     * 获取一条菜单
     * @return [type] [description]
     */
    public function getInfo($param){
        if(!empty($param['account']))    $where['account']    = $param['account'];
        if(!empty($param['id']))    $where['id']    = $param['id'];
        $where['status']    = 1;
        $info = Db::name('admin_user')->where($where)->find();
        return $info;
    }

}