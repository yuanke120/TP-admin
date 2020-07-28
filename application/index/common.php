<?php
/**
 * JSON接口返回值
 * Author:YuanKe
 * Date:2020年1月12日 16:02:29
 */
//应用公共文件
namespace app\index;

class common
{
    /**
     * 返回操作结果json数据
     * @param $code
     * @param $message
     * @param $url
     * @return array
     */
    public static function return_result($code, $message, $url)
    {
        $result = array(
            'code'      =>  $code,
            'msg'       =>  $message,
            'url'       =>  $url
        );
        return $result;
    }
}