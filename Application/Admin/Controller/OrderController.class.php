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
    public function no_pass_order(){
        $where = array('admin_ispass'=>array('eq',0));
        $db_order = M('shop_order'); // 实例化User对象
        $count      = $db_order->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $db_order->where('status=1')->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        p($list);
        p($show);
        die;
        $this->display(); // 输出模板

    }
}