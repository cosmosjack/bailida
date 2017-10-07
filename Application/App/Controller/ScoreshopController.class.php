<?php
// 本类由系统自动生成，仅供测试用途
namespace App\Controller;

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
        $db_score_goods = M("score");
        $where['status'] = 1;
        $data_score_goods = $db_score_goods->where($where)->select();
        p($data_score_goods);
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


}
