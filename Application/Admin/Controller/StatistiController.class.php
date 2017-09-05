<?php
/**
 * Created by 大师兄
 * 派系: 神秘剑派
 * 技能: zxc秒杀
 * Date: 2017/9/5
 * Time: 10:21
 * QQ:  997823131 
 */
namespace Admin\Controller;


class StatistiController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
//        echo '统计的首页';
        $this->display();
    }
    public function agent_list(){
        $db_vip = M("vip");
        $data_vip = $db_vip->where(array("id"=>array("GT",600)))->select();
        $this->ajaxReturn($data_vip,"JSON");
    }



}