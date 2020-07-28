<?php
/**
 * 管理员模型验证器
 * Author:YuanKe
 * Date:2020年1月12日 13:11:49
 */
namespace app\index\validate;

use think\Validate;

/**
 * Class Admin
 * @package app\index\validate
 */

class Admin extends Validate
{
    //创建验证规则 unique 唯一验证 必填 字段的值是否在xxx表(不包括前缀)中唯一
    protected $rule=[
        'account'   => 'require|max:16|unique:admin',
        'password'  => 'require',
        'nickname'  =>  'max:10',
        'email'     =>'max:20',
    ];

    //自定义失败的提示验证  验证提示失败信息
    protected $message=[
        'account.require' => '请填写用户帐号',
        'account.max'     => '用户账号不能超过16个',
        'account.unique'  => '用户账号已存在',
        'password.require'=> '请填写用户密码',
        'nickname.max'    => '用户昵称超过10个字,请你重新写',
        'email'           => '邮箱格式错误'
    ];

    // 验证场景  某个验证场景需要验证这些字段
    protected $scene =[
        'add'  =>['account','password','nickname','email'],
        'edit' =>['nickname','emil'],
        'update_password' =>['password']
    ];

}