<?php
/**
 * index模块配置文件
 * Author：YuanKe
 * Date:2020年1月10日 12:06:16
 */

return [
    // +----------------------------------------------------------------------
    // | 定义设置
    // +----------------------------------------------------------------------
    //静态资源路径
    'RESOURCE_PATH'         =>'/static/manage',

    'UPLOAD_PATH'           =>'./upload',
    //默认错误跳转对应的末班文件
    'dispatch_error_tmpl'   =>'./static/manage/error.tpl'
];