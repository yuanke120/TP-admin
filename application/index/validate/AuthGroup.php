<?php
/**
 * 角色模型验证
 * Author:YuanKe
 * Date:2020年1月18日 17:47:58
 */
namespace app\index\validate;

use think\Validate;

/**
 * Class AuthGroup
 * @package app\index\validate
 */
class  AuthGroup extends Validate
{

    protected $rule =[
        'title'      =>'require|max:100|unique:auth_group',
        'rules'     =>'require|max:80'
    ];

    protected $message=[
        'title.require'     => '请填写权限组名称',
        'title.max'         =>'权限组名称最多不能超过100字',
        'title.unique'      =>'权限组名称已存在',
        'rules.require'     =>'请选择包含权限',
        'rules.max'         =>'包含权限超限',
    ];

    //验证场景
    protected $scene=[
        'add'   =>['title','rules'],
        'edit'  =>['rules'],
    ];

}