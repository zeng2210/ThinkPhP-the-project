<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>产品修改审核</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/html/css/plugins/chosen/chosen.css" rel="stylesheet">
    <!-- Data Tables -->
    <link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <style type="text/css">
        body {
            color: black;
        }
        .hiddenDiv{
            display: none;
        }
        a{
            border: none!important;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content tab-content">
                    <form class="form-inline">
                        <label for="">根据审核状态筛选</label>
                        <select name="" class="form-control auditStatusSelect">
                            <option value="1">未审核</option>
                            <option value="2">审核通过</option>
                            <option value="3">审核未通过</option>
                        </select>
                        <label for="">根据类型筛选</label>
                        <select name="" class="form-control actionTypeSelect">
                            <option value="all">全部</option>
                            <option value="1">物料修改</option>
                            <option value="2">新物料添加</option>
                        </select>
                    </form>
                    <table id="productAuditTable" class="table table-striped table-bordered table-full-width" width="100%">
                        <thead>
                        <tr>
                            <th>产品名称</th>
                            <th>产品型号</th>
                            <th>修改人</th>
                            <th>申请时间</th>
                            <th>内容</th>
                            <th>状态</th>
                            <th>类型</th>
                            <th>审核人</th>
                            <th>查看</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/Public/html/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/html/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/Public/html/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script>

var productAuditTable = $('#productAuditTable').DataTable({
    serverSide: true,
    ajax: {
        type: 'post',
        data: {
            mySearch: {
                auditor_id: 'myID',
                action_type: auditType,
                audit_status: auditStatus
            }
        }
    },
    order:[[3,'desc']],
    columns: [
        {data: 'newproduct_number',searchable:true},
        {data: 'product_name',searchable:false},
        {data: 'changemanname',searchable:false},
        {data: 'create_time',searchable:false},
        {data: 'info',searchable:false,orderable:false},
        {
            data: 'audit_status', searchable: false, render: function (data) {
                var arr = ['', '未审核', '审核通过', '审核不通过'];
                return arr[+data];
            }
        },
        {
            data: 'action_type', searchable: false, render: function (data) {
                var arr = ['', '修改', '添加'];
                return arr[+data];
            }
        },
        {data: 'auditor_name',searchable:false},
        {data: null,render:function (data,type,row) {
                return "<button class='btn btn-success btn-outline btn-xs info' data-id='"+row.id+"' type='button'>审核</button>"
            } ,orderable: false}
    ]
});
var auditStatus = $('.auditStatusSelect').val();
$('.auditStatusSelect').on('change', function () {
    auditStatus = $(this).val();
    productAuditTable.settings()[0].ajax.data.mySearch.audit_status = auditStatus;
    productAuditTable.ajax.reload(null, false);
});
var auditType = $('.actionTypeSelect').val();
$('.actionTypeSelect').on('change', function () {
    auditType = $(this).val();
    productAuditTable.settings()[0].ajax.data.mySearch.action_type = auditType;
    productAuditTable.ajax.reload(null, false);
});
var urlMap = ['','patchEditProductRequest', 'patchAddProductRequest'];
var confirmInfo = ['','是否通过修改申请', '是否通过添加申请'];
$('#productAuditTable').on('click', '.info', function () {
    auditType = productAuditTable.row($(this).parents('tr')).data().action_type;
    var data2 = productAuditTable.row($(this).parents('tr')).data();
    console.log(data2);
    var id = $(this).attr('data-id');
    var actionTypeUrl = urlMap[auditType];
    layer.confirm(confirmInfo[auditType], {
        btn: ['是','否'] //按钮
    }, function(){
        $.ajax({
            type : "post",
            url : actionTypeUrl,
            data : {
                status : 2,
                id : id
            },
            success : function (res) {
                if (res.status > 0) {
                    layer.msg(res.msg, {icon: 4, time: 1500, shade: 0.1}, function (index) {
                        layer.close(index);
                    });
                } else {
                    layer.msg(res.msg, {icon: 5, time: 1500, shade: 0.1}, function (index) {
                        layer.close(index);
                    });
                    return false;
                }
            }
        });
    }, function(){
        $.ajax({
            type : "post",
            url : actionTypeUrl,
            data : {
                status : 3,
                id : id
            },
            success : function (res) {
                if (res.status > 0) {
                    layer.msg(res.msg, {icon: 4, time: 1500, shade: 0.1}, function (index) {
                        layer.close(index);
                    });
                } else {
                    layer.msg(res.msg, {icon: 5, time: 1500, shade: 0.1}, function (index) {
                        layer.close(index);
                    });
                    return false;
                }
            }
        });
    });
});

</script>
</body>
</html>