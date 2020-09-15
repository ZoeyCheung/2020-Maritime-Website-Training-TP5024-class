<?php
/*
 * @Description: 
 * @version: V 1.0
 * @Author: Zoey Cheung
 * @Date: 2020-09-11 10:04:30
 * @LastEditors: Zoey Cheung
 * @LastEditTime: 2020-09-13 16:24:47
 */

namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Request;

class Index extends Controller
{
    public function index()
    {
    	$recommend_goods=Db::name('goods')->where('is_recommend',1)->limit(4)->select();
        return view('index',['recommend_goods'=>$recommend_goods]);
    }

    public function login()
    {
        return view('login');
    }

    public function login_check()
    {
        $data = Request::instance()->param();
        $result = Db::name('users')->where(['username' => $data['username'], 'password' => $data['password']])->find();
        if ($result) {
            session('user_id', $result['id']);
            session('username', $result['username']);
            session('nickname', $result['nickname']);
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('登录成功', '/tp524end/public/');
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('登录失败');
        }
    }

    public function register()
    {
        return view('register');
    }
    public function create()
    {
        $data = Request::instance()->param();
        $result = Db::name('users')->insert($data);
        $id = Db::name('users')->getLastInsID();
        if ($result) {
            session('user_id', $id );
            session('username', $data['username']);
            session('nickname', $data['nickname']);
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('注册成功', '/tp524end/public/');
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('注册失败');
        }
    }
    public function logout(){
        // 清除session
        session(null);
        return redirect('/tp524end/public/');
    }
}
