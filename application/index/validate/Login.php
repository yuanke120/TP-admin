<?php
/**
 * 登录验证器
 * Author:YuanKe
 * Date:2020年1月12日 13:11:49
 */
namespace app\index\validate;

use think\Validate;

/**
 * Class Login
 * @package app\index\validate
 */
class Login extends Validate
{
    //创建验证规则  require 规则
    protected $rule=[
        'account'   =>  'require|max:15',
        'password'  =>  'require|max:20',
        'verify'    =>  'require|captcha'
    ];

    //message自定义失败的提示验证  验证提示信息
    protected $message=[
        'account.require'      =>   '请填写用户帐号',
        'account.max'          =>   '用户不能超过字符',
        'password.require'     =>   '请填写用户密码',
        'verify'              =>[
                'require'  =>'请填写验证码',
                'captcha' =>'验证码不正确',
            ],
    ];
}