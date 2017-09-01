<?php

namespace App\Controller;
/**
 * 商品搜索及提交二手车出售
 */

class SearchController extends BaseController
{
    public  function  index(){
    	// 获取商品分类信息
        $indexicons = M('Shop_cate')->where(array('pid'=>array('eq',0)))->select();
        foreach ($indexicons as $k => $v) {
            $listpic = $this->getPic($v['icon']);
            $indexicons[$k]['iconurl'] = $listpic['imgurl'];
        }
        $this->assign('cate',$indexicons);

        //名称搜索
        if (!empty($_GET['search'])) {
	        $where['name'] = array('like',"%".trim(I('search'))."%");
        }
        // 分类搜索
        if (!empty(I('cate'))) {
        	$where['cid'] = array('eq',I('cate'));
        }
        // 价格区间搜索
        if (!empty($_GET['price'])) {
			switch ($_GET['price']) {
				case '1':
		        	$where['oprice'] = array(array('EGT',0),array('lt',50000));
					break;
				case '2':
		        	$where['oprice'] = array(array('EGT',50000),array('lt',100000));
					break;
				case '3':
		        	$where['oprice'] = array(array('EGT',100000),array('lt',150000));
					break;
				case '4':
		        	$where['oprice'] = array(array('EGT',150000),array('lt',200000));
					break;
				case '5':
		        	$where['oprice'] = array(array('EGT',200000),array('lt',300000));
					break;
				case '6':
		        	$where['oprice'] = array(array('EGT',300000),array('lt',50000000));
					break;
				default:
					# code...
					break;
			}

        	$beg = (int)base64_decode($_GET['b'])*10000;
        	$stop = (int)base64_decode($_GET['s'])*10000;
        }


        // 标签搜索
        if (!empty($_GET['label'])) {
        	$where['lid'] = array('like','%'.$_GET['label'].'%');
        }

        $res = M('shop_goods')->where($where)->select();
        foreach ($res as $k => $v) {
        	$res[$k]['label'] = M('Shop_label')->where(array('id'=>array('eq',explode(',',$v['lid'])[0])))->find()['name'];
        	$res[$k]['imgurl'] = $this->getPic($v['listpic'])['imgurl'];
        }
        $this->assign('res',$res);

        $this->display();
    }
    // 获取图片  源码自带方法
    public function getPic($id)
    {
        $m = M('UploadImg');
        $map['id'] = $id;
        $list = $m->where($map)->find();
        if ($list) {
            $list['imgurl'] = __ROOT__ . "/Upload/" . $list['savepath'] . $list['savename'];
        }
        return $list ? $list : "";
    }


    public function sell(){
        if (IS_GET) {
            $this->display();die;
        }

        if (IS_POST) {
        $m = M('Old_car');
        $uid = $_SESSION['WAP']['vipid'];
        if (!$uid) {
        $this->ajaxReturn(array('state'=>false,'msg'=>'请先登录！'));
        } 
         // 统计今日次数
         $map['vipid'] = array('eq',$uid);
         $time = strtotime(date('Y-m-d'));
         $map['addtime'] = array(array('egt',$time),array('lt',$time+3600*24));
         $count = $m ->where($map)->count();
         if ($count > 10) {
            $this->ajaxReturn(array('state'=>false,'msg'=>'对不起，您今日发布的数量已经超过上限！'));
         }
         // 两次间隔时间不能小于60秒
         $last = $m->where(array('vipid'=>array('eq',$uid)))->order('addtime desc')->find()['addtime']+60 - time();

         if ($last<60 && $last >0) {
            $this->ajaxReturn(array('state'=>false,'msg'=>'您的操作太快了，请'.$last.'秒后再试！'));
         }
         // 联系人
          if (!preg_match('/^[_\x{4e00}-\x{9fa5}\d]{2,5}$/iu',I('link_name'))) {
            $this->ajaxReturn(array('state'=>false,'msg'=>'联系人请输入2-5位中文名称！'));
         }

         if (!preg_match('/1[34578]\d{9}$/',I('phone'))) {
            $this->ajaxReturn(array('state'=>false,'msg'=>'手机号码格式不正确！'));
         }

         if (mb_strlen(I('name'))<5 || mb_strlen(I('name'))>20) {
            $this->ajaxReturn(array('state'=>false,'msg'=>'车型名称应该在5到20个字符之间！'));
         }

         if (mb_strlen(I('address'))<5 || mb_strlen(I('address'))>50) {
            $this->ajaxReturn(array('state'=>false,'msg'=>'联系地址应该在5到50个字符之间！'));
         }

         if (mb_strlen(I('desc'))<20 || mb_strlen(I('desc'))>500) {
            $this->ajaxReturn(array('state'=>false,'msg'=>'详情介绍应该在20-500个字符之间！'));
         }
            $data['phone'] = I('phone');
            $data['name'] = I('name');
            $data['address'] = I('address');
            $data['link_name'] = I('link_name');
            $data['desc'] = I('desc');
            $data['addtime'] = time();
            $data['vipid'] = $_SESSION['WAP']['vipid'];
            if ($m->add($data)) {
                $this->ajaxReturn(array('state'=>true,'msg'=>'信息提交成功！近期将会有专人联系您，请留意手机电话！'));
            }else{
                $this->ajaxReturn(array('state'=>false,'msg'=>'提交失败，请稍后重试！'));
            }
        }
    }
}