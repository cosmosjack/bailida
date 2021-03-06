<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="author" content="blog.anchen8.net" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<title>百利达车行交易商城</title>
	    <link rel="stylesheet" type="text/css" href="/Public/App/css/hstyle.css" />
        <script src="/Public/App/js/jquery-1.8.3.min.js"></script>
	</head>
	<body>
        <header class="header">
            百利达车行交易商城
            <div class="nav_btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </header>
        <!--搜索-->
                <form action="">
          <div class="search">
            <p>
                <a href="javascript:;" class="pull_down"></a>
                    
                <input type="search" name="search" placeholder="输入品牌/车型" id="search" />
            </p>
                <button id="sub" type="submit"></button>
        </div>
                </form>
        <!--筛选-->
        <div class="filtrate_box">
            <div class="filtrate">
                <div class="filtrate_link">
                    <a href="javascript:;" class="brand_btn">品牌</a>
                    <a href="javascript:;" class="price_sort">价格</a>
                    <a href="javascript:;" class="motorcycle_type_btn">车型</a>
                    <a href="javascript:;" class="all_btn">全部</a>
                </div>
                <ul class="all">
                    <li><a href="<?php echo U('index',get_search('label',9));?>">新车</a></li>
                    <li><a href="<?php echo U('index',get_search('label',10));?>">二手车</a></li>
                </ul>
            </div>
            <!--价格筛选框-->
            <div class="price_box">
                    <ul class="price_filtrate">
                    <li><a href="<?php echo U('index',get_search('price',1));?>">5万以下</a></li>
                    <li><a href="<?php echo U('index',get_search('price',2));?>">5万-10以下</a></li>
                    <li><a href="<?php echo U('index',get_search('price',3));?>">10万-15万以下</a></li>
                    <li><a href="<?php echo U('index',get_search('price',4));?>">15万-20万以下</a></li>
                    <li><a href="<?php echo U('index',get_search('price',5));?>">20万-30万以下</a></li>
                    <li><a href="<?php echo U('index',get_search('price',6));?>">30万以上</a></li>
                </ul>
                <a href="javascript:;" class="up"><img src="/Public/App/images/up.png" /></a>
            </div>
            <!--车型筛选框-->
            <div class="motorcycle_type_frame">
                <ul>
                    <a href="<?php echo U('index',get_search('label',2));?>"><li><img src="/Public/App/images/MPV.png" /><p>MPV</p></li></a>
                    <a href="<?php echo U('index',get_search('label',3));?>"><li><img src="/Public/App/images/zdx.png" /><p>中大型车</p></li></a>
                    <a href="<?php echo U('index',get_search('label',4));?>"><li><img src="/Public/App/images/SUV.png" /><p>SUV</p></li></a>
                    <a href="<?php echo U('index',get_search('label',5));?>"><li><img src="/Public/App/images/pc.png" /><p>跑车</p></li></a>
                    <a href="<?php echo U('index',get_search('label',6));?>"><li><img src="/Public/App/images/jc.png" /><p>紧凑型车</p></li></a>
                    <a href="<?php echo U('index',get_search('label',7));?>"><li><img src="/Public/App/images/zx.png" /><p>中型车</p></li></a>
                    <a href="<?php echo U('index',get_search('label',8));?>"><li><img src="/Public/App/images/wxc.png" /><p>微小型车</p></li></a>
                    <a href="<?php echo U('index',get_search('label',''));?>"><li><img src="/Public/App/images/all_car.png" /><p>全部</p></li></a>
                </ul>
                <a href="javascript:;" class="up_1"><img src="/Public/App/images/up.png" /></a>
            </div>
            <!--品牌筛选框-->
            <div class="brand">
                <ul>
                <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('index',get_search('cate',$vo['id']));?>">
                            <li class="choice_box">
                                <div class="choice">
                                    <img class="choice_no" src="<?php echo ($vo['iconurl']); ?>" />
                                </div>
                                <p><?php echo ($vo['name']); ?></p>
                            </li>
                        </a><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <a href="javascript:;" class="up_2"><img src="/Public/App/images/up.png" /></a>
            </div>
        </div>
        <!--车型列表-->
        <ul class="motorcycle_type">
             <?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
            <a href="<?php echo U('App/Shop/goods',array('sid'=>0,'id'=>$vo['id'],'ppid'=>$_SESSION['WAP']['vipid']));?>">
                <div class="vehicle">
                    <span><?php echo ($vo['label']); ?></span>
                    <img src="<?php echo ($vo['imgurl']); ?>" />
                </div>
                <div class="intro">
                    <h5><?php echo ($vo['name']); ?></h5>
                    <p><span>惠州</span> 指导价<?php echo sprintf("%.2f", $vo['oprice']/10000);?>万</p>
                    <!-- <p style="color:#407fec;"><span>首付<b>21.8</b>万</span> 月供11053元</p> -->
                </div>
                <div style="clear:both;"></div>
            </a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!--买车-卖车-->
        <div class="deal">
            <a href="">
                <img src="/Public/App/images/maiche.png" />
                <p>买车</p>
            </a>
            <a href="<?php echo U('sell');?>">
                <img src="/Public/App/images/mai.png" />
                <p>卖车</p>
            </a>
        </div>
        <!--底部导航-->
        <div class="support"></div>
        <footer class="support footer">
            <ul>
                <a href="<?php echo U('App/Shop/index');?>"><li><img src="/Public/App/images/home.png" /><p>主页</p></li></a>
                <a href=""><li class="footer_hover"><img src="/Public/App/images/purchase.png" /><p>购车</p></li></a>
                <a href=""><li><div class="tgc"><img src="/Public/App/images/tgc.png" /></div></li></a>
                <a href="<?php echo U('App/Shop/basket',array('sid'=>0,'lasturl'=>$footlasturl));?>"><li><img src="/Public/App/images/information.png" /><p>购物车</p></li></a>
                <a href="<?php echo U('App/Vip/index');?>"><li><img src="/Public/App/images/personage.png" /><p>我的</p></li></a>
            </ul>
        </footer>
        <script>
                /*价格*/
                $('.price_sort').click(function(){
                    $('.motorcycle_type_frame').hide()
                    $('.all').hide()
                    $('.brand').hide()
                    $('.price_box').slideDown()
                })
                $('.up').click(function(){
                    $('.price_box').slideUp()
                    $('.filtrate_link').children('a').removeClass('filtrate_hover')
                })
                /*车型*/
                $('.motorcycle_type_btn').click(function(){
                    $('.price_box').hide()
                    $('.all').hide()
                    $('.brand').hide()
                    $('.motorcycle_type_frame').slideDown()
                })
                $('.up_1').click(function(){
                    $('.motorcycle_type_frame').slideUp()
                    $('.filtrate_link').children('a').removeClass('filtrate_hover')
                })
                /*全部*/
                $('.all_btn').click(function(){
                    if($(this).hasClass('filtrate_hover')){
                        $('.all').slideUp()
                    }else{
                        $('.price_box').hide()
                        $('.motorcycle_type_frame').hide()
                        $('.brand').hide()
                        $('.all').slideDown()
                    }
                })
                /*品牌*/
                $('.brand_btn').click(function(){
                    $('.price_box').hide()
                    $('.all').hide()
                    $('.motorcycle_type_frame').hide()
                    $('.brand').slideDown()
                })
                $('.up_2').click(function(){
                    $('.brand').slideUp()
                    $('.filtrate_link').children('a').removeClass('filtrate_hover')
                })
                /*点中变色  关闭*/
                $('.filtrate_link').children('a').click(function(){
                    if($(this).hasClass('filtrate_hover')){
                        $('.price_box').slideUp()
                        $('.all').slideUp()
                        $('.motorcycle_type_frame').slideUp()
                        $('.brand').slideUp()
                        $('.filtrate_link').children('a').removeClass('filtrate_hover')
                    }else{
                        $('.filtrate_link').children('a').not(this).removeClass('filtrate_hover')
                        $(this).addClass('filtrate_hover')
                    }
                })
                
                /*品牌选中状态*/
                $('.choice_box').click(function(){
                    if($(this).children('.choice').children('img').is(".choice_no")){
                        $(this).children('.choice').children('img').attr('class','choice_yes')
                    }else{
                        $(this).children('.choice').children('img').attr('class','choice_no')
                    }
                })
        </script>
	</body>
</html>