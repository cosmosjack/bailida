<?php if (!defined('THINK_PATH')) exit();?><head>
<link href="/Public/Admin/statistic/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/Public/Admin/statistic/bootstrap/css/font-awesome.min.css" rel="stylesheet">
<link href="/Public/Admin/statistic/bootstrap/css/animate.min.css" rel="stylesheet">
<link href="/Public/Admin/statistic/bootstrap/css/style.min.css" rel="stylesheet">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>百利达</title>
    <meta name="keywords" content="百利达,二手车">
    <meta name="description" content="百利达二手车,幸福你我他">

    <link rel="shortcut icon" href="favicon.ico">

    <!-- Morris -->
    <link href="/Public/Admin/statistic/bootstrap/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="/Public/Admin/statistic/bootstrap/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <!--   日期CSS start  -->
    <link href="/Public/Admin/statistic/bootstrap/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/Public/Admin/statistic/bootstrap/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/Public/Admin/statistic/bootstrap/css/plugins/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="/Public/Admin/statistic/bootstrap/css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="/Public/Admin/statistic/bootstrap/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/Public/Admin/statistic/bootstrap/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="/Public/Admin/statistic/bootstrap/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">
    <link href="/Public/Admin/statistic/bootstrap/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/Public/Admin/statistic/bootstrap/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="/Public/Admin/statistic/bootstrap/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <link href="/Public/Admin/statistic/bootstrap/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="/Public/Admin/statistic/bootstrap/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="/Public/Admin/statistic/bootstrap/css/plugins/footable/footable.core.css" rel="stylesheet">

    <!--   日期CSS end  -->


</head>
<h2 align="center"><?php echo ($_GET['year']); ?>年<?php echo ($_GET['month']); ?>月的订单统计信息</h2>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <!-- 条形图 start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <!-- box标题 start-->
                <div class="ibox-title">
                    <h5>订单</h5>
                    <div class="pull-right">

                    </div>
                </div>
                <!-- box标题 end-->

                <div class="ibox-content">
                    <div class="row">
                        <!-- col-sm-9 一共12 这里站9个 左边 start -->
                        <div class="col-sm-9">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                            </div>
                        </div>
                        <!-- col-sm-9 一共12 这里站9个 左边 end -->
                        <!-- col-sm-9 一共12 这里站3个 右边 start -->
                        <div class="col-sm-3">
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins"><?php echo ($order_total_num); ?></h2>
                                    <small>开始至今已成交订单总数</small>
                                    <div class="stat-percent"><?php echo ($order_total_num); ?>% <i class="fa fa-level-up text-navy"></i>
                                    </div>
                                    <div class="progress progress-mini">
                                        <div style="width: <?php echo ($order_total_num); ?>%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins "><?php echo ($month_order_num); ?></h2>
                                    <small><?php echo ($_GET['month']); ?>月份的订单总数</small>
                                    <div class="stat-percent"><?php echo ($month_order_num); ?>% <i class="fa fa-level-down text-navy"></i>
                                    </div>
                                    <div class="progress progress-mini">
                                        <div style="width: <?php echo ($month_order_num); ?>%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins "><?php echo ($month_order_price); ?></h2>
                                    <small>查询月份的销售额</small>
                                    <div class="stat-percent">15% <i class="fa fa-bolt text-navy"></i>
                                    </div>
                                    <div class="progress progress-mini">
                                        <div style="width: 15%;" class="progress-bar"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- col-sm-9 一共12 这里站3个 右边 end -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- 条形图 end -->
    <div class="row">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>选择月份 <small>数据将按一个月的展示</small></h5>

                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content" style="padding: 15px 20px 10px;">
                <div class="form-group" id="data_4" style="margin: 0">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input name="date_choose" type="text" class="form-control "  value="<?php echo $output['now_date'];?>">
                    </div>
                    <div class="input-group ">
                        <span class="input-group-addon" ><span onclick="getDataByDate();" style="font-size: 16px;cursor: crosshair;" class="label label-primary">查询</span></span>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--   数据开始 start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <p  style="font-size: 16px;text-align: center;font-weight: bolder;width: 90%;float: left;"><?php echo ($_GET['month']); ?>月份详细数据-每天的详细数据</p>
                    <div class="ibox-tools" style="width: 8%;float: right;">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up pull-right"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                        <tr>
                            <th data-toggle="true">日期</th>
                            <th>订单数</th>
                            <th>在线支付</th>
                            <th data-hide="all">成交金额</th>
                            <th data-hide="all">订单成本</th>
                            <th data-hide="all">提成</th>
                            <th data-hide="all">操作</th>
                        </tr>
                        </thead>

                        <tbody>

                            <?php foreach($day_data as $key=>$val){ ?>
                                <?php if(isset($val['code'])){ ?>
                                    <tr>
                                        <td><?php echo ($year); ?>年<?php echo ($month); ?>月<?php echo ($key); ?>日</td>
                                        <td colspan="6" align="center">
                                            这天没有订单
                                        </td>
                                    </tr>
                                <?php }else{ ?>
                                    <tr>
                                        <td><?php echo ($year); ?>年<?php echo ($month); ?>月<?php echo ($key); ?>日</td>
                                        <td><?php echo count($val); ?>笔订单</td>
                                        <td>
                                            <?php $amount_order_price = 0; $real_order_price = 0; $cost_order_price = 0; for($l=0;$l<count($val);$l++){ $amount_order_price += $val[$l]['payprice']; $real_order_price += $val[$l]['order_real_price']; $cost_order_price += $val[$l]['order_cost_price']; } echo $amount_order_price; ?>元
                                        </td>
                                        <td><?php echo ($real_order_price); ?>元</td>
                                        <td><?php echo ($cost_order_price); ?>元</td>
                                        <td>
                                            <?php echo ($real_order_price - $cost_order_price)*$point; ?>元
                                        </td>
                                        <td>
                                            <button  value="" onclick="showOrder('<?php echo ($year); ?>-<?php echo ($month); ?>-<?php echo ($key); ?>','<?php echo ($_GET['agent_id']); ?>');"  type="button" class="btn btn-primary order_button" data-toggle="modal" data-target="#myModal2">
                                                订单详情
                                            </button>
                                        </td>
                                    </tr>

                                <?php } ?>


                            <?php } ?>
                        <!--<tr>
                            <td>2017年8月8日</td>
                            <td colspan="5" align="center">
                                这天没有订单
                            </td>
                        </tr>-->



                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">
                                <ul class="pagination pull-right"></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!--   窗口数据1 start -->

    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <i class="fa fa-laptop modal-icon"></i>
                    <h4 class="modal-title">订单详情</h4>
                    <small id="order_date1" class="font-bold">2017年02月11日</small>
                </div>
                <div class="modal-body">
                    <div >
                        <table class="table">
                            <tbody>
                            <tr id="order_detail_body1">
                                <td>订单号</td>
                                <td>购买者</td>
                                <td>订单金额</td>
                                <td>是否付款</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary">确定</button>
                </div>
            </div>
        </div>
    </div>
    <!--   窗口数据1 end -->

    <!--   窗口数据2 start -->
    <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <i class="fa fa-laptop modal-icon"></i>
                    <h4 class="modal-title">订单详情</h4>
                    <small id="order_date" class="font-bold">2017年02月11日</small>
                </div>
                <div class="modal-body">
                    <div >
                        <table class="table">
                            <tbody>
                            <tr id="order_detail_body2">
                                <td>订单号</td>
                                <td>购买者</td>
                                <td>电话</td>
                                <td>押金</td>
                                <td>总金额</td>
                                <td>是否付款</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary">确定</button>
                </div>
            </div>
        </div>
    </div>
    <!--   窗口数据2 end -->

    <!--   数据开始 end -->
</div>

<script src="/Public/Admin/statistic/bootstrap/js/config.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/jquery.min.js?v=2.1.4"></script>
<script src="/Public/Admin/statistic/bootstrap/js/bootstrap.min.js?v=3.3.5"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/flot/jquery.flot.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/demo/peity-demo.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/content.min.js?v=1.0.0"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/easypiechart/jquery.easypiechart.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/demo/sparkline-demo.min.js"></script>


<script src="/Public/Admin/statistic/bootstrap/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/jsKnob/jquery.knob.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/prettyfile/bootstrap-prettyfile.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/nouslider/jquery.nouislider.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/switchery/switchery.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/iCheck/icheck.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/clockpicker/clockpicker.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/cropper/cropper.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/demo/form-advanced-demo.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/footable/footable.all.min.js"></script>


<script>
    $(document).ready(function(){
        $(".chart").easyPieChart({
            barColor:"#f8ac59",
            scaleLength:5,
            lineWidth:4,
            size:80
        });
        $(".chart2").easyPieChart({
            barColor:"#1c84c6",
            scaleLength:5,
            lineWidth:4,
            size:80
        });
//        var data2 = <?php ?>//;
        var data2 = <?php echo ($float_data); ?>;
        /*var data2=[
         [gd(2017,1,1),7], [gd(2017,1,2),6], [gd(2017,1,3),4],
         [gd(2017,1,4),8], [gd(2017,1,5),9], [gd(2017,1,6),7],
         [gd(2017,1,7),5], [gd(2017,1,8),4], [gd(2017,1,9),7],
         [gd(2017,1,10),8], [gd(2017,1,11),9], [gd(2017,1,12),6],
         [gd(2017,1,13),4], [gd(2017,1,14),5], [gd(2017,1,15),11],
         [gd(2017,1,16),8], [gd(2017,1,17),8], [gd(2017,1,18),11],
         [gd(2017,1,19),11], [gd(2017,1,20),6], [gd(2017,1,21),6],
         [gd(2017,1,22),8], [gd(2017,1,23),11], [gd(2017,1,24),13],
         [gd(2017,1,25),7], [gd(2017,1,26),9], [gd(2017,1,27),9],
         [gd(2017,1,28),8], [gd(2017,1,29),5], [gd(2017,1,30),8],
         [gd(2017,1,31),25]
         ];*/
        var data3 = <?php echo ($amount_data); ?>;

        /*var data3=[
         [gd(2017,2,1),0],[gd(2017,2,2),0],[gd(2017,2,3),0],
         [gd(2017,2,4),700],[gd(2017,2,5),0],[gd(2017,2,6),456],
         [gd(2017,2,7),800],[gd(2017,2,8),0],[gd(2017,2,9),467],
         [gd(2017,2,10),876],[gd(2017,2,11),689],[gd(2017,2,12),700],
         [gd(2017,2,13),500],[gd(2017,2,14),600],[gd(2017,2,15),700],
         [gd(2017,2,16),786],[gd(2017,2,17),345],[gd(2017,2,18),888],
         [gd(2017,2,19),888],[gd(2017,2,20),888],[gd(2017,2,21),987],
         [gd(2017,2,22),444],[gd(2017,2,23),999],[gd(2017,2,24),567],
         [gd(2017,2,25),786],[gd(2017,2,26),666],[gd(2017,2,27),888],
         [gd(2017,2,28),900]
         ];*/

        var dataset=[
            {
                label:"订单金额",// 图形中所包含的数据名字
                data:data3,     // 数据[gd(a,b,c)//位置X,800//数值Y]
                color:"#1ab394", //颜色
                bars:{ // bars 条形图
                    show:true, // 是否展示 如果不展示默认为线条
                    align:"center", // 位置 中间
                    barWidth:24*60*60*600, //按一天的时间算的宽度 最小单位为毫秒
                    lineWidth:0 //条形图的边框宽度
                }
            },
            {
                label:"订单数量", // 第二个数据 标题
                data:data2,     // 数据
                yaxis:2,    // Y刻度
                color:"#464f88",//线的颜色
                lines:{     //lines// 线
                    lineWidth:1, //线的宽度
                    show:true,// 是否展示
                    fill:true,//是否填充饼
                    fillColor:{
                        colors:[
                            {opacity:0.2},
                            {opacity:0.2}
                        ]
                    }
                },
                splines:{  // 是否以弧线形式显示
                    show:false,
                    tension:0.6,
                    lineWidth:1,
                    fill:0.1}
            }
        ];
        var options={
            xaxis:{
                mode:"time", // 必须以时间格式显示数据
                tickSize:[3,"day"], // X轴 刻度 3天
                tickLength:0,       // 刻度的宽度
                axisLabel:"Date",   // 设置类型
                axisLabelUseCanvas:true, //是否启用画布
                axisLabelFontSizePixels:12, //字体12
                axisLabelFontFamily:"Arial", //字体family
                axisLabelPadding:10,color:"red" //颜色
            },
            yaxes:[     // Y轴的刻度
                {
                    position:"left", //位置
                    max:20000,color:"#838383", // 最大刻度
                    axisLabelUseCanvas:true, //是否启用画布
                    axisLabelFontSizePixels:12, //字体大小
                    axisLabelFontFamily:"Arial", //
                    axisLabelPadding:3 //
                },
                {
                    position:"right",
                    max:35,
                    clolor:"#838383",
                    axisLabelUseCanvas:true,
                    axisLabelFontSizePixels:12,
                    axisLabelFontFamily:" Arial",
                    axisLabelPadding:67
                }
            ],
            legend:{  // 图标说明
                noColumns:1, // 1 时 为上下排列 0 时 为左右一排
                labelBoxBorderColor:"#000000", //边框颜色
                position:"nw"       // 位置 north  west  east south
            },
            grid:{          //网格
                hoverable:true, // 是否开启鼠标移入事件
                borderWidth:0, //边框宽度
                color:"#838383"
            },
            tooltip: true,
            tooltipOpts: {
                content: "日期: %x号, %s: %y" // %s dataset 中的label 标题 %x X轴数据 %y Y轴数据
            }
        };
        function gd(year,month,day){
            return new Date(year,month-1,day+1).getTime()
        }
        var previousPoint=null,previousLabel=null;
        $.plot($("#flot-dashboard-chart"),dataset,options);

        var mapData={
            "US":298,"SA":200,"DE":220,"FR":540,"CN":120,"AU":760,"BR":550,"IN":200,"GB":120
        };
        // 世界地图
        $("#world-map").vectorMap({
            map:"world_mill_en",
            backgroundColor:"transparent",
            regionStyle:{
                initial:{
                    fill:"#e4e4e4",
                    "fill-opacity":0.9,
                    stroke:"none",
                    "stroke-width":0,
                    "stroke-opacity":0
                }
            },
            series:{
                regions:[
                    {
                        values:mapData,
                        scale:["#1ab394","#22d6b1"],
                        normalizeFunction:"polynomial"}
                ]
            }
        })
    });
    // 获取一天数据的详情
    function showOrder(date,agent_id){
        console.log(date);
        $.ajax({
            url:AdminUrl+"Statisti/get_one_day/",
            type:"GET",
            data:{"agent_id":agent_id,"date":date},
            success:function(msg){
                console.log(msg);
                $(".order_detail_tr").remove();
                $("#order_date").text(date)
                if(msg.code == 200){
//                    alert("有数据");
                    for(var i=0;i<msg.data.length;i++){
                        if(msg.data[i]['ispay'] == 1){
                            var pay_state = '<span class=\"btn btn-info\">已付款</span>'; // 深蓝色
                        }else{
                            var pay_state = '<span class=\"btn btn-warning\">未付款</span>';     //黄色
                        }
                        $("#order_detail_body2").after("<tr class='order_detail_tr'><td>"+msg.data[i]['id']+i+"</td><td>"+msg.data[i]['vipname']+"</td><td>"+msg.data[i]['vipmobile']+"</td><td>"+msg.data[i]['payprice']+"</td><td>"+msg.data[i]['order_real_price']+"</td><td>"+pay_state+"</td></tr>");
                    }
                }else{
                    alert(msg.msg);
                }

            },
            error:function(){
                console.log("http error");
            }
        });

    }

    function getOneDayData(name,value,store_id){
        console.log(value);
        var AgentUrl = "http://"+window.location.host+"/agent";
        $.ajax({
            url:AgentUrl+"/index.php?act=store&op=getOneDay",
            type:"GET",
            data:{"date":value,"store_id":store_id},
            success:function(msg){
                if(msg.code == 200){
                    $(".order_detail_tr").remove();
                    for(var i=0;i<msg.data.length;i++){
                        var order_state = '已完成';
                        console.log(parseInt(msg.data[i]['order_state']));
                        switch (parseInt(msg.data[i]['order_state'])){
                            case 0:
                                //0(已取消)10(默认):未付款;20:已付款;30:已发货;40:已收货;
                                order_state = '<span class=\"btn btn-danger\">已取消</span>';  //红色
                                break;
                            case 10:
                                order_state = '<span class=\"btn btn-warning\">未付款</span>';     //黄色
                                break;
                            case 20:
                                order_state = '<span class=\"btn btn-info\">已付款</span>'; // 深蓝色
                                break;
                            case 30:
                                order_state = '<span class=\"btn btn-primary\">已发货</span>'; // 浅蓝色
                                break;
                            case 40:
                                order_state = '<span class=\"btn btn-success\">已收货</span>';  // 绿色
                                break;
                        }
                        $(name).after("<tr class='order_detail_tr'><td>"+msg.data[i]['order_sn']+i+"</td><td>"+msg.data[i]['buyer_name']+"</td><td>"+msg.data[i]['order_amount']+"</td><td>"+order_state+"</td></tr>");
                    }
                    $("#order_date").html(msg.date);
                }else{
                    $(name).html("<strong>无订单数据</strong>");
                }

            },
            error:function(){
                console.log('请求失败');
            }

        });
    }
    // 通过 自选日期 获取数据
    function getDataByDate(){
        console.log("<?php echo $_GET['month']; ?>");
        var now_month = "<?php echo $_GET['month']; ?>";
        now_month = parseInt(now_month);
        var date_arr = $("input[name='date_choose']").val().split("-");
        console.log(date_arr);
        var new_year = parseInt(date_arr[0]);
        var new_month = parseInt(date_arr[1]);
        console.log(new_month);
        window.location.href = AdminUrl+"statisti/calc_order/agent_id/<?php echo ($_GET['agent_id']); ?>/year/"+new_year+"/month/"+new_month;

    }
</script>
<!--<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>-->
</body>

</html>