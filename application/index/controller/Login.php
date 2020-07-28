<?php
/**
 * 登陆控制器
 * Author:YuanKe
 * Date:2020年1月18日 17:53:44
 */
namespace app\index\controller;

use think\Controller;

/**
 * Class Login
 * @package app\index\controller
 */
class Login extends Controller
{
    /**
     * @var \app\index\logic\Login
     */
    private $login_logic;

    public function _initialize()
    {
        parent::_initialize();
        $this->login_logic =model('Login','logic');
    }

    //进入登录
    public function index()
    {
        //是否为post请求
        if(request()->isPost()){
                //返回json类型
            return json($this->login_logic->signIn(input('post.')));
        }else{
            return $this->fetch(strtolower(request()->controller()) . DS . strtolower(request()->action()));
        }
    }
}