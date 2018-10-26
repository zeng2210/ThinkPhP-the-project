<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>公司员工列表-数据表格</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <!-- Data Tables -->
    <link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <style type="text/css">
        body {
            color : black;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>客户信息查询</h5>
                    <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                </div>
                <div class="ibox-content">
                    <input type="text" name="cusName" id="cusNameForSearch">
                    <span>(支持客户名称模糊检索)</span>

                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <th>客户编号</th>
                            <th>客户名称</th>
                            <th>行业</th>
                            <th>客户负责人</th>
                            <th>客户创建时间</th>
                            <th>售后记录</th>
                        </tr>
                        </thead>
                        <tbody id="listof">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/Public/Admin/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/html/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/Public/html/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script>
    $(document).ready(function()
    {
        $(".dataTables-example").dataTable({
            'bFilter' : false,
            'bLengthChange' : false,
            'bSort' : false,
            'bInfo' :　false,
            'iDisplayLength' :　3
        });
    });

    $("#cusNameForSearch").on('keyup', function () {
        var _name = $("#cusNameForSearch").val();
         if ((_name) != "") {
         $.ajax({
             type : 'POST',
             url  : "/Dwin/SaleService/showCustomer",
             data : {
                 cusName : _name
                 },
             success : function (msg) {
                var trInner = "";
                var cid = [], cname = [], addtime =[], counts=[],keyword=[],uname=[];
                for(var i = 0; i < msg.length; i++) {
                    cid[i]     = msg[i]['cid'];
                    cname[i]   = msg[i]['cname'];
                    addtime[i] = msg[i]['addtime'];
                    counts[i]  = msg[i]['counts'];
                    keyword[i] = msg[i]['indusname'];
                    uname[i]   = msg[i]['uname'];
                    trInner   += "<tr class='btnadd' data='" + cid[i]+ "'><td>" + cid[i] + "</td><td>" + cname[i] + "</td><td>" + keyword[i] + "</td><td>" + uname[i] + "</td><td>" + addtime[i] + "</td><td>" + counts[i] +
                        "</td></tr>";
                }
                 $("#listof").html('');
                 $("#listof").append(trInner);
                 // 相关按钮功能
                 $('.btnadd').on('click',function()
                 {
                     var cid = $(this).attr('data');
                     layer.open({
                         type    : 2,
                         title   : '添加记录',
                         area    : ['100%', '100%'],
                         end     : function () {
                             location.reload();
                         },
                         content : "/Dwin/SaleService/showSaleServiceHisList/cid/" + cid //iframe的url
                     });
                 });
             }
         });
         } else {
             layer.msg(
                 "输入内容",
                 {
                     icon : 7,
                     time : 500
                 }
             );
         }
    });



</script>
</body>