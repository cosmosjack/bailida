<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header bg-blue">
                <i class="widget-icon fa fa-arrow-down"></i>
                <span class="widget-caption">卖车申请</span>
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
                <a href="#" class="btn btn-danger" id="App-delall">
                        <i class="fa fa-delicious"></i>全部删除
                    </a>
                    <div class="pull-right">
                        <form id="App-search">
                            <label style="margin-bottom: 0px;">
                                <input name="name" type="search" value="<?php echo ($name); ?>" class="form-control input-sm">
                            </label>
                            <a href="<?php echo U('Admin/Shop/old/');?>" class="btn btn-success" data-loader="App-loader" data-loadername="商品" data-search="App-search">
                                <i class="fa fa-search"></i>搜索
                            </a>
                        </form>
                    </div>
                </div>
                <table id="App-table" class="table table-bordered table-hover">
                    <thead class="bordered-darkorange">
                        <tr role="row">
                            <th width="30px">
                                <div class="checkbox" style="margin-bottom: 0px; margin-top: 0px;">
                                    <label style="padding-left: 4px;">
                                        <input type="checkbox" class="App-checkall colored-blue">
                                        <span class="text"></span>
                                    </label>
                                </div>
                            </th>
                            <th>id</th>
                            <th>会员id</th>
                            <th>昵称</th>
                            <th>联系人</th>
                            <th>联系电话</th>
                            <th>车型</th>
                            <th>地址</th>
                            <th>简介</th>
                            <th>创建时间</th>
                            <th>状态</th>
                            <th>审核时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($cache)): $i = 0; $__LIST__ = $cache;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="item<?php echo ($vo["id"]); ?>">
                                <td>
                                    <div class="checkbox" style="margin-bottom: 0px; margin-top: 0px;">
                                        <label style="padding-left: 4px;">
                                            <input name="checkvalue" type="checkbox" class="colored-blue App-check" value="<?php echo ($vo["id"]); ?>">
                                            <span class="text"></span>
                                        </label>
                                    </div>
                                </td>
                                <td class=" sorting_1"><?php echo ($vo["id"]); ?></td>
                                <td class=" sorting_1"><?php echo ($vo["vipid"]); ?></td>
                                <td class=" sorting_1"><?php echo ($vo["nickname"]); ?></td>
                                <td class=" "><?php echo ($vo["link_name"]); ?></td>
                                <td class=" "><?php echo ($vo["phone"]); ?></td>
                                <td class=" "><?php echo ($vo["name"]); ?></td>
                                <td class=" "><?php echo ($vo["address"]); ?></td>
                                <td class=" "><?php echo ($vo["desc"]); ?></td>
                                <td class=" "><?php echo date('Y-m-d H:i:s',$vo['addtime']);?></td>
                                <td>
                                    <?php if ($vo['state'] == 1): ?>
                                        <span style="color: red;">未读</span>
                                    <?php else: ?>
                                        已读
                                    <?php endif ?>
                                </td>
                                <td class=" ">
                                <?php if (empty($vo['readtime'])): ?>
                                    暂无数据
                                <?php else: ?>
                                <?php echo date('Y-m-d H:i:s',$vo['readtime']);?>
                                <?php endif ?>
                                </td>
                                <td class=" ">
                                    <?php if(($vo["state"]) == "1"): ?><button class="btn btn-danger btn-xs status" data-id="<?php echo ($vo["id"]); ?>" data-str="已读" data-status="<?php echo ($vo["status"]); ?>"><i class="fa fa-arrow-down"></i>未读</button>
                                        <?php else: ?>
                                        <button class="btn btn-success btn-xs status" data-id="<?php echo ($vo["id"]); ?>" data-str="取消已读"  data-status="<?php echo ($vo["status"]); ?>"><i class="fa fa-arrow-up"></i>已读</button><?php endif; ?>
                                    <button class="btn btn-success btn-xs getlink" data-id="<?php echo ($vo["id"]); ?>"><i class="fa fa-link"></i>查看详情</button>
                                    <a href="javascript:;" class="btn btn-danger btn-xs olddel"  data-url="<?php echo U('Admin/Shop/oldDel/',array('id'=>$vo['id']));?>">
                                    <i class="fa fa-trash-o"></i> 删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                <div class="row DTTTFooter">
                    <?php echo ($page); ?>
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
    var toajax = "<?php echo U('Admin/Shop/oldDelAll');?>" + "?id=" + chk;
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
//上下架
$('.status').on('click', function() {
    var id = $(this).data('id');
    var status = $(this).data('status');
    var toajax = '<?php echo U("getOneOld");?>';
    var data = {
        'id': id,
    };
    var callok = function() {
        $('#refresh-toggler').click();;
        return false;
    };
    var callerr = function() {
        //拦截错误
        return false;
    };
    $.App.ajax('post', toajax, data, callok, callok);
});
$('.olddel').click(function(event) {
    var url = $(this).data('url');
    var callok = function() {
        $('#refresh-toggler').click();;
        return false;
    };
    var funok = function(){
        $.App.ajax('get', url,'',callok,callok);
    }
    $.App.confirm("确认要删除吗？", funok);
    

});
</script>
<!--/全选特效封装-->
<!--获取商品链接-->
<script type="text/javascript">
$('.getlink').on('click',function(){
    var id = $(this).data('id');
    $.post('<?php echo U("getOneOld");?>', {id:id,type:1}, function(data) {
          var callok = function() {
        $('#refresh-toggler').click();;
        return false;
    };
        bootbox.dialog({
            title: '详情介绍（更多信息请联系用户沟通）',
            message: data['desc'],
        	// className: "modal-darkorange",
        	buttons: {
                '操作':{
                    className:"",
                    callback:function(){
                            $.App.ajax('post', '<?php echo U("getOneOld");?>', {id:id,type:2},callok,callok);
                    }
                }
        	}
    	});
    });
	return false;
});


// bootbox.confirm({  
//         buttons: {  
//             confirm: {  
//                 label: '',  
//                 className: 'btn-myStyle'  
//             },  
//             cancel: {  
//                 label: '我是取消按钮',  
//                 className: 'btn-default'  
//             }  
//         },  
//         message: '提示信息',  
//         callback: function(result) {  
//             if(result) {  
//                 alert('点击确认按钮了');  
//             } else {  
//                 alert('点击取消按钮了');  
//             }  
//         },  
//     }); 

</script>
<!--获取商品链接-->