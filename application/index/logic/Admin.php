<?php
/**
 * 管理员逻辑层
 * User: Zachary Liang
 * Date: 16-11-24
 * Time: 下午3:32
 */

namespace app\index\logic;

use app\index\common;
use app\index\common\logic\BaseLogic;
use app\index\common\logic\ILogic;

/**
 * Class Admin
 * @package app\manage\logic
 */
class Admin extends BaseLogic implements ILogic
{
    /**
     * @var \app\index\model\Admin
     */
    private $admin_model;

    /**
     * @var \app\index\validate\Admin
     */
    protected $validate;

    /**
     * 构造函数
     */
    public function initialize()
    {
        parent::initialize();
        $this->admin_model = model('Admin');
        $this->validate = validate('Admin', 'validate');
    }

    /**
     * 获取管理员列表
     * @return array
     */
    public function getList()
    {
        $admins = $this->admin_model->getList();
        return $admins ?: null;
    }

    /**
     * 获取管理员模型
     * @param $uuid
     * @return \app\index\model\Admin
     */
    public function getMode($uuid)
    {
        $admin = $this->admin_model->getMode($uuid);
        return $admin ?: null;
    }

    /**
     * 添加管理员
     * @param $param
     * @return array
     */
    public function add($param)
    {
        if (!$this->validate->scene('add')->check($param)){
            return common::return_result('500', $this->validate->getError(), null);
        } else {
            $result = $this->admin_model->add($param);
            return $result ?
                common::return_result('200', ADD_SUCCESS_TEXT, url('Admin/index')) :
                common::return_result('500', ADD_FAILURE_TEXT, null);

        }
    }

    /**
     * 编辑管理员
     * @param $param
     * @param $uuid
     * @return array
     */
    public function edit($param, $uuid)
    {
        if (!$this->validate->scene('edit')->check($param)){
            return common::return_result('500', $this->validate->getError(), null);
        } else {
            $result = $this->admin_model->edit($param);
            return $result ?
                common::return_result('200', EDIT_SUCCESS_TEXT, url('Admin/index')) :
                common::return_result('500', EDIT_FAILURE_TEXT, null);
        }
    }

    /**
     * 删除管理员
     * @param $param
     * @return array
     */
    public function del($param)
    {
        if ($param['item'] === '1'){
            return common::return_result('500', ADMIN_CANNOT_DELETE_TEXT, null);
        }
        $result = $this->admin_model->del($param);
        return $result ?
            common::return_result('200', DELETE_SUCCESS_TEXT, null) :
            common::return_result('500', DELETE_FAILURE_TEXT, null);
    }

    /**
     * 批量删除管理员
     * @param $param
     * @return array
     */
    public function batchDel($param)
    {
        if (strpos($param['items'], '1,') !== false){
            return common::return_result('500', ADMIN_CANNOT_DELETE_TEXT, null);
        }
        $result = $this->admin_model->batchDel($param);
        return $result ?
            common::return_result('200', BATCH_DELETE_SUCCESS_TEXT, null) :
            common::return_result('500', BATCH_DELETE_FAILURE_TEXT, null);
    }

    /**
     * 更新密码
     * @param $param
     * @return array
     */
    public function updatePassword($param){
        if (!$this->validate->scene('update_password')->check($param)){
            return common::return_result('500', $this->validate->getError(), null);
        }

        $result = $this->admin_model->updatePassword($param);
        return $result ?
            common::return_result('200', UPDATE_PASSWORD_SUCCESS_TEXT, null) :
            common::return_result('500', UPDATE_PASSWORD_FAILURE_TEXT, null);
    }
}