<?php
/**
 * Created by 大师兄
 * 派系: 神秘剑派
 * 技能: zxc秒杀
 * Date: 2017/9/6
 * Time: 14:35
 * QQ:  997823131 
 */
namespace Admin\Controller;
class OrderController extends BaseController{
    public function __construct(){
        parent::__construct();
    }
    public function no_pass_order(){
        $db_order = M("shop_order");
        $data_order = $db_order
            ->where(array('admin_ispass'=>array('eq',0)))
            ->select();
        p($data_order);

    }
}