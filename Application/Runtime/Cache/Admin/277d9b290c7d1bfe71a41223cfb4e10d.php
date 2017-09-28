<?php if (!defined('THINK_PATH')) exit();?><style>
.left15 {
    float: left !important;
    padding-left: 15px!important;
}
</style>
<div class="row">
    <div class="col-xs-12 col-xs-12">
        <div class="widget radius-bordered">
            <div class="widget-header bg-blue">
                <i class="widget-icon fa fa-arrow-down"></i>
                <span class="widget-caption">合作商级别设置</span>
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
                <form id="AppForm" action="" method="post" class="form-horizontal" data-bv-message="" data-bv-feedbackicons-valid="glyphicon glyphicon-ok" data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">


                    <div class="form-group">
                        <label style="color: #19ba44;background-color: #000f22;text-align: center;" class="col-lg-2 control-label">白银代理</label>
                        <div class="input-group input-group-sm col-lg-2 left15">
                            <span class="input-group-addon">押金</span>
                            <input type="text" class="form-control" name="reg_score" value="<?php echo ($data["reg_score"]); ?>">
                        </div>
                        <div class="input-group input-group-sm col-lg-2 left15">
                            <span class="input-group-addon">提成点</span>
                            <input type="text" class="form-control" name="reg_exp" value="<?php echo ($data["reg_exp"]); ?>">
                        </div>
                        <label class="col-lg-0 control-label darkorange">&nbsp;&nbsp;固定提成点,尽量不要多次修改。</label>
                    </div>

                    <div class="form-group">
                        <label style="color: #1c44ba;background-color: #000f22;text-align: center;" class="col-lg-2 control-label">黄金代理</label>
                        <div class="input-group input-group-sm col-lg-2 left15">
                            <span class="input-group-addon">押金</span>
                            <input type="text" class="form-control" name="reg_score" value="<?php echo ($data["reg_score"]); ?>">
                        </div>
                        <div class="input-group input-group-sm col-lg-2 left15">
                            <span class="input-group-addon">提成点</span>
                            <input type="text" class="form-control" name="reg_exp" value="<?php echo ($data["reg_exp"]); ?>">
                        </div>
                        <label class="col-lg-0 control-label darkorange">&nbsp;&nbsp;固定提成点,尽量不要多次修改。</label>
                    </div>

                    <div class="form-group">
                        <label style="color: #ba0e0c;background-color: #000f22;text-align: center;" class="col-lg-2 control-label">铂金代理</label>
                        <div class="input-group input-group-sm col-lg-2 left15">
                            <span class="input-group-addon">押金</span>
                            <input type="text" class="form-control" name="reg_score" value="<?php echo ($data["reg_score"]); ?>">
                        </div>
                        <div class="input-group input-group-sm col-lg-2 left15">
                            <span class="input-group-addon">提成点</span>
                            <input type="text" class="form-control" name="reg_exp" value="<?php echo ($data["reg_exp"]); ?>">
                        </div>
                        <label class="col-lg-0 control-label darkorange">&nbsp;&nbsp;固定提成点,尽量不要多次修改。</label>
                    </div>

                    <div class="form-group">
                        <label style="color: #690d5f;background-color: #000f22;text-align: center;" class="col-lg-2 control-label">钻石代理</label>
                        <div class="input-group input-group-sm col-lg-2 left15">
                            <span class="input-group-addon">押金</span>
                            <input type="text" class="form-control" name="reg_score" value="<?php echo ($data["reg_score"]); ?>">
                        </div>
                        <div class="input-group input-group-sm col-lg-2 left15">
                            <span class="input-group-addon">提成点</span>
                            <input type="text" class="form-control" name="reg_exp" value="<?php echo ($data["reg_exp"]); ?>">
                        </div>
                        <label class="col-lg-0 control-label darkorange">&nbsp;&nbsp;固定提成点,尽量不要多次修改。</label>
                    </div>

                    <div class="form-group">
                        <label style="color: rgba(170, 116, 10, 0.98);background-color: #000f22;text-align: center;" class="col-lg-2 control-label">王者代理</label>
                        <div class="input-group input-group-sm col-lg-2 left15">
                            <span class="input-group-addon">押金</span>
                            <input type="text" class="form-control" name="reg_score" value="<?php echo ($data["reg_score"]); ?>">
                        </div>
                        <div class="input-group input-group-sm col-lg-2 left15">
                            <span class="input-group-addon">提成点</span>
                            <input type="text" class="form-control" name="reg_exp" value="<?php echo ($data["reg_exp"]); ?>">
                        </div>
                        <label class="col-lg-0 control-label darkorange">&nbsp;&nbsp;固定提成点,尽量不要多次修改。</label>
                    </div>

                    <div class="form-group">
                        <label style="color: #ffff00;background-color: #000f22;text-align: center;" class="col-lg-2 control-label">大神代理</label>
                        <div class="input-group input-group-sm col-lg-2 left15">
                            <span class="input-group-addon">押金</span>
                            <input type="text" class="form-control" name="reg_score" value="<?php echo ($data["reg_score"]); ?>">
                        </div>
                        <div class="input-group input-group-sm col-lg-2 left15">
                            <span class="input-group-addon">提成点</span>
                            <input type="text" class="form-control" name="reg_exp" value="<?php echo ($data["reg_exp"]); ?>">
                        </div>
                        <label class="col-lg-0 control-label darkorange">&nbsp;&nbsp;固定提成点,尽量不要多次修改。</label>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-4">
                            <button class="btn btn-primary btn-lg submit" type="submit" disabled="disabled">保存</button>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-palegreen btn-lg" type="reset">重填</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--面包屑导航封装-->
<div id="tmpbread" style="display: none;"><?php echo ($breadhtml); ?></div>
<script type="text/javascript">
setBread($('#tmpbread').html());

if ($('#isverify').val() == 1) {
    $('#verifyCheck').attr("checked", "checked");
    $('.isverify').show();
}
$('#verifyCheck').on('click', function() {
    var isverify = $('#isverify').val();
    $('#isverify').val(1 - isverify * 1);
    $('.isverify').toggle();
    $('.submit').removeAttr("disabled");
});
if ($('#isgift').val() == 1) {
    $('#giftCheck').attr("checked", "checked");
    $('.isgift').show();
}
$('#giftCheck').on('click', function() {
    var isgift = $('#isgift').val();
    $('#isgift').val(1 - isgift * 1);
    $('.isgift').toggle();
    $('.submit').removeAttr("disabled");
});
$('#AppForm').bootstrapValidator({
    submitHandler: function(validator, form, submitButton) {
        var tourl = "<?php echo U('Admin/Vip/set');?>";
        var data = $('#AppForm').serialize();
        $.App.ajax('post', tourl, data, null);
        return false;
    },
});

$('#isqiandaobtn').on('click', function() {
    var value = $(this).prop('checked') ? 1 : 0;
    $('#isqiandao').val(value);
});
$('#ispaihangbtn').on('click', function() {
    var value = $(this).prop('checked') ? 1 : 0;
    $('#ispaihang').val(value);
});
</script>