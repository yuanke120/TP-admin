<?php
/**
 * 管理员控制器
 * Author:YuanKe
 * Date:2020年1月12日 16:02:29
 */
namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\logic\AuthGroup;
use think\Request;

/**
 * Class Admin
 * @package app\index\controller
 */
class Admin extends Base
{
    /**
     * @var \app\index\logic\Admin
     */
    private $admin_logic;

    /**
     * @var AuthGroup;
     */
    private $auth_group_logic;

    /**
     * 构造方法
     */
    protected function _initialize()
    {
        parent::_initialize();
        $this->admin_logic = model('Admin', 'logic');
        $this->auth_group_logic = model('AuthGroup', 'logic');
        $this->data['auth_groups'] = $this->auth_group_logic->getListWithoutClosed();
    }

    /**
     * 列表
     * @return mixed
     */
    public  function index()
    {
        $this->data['admins']=$this->admin_logic->getList();
        return $this->ShowView();
    }

    /**
     * 添加管理员
     * @return mixed|\think\response\Json
     */
    public function add()
    {
        //input获取全部参数
        if(request()->isPost()){
            return json($this->admin_logic->add(input('post.')));
        }else{
            return $this->ShowView();
        }
    }

    /**
     * 编辑
     * @param $uuid
     * @return mixed|\think\response\Json
     */
    public function edit($uuid)
    {
        if (request()->isPost()){
            return json($this->admin_logic->edit(input('post.'), $uuid));
        } else {
            $this->data['admin'] = $this->admin_logic->getMode($uuid);
            return $this->ShowView();
        }
    }

    /**
     * 删除
     * @param  $type
     * @return \think\response\Json
     */
    public  function delete($type='')
    {
        if (request()->isPost()){
            if($type === 'batch'){
                return json($this->admin_logic->batchDel(input('post.')));
            }else{
                return json($this->admin_logic->del(input('post.')));
            }
        }
    }

    /**
     * 更新密码
     * @return \think\response\Json
     */
    public function updatePassword()
    {
        if(request()->isPost()){
            return json($this->admin_logic->updatePassword(input('post.')));
        }
    }

    //管理员状态
//    public function setStatus(Request $request)
//    {
//        $admin_id=$request->param('id');
//        $result=AdminModel::get($admin_id);
//        //获取原始字段数据
//        if($result->getData('status')==1){
//            AdminModel::update(['status'=>0],['id'=>$admin_id]);
//        }
//    }

}