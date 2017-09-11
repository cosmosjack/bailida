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
        if(!isset($_GET['agent_id']) && empty($_GET['agent_id'])){
            header('location:'.getenv("HTTP_REFERER"));
        }
        $db_order = M('shop_order');

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

//        p($already_calc_time);
//        p($already_calc_date);
        if($already_calc_time){
            $temp_time = explode("|",$already_calc_time);
            $already_calc_time = $temp_time[1];
        }
        $already_calc_m = '0';
        if($already_calc_date){
            $temp_date = explode("-",$already_calc_date);
            $already_calc_m = $temp_date[1];
            $already_calc_y = $temp_date[0];
        }

//        die;
        $begin_time = $already_calc_time;
        $now_y = intval(date("Y",time()));

        if($now_d > 15){
            //截止日期大于等于上个月 月末时 不用统计 否则 就统计到上月月末结束

            // 如果上次 统计已经到了 上个月 则 不用统计了
            if($already_calc_y >= $now_y && intval($already_calc_m) >=($now_m-1)){
                // 不用做插入了
//                echo '到了1';
                goto doForDetail;
            }
            $end_time = mktime(23,59,59,($now_m-1),cal_days_in_month(CAL_GREGORIAN, $now_m-2, date("Y")),date("Y"));
//            p($end_time);
        }else{
            // 截止日期到 上上个月 同上
            if($already_calc_y >= $now_y && intval($already_calc_m) >=($now_m-2)){
                // 不用做插入了
//                echo '到了2';
                goto doForDetail;
            }
            $end_time = mktime(23,59,59,($now_m-2),cal_days_in_month(CAL_GREGORIAN, $now_m-2, date("Y")),date("Y"));
//            p($end_time);
        }
        // 还需要加入 开始时间和结束时间
        $where = array(
            "ispay"=>1,
            "vipid"=>array("in",$agent_arr)
        );


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
//        p($insert_order_calc);
        $row_calc = $db_order_calc->add($insert_order_calc);
//        p($row_calc);

        /* 成功根据合作商的级别及提成点 计算提成 并加钱 并记录日志 start  */
        $db_agent_level = M("agent_level");
        $data_agent_level = $db_agent_level->where(array('vip_id'=>$_GET['agent_id']))->find();
        $agent_point = $data_agent_level['point'] ? $data_agent_level['point'] : "0.02"; // 这里 需要换成 整站参数  C('default_agent_point');
        $agent_get_money = $insert_order_calc['calc_profits'] * $agent_point;

        $result_money = $db_vip->where(array("id"=>$_GET['agent_id']))->setInc("money",$agent_get_money);
        if($result_money){
//            echo '记录日志';
            $data_agent_info = $db_vip->where(array('id'=>$_GET['agent_id']))->find();
            /* 整理日志数据 start  */
            $insert_vip_log['ip'] = $_SERVER['REMOTE_ADDR'];
            $insert_vip_log['vipid'] = $data_agent_info['id'];
            $insert_vip_log['openid'] = $data_agent_info['openid'];
            $insert_vip_log['nickname'] = $data_agent_info['nickname'];
            $insert_vip_log['mobile'] = $data_agent_info['mobile'];
            $insert_vip_log['money'] = $data_agent_info['money'];
            $insert_vip_log['score'] = 0;
            $insert_vip_log['exp'] = 0;
            $insert_vip_log['status'] = 4;
            $insert_vip_log['ctime'] = time();
            $insert_vip_log['event'] = "订单提成";
            /* 整理日志数据 end  */
            $db_vip_log = M('vip_log');
            @$result_log = $db_vip_log->add($insert_vip_log);
        }else{
//            echo '删除统计记录'.$row_calc;$db_order_calc
            @$db_order_calc->where($row_calc)->delete();
        }
        /* 成功根据合作商的级别及提成点 计算提成 并加钱 并记录日志 end  */
//        die;

        doForDetail:
        echo '已经有订单统计了,开始按日期铺数据';
//        die;

        /* 统计完成订单后的页面展示 start  */

        /* 算出要展示的开始和结束时间 start */
        $search_month = $_GET['month'] ? intval($_GET['month']) : (intval(date("d",time()))>15) ? intval(date("m"),time())-1 : intval(date("m",time()))-2;
        $search_year = $_GET['year'] ? intval($_GET['year']) : intval(date("Y",time()));
        /* 算出要展示的开始和结束时间 end */

        //总的订单数量
        $order_total_num = $db_order_calc->where(array('agent_id'=>$_GET['agent_id']))->sum("calc_num");
        //要查看的月份的订单数量
//        p($search_month);
//        p($search_year);
//        p($order_total_num);
        // 查出 需要展示的订单数据
        $search_begin_time = mktime(0,0,0,$search_month,1,$search_year);
        $search_end_time = mktime(23,59,59,$search_month,cal_days_in_month(CAL_GREGORIAN, $search_month, $search_year),$search_year);
//        p($search_begin_time);
//        p($search_end_time);
        $map['ctime'] = array('between',"$search_begin_time,$search_end_time");
        $data_order = $db_order
            ->where($map)
            ->select();
//        p($data_order);
        $month_day_num = cal_days_in_month(CAL_GREGORIAN, $search_month, $search_year);
        if($data_order){
            // 声明 前端需要的 线形图 数据
            $float_data = '';
            $amount_data = ''; //订单定金
            $order_real_price = '';
            for($i=1;$i<($month_day_num+1);$i++){
                $day_start = mktime(0,0,0,$search_month,$i,$search_year);
                $day_end = mktime(23,59,59,$search_month,$i,$search_year);
                $day_amount[$i] = 0; // 每天收入的押金
                for($j=0;$j<count($data_order);$j++){
                    if($data_order[$j]['ctime'] >= $day_start && $data_order[$j]['ctime'] <= $day_end){
                        $day_amount[$i] = $day_amount[$i] + $data_order[$j]['payprice'];
                        $day_data[$i][] = $data_order[$j];
                    }
                }
                if(!isset($day_data[$i])){
                    $day_data[$i] = array('code'=>1,'msg'=>"没有订单");

                    $float_data .= "[gd(".$search_year.",".$search_month.",".$i."),0],"; //  [gd(2012,1,31),25]
                    $amount_data .= "[gd(".$search_year.",".$search_month.",".$i."),0],"; // 金额数据

                }else{
                    $float_data .= "[gd(".$search_year.",".$search_month.",".$i."),".count($day_data[$i])."],";
                    /* 金额数据 start */
                    $amount_data .= "[gd(".$search_year.",".$search_month.",".$i."),".$day_amount[$i]."],";
                    /* 金额数据 end */

                }
            }
        }else{
            echo '没有订单数据';
        }
        $float_data = "[".rtrim($float_data,",")."]";
        $amount_data = "[".rtrim($amount_data,",")."]";
//        p($float_data);
//        p($amount_data);
//        p($day_data);
        /* 合作商 提成点 start */
        $db_agent_level = M("agent_level");
        $data_agent_level = $db_agent_level->where(array('vip_id'=>$_GET['agent_id']))->find();
        $agent_point = $data_agent_level['point'] ? $data_agent_level['point'] : "0.02"; // 这里 需要换成 整站参数  C('default_agent_point');
        /* 合作商 提成点 end */

//        p($agent_point);
        $this->assign("point",$agent_point);
        $this->assign("year",$search_year);
        $this->assign("month",$search_month);
        $this->assign("day_data",$day_data);
        $this->assign("float_data",$float_data);
        $this->assign("amount_data",$amount_data);
        $this->display();
        /* 统计完成订单后的页面展示 end  */

        /* 算出所有的订单按月分开 然后再通过级别的不同来分成 end */

    }
    /* 统计自己和自己下线的订单 每月15号统计上个月的 没有支付的将自动销毁 没有确认的也将自动确认 end */

// 获取其中一天的订单详情
public function get_one_day(){

}

}