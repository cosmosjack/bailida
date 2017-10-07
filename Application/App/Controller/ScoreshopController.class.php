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
