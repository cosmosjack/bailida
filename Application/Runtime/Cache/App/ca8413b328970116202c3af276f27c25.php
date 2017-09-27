<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<title>提现资料设置</title>
	    <meta charset="utf-8" />
		<!--页面优化-->
		<meta name="MobileOptimized" content="320">
		<!--默认宽度320-->
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
		<!--viewport 等比 不缩放-->
		<meta http-equiv="cleartype" content="on">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<!--删除苹果菜单-->
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<!--默认颜色-->
		<meta name="apple-mobile-web-app-title" content="yes">
		<meta name="apple-touch-fullscreen" content="yes">
		<!--加载全部后 显示-->
		<meta content="telephone=no" name="format-detection" />
		<!--不识别电话-->
		<meta content="email=no" name="format-detection" />
		<link rel="stylesheet" href="/Public/App/css/style.css" />
		<script type="text/javascript" src="/Public/App/js/zepto.min.js"></script>
        <script type="text/javascript" src="/Public/App/gmu/gmu.min.js"></script>
        <script type="text/javascript" src="/Public/App/gmu/app-basegmu.js"></script>
	</head>
	<body class="back1">
		<form action="" method="post" id="AppForm">
		<p class="add-hd color6">银行卡提现资料</p>
		<div class="add-ads back2">
			<ul class="add-uls">
				<li class="border-b1 ovflw"><span class="fl">姓名</span><input type="text" name="txname" value="<?php echo ($data["txname"]); ?>" placeholder="请输入姓名" id="txname" /></li>
				<li class="border-b1 ovflw"><span class="fl">电话</span><input type="text" name="txmobile" value="<?php echo ($data["txmobile"]); ?>" placeholder="请输入联系电话"  id="txmobile"/></li>
				<li class="border-b1 ovflw"><span class="fl">开户银行</span><input type="text" name="txyh" value="<?php echo ($data["txyh"]); ?>" placeholder="请输入银行"  id="txyh"/></li>
				<li class="border-b1 ovflw"><span class="fl">所属分行</span><input type="text" name="txfh" value="<?php echo ($data["txfh"]); ?>" placeholder="请输入银行分行"  id="txfh"/></li>
				<li class="border-b1 ovflw"><span class="fl">开户行所在地</span><input type="text" name="txszd" value="<?php echo ($data["txszd"]); ?>" placeholder="请输入银行所在地"  id="txszd"/></li>
				<li class="border-b1 ovflw"><span class="fl">银行卡号</span><input type="text" name="txcard" value="<?php echo ($data["txcard"]); ?>" placeholder="请输入银行分行"  id="txcard"/></li>
			</ul>			
		</div>
		</form>
		<div class="insert1"></div>
		<div class="dtl-ft ovflw">
				<div class=" fl dtl-icon dtl-bck ovflw">
					<a href="<?php echo U('App/Vip/index');?>">
						<i class="iconfont">&#xe679</i>
					</a>
				</div>
				<a href="#" class="fr ads-btn fonts9 back3">保存</a>
		</div>
		<!--通用分享-->
		<script type="text/javascript">
	function onBridgeReady(){
 		WeixinJSBridge.call('hideOptionMenu');
	}

	if (typeof WeixinJSBridge == "undefined"){
	    if( document.addEventListener ){
	        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
	    }else if (document.attachEvent){
	        document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
	        document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
	    }
	}else{
	    onBridgeReady();
	}	
</script>

	</body>
	
</html>
<script>
	$('.ads-btn').click(function(){
		if(!$('#txname').val()){
			App_gmuMsg('请填写提现姓名！');
			return false;
		}
		if(!$('#txmobile').val()){
			App_gmuMsg('请填写提现手机！');
			return false;
		}
		if(!$('#txyh').val()){
			App_gmuMsg('请填写开户银行！');
			return false;
		}
		if(!$('#txfh').val()){
			App_gmuMsg('请填写开户银行分行！没有请填写总行!');
			return false;
		}
		if(!$('#txszd').val()){
			App_gmuMsg('请填写提现所在地！');
			return false;
		}
		if(!$('#txcard').val()){
			App_gmuMsg('请填写提现银行卡号！');
			return false;
		}
		$('#AppForm').submit();
	})
</script>