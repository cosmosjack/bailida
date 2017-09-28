<?php if (!defined('THINK_PATH')) exit();?><head>
<link href="/Public/Admin/statistic/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/Public/Admin/statistic/bootstrap/css/font-awesome.min.css" rel="stylesheet">
<link href="/Public/Admin/statistic/bootstrap/css/animate.min.css" rel="stylesheet">
<link href="/Public/Admin/statistic/bootstrap/css/style.min.css" rel="stylesheet">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/Public/Admin/statistic/bootstrap/css/plugins/footable/footable.core.css" rel="stylesheet">
<script type="text/javascript" src="/Public/Admin/statistic/bootstrap/js/jquery.min.js"> </script>



<title>未审核的订单</title>
<meta name="keywords" content="百利达">
<meta name="description" content="百利达二手车,成就你我他">

<link rel="shortcut icon" href="favicon.ico">


<link href="/Public/Admin/statistic/bootstrap/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
<link href="/Public/Admin/statistic/bootstrap/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
<link href="/Public/Admin/statistic/bootstrap/css/animate.min.css" rel="stylesheet">
<link href="/Public/Admin/statistic/bootstrap/css/style.min.css?v=4.0.0" rel="stylesheet">
<link href="/Public/Admin/statistic/bootstrap/css/plugins/footable/footable.core.css" rel="stylesheet">

<script src="/Public/Admin/statistic/bootstrap/js/jquery.min.js?v=2.1.4"></script>
<script src="/Public/Admin/statistic/bootstrap/js/bootstrap.min.js?v=3.3.5"></script>
<script src="/Public/Admin/statistic/bootstrap/js/content.min.js?v=1.0.0"></script>
<script src="/Public/Admin/statistic/bootstrap/js/template.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/config.js"></script>

<script src="/Public/Admin/statistic/bootstrap/js/plugins/footable/footable.all.min.js"></script>

<script>
    //展示订单详情
    function show_order(order_id){
//        console.log(order_id);
        var body_html = $("#goods_"+order_id).html();
//        console.log(body_html);
        $("#myModal_body").empty();
        $("#myModal_body").append(body_html);
    }
//修改订单时 的展示
    function mod_order_show(order_id,order_real_price,order_cost_price){
        $("#mod_order_body").empty();
        $("#mod_order_body").val(order_real_price);
        $("#order_cost_price").val(order_cost_price);
        $("input[name='order_id']").val(order_id);
    }
    //修改订单
    function mod_order(){
        var order_id = $("input[name='order_id']").val();
        var real_price = $("#mod_order_body").val();
        var cost_price = $("#order_cost_price").val();
        console.log(order_id);
        console.log(real_price);
        $.ajax({
            url:AdminUrl+"/Order/order_mod",
            type:"POST",
            data:{"order_id":order_id,"real_price":real_price,"cost_price":cost_price},
            success:function(msg){
                console.log(msg);
                if(msg.code == 200){
                    alert('修改成功');
                }else{
                    alert('修改失败');
                }
                location.reload();
            },
            error:function(){
                console.log('http error');
                location.reload();

            }
        });
    }
    function order_review(order_id){
        var msg = "请确认您已经审核好了";
        if(confirm(msg)){
            console.log(order_id);
            $.ajax({
                url:AdminUrl+"/Order/order_review/order_id/"+order_id,
                type:"GET",
                data:{},
                success:function(msg){
                    console.log(msg);
                    if(msg.code == 200){
                        alert('审核成功');
                        location.reload();
                    }
                },
                error:function(){
                    console.log("http error");
                }
            });
        }else{
            return false;
        }
    }
</script>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>请尽快审核近期订单</h5>

                    <div class="ibox-tools">
                        <!--<a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">选项 01</a>
                            </li>
                            <li><a href="#">选项 02</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>-->
                    </div>
                </div>
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                        <tr>
                            <th data-toggle="true">订单号</th> <!--oid-->
                            <th>下单人</th>  <!--vipname-->
                            <th>电话</th> <!--vipmobile-->
                            <th data-hide="all">订单时间</th> <!--ctime-->
                            <th data-hide="all">已支付定金</th>  <!--payprice-->
                            <th data-hide="all">成本价</th> <!--order_cost_price-->
                            <th data-hide="all">销售价</th> <!--order_real_price-->
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($vo["oid"]); ?></td>
                                <td><?php echo ($vo["vipname"]); ?></td>
                                <td><?php echo ($vo["vipmobile"]); ?></td>
                                <td><?php echo ($vo["ctime"]); ?></td>
                                <td><span class="pie"><?php echo ($vo["payprice"]); ?></span></td>
                                <td><?php echo ($vo["order_cost_price"]); ?></td>
                                <td><?php echo ($vo["order_real_price"]); ?></td>
                                <td>
                                    <button onclick="show_order('<?php echo ($vo["id"]); ?>')" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">
                                       <i class="fa fa-file-text"></i>详情
                                    </button>
                                    <button onclick="order_review('<?php echo ($vo["id"]); ?>');" class="btn btn-danger">
                                        <i class="fa fa-key">审核通过</i>
                                    </button>
                                    <button onclick="mod_order_show('<?php echo ($vo["id"]); ?>','<?php echo ($vo["order_real_price"]); ?>','<?php echo ($vo["order_cost_price"]); ?>')" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal4">
                                        修改
                                    </button>
                                </td>
                                <div id="goods_<?php echo ($vo["id"]); ?>" class="goods_details" style="display: none;">
                                    <?php if(is_array($vo['goods_arr'])): $goods_k = 0; $__LIST__ = $vo['goods_arr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods_arr): $mod = ($goods_k % 2 );++$goods_k;?><ul class="list-group">
                                            <li class="list-group-item">商品ID:<?php echo ($goods_arr['id']); ?> <?php echo ($goods_arr['name']); ?> 商品数量:<?php echo ($goods_arr['num']); ?> 商品成本价:<?php echo ($goods_arr['cost_price']); ?> 商品销售价:<?php echo ($goods_arr['real_price']); ?></li>
                                        </ul><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="8">
                                <ul class="pagination pull-right"><?php echo ($page); ?></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">订单详情</h4>
                <small class="font-bold text-danger">请核算好成本避免统计出错</small>
            </div>
            <div id="myModal_body" class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary">确定</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-clock-o modal-icon"></i>
                <h4 class="modal-title">订单修改</h4>
                <small class="text-danger">适当改变订单销售价格根据商品销售价</small>
            </div>
            <div  class="modal-body">
                <span>订单实际销售价</span><input id="mod_order_body" type="text" value="" name="order_real_price">
                <span>订单成本价</span><input id="order_cost_price" type="text" value="" name="order_cost_price">
            </div>
            <div class="modal-footer">
                <input type="hidden" name="order_id" value="">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button onclick="mod_order();" type="button" class="btn btn-primary">保存修改</button>
            </div>
        </div>
    </div>
</div>
</body>

</html>