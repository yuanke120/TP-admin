<?php
/**
 * logic基础方法接口
 * Author:YuanKe
 * Date:2020年1月18日 17:47:58
 */

namespace app\index\common\logic;

/**
 * Interface ILogic
 * @package app\index\common\logic
 */
//接口
interface ILogic
{
    public function getList();

    public function getMode($uuid);

    public function add($param);

    public function edit($param,$uuid);

    public function del($param);

    public function batchDel($param);

}
