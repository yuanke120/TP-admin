<?php
/**
 * 权限节点验证器
 * Author:YuanKe
 * Date:2020年1月12日 13:11:49
 */
namespace app\index\validate;

use think\Validate;

/**
 * Class AdminRule
 * @package app\index\validate
 */
class AuthRule extends Validate
{

    protected $rule=[
        'name' =>'require|max:80|unique:auth_rule',
        'title' =>'require|max:20'
    ];

    protected $message=[
        'name.require'    =>'请填写权限节点唯一标识',
        'name.max'        =>'权限节点唯一标识最多不能超过80字',
        'name.unique'     =>'权限节点唯一标识已存在',
        'title.require'   =>'请填写权限节点名称',
        'title.max'       =>'权限节点名称做多不能超过20字'

    ];

    //验证场景
    protected $scene = [
        'add'                   =>  ['name', 'title'],
        'edit'                  =>  ['title'],
    ];

}