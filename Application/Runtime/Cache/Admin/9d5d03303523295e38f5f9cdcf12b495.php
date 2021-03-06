<?php if (!defined('THINK_PATH')) exit();?><head>
<link href="/Public/Admin/statistic/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/Public/Admin/statistic/bootstrap/css/font-awesome.min.css" rel="stylesheet">
<link href="/Public/Admin/statistic/bootstrap/css/animate.min.css" rel="stylesheet">
<link href="/Public/Admin/statistic/bootstrap/css/style.min.css" rel="stylesheet">

<script type="text/javascript" src="/Public/Admin/statistic/bootstrap/js/jquery-1.8.3.min.js"> </script>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>统计列表</title>
<meta name="keywords" content="百利达">
<meta name="description" content="百利达二手车,成就你我他">

<link rel="shortcut icon" href="favicon.ico">

<!-- Data Tables -->
<link href="/Public/Admin/statistic/bootstrap/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">


<base target="_blank">

<script src="/Public/Admin/statistic/bootstrap/js/jquery.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/bootstrap.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/content.min.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/template.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/config.js"></script>
<script src="/Public/Admin/statistic/bootstrap/js/tpl/agent_list.js"></script>
<style>
.show_span{
    font-size: 0;
    line-height: 12px;
    background-color: #EEE;
    vertical-align: middle;
    display: inline-block;
    width: 200px;
    height: 12px;
    border-radius: 6px;
    position: relative;
    z-index: 1;
    box-shadow: inset 1px 1px 1px rgba(204,204,204,1);
}
.show_em{
    /*width: 66%;*/
    border-radius: 6px;
    font-size: 0;
    line-height: 12px;
    background: url("/Public/Admin/statistic/bootstrap/img/member_pics.png") no-repeat 0 -140px;
    display: block;
    height: 12px;
    position: absolute;
    z-index: 1;
}
</style>
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>基本 <small>分类，查找</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">选项1</a>
                        </li>
                        <li><a href="#">选项2</a>
                        </li>
                        </ul>
                        <a class="close-link">
                        <i class="fa fa-times"></i>
                        </a>
                    </div>
                    </div>
                    <div class="ibox-content" >
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="tpl_data">
                            <thead>
                            <tr>
                            <th>合作商或员工</th>
                            <th class="col-sm-2">级别</th>
                            <th>上级代理人</th>
                            <th class="col-lg-1">提醒</th>
                            <th >手机</th>
                            <th>操作</th>
                            </tr>
                            </thead>
                        <tbody id="store_table_tbody">
                            <tr class="gradeX">
                                <td>jack</td>
                                <td>钻石</td>
                                <td>平台</td>
                                <td>666</td>
                                <td class="center">18825466506</td>
                                <td class="center">删除</td>

                            </tr>
                            <tr class="gradeX">
                                <td>jack</td>
                                <td>钻石</td>
                                <td>平台</td>
                                <td>666</td>
                                <td class="center">18825466506</td>
                                <td class="center">删除</td>

                            </tr>
                            <tr class="gradeX">
                                <td>jack</td>
                                <td>钻石</td>
                                <td>平台</td>
                                <td>666</td>
                                <td class="center">18825466506</td>
                                <td class="center">删除</td>

                            </tr>

                        </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>