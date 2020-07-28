<?php
/**
 * Logic 基类
 * Author:YuanKe
 * Date:2020年1月12日 16:02:29
 */

namespace app\index\common\logic;

use think\Model;

/**
 * Class BaseLogic
 * @package app\index\common\logic
 */

class BaseLogic extends Model
{
    public function initialize()
    {
        parent::initialize();
        //defined()检测常量是否被定义  define() 常量定义
        if(!defined('SIGN_SUCCESS_TEXT')){define('SIGN_SUCCESS_TEXT','登录成功');};
        if(!defined('SIGN_FAILURE_TEXT')){define('SIGN_FAILURE_TEXT','用户或者密码错误');};

       if(!defined('SIGINT_SUCCESS_TEXT')){define('SIGINT_SUCCESS_TEXT','注销成功');};
       if(!defined('SIGINT_FAILURE_TEXT')){define('SIGINT_FAILURE_TEXT','注销失败');};
       //CURD
        if(!defined('ADD_SUCCESS_TEXT')){define('ADD_SUCCESS_TEXT','添加成功');};
        if(!defined('ADD_FAILURE_TEXT')){define('ADD_FAILURE_TEXT','添加失败');};
        if(!defined('EDIT_SUCCESS_TEXT')){define('EDIT_SUCCESS_TEXT','编辑成功');};
        if(!defined('EDIT_FAILURE_TEXT')){define('EDIT_FAILURE_TEXT','编辑失败');};
        if(!defined('DELETE_SUCCESS_TEXT')){define('DELETE_SUCCESS_TEXT','删除成功');};
        if(!defined('DELETE_FAILURE_TEXT')){define('DELETE_FAILURE_TEXT','删除失败');};

        if(!defined('BATCH_DELETE_SUCCESS_TEXT')){define('BATCH_DELETE_SUCCESS_TEXT','批量删除成功');};
        if(!defined('BATCH_DELETE_FAILURE_TEXT')){define('BATCH_DELETE_FAILURE_TEXT','批量删除失败');};

        if(!defined('UPDATE_PASSWORD_SUCCESS_TEXT')){define('UPDATE_PASSWORD_SUCCESS_TEXT','密码更新成功');};
        if(!defined('UPDATE_PASSWORD_FAILURE_TEXT')){define('UPDATE_PASSWORD_FAILURE_TEXT','密码更新失败');};

        if(!defined('ADMIN_CANNOT_DELETE_TEXT')){define('ADMIN_CANNOT_DELETE_TEXT','内置管理员禁止删除');};
        if(!defined('ROLE_CANNOT_DELETE_TEXT')){define('ROLE_CANNOT_DELETE_TEXT','内置角色禁止删除');};
        if(!defined('AUTH_GROUP_CANNOT_DELETE_TEXT')){define('AUTH_GROUP_CANNOT_DELETE_TEXT','内置权限组禁止删除');};

        //upload
        if(!defined('AVATAR_UPDATE_SUCCESS_TEXT')){define('AVATAR_UPDATE_SUCCESS_TEXT','头像上传成功');};
        if(!defined('AVATAR_UPDATE_FAILURE_TEXT')){define('AVATAR_UPDATE_FAILURE_TEXT','头像上传失败');};

        if(!defined('PROFILE_UPDATE_SUCCESS_TEXT')){define('PROFILE_UPDATE_SUCCESS_TEXT','个人资料更新成功');};
        if(!defined('PROFILE_UPDATE_FAILURE_TEXT')){define('PROFILE_UPDATE_FAILURE_TEXT','个人资料更新失败');};

    }
}