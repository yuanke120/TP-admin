<?php
/**
 * 管理员模型
 * Author:YuanKe
 * Date:2020年1月12日 13:11:49
 */
namespace app\index\model;

use app\common\common;
use think\Db;
use think\Model;

/**
 * Class Admin
 * @package app\index\model
 */
class Admin extends Model
{
    /**
     * 登陆验证查询
     * @param $param
     * @return mixed
     */
    public function loginCheck($param)
    {
        //select * ,title from bl_admin a inner join bl_auth_group_access b on a.id=b.uid inner join bl_auth_group c on b.group_id=c.id inner join bl_admin_profile d on a.id=d.uid
        $result = db('admin')
            ->alias('admin')
            ->where('account', $param['account'])
            ->where('password', common::encrypt_password($param['password']))
            ->where('state', 1)  //status
            ->join('__AUTH_GROUP_ACCESS__ access', 'access.uid=admin.id')
            ->join('__AUTH_GROUP__ group', 'group.id=access.group_id')
            ->join('__ADMIN_PROFILE__ profile', 'profile.uid=admin.id')
            ->field('admin.*, group.title as rolename, profile.*')
            ->find();
        return $result;
    }

    /**
     * 获取角色Id
     * @param $value
     * @param $date
     * @return mixed
     */
    //select group_id from bl_auth_group_access where uid=1
    public function getRoleAttr($value,$data)
    {
        $result = db('auth_group_access')
            ->where('uid', $data['id'])
            ->field('group_id')
            ->find();
        return $result['group_id'];
    }

    /**
     * 获取角色的名称
     * @param $value
     * @param $data
     * @return mixed
     */
    //select title as admin from bl_auth_group_access access inner join bl_auth_group b where b.id=access.group_id;
    public function getRoleNameAttr($value, $data)
    {
        $result = db('auth_group_access')
            ->alias('access')
            ->where('uid', $data['id'])
            ->join('__AUTH_GROUP__ group', 'access.group_id = group.id')
            ->join('group.title')
            ->find();
        return $result['title'];
    }

    /**
     * 获取管理员列表
     * @return mixed
     */
    public function getList()
    {
        $result=db('admin')
            ->alias('admin')
            ->join('__AUTH_GROUP_ACCESS__ access','access.uid=admin.id')
            ->join('__AUTH_GROUP__ group','group.id=access.group_id')
            ->join('__ADMIN_PROFILE__ profile','profile.uid=admin.id')
            ->order('admin.id','desc')
            ->field('admin.*,group.title as role_name, profile.*')
            ->select();
        return $result;
    }


    /**
     * 获取管理员模型
     * @param $uuid
     * @return mixed
     */
    public function getMode($uuid)
    {
        $result = db('admin')
            ->alias('admin')
            ->where('uuid', $uuid)
            ->join('__AUTH_GROUP_ACCESS__ access', 'access.uid = admin.id')
            ->join('__ADMIN_PROFILE__ profile', 'profile.uid = admin.id')
            ->field('admin.*, access.group_id as role, profile.*')
            ->find();
        return $result;
    }

    /**
     *添加操作 使用事务添加多个表
     * @param $param
     * @return bool
     */
    public function add($param)
    {
        $nickname=$param['nickname'];
        $email=$param['email'];
        $role_id=$param['role'];
        //指定key才能删除字段value
        unset($param['nickname']);
        unset($param['email']);
        unset($param['role']);
        //产生获取唯一的id
        $param['uuid'] =common::get_uniqueness_id();
        $param['password']=md5(md5($param['password']));
        $param['state']=isset($param) ? 1 : 0;
        $param['create_time']=date($this->dateFormat,time());
        $param['update_time']=date($this->dateFormat,time());
        //启动事务
        Db::startTrans();
        try{
            $id =db('admin')
                //insertGetId 添加数据成功返回添加数据的自增主键
                ->insertGetId($param);
                db('auth_group_access')
                    ->insert([
                        'uid'           =>$id,
                        'group_id'      =>$role_id,
                        'create_time'   =>date($this->dateFormat,time()),
                        'update_time'   =>date($this->dateFormat,time()),
                    ]);
                db('admin_profile')
                ->insert([
                        'uid'           => $id,
                        'nickname'      =>$nickname,
                        'email'         =>$email,
                        'create_time'   =>date($this->dateFormat,time()),
                        'update_time'   =>date($this->dateFormat,time()),
                ]);
                //commit 提交事务
                Db::commit();
                return true;
        }catch(\Exception $exception){
            //回滚事务
            Db::rollback();
            return false;
        }
    }

    //status状态
//    public function getStatusAttr($value){
//        $status=[
//            1=>'启用',
//            0=>'禁用'
//        ];
//        return $status[$value];
//    }

    /**
     * 编辑操作，使用事务编辑多个表
     * @param $param
     * @return bool
     */
    public function edit($param)
    {
        $nickname=$param['nickname'];
        $email=$param['email'];
        $role_id=$param['role'];
        unset($param['nickname']);
        unset($param['email']);
        unset($param['role']);
        $param['state'] = isset($param['state']) ? 1: 0;
        $param['update_time']=date($this->dateFormat,time());
        Db::startTrans();
        try{
            db('admin')
                ->where('id',$param['id'])
                ->update($param);
            db('auth_group_access')
                //access.uid=admin.id
                ->where('uid',$param['id'])
                ->update([
                    'group_id'      =>$role_id,
                    'update_time'   =>date($this->dateFormat,time()),
                ]);
            db('admin_profile')
                //profile.uid=admin.id
                ->where('uid',$param['id'])
                ->update([
                    'nickname'  =>$nickname,
                    'email'     =>$email,
                    'update_time'   =>date($this->dateFormat,time())
                ]);
            Db::commit();
            return true;
        }catch(\Exception $exception){
            Db::rollback();
            return false;
        }
    }

    /**
     *删除操作 同时删除相关并联的数据
     * @param $param
     * @return bool
     */
    public function del($param)
    {
        Db::startTrans();
        try{
            db('admin')
                ->where('id', $param['item'])
                ->delete();
            db('auth_group_access')
                ->where('uid', $param['item'])
                ->delete();
            db('admin_profile')
                ->where('uid', $param['item'])
                ->delete();
            Db::commit();
            return true;
        } catch (\Exception $exception){
            Db::rollback();
            return false;
        }
    }

    /**
     * 批量删除操作，同时删除相关并联的数据
     * @param $param
     * @return bool
     */
    public function batchDel($param)
    {
        Db::startTrans();
        try{
            db('admin')
                ->where('id','IN',$param['items'])
                ->delete();
            db('auth_group_access')
                ->where('uid','IN',$param['items'])
                ->delete();
            db('admin_profile')
                ->where('uid','IN',$param['items'])
                ->delete();
            Db::commit();
            return true;
        }catch(\Exception $exception){
            Db::rollback();
            return false;
        }
    }

    /**
     * 更新密码
     * @param $param
     * @return int|string
     */
    public function updatePassword($param)
    {
        $password=common::encrypt_password($param['password']);
        $result =db('admin')
            ->where('uuid',$param['item'])
            ->update(['password'=>$password]);
        return $result;
    }
}