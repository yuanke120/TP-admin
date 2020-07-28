<?php
/**
 * 登录逻辑层
 * Author:YuanKe
 * Date:2020年1月12日 13:11:49
 */
namespace app\index\logic;

use app\index\common;
use app\index\model\Admin;
use app\index\common\logic\BaseLogic;
use think\Session;

class Login extends BaseLogic
{
    /**
     * @var Admin
     */
    private $admin_model;

    /**
     * @var \app\index\validate\Login
     */
    protected $validate;

    //后台登陆规则
    public function initialize()
    {
        parent::initialize();
        $this->admin_model = model('Admin');
        $this->validate = validate('Login','validate');
    }

    //用户登录
    public  function signIn($param){
        if(!$this->validate->check($param)){
            return common::return_result('500',$this->validate->getError(),null);
        }else{
            //进入登陆验证
            $result = $this->admin_model->loginCheck($param);

            if($result){
                Session::set('admin',$result);
                return common::return_result('200',SIGN_FAILURE_TEXT,url('Index/index'));
            }else{
                return common::return_result('500',SIGN_FAILURE_TEXT,null);
            }
        }
    }

    //用户注销
    public function sign_out(){
        Session::set('admin',null);
        if(!Session::get('admin')){
            return common::return_result('200',SIGINT_SUCCESS_TEXT,url('Index/index'));
        }else{
            return common::return_result('500',SIGINT_FAILURE_TEXT,null);
        }
    }
}