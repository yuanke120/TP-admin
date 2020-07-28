<?php
/**
 * 控制器基类
 * Author:YuanKe
 * Date:2020年1月12日 13:11:49
 */

namespace app\index\common\controller;

use app\index\common;
use app\index\common\Auth;
use think\Config;
use think\Controller;
use think\exception\HttpResponseException;
use think\Response;
use think\Session;

/**
 * Class Base
 * @package app\index\common\controller
 */
class Base extends Controller
{
    protected $data;

    protected function _initialize()
    {
        parent::_initialize();
        $this->data['resource_path'] = Config::get('RESOURCE_PATH');
        $this->CheckLogin();
        $this->CheckPermission();
    }

    /**
     * 渲染视图方法
     */
    public function ShowView()
    {
        $controller = strtolower(request()->controller());
        $action = strtolower(request()->action());
        $template_file = $controller . DS . $action;
        $this->assign('data', $this->data);
        return $this->fetch($template_file);
    }

    /**
     * 登陆验证
     */
    public function  CheckLogin()
    {
        if(!Session::get('admin') || Session::get('admin') === null){
            $this->redirect('Login/index');
        }else{
            Session::set('admin',Session::get('admin'));
        }
    }

    /**
     * 验证权限
     */
    public function CheckPermission()
    {
        $controller = request()->controller();
        $action = request()->action();
        $pass_controller = ['Index', 'Profile'];
        $pass_action = ['index', 'home', 'signOut'];
        $auth=new Auth();
        if(!in_array($controller, $pass_controller) && !in_array($action, $pass_action)){
            if(!$auth->check($controller . '-' . $action, Session::get('admin.id'))){
                if (request()->isPost()){
                    $result=common::return_result('500','你没有此操作的权限',null);
                    //header() 获取请求的HTTP请求头的信息
                    $response = Response::create($result,'json')->header(request()->header());
                    //throw new 手动抛出一个异常  HttpResponseException异常，从而影响正常的异常捕获这些
                    throw new HttpResponseException($response);
                }else{
                    $this->error('抱歉，你没权限访问功能');
                }
            }
        }
    }

}