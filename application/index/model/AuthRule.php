<?php
/**
 * 权限节点模型
 * Author:YuanKe
 * Date:2020年1月12日 13:11:49
 */
namespace app\index\model;

use think\Model;

/**
 * Class AuthRule
 * @package app\index\model
 */
class AuthRule extends Model
{
    //新增自动完成字段
    protected  $insert=['status'];
    //更新自动完成列表
    protected $update = ['status'];

    //权限状态 修改器
    protected function setStatusAttr($value)
    {
        return $value === 'on' ? 1 : 0;
    }
    //等同于
    // if($value==='on'){ return 1; }else{ return 0; }

}