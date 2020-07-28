<?php
/**
 * 后台系统
 * Author:YuanKe
 * Date:2020年1月12日 16:02:29
 */
namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\logic\Login;

/**
 * Class Index
 * @package app\index\controller
 */

class Index extends Base
{
    /**
     * @var Login
     */
    private $login_logic;

    public function _initialize()
    {
        parent::_initialize();
        $this->login_logic =model('Login','logic');
    }

    public function index()
    {
        return $this->ShowView();
    }

    /**
     * 退出登录
     * @return \think\response\Json
     */
    public function signOut()
    {
        if(request()->isPost()){
            return json($this->login_logic->sign_out() );
        }
    }

}
