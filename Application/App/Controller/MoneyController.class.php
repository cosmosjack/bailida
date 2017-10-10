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
//        p($_SESSION);
        $db_order_calc = M("order_calc");
        $data_order_calc = $db_order_calc->where(array())->order("add_time desc")->limit(50)->select();
        p($data_order_calc);
        for($i=0;$i<count($data_order_calc);$i++){
            $temp_time = explode("|",$data_order_calc[$i]['calc_time']);
            $data_order_calc[$i]['start_time'] = $temp_time[0];
            $data_order_calc[$i]['end_time'] = $temp_time[1];
        }
        $this->assign("data_order_calc",$data_order_calc);
        $this->display();
    }
}