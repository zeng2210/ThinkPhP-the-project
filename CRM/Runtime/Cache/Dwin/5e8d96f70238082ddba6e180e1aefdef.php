<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM--添加产品</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/html/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加分类信息</h5>
                    <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="addSonDeptForm">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">新分类名称：</label>
                            <div class="col-sm-4">
                                <input id="addCategoryName" name="name" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">上级分类：</label>
                            <div class="col-sm-4">
                                <select name="id" id="parentCategory" class="form-control">
                                    <option value="">请选择</option>
                                    <?php if(is_array($screenData)): $i = 0; $__LIST__ = $screenData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo (str_repeat("&emsp;&emsp;",$vol["level"]*2)); echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <!--<div class="form-group">-->
                            <!--<label class="col-sm-3 control-label">单件业绩(元/件)：</label>-->
                            <!--<div class="col-sm-4">-->
                                <!--<input id="performance" name="performance" class="form-control" type="text" value="0">-->
                            <!--</div>-->
                        <!--</div>-->
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-3">
                                <button class="btn btn-primary" type="button" id="addCategoryButton">提交</button>
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
<script src="/Public/html/js/dwin/WdatePicker.js"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script>
$(document).on('click','#addCategoryButton',function(){
    $("#addCategoryButton").attr("disabled",'disabled');
    var newName   = $("#addCategoryName").val();
    var parentId  = $("#parentCategory option:selected").val();
    var performance  = $("#performance").val();
    if (!newName) {
        $("#addCategoryButton").attr("disabled", false);
        layer.alert("分类名称不能为空！",
            { 
                icon : 5
            }
        );
        return false;
    }
    if (!parentId) {
        $("#addCategoryButton").attr("disabled", false);
        layer.alert("未选择上级分类！",           
            { 
                icon : 5
            }
        );
        return false;    
    }
    // if (!performance) {
    //     $("#addCategoryButton").attr("disabled", false);
    //     layer.alert("不包含单件业绩请填写0！",
    //         {
    //             icon : 5
    //         }
    //     );
    //     return false;
    // }
    $.ajax({
        type : 'POST',
        url  : '/Dwin/Product/addCategory',
        data : {
            id   : parentId,
            name : newName
            // performance:performance,
        },
        success : function (msg) {
            if(msg == 1) {
                layer.msg(
                    '提交成功',
                    {
                        icon : 6,
                        time : 500
                    },
                    function () {
                        var index = parent.layer.getFrameIndex(window.name);                       
                        parent.layer.close(index);
                    }
                );
            } else {
                layer.alert("提交出错");
                $("#addCategoryButton").attr("disabled", false);
                return false;
            }
        },
        error : function (error) {
            layer.alert(error);
            $("#addCategoryButton").attr("disabled", false);
        }
    });
});
</script>
<!-- <script type="text/javascript">
    $("#newAttributeTable tbody").on("click", ".save-btn", function () {
        var id =$(this).attr("id");
        var tds = $(this).parents("tr").children();
        var sTds = tds.length;
        var lisval = [];
        for (var i = 0; i < sTds; i++) {
        if (i < sTds - 1)
                  lisval.push(tds.eq(i).children("input").val());
        else lisval.push(tds.eq(i).children("input").val())
              }
        if (i == sTds - 1) lisval.push();
        if (lisval[1] == "") {
        toNotification("警告！", "证照属性设置不能为空！", "warning");
        return false;
        } else if(lisval[1].length >10){
        toNotification("警告！", "证照属性设置不能超过十个字符！", "warning");
        return false;
        }else {
        $.each(tds, function (i, val) {
        var jqob = $(val);
        //把input变为字符串
        if (!jqob.has('i').length) {
        var txt = jqob.children("input").val();
        jqob.html(txt);
        }
                 });
        $(this).toggleClass("edit-btn fa-pencil");
        $(this).toggleClass("save-btn fa-save");
        //保存数据
        SaveData(lisval[1],id);
        }
            });
</script> -->
</body>
</html>