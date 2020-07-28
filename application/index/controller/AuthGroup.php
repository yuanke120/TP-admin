<?php
/**
 * 角色控制器
 * Author:YuanKe
 * Date:2020年1月12日 16:02:29
 */

namespace app\index\controller;

use app\index\common\controller\Base;

/**
 * Class AuthGroup
 * @package app\index\controller
 */
class AuthGroup extends Base
{
    /**
     * @var \app\index\logic\AuthGroup
     */
    private $auth_group_logic;

    /**
     * @var \app\index\logic\AuthRule
     */
    private $auth_rule_logic;

    public function _initialize()
    {
        parent::_initialize();
        $this->auth_group_logic=model('AuthGroup','logic');
        $this->auth_rule_logic=model('AuthRule','logic');
        $this->data['rules']=$this->auth_rule_logic->getListWithoutClosed();
    }

    /**
     * 列表
     * @return mixed
     */
    public function index()
    {
        $this->data['auth_groups'] = $this->auth_group_logic->getList();
        return $this->ShowView();
    }

    /**
     * 添加
     * @return mixed|\think\response\Json
     */
    public function add()
    {
        if(request()->isPost()){
            return json($this->auth_group_logic->add('post.'));
        }else{
            return $this->ShowView();
        }
    }

    /**
     * 编辑
     * @param $uuid
     * @return \think\response\Json|null
     */
    public  function edit($uuid)
    {
        if(request()->isPost()){
            return json($this->auth_group_logic->edit(input('post.'),$uuid));
        }else{
            $this->data['auth_group']= $this->auth_group_logic->getMode($uuid);
            return $this->ShowView();
        }
    }

    /**
     * 删除
     * @param string $type
     * @return \think\response\Json
     */
    public function del($type='')
    {
        if(request()->isPost()){
           if ($type=== 'batch'){
                return json($this->auth_group_logic->batchDel(input('post.')));
           }else{
               return json($this->auth_group_logic->del(input('post.')));
           }
        }
    }
}