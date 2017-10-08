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
        $insert['status'] = 0;
        $insert['address_id'] = $data_vip_address['id'] ? $data_vip_address['id'] : 0;
        $insert['time'] = time();
        $db_score_order = M("score_order");
        $result = $db_score_order->add($insert);
        if(!$result){
            $this->ajaxReturn(array('control'=>'add_order','code'=>0,'msg'=>'参数不全无法生成订单','data'=>$_GET),"JSON");
            die();
        }
        $this->ajaxReturn(array('control'=>'add_order','code'=>200,'msg'=>'成功'),"JSON");
    }
    /* 订单列表 */
    public function order_list(){
        $this->display();
    }


}
