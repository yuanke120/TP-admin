<?php
/**
 * 权限节点控制器
 * Author:YuanKe
 * Date:2020年1月12日 16:02:29
 */
namespace app\index\controller;

use app\index\common\controller\Base;

/**
 * Class AuthRule
 * @package app\index\controller
 */
class AuthRule extends  Base
{

    /**
     * @var \app\index\logic\AuthRule
     */
    private $auth_rule_logic;

    /**
     * 构造函数
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->auth_rule_logic = model('AuthRule','logic');
    }

    /**
     * 列表
     * @return mixed
     */
    public function index()
    {
        $this->data['auth_rules'] = $this->auth_rule_logic->getList();
        return $this->ShowView();
    }

    /**
     * 添加
     * @return mixed|\think\response\Json
     */
    public function add()
    {
        if(request()->isPost()){
            return json($this->auth_rule_logic->add(input('post.')));
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
        if(request()->isPost()){
            return json($this->auth_rule_logic->edit(input('post.'),$uuid));
        }else{
            $this->data['auth_rule'] = $this->auth_rule_logic->getMode($uuid);
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
            if($type === 'batch'){
                return json($this->auth_rule_logic->batchDel(input('post.')));
            }else{
                return json($this->auth_rule_logic->del(input('post.')));
            }
        }
    }

}