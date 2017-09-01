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
        <script src="/Public/layer/layer.js"></script>

	</head>
	<body style="background:#bdd8eb;">
		<header class="header_2">
			<a href="javascript:history.go(-1);">&#139</a>
			卖车
		</header>
		<form id="form">
			<div class="sell">
				<img src="/Public/App/images/logo.png" class="sell_logo" />
				<div style="text-align:left;">
					<p><span>姓名：</span><input type="text"  name="link_name" /></p>
					<p><span>电话：</span><input type="text"  name="phone" /></p>
					<p><span>车型：</span><input type="text"  name="name" /></p>
					<p><span>联系地址：</span><input type="text"  name="address" /></p>
					<p><span>车型描述：</span><textarea name="desc"  placeholder="例如：14款奥迪A3，2万公里.....填写好资料后会安排专人联系您！"></textarea></p>
					<button class="confirm_btn" type="button" id="send">确定</button>
				</div>
			</div>
		</form>
	</body>
	<script type="text/javascript">
        $('#send').click(function(){
        	if ($(this).hasClass('send')) {
        		layer.msg('正在发送数据中！');
        		return false;
        	};
        	$(this).addClass('send')
	        var data = $('form').serialize();
	        	layer.load();
	        $.post('<?php echo U("sell");?>', data, function(data, textStatus, xhr) {
	        	$('#send').removeClass('send');
	        	layer.closeAll();
        		layer.msg(data['msg']);
	        	if (data['state']) {
	        		setTimeout(function(){
	        			location.href=history.go(-1);
	        		},1000)
	        	}
	        });
        })
	</script>
</html>