<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header bg-blue">
                <i class="widget-icon fa fa-arrow-down"></i>
                <span class="widget-caption">员工列表</span>
                <div class="widget-buttons">
                    <a href="#" data-toggle="maximize">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a href="#" data-toggle="collapse">
                        <i class="fa fa-minus"></i>
                    </a>
                    <a href="#" data-toggle="dispose">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="table-toolbar">
                    <a href="<?php echo U('Admin/Employee/employeeSet/');?>" class="btn btn-primary" data-loader="App-loader" data-loadername="设置分组">
                        <i class="fa fa-plus"></i>新增员工
                    </a>
                    <div class="pull-right">
                        <form id="App-search">
                            <label style="margin-bottom: 0px;">
                                <input name="name" type="search" class="form-control input-sm" value="<?php echo ($name); ?>">
                            </label>
                            <a href="<?php echo U('Admin/Employee/employeeList/');?>" class="btn btn-success" data-loader="App-loader" data-loadername="管理员列表" data-search="App-search">
                                <i class="fa fa-search"></i>搜索
                            </a>
                        </form>
                    </div>
                </div>
                <table id="App-table" class="table table-bordered table-hover">
                    <thead class="bordered-darkorange">
                        <tr role="row">
                            <th>ID</th>
                            <th>会员号</th>
                            <th>昵称</th>
                            <th>登陆名</th>
                            <th>手机号</th>
                            <th>权重</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($cache)): $i = 0; $__LIST__ = $cache;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="item<?php echo ($vo["id"]); ?>">
                                <td class=" sorting_1"><?php echo ($vo["id"]); ?></td>
                                <td class=" "><?php echo ($vo["vipid"]); ?></td>
                                <td class=" "><?php echo ($vo["nickname"]); ?></td>
                                <td class=" "><?php echo ($vo["username"]); ?></td>
                                <td class=" "><?php echo ($vo["mobile"]); ?></td>
                                <td class=" "><?php echo ($vo["weight"]); ?></td>
                                <td class=" "><?php echo ($vo["createtime"]); ?></td>
                                <td class="center ">
                                    <a href="<?php echo U('Admin/Employee/employeeSet/',array('id'=>$vo['id']));?>" class="btn btn-success btn-xs" data-loader="App-loader" data-loadername="员工设置"><i class="fa fa-edit"></i> 编辑</a>
                                    <a href="<?php echo U('Admin/Employee/employeeList/');?>" class="btn btn-danger btn-xs" data-type="del" data-ajax="<?php echo U('Admin/Employee/employeeDel',array('id'=>$vo['id']));?>"><i class="fa fa-trash-o"></i> 删除</a>
                                    <?php if(($vo["vipid"]) == "0"): ?><a href="javascript:;" class="btn btn-info btn-xs" data-id="<?php echo ($vo["id"]); ?>" onclick="showQrcode(this);"><i class="glyphicon glyphicon-resize-small"></i> 绑定</a>
                                        <?php else: ?>
                                        <a href="javascript:;" class="btn btn-info btn-xs" data-id="<?php echo ($vo["id"]); ?>" onclick="showQrcode(this);"><i class="glyphicon glyphicon-resize-small"></i> 重绑</a>
                                        <a href="<?php echo U('Admin/Employee/employeeList/');?>" class="btn btn-warning btn-xs" data-type="del" data-content="确定解绑，解绑后需重新绑定" data-ajax="<?php echo U('Admin/Employee/unbindVip',array('eid'=>$vo['id']));?>"><i class="glyphicon glyphicon-resize-full"></i> 解绑</a><?php endif; ?>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                <div class="row DTTTFooter">
                    <?php echo ($page); ?>
                </div>
            </div>
            <div id="dialog" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content widget">
                        <div class="widget-header bg-gold modal-header">
                            <span class="widget-caption"><h5>员工-会员 绑定二维码</h5></span>
                            <div class="widget-buttons">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                        </div>
                        <div class="modal-body" >
                        <center>
                            <img id="qrcode" style="width:70%;" src="" />
                            </center>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="pull-right btn btn-primary span2" data-dismiss="modal">关闭</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--面包屑导航封装-->
<div id="tmpbread" style="display: none;"><?php echo ($breadhtml); ?></div>
<script type="text/javascript">
setBread($('#tmpbread').html());
</script>
<!--/面包屑导航封装-->
<!--全选特效封装/全部删除-->
<script type="text/javascript">
//全选
var checkall = $('#App-table .App-checkall');
var checks = $('#App-table .App-check');
var trs = $('#App-table tbody tr');
$(checkall).on('click', function() {
    if ($(this).is(":checked")) {
        $(checks).prop("checked", "checked");
    } else {
        $(checks).removeAttr("checked");
    }
});
$(trs).on('click', function() {
    var c = $(this).find("input[type=checkbox]");
    if ($(c).is(":checked")) {
        $(c).removeAttr("checked");
    } else {
        $(c).prop("checked", "checked");
    }
});
//全删
$('#App-delall').on('click', function() {
    var checks = $(".App-check:checked");
    var chk = '';
    $(checks).each(function() {
        chk += $(this).val() + ',';
    });
    if (!chk) {
        $.App.alert('danger', '请选择要删除的项目！');
        return false;
    }
    var toajax = "<?php echo U('Admin/Employee/employeeDel');?>" + "/id/" + chk;
    var funok = function() {
        var callok = function() {
            //成功删除后刷新
            $('#refresh-toggler').trigger('click');
            return false;
        };
        var callerr = function() {
            //拦截错误
            return false;
        };
        $.App.ajax('post', toajax, 'nodata', callok, callerr);
    }
    $.App.confirm("确认要删除吗？", funok);
});
</script>
<script>
function showQrcode(o) {
    var eid = $(o).data('id');
    var url = "<?php echo U('Admin/Employee/getqrcode');?>" + "/eid/" + eid;
    $("#qrcode")[0].src=url;
    $('#dialog').modal('show');
}
</script>
<!--/全选特效封装-->