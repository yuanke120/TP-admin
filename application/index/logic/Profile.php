<?php
/**
 * 个人设置逻辑层
 * Author:YuanKe
 * Date:2020年1月12日 13:11:49
 */
namespace  app\index\logic;

use app\index\common;
use app\index\common\logic\BaseLogic;
use think\Config;
use think\Session;

/**
 * Class Profile
 * @package app\index\logic
 */
class Profile extends BaseLogic
{
    /**
     * 获取个人资料
     * @return null
     */
    public function getMode()
    {
        $result=db('admin_profile')
            ->alias('profile')
            ->where('uid',Session::get('admin.id'))
            ->join('__AUTH_GROUP__ group', 'group.title = "'.Session::get('admin.rolename').'"')
            ->field('profile.* ,group.rules')
            ->find();
        return $result ?:null;
    }

    /**
     * 更新个人资料
     * @param $param
     * @return array
     */
    public function save_profile($param)
    {
        $result=db('admin_profile')
            ->where('uid',Session::get('admin.id'))
            ->update($param);
        Session::set('admin.nickname',$param['nickname']);
        return $result ?
            common::return_result('200',PROFILE_UPDATE_SUCCESS_TEXT,null) :
            common::return_result('500',PROFILE_UPDATE_FAILURE_TEXT,null);
    }

    /**
     * 上传头像  特别重要
     * @param $param
     * @return array
     */
    public function upload_avatar($param)
    {
        $base64_img = str_replace(' ', '+', $param['avatar']);
        //post的数据里面，加号被替换为空格，需要重新替换回来，如果不是post，则注释这一行去掉
        //匹配图片格式  是否是base64的图片
        if(preg_match('/^(data:\s*image\/(\w+);base64,)/',$base64_img,$result)){
            //匹配成功
            if($result[2]=='jpeg'){
                $image_name=Session::get('admin.account').'_'.\app\common\common::get_uniqueness_id().'.png';
                //jpeg替换png
            }else{
                $image_name=Session::get('admin.account').'_'.\app\common\common::get_uniqueness_id().'.'.$result[2];
            }
            //文件目录路径
            $image_file= Config::get('UPLOAD_PATH')."/avatar/{$image_name}";
            //解码64的图片
            //服务器文件存储路径
           if(file_put_contents($image_file,base64_decode(str_replace($result[1],'',$base64_img)))){
               $result=db('admin_profile')
                   ->where('uid',Session::get('admin.id'))
                   ->update(['avatar'=>ltrim($image_file,'.')]);
               if($result){
                   Session::set('admin.avatar',ltrim($image_file,'.'));
                   return common::return_result('200',AVATAR_UPDATE_SUCCESS_TEXT,null);
               }else{
                   return common::return_result('500',AVATAR_UPDATE_FAILURE_TEXT,null);
               }
           }else{
               return common::return_result('500',AVATAR_UPDATE_FAILURE_TEXT,null);
           }
        }else{
            return common::return_result('500',AVATAR_UPDATE_FAILURE_TEXT,null);
        }
    }


    /**
     * 更新个人设置密码
     * @param $param
     * @return array
     */
    public function update_password($param)
    {
        $result=db('admin')
            ->where('id',Session::get('admin.id'))
            ->update([
                'password' =>\app\common\common::encrypt_password($param['password']),
            ]);

        return $result ?
            common::return_result('200',UPDATE_PASSWORD_SUCCESS_TEXT,null) :
            common::return_result('500',UPDATE_PASSWORD_FAILURE_TEXT,null);
    }

}