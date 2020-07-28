<?php
/**
 * 角色模型
 * Author:YuanKe
 * Date:2020年1月12日 13:11:49
 */
namespace app\index\model;

use think\Model;

/**
 * Class AuthGroup
 * @package app\index\model
 */
class AuthGroup extends Model
{
    protected $insert=['rules','status'];
    protected $update=['rules','status'];

    /**
     * rules角色添加分隔
     * @param $value
     * @return string
     */
    public function setRulesAttr($value)
    {
        $result=implode(',',$value);
        return rtrim($result,',');
    }

    /**
     * 管理员状态
     * @param $value
     * @return int
     */
    public function setStatusAttr($value)
    {
        return $value  === 'on' ? 1 : 0;
    }

    /**
     * 获取权限文本内容
     * @param $value
     * @param $data
     * @return string
     */
    public  function getRulesNameAttr($value,$data)
    {
        $result=db('auth_rule')
            ->where('id','IN',$data['rules'])
            ->field('title')
            ->select();
        $rules=array(); //创建一个空数组
        foreach($result as $item){
            $rules[]=$item['title'];
        }
        return implode('、',$rules);
    }

}