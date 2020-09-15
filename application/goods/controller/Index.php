<?php
/*
 * @Description: 
 * @version: V 1.0
 * @Author: Zoey Cheung
 * @Date: 2020-09-11 10:02:32
 * @LastEditors: Zoey Cheung
 * @LastEditTime: 2020-09-13 15:31:01
 */
namespace app\goods\controller;
use think\Db;
use think\Paginator;

class Index
{
    public function index()
    {
    	$goods = Db::name('goods')->paginate(8);
    	return view('index',['goods'=>$goods]);
    }
    public function detail($id){
    	$goods = Db::name('goods')->where('id',$id)->find();
    	$recommend_goods=Db::name('goods')->where('is_recommend',1)->limit(4)->select();
//  	var_dump($recommend_goods);
    	return view('goods_detail',['goods'=>$goods,'recommend_goods'=>$recommend_goods]);
    }
}
?>