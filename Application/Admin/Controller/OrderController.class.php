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
    /* 没有审核的订单的列表 */
    public function no_pass_order(){
        $where = array('admin_ispass'=>array('eq',0),'ispay'=>1);
        $db_order = M('shop_order'); // 实例化User对象
        $count      = $db_order->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $db_order->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();

        for($i=0;$i<count($list);$i++){
            $list[$i]['goods_arr'] = unserialize(stripcslashes(htmlspecialchars_decode($list[$i]['items'])));
        }
//        p($list);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
//        p($show);
//        die;
        $this->display(); // 输出模板

    }
    /* 订单审核 */
    public function order_review(){
        $db_order =M("shop_order");
        $update['admin_ispass'] = 1;
        $result = $db_order->where(array("id"=>$_GET['order_id']))->save($update);
        if($result){
            $this->ajaxReturn(array('control'=>'order_review','code'=>200,'msg'=>'修改成功'),"JSON");
        }else{
            $this->ajaxReturn(array('control'=>'order_review','code'=>0,'msg'=>'没有修改成功','data'=>$_GET),"JSON");
        }
    }
    /* 修改成本价与实际销售价 */
    public function order_mod(){
        $db_order = M('shop_order');
        $update['order_real_price'] = $_POST['real_price'];
        $update['order_cost_price'] = $_POST['cost_price'];
        $result = $db_order->where(array("id"=>$_POST['order_id']))->save($update);
        if($result){
            $this->ajaxReturn(array('control'=>'order_mod','code'=>200,'msg'=>'修改成功'),"JSON");
        }else{
            $this->ajaxReturn(array('control'=>'order_mod','code'=>0,'msg'=>'没有修改成功','data'=>$_POST),"JSON");
        }
    }
}