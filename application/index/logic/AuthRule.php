<?php
/**
 * 权限节点逻辑层
 * Author:YuanKe
 * Date:2020年1月12日 13:11:49
 */
namespace app\index\logic;

use app\index\common;
use app\index\common\logic\BaseLogic;
use app\index\common\logic\ILogic;

/**
 * Class AuthRule
 * @package app\index\logic
 */
class AuthRule extends BaseLogic implements ILogic
{
    /**
     * @var \app\index\model\AuthRule
     */
    private $auth_rule_model;

    /**
     * @var \app\index\validate\AuthRule
     */
    protected $validate;

    public function initialize()
    {
        parent::initialize();
        $this->auth_rule_model=model('AuthRule');
        $this->validate=validate('AuthRule','validate');
    }

    /**
     *获取权限节点列表
     */
    public function getList()
    {
        $auth_rules = $this->auth_rule_model->order('create_time','desc')->select();
        return $auth_rules ? : null;
    }

    /**
     * 获取权限节点列表(不包含关闭的条目)
     */
    public function getListWithoutClosed()
    {
        $map['status']= 1;
        $auth_rules = $this->auth_rule_model->where($map)->select();
        return $auth_rules ? : null;
    }


    /**
     * 获取节点模型
     * @param $uuid
     * @return null
     */
    public function getMode($uuid)
    {
        $auth_rule= $this->auth_rule_model->find($uuid);
        return $auth_rule ? : null;
    }

    /**
     * 添加权限节点
     * @param $param
     * @return array
     */
    public function add($param)
    {
        if(!$this->validate->scene('add')->check($param)){
            return common::return_result('500',$this->validate->getError(),null);
        }else{
            $result=$this->auth_rule_model->save($param);
            return $result ?
                common::return_result('200',ADD_SUCCESS_TEXT,url('AuthRule/index')) :
                common::return_result('500',ADD_FAILURE_TEXT,null);
        }
    }

    /**
     *编辑权限节点
     * @param $param
     * @param $uuid
     * @return array
     */
    public function edit($param, $uuid)
    {
        if(!$this->validate->scene('edit')->check($param)){
            return common::return_result('500',$this->validate->getError(),null);
        }else{
            $result = $this->auth_rule_model->save($param,['id'=>$uuid]);
            return $result ?
                common::return_result('200',EDIT_SUCCESS_TEXT,url('AuthRule/index')) :
                common::return_result('500',EDIT_FAILURE_TEXT,null);
        }
    }

    /**
     * 删除权限节点
     * @param $param
     * @return array
     */
    public function del($param)
    {
        $map['id']=$param['item'];
        $result=$this->auth_rule_model->where($map)->delete();
        return $result ?
            common::return_result('200',DELETE_SUCCESS_TEXT,null) :
            common::return_result('500',DELETE_FAILURE_TEXT,null);
    }

    /**
     * 批量删除权限节点
     * @param $param
     * @return array
     */
    public function batchDel($param)
    {
        $map['id']=['IN', rtrim($param['items'], ',')];
        $result = $this->auth_rule_model->where($map)->delete();
        return $result ?
            common::return_result('200',BATCH_DELETE_SUCCESS_TEXT,null) :
            common::return_result('500',BATCH_DELETE_FAILURE_TEXT,null);
    }
}