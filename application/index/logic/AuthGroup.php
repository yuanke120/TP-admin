<?php
/**
 * 角色逻辑层
 * Author:YuanKe
 * Date:2020年1月12日 13:11:49
 */
namespace app\index\logic;

use app\index\common;
use app\index\common\logic\BaseLogic;
use app\index\common\logic\ILogic;
use app\index\validate\AuthRule;

/**
 * Class AuthGroup
 * @package app\index\logic
 */
class  AuthGroup extends BaseLogic implements ILogic
{
    /**
     * @var \app\index\model\AuthGroup
     */
    private $auth_group_model;

    /**
     * @var AuthRule
     */
    private $auth_rule_logic;

    /**
     * @var \app\index\validate\AuthGroup
     */
    protected $validate;


    public function initialize()
    {
        parent::initialize();
        $this->auth_group_model = model('AuthGroup');
        $this->validate = validate('AuthGroup', 'validate');
        $this->auth_rule_logic = model('AuthRule', 'logic');
    }

    /**
     * 获取管理员列表
    */
    public function getList()
    {
        $auth_groups = $this->auth_group_model->order('create_time', 'desc')->select();
        return $auth_groups ?: null;
    }

    /**
     * 获取角色列表(不包含关闭条目)
     */
    public  function getListWithoutClosed()
    {
        $map['status'] = 1;
        $auth_groups = $this->auth_group_model->where($map)->select();
        return $auth_groups ?: null;
    }

    /**
     * 获取角色模型
     * @param $uuid
     * @return \app\index\model\AuthGroup
     */
     public function getMode($uuid)
    {
        $map['id']=$uuid;
        $auth_group = $this->auth_group_model->where($map)->find();
        return $auth_group ? :null;
    }

    /**
     * 添加角色
     * @param $param
     * @return array
     */
    public function add($param)
    {
        if (!$this->validate->scene('add')->check($param))
        {
            return common::return_result('500',$this->validate->getError(),null);
        }else{

            $result= $this->auth_group_model->save($param);

            return $result ?
                common::return_result('200',ADD_SUCCESS_TEXT,url('AuthGroup/index')) :
                common::return_result('500',ADD_FAILURE_TEXT,null);
        }
    }

    /**
     * 编辑角色
     * @param $param
     * @param $uuid
     * @return array
     */
    public function edit($param, $uuid)
    {
        if(!$this->validate->scene('edit')->check($param)){
            return  common::return_result('500',$this->validate->getError(),null);
        }else{
            $result = $this->auth_group_model->save($param, ['id' => $uuid]);
            return $result ?
                common::return_result('200',EDIT_SUCCESS_TEXT,url('AuthGroup/index')) :
                common::return_result('500',EDIT_FAILURE_TEXT,null);
        }
    }

    /**
     * 删除角色
     * @param $param
     * @return array
     */
    public function del($param)
    {
        if ($param['item']==='1')
        {
            return common::return_result('500',AUTH_GROUP_CANNOT_DELETE_TEXT,null);
        }

        $map['id']=$param['item'];
        $result=$this->auth_group_model->where($map)->delete();
        return  $result ?
            common::return_result('200',DELETE_SUCCESS_TEXT,null) :
            common::return_result('500',DELETE_FAILURE_TEXT,null);
    }

    /**
     * 批量删除角色
     * @param $param
     * @return array
     */
    public function batchDel($param)
    {
        if(strpos($param['items'],'1,')!==false){
            return common::return_result('500',AUTH_GROUP_CANNOT_DELETE_TEXT,null); //权限组禁止删除
        }

        $map['id']=['IN',rtrim($param['items'],',')];
        $result=$this->auth_group_model->where($map)->delete();

        return $result ?
            common::return_result('200',BATCH_DELETE_SUCCESS_TEXT,null) :
            common::return_result('500',BATCH_DELETE_FAILURE_TEXT,null);
    }
}