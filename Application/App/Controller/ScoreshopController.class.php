<?php
// 本类由系统自动生成，仅供测试用途
namespace App\Controller;

use Think\Model;

class ScoreshopController extends BaseController
{

    public function _initialize()
    {
        //你可以在此覆盖父类方法
        parent::_initialize();
        $shopset = M('Shop_set')->where('id=1')->find();
        if ($shopset['pic']) {
            $listpic = $this->getPic($shopset['pic']);
            $shopset['sharepic'] = $listpic['imgurl'];
        }
        if ($shopset) {
            self::$WAP['shopset'] = $_SESSION['WAP']['shopset'] = $shopset;
            $this->assign('shopset', $shopset);
        } else {
            $this->diemsg(0, '您还没有进行商城配置！');
        }
    }
/* 一般的列表 */
    public function index()
    {
        $db_score_goods = new Model();
        $data_score_goods = $db_score_goods->query("select wfx_score.*,wfx_upload_img.name as img_name,wfx_upload_img.savename,wfx_upload_img.savepath from wfx_score INNER JOIN wfx_upload_img ON wfx_score.pic = wfx_upload_img.id WHERE wfx_score.status = 1");
//        p($data_score_goods);
        if($data_score_goods){
            $this->assign("data_score_goods",$data_score_goods);
        }else{
            echo '暂无积分商品';
        }
        $this->display();
    }
/* 瀑布流 */
    public function get_goods_list(){
        p($_SESSION["WAP"]['vip']['score']);
    }
    /* 积分下订单 */
    public function add_order(){
        if(empty($_SESSION['WAP']['vipid'])){
            $this->ajaxReturn(array('control'=>'add_order','code'=>0,'msg'=>'您属于非法用户'),"JSON");
            die();
        }
        $db_score = M("score");

        $data_score = $db_score->where(array("id"=>$_GET['score_id'],"status"=>1))->find();
        if(!$data_score){
            $this->ajaxReturn(array('control'=>'add_order','code'=>0,'msg'=>'此礼品库存已不足'),"JSON");
            die();
        }
        $db_vip_address = M("vip_address");
        $data_vip_address = $db_vip_address->where(array("vipid"=>$_SESSION['WAP']['vipid'],"xqid"=>1))->find();
        $insert['user_id'] = $_SESSION['WAP']['vipid'];
        $insert['orderid'] = date("ymd",time()).mt_rand(100000,999999);
        $insert['score_id'] = $_GET['score_id'];
        $insert['totalscore'] = $data_score['score'];
        $insert['status'] = 1;
        $insert['address_id'] = $data_vip_address['id'] ? $data_vip_address['id'] : 0;
        $insert['time'] = time();
        $db_score_order = M("score_order");
        /* 查出会员的剩余积分 */
        $_SESSION["WAP"]['vip']['score'] ; // 会员的剩余积分
        $surplus_score = intval($_SESSION["WAP"]['vip']['score']);
        if($surplus_score < $insert['totalscore']){
            $this->ajaxReturn(array('control'=>'add_order','code'=>0,'msg'=>'您的积分不足'),"JSON");
            die();
        }
        $result = $db_score_order->add($insert);
        if(!$result){
            /* 扣除积分 更新当前session */
            $db_vip = M("vip");
            $db_vip->where(array("id"=>$_SESSION['WAP']['vipid']))->setDec('score',$insert['totalscore']); // 用户的积分减5
            $this->ajaxReturn(array('control'=>'add_order','code'=>0,'msg'=>'参数不全无法生成订单','data'=>$_GET),"JSON");
            die();
        }
        $this->ajaxReturn(array('control'=>'add_order','code'=>200,'msg'=>'成功'),"JSON");
    }
    /* 订单列表 */
    public function orderList(){
        $db_score_order = M("score_order");
        $where['wfx_score_order.user_id'] = $_SESSION['WAP']['vipid'];
            switch ($_GET['type']){
                case 1:
                    $where['wfx_score_order.status'] = 1;
                    break;
                case 2:
                    $where['wfx_score_order.status'] = 2;
                    break;
                case 3:
                    $where['wfx_score_order.status'] = array("in",array(1,2));
                    break;
                default:
                    $where['wfx_score_order.status'] = array("in",array(1,2));
                    break;
            }
        $order_type = $_GET['type'] ? $_GET['type'] : 3;
        $data_score_order = $db_score_order->field('wfx_score_order.*,wfx_score.name as score_name')->join('wfx_score ON wfx_score_order.score_id = wfx_score.id')->where($where)->select();
//        $data_score_order = $db_score_order->field('wfx_score_order.*,wfx_score.name as score_name')->join('wfx_score ON wfx_score_order.score_id = wfx_score.id')->select();
//        p($data_score_order);
            $this->assign("order_type",$order_type);
            $this->assign("data_score_order",$data_score_order);
            $this->display();

    }


}
