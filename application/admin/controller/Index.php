<?php
/*
 * @Description: 
 * @version: V 1.0
 * @Author: Zoey Cheung
 * @Date: 2020-09-12 13:40:14
 * @LastEditors: Zoey Cheung
 * @LastEditTime: 2020-09-13 15:27:37
 */

namespace app\admin\controller;

use think\View;
use think\Db;
use think\Controller;
use think\Request;

class Index extends Controller
{
    public function index()
    {
        $goods = Db::name('goods')->select();
        return view('goods', ['goods' => $goods]);
    }

    public function create()
    {
        return view('create', ['title' => 'Goods Create']);
    }
    public function save()
    {
        $data = Request::instance()->param();
        $result = Db::name('goods')->insert($data);
        if($result){
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('添加成功', '/tp524end/public/admin');
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('添加失败');
        }
    }
    public function edit($id)
    {
        $goods = Db::name('goods')->where('id',$id)->find();
        return view('edit', ['title' => 'Goods Edit', 'goods' => $goods]);
    }
    public function update()
    {
        $data = Request::instance()->param();
        $result = Db::name('goods')->update($data);
        if($result){
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('修改成功', '/tp524end/public/admin');
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('修改失败');
        }
    }
    public function delete($id)
    {
        $result = Db::name('goods')->delete($id);
        if($result){
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('删除成功', '/tp524end/public/admin');
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('删除失败');
        }
    }
}
