<?php
namespace app\admin\controller;
use think\Controller;
class Text extends Controller
{
	

	public function index(){
		$arr = array(
				['电信4G','联通4G'],
				['红色','蓝色','白色'],
				['套餐1','套餐2','套餐3'],
				['8G','16G']
			);
		foreach ($arr as $key => $value) {
			foreach ($value as $kk => $vv) {
				$data[] = $vv;
			}
		}

		

		dump($data);
	}
}