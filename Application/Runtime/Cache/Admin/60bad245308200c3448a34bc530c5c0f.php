<?php if (!defined('THINK_PATH')) exit();?> <!--百度编辑器-->
<!--<script src="/Public/Admin/ueditor/ueditor.config.js"></script>
<script src="/Public/Admin/ueditor/ueditor.all.min.js"></script>-->
<div class="row">
     <div class="col-xs-12 col-xs-12">
          <div class="widget radius-bordered">
              <div class="widget-header bg-blue">
				<i class="widget-icon fa fa-arrow-down"></i>
				<span class="widget-caption">员工Qrcode-Background-Setting</span>
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
                   <form id="AppForm" action="<?php echo U('Wx/qrcodeBgEmpSet');?>" method="post" class="form-horizontal" enctype="multipart/form-data" target="image" data-bv-message="" data-bv-feedbackicons-valid="glyphicon glyphicon-ok" data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                    
                    <div class="form-group">
                    	<div class="col-lg-5">
							<img src="<?php echo ($img); ?>" id="imgshow">
						</div>
					</div>            		
  
					<div class="form-group">
                        <div class="col-lg-4">
                           
                             <button class="btn btn-palegreen btn-lg" id="submitimage" type="submit">Change</button>
                        </div>
                    </div>

                   	<input type="file" style="display:none" name="qrcode" id="qrcode">
					</form>
					<iframe id='image' name='image' style='display:none;'></iframe>
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
<!--表单验证与提交封装-->
<script type="text/javascript">
	// $('#AppForm').bootstrapValidator({
	// 	submitHandler: function (validator, form, submitButton) {
 //   //         	var tourl="<?php echo U('Admin/Shop/setQrcode');?>";
	// 		// var data=$('#AppForm').serialize();
	// 		// $.App.ajax('post',tourl,data,null);
	// 		// return false;
	// 		$('#AppForm').submit();
 //        },
	// });
</script>
<!--/表单验证与提交封装-->
<script type="text/javascript">
$('#imgshow').on('click',function(){
		$('#qrcode').click();
});
$('#qrcode').on('change',function(){
	$('#imgshow')[0].src = window.URL.createObjectURL($('#qrcode')[0].files[0]);	
});
$('#submitimage').on('click',function(){
	if($('#qrcode').val()==''){
		$.App.alert('danger','Select First!');
		return false;
	}
	$('#AppForm').submit();
});
 function replaceok(){
 	$.App.alert('success','Replace OK!');
 	$('#qrcode').val('');
 }
 function replaceFuck(){
 	$.App.alert('danger','Replace Failure');
 }
</script>