<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM--联系记录详情</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">

</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>新员工添加</h5>
                    <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="signupForm">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">姓名：</label>
                            <div class="col-sm-4">
                                <input id="firstname" name="firstname" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">职位：</label>
                            <div class="col-sm-4">
                                <select name="userPosition" id="userPosition" data-placeholder="选择职位" class="form-control chosen-select">
                                    <option value="">请选择</option>
                                    <?php if(is_array($postInfo)): $i = 0; $__LIST__ = $postInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">部门：</label>
                            <div class="col-sm-4">
                                <select name="department" id="userDept" data-placeholder="选择部门" class="form-control">
                                    <option value="">请选择</option>
                                    <?php if(is_array($deptInfo)): $i = 0; $__LIST__ = $deptInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo (str_repeat("&emsp;&emsp;",$vol["level"]*2)); echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">系统登录用户名：</label>
                            <div class="col-sm-4">
                                <input id="staffUName" name="staffUName" class="form-control" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">入职时间：</label>
                            <div class="col-sm-4">
                                <input id="enTime" name="enTime" class="form-control" type="text" onclick="WdatePicker( {el:this,dateFmt:'yyyy-MM-dd'} )">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-3">
                                <button class="btn btn-primary" type="button" id="addStaffSubmit">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="/Public/Admin/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/html/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/Public/html/js/demo/form-advanced-demo.min.js"></script>
<script src="/Public/html/js/dwin/WdatePicker.js"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script>
    $("#addStaffSubmit").on('click', function () {
        var userDept = $("#userDept").val();
        var userPost = $("#userPosition").val();
        var name  = $("#firstname").val();
        var staffUName = $("#staffUName").val();
        var enTime = $("#enTime").val();
        if ( name == "") { layer.alert('未填写姓名',{ icon: 5 } ); return false; }
        if ( userDept == "") { layer.alert("部门不能为空", { icon : 5 }); return false; }
        if ( userPost == "") { layer.alert("职位不能为空", { icon : 5 }); return false; }
        if ( staffUName == "") { layer.alert('登录用户名未设置', { icon : 5 }); return false; }
        if ( enTime == "") { layer.alert('请登记员工入职时间', { icon : 5 }); return false; }
        $("#addStaffSubmit").attr("disabled",'disabled');
        var indexLoad = layer.load(1, {shade : [0.1, '#fff']});
        $.ajax({
            type : 'POST',
            url  : '/Dwin/System/addStaff',
            data : {
                name : name,
                staffName : staffUName,
                enTime : enTime,
                userDept : userDept,
                userPost : userPost
            },
            success : function (msg) {
                if(msg == 1) {
                    layer.msg(
                        '提交成功',
                        {
                            icon : 6,
                            time : 1000
                        },
                        function () {
                            window.location.href = "/Dwin/System/showStaff";
                            layer.close(indexLoad);
                        }
                    );
                } else {
                    layer.alert("提交出错");
                    layer.close(indexLoad);
                    $("#addStaffSubmit").attr("disabled", false);
                    return false;

                }
            },
            error   : function (error) {
                layer.alert(error);
	 	        $("#addStaffSubmit").attr('disabled', true);
            }
        });
    });
    $('#staffUName').on('change', function () {
        var _name =  $(this).val();
        $.ajax({
            type : 'POST',
            url : "/Dwin/System/checkStaffUN",
            data : { name : _name},
            success : function (msg) {
                if (msg != 1) {
                    layer.msg(
                        '该登录名称已存在',
                        {
                            icon : 5,
                            time : 1000
                        },
                        function () {
                            $("#addStaffSubmit").attr('disabled', true);
                        }
                    );
                } else {
                    $("#addStaffSubmit").attr('disabled', false);
                }
            }
        });
    });
</script>
</body>
</html>