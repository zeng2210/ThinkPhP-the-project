<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>客户满意度调查-数据表格</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
        <link href="/Public/html/css/plugins/chosen/chosen.css" rel="stylesheet">
    <!-- Data Tables -->
    <link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <style type="text/css">
        body {  color: black;  }
        tbody td{  cursor:pointer;  }
	.cus-24{ color:red;}
	.selected{
            background-color: yellow !important;
        }
    .chosen-customer-type {
        color : blue;
    }
    .ibox-title {
        padding-top: 7px;
    }
    .chosen-select{
        width : 100%;
    }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>满意度调查管理</h5>
                    <div class="ibox-tools">
                        <button class="btn btn-primary btn-xs" id="get-random">满意度调查抽取客户</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row m-b-sm m-t-sm">
                        <div class="col-md-1">
                            <button type="button" id="reloading-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> 刷新</button>
                        </div>
                    </div>
                    <div class="project-list">
                        <table class="table table-hover dataTables-Callback">
                            <thead>
                            <tr>
                                <th>回访进度</th>
                                <th>客服专员</th>
                                <th>进度</th>
                                <th>满意度调查分配时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="project-status">
                                        <span class="label label-primary"><?php echo ($vol["status"]); ?></span>
                                    </td>
                                    <td class="project-title">
                                        <p><?php echo ($vol["name"]); ?></p>
                                    </td>
                                    <td class="project-completion">
                                        <p>当前进度： <?php echo ($vol["a"]); ?>（<span style="color:red;"><?php echo ($vol["done"]); ?></span> / <?php echo ($vol["total"]); ?>）</p>
                                        <div class="progress progress-mini">
                                            <div style="width: <?php echo ($vol["a"]); ?>;" class="progress-bar"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo (date('Y-m-d',$vol["assign_time"])); ?>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/Public/html/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/html/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/Public/html/js/demo/form-advanced-demo.min.js"></script>
<script src="/Public/html/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/Public/html/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/Public/html/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="/Public/html/js/dwin/customer/common_func.js"></script>
<script>
    var controller = "/Dwin/OnlineService";
    var reloadBtn = $("#reloading-btn");
    var randBtn   = $("#get-random");
    var dataTablesCallback = $(".dataTables-Callback");
    var oTables;
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        oTables = dataTablesCallback.dataTable();
    }); //inintTable END
    reloadBtn.on('click', function (){
        window.location.reload();
    });
    randBtn.on('click', function () {
        $.ajax({
            type : 'post',
            data : {
                flag : 1
            },
            url : controller + "/getCusCallback",
            success : function (msg) {
                if (msg['status'] == 200) {
                    layer.msg(msg['msg'] + "&emsp;开始抽取客户", function () {
                        $.ajax({
                           type : 'post',
                            data : {
                               flag : 2
                            },
                            url : controller + "/getCusCallback",
                            success : function (ajaxData) {
                                layer.msg(ajaxData['msg']);
                            }
                        });
                    });
                } else {
                    layer.confirm(msg['msg'],
                        {
                          icon:4
                        },
                        function(){
                        layer.msg("1s后开始重新抽取，请等待抽取结果",
                            {
                                icon : 4,
                                time : 1000
                            }, function () {
                                $.ajax({
                                    type : 'post',
                                    data : {
                                        flag : 2
                                    },
                                    url : controller + "/getCusCallback",
                                    success : function (ajaxData2) {
                                        layer.msg(ajaxData2['msg']);
                                    }
                                });
                            });
                    },function () {
                            layer.msg("取消");
                        }
                    );
                }
            }
        })
    });
</script>
</body>
</html>