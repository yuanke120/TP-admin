<?php
/**
 * 个人设置控制器
 * Author:YuanKe
 * Date:2020年1月12日 16:02:29
 */

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\logic\Profile as profile_logic;

/**
 * Class Profile
 * @package app\index\controller
 */
class Profile extends Base
{
    /**
     * @var \app\index\logic\Profile
     */
    private $profile_logic;

    /**
     * @var \app\index\logic\AuthRule
     */
    private $auth_rule_logic;

    public function _initialize()
    {
        parent::_initialize();
        $this->profile_logic= new profile_logic();
        $this->auth_rule_logic=model('AuthRule','logic');
        $this->data['profile']=$this->profile_logic->getMode();
        $this->data['rules']=$this->auth_rule_logic->getListWithoutClosed();
    }

    public function index(){
        return $this->ShowView();
    }


    //上传头像
    public function uploadAvatar()
    {
        if(request()->isPost()){
            return json($this->profile_logic->upload_avatar(input('post.')));
        }
    }

    /**
     *个人更新资料
     * @return \think\response\Json
     */
    public function save()
    {
        if(request()->isPost()){
            return json($this->profile_logic->save_profile(input('post.')));
        }
    }

    /**
     * 更新密码
     * @return \think\response\Json
     */
    public function updatePassword()
    {
        if(request()->isPost()){
            return json($this->profile_logic->update_password(input('post.')));
        }
    }
}