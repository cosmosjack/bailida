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

        $this->display();
    }
    public function agent_list(){
        $db_vip = M("vip");
        $data_vip = $db_vip->where(array("id"=>array("GT",600),"isfx"=>1))->select();
        $this->ajaxReturn($data_vip,"JSON");
    }
    /* 统计自己和自己下线的订单 每月15号统计上个月的 没有支付的将自动销毁 没有确认的也将自动确认 如果有存在用户已经确认订单但没有填写真正订单金额的 将跳出统计并提醒 start */
    public function calc_order(){
        // 如果用户支付了 定金且 已经确认了订单 但又 不要了 则需要修改订单状态为 取消状态

        /* 统计自己的下线 start  */
        $db_vip = M("vip");
        $data_junior = $db_vip->where(array("pid"=>$_GET['agent_id']))->select();
//        p($data_junior); // 下线列表
        $agent_arr = array();
        for($i=0;$i<count($data_junior);$i++){
            $agent_arr[$i] = $data_junior[$i]['id'];
        }
        array_push($agent_arr,$_GET['agent_id']);
        P($agent_arr);
        /* 统计自己的下线 end  */

        /* 算出所有的订单按月分开 然后再通过级别的不同来分成 start */
        $now_d = date("d",time());
        $now_m = date("m",time());
        // 查看之前是否有统计过
        $db_order_calc = M("order_calc");
        $data_order_calc = $db_order_calc->where(array('agent_id'=>$_GET['agent_id']))->order("add_time desc")->find();
        if($data_order_calc){
            $already_calc_date = $data_order_calc['calc_date'];
            $already_calc_time = $data_order_calc['calc_time'];
        }else{
            $already_calc_date = '0';
            $already_calc_time = '0';
        }

        p($already_calc_time);
        p($already_calc_date);
        if($already_calc_time){
            $temp_time = explode("|",$already_calc_time);
            $already_calc_time = $temp_time[1];
        }
        $already_calc_m = '0';
        if($already_calc_date){
            $temp_date = explode("-",$already_calc_date);
            $already_calc_m = $temp_date[1];
        }

//        die;
        $begin_time = $already_calc_time;
        if($now_d > 15){
            //截止日期大于等于上个月 月末时 不用统计 否则 就统计到上月月末结束
            $end_time = mktime(23,59,59,($now_m-1),cal_days_in_month(CAL_GREGORIAN, $now_m-2, date("Y")),date("Y"));
            p($end_time);
        }else{
            // 截止日期到 上上个月 同上
            $end_time = mktime(23,59,59,($now_m-2),cal_days_in_month(CAL_GREGORIAN, $now_m-2, date("Y")),date("Y"));
            p($end_time);
        }
        // 还需要加入 开始时间和结束时间
        $where = array(
            "ispay"=>1,
            "vipid"=>array("in",$agent_arr)
        );


        $db_order = M('shop_order');
        $total_price = $db_order // 押金
            ->where($where)
            ->sum('totalprice');

        $real_price = $db_order->where($where)->sum('order_real_price');
        $cost_price = $db_order->where($where)->sum('order_cost_price');
        $total_num = $db_order->where($where)->count('id');
        // 插入数据
        $insert_order_calc['calc_time'] = $begin_time."|".$end_time;
        $insert_order_calc['add_time'] = time();
        $insert_order_calc['calc_amount'] = $real_price;
        $insert_order_calc['calc_date'] = date("Y-m",$end_time);
        $insert_order_calc['agent_id'] = $_GET['agent_id'];
        $insert_order_calc['calc_cost'] = $cost_price;
        $insert_order_calc['calc_profits'] = $real_price-$cost_price;
        $insert_order_calc['calc_num'] = $total_num;
        p($insert_order_calc);
        $row_calc = $db_order_calc->add($insert_order_calc);
        p($row_calc);
        die;
        /* 先做总的订单提成统计 start  */
        $total_order = count($data_order);
        if($total_order<=0){
            echo '暂无需要统计的订单';
        }
        for($i=0;$i<$total_order;$i++){

        }
        /* 先做总的订单提成统计 end  */

        /* 算出所有的订单按月分开 然后再通过级别的不同来分成 end */


    }
    /* 统计自己和自己下线的订单 每月15号统计上个月的 没有支付的将自动销毁 没有确认的也将自动确认 end */



}