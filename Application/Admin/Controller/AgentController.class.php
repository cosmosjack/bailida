<?php
/**
 * Created by 大师兄
 * 派系: 神秘剑派
 * 技能: zxc秒杀
 * Date: 2017/9/13
 * Time: 10:13
 * QQ:  997823131 
 */
namespace Admin\Controller;
class AgentController extends BaseController{
    public function __construct(){
        parent::__construct();
    }
    public function set(){
        $db_level_set = M("level_set");

        if(isset($_POST['sub']) && $_POST['sub'] == 'ok'){

            $this->ajaxReturn(array("status"=>"0","msg"=>"添加成功",'data'=>$_POST),"JSON");
        }else{
            $data_level_set = $db_level_set->select();
            $this->assign("data_level_set",$data_level_set);
            p($data_level_set);
            $this->display();
        }

    }
}