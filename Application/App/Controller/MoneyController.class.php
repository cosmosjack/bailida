<?php
/**
 * Created by 大师兄
 * 派系: 神秘剑派
 * 技能: zxc秒杀
 * Date: 2017/9/28
 * Time: 15:06
 * QQ:  997823131 
 */
namespace App\Controller;

use Think\Controller;

class MoneyController extends BaseController{
    public function _initialize()
    {
        //你可以在此覆盖父类方法
        parent::_initialize();
    }
    public function index(){
        echo 'this is the index page';
    }
    public function history(){
        p($_SESSION);
        $this->display();
    }
}