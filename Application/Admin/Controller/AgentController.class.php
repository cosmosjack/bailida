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
            $row = false;
            for($i=1;$i<4;$i++){
                    $update['first_point'] = $_POST["first_{$i}"];
                    $update['second_point'] = $_POST["second_{$i}"];
                    $update['money'] = $_POST["money_{$i}"];
                $result[$i] = $db_level_set->where(array("id"=>$i))->save($update);
                if($result[$i]){
                    $row = true;
                }
            }
            if($row){
                $this->ajaxReturn(array("status"=>"0","msg"=>"修改成功",'data'=>$_POST),"JSON");
            }else{
                $this->ajaxReturn(array("status"=>"0","msg"=>"无任何修改",'data'=>$_POST),"JSON");
            }
        }else{
            $data_level_set = $db_level_set->select();
            $this->assign("data_level_set",$data_level_set);
//            p($data_level_set);
            $this->display();
        }

    }
}