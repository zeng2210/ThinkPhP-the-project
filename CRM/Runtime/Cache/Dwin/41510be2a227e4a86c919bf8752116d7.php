<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加客户联系记录</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.6/theme-chalk/index.css" rel="stylesheet">

    <style>
        body{
            color:black;
        }
        .selected{
            background: #d0d27e!important;
        }
        .el-table thead{
            color:black!important;
        }

        .el-table td, .el-table th{
            padding-top: 2px!important;
            padding-bottom: 2px!important;
        }
        .el-pagination__jump{
            color:black!important;
        }

        td{
            cursor: pointer!important;
        }

    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <input type="text" name="cusName" id="cusNameForSearch">
            <span>(数据库内客户搜索，支持客户名称查询)</span>
            <table class="table table-striped table-bordered table-hover custable">
                <thead>
                <tr>
                    <th>客户名称</th>
                    <th>行业</th>
                    <th>客户负责人</th>
                    <th>客户创建时间</th>
                </tr>
                </thead>
                <tbody id="listof">
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="/Public/html/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/vue.js"></script>
<script src="/Public/html/js/jquery.form.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/html/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/Public/html/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/Public/html/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.6/index.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script src="/Public/html/js/dwin/customer/common_func.js"></script>
<script>
    var table = $(".custable").DataTable({
        'autoWidth': false
    });
    $(".custable tbody").on('click', 'tr', function () {
        var id = $(this).attr('data')
        var index = layer.open({
            type: 2,
            title: '添加联系记录',
            content: 'addContactRecords?cusId=' + id,
            area: ['90%', '90%'],
            shadeClose:true,
        })
    })
    var controller = "/Dwin/Customer";
</script>
<script src="/Public/html/js/dwin/customer/business_aud.js"></script>
</body>
</html>