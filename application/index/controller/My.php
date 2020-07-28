<?php
namespace app\index\controller;

use app\index\common\controller\Base;

class My extends  Base
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function home()
    {
        return $this->ShowView();
    }
}
