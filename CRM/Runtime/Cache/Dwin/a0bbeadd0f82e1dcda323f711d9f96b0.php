<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CRM--订单列表</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.6/theme-chalk/index.css" rel="stylesheet">
    <style type="text/css">
        body {
            color: black;
        }
        .selected{
            background-color: #2a83cf !important;
        }
        .dataTables-orderList th,td{
            white-space: nowrap!important;
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
        .dataTables_scrollBody thead{
            visibility: hidden;
        }
        div.dataTables_scrollBody table{
            margin-top: -18px!important;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins" id="orders">
                <div class="ibox-title">
                    <h5>客户订单列表</h5>
                    <div class="fa-hover col-md-2 col-sm-4 "><a href="javascript:;" class="changeOrder" id="order_1"><i class="fa fa-tv">待审核订单</i></a></div>
                    <div class="fa-hover col-md-2 col-sm-4 "><a href="javascript:;" class="changeOrder" id="order_2"><i class="fa fa-tv">已审核订单</i></a></div> 
                    <div class="fa-hover col-md-2 col-sm-4 "><a href="javascript:;" class="changeOrder" id="order_3"><i class="fa fa-tv">不合格订单</i></a></div>
                    <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                    <input type="hidden" name="orderType" id="orderType" value="order_1">
                    <input type="hidden" name="orderNum" id="orderNum" value="<?php echo I('get.k');?>">
                </div>
                <div class="ibox-content">
                    <div class="table-responsive1">
                        <table class="table table-bordered table-striped dataTables-orderList" id="orderTable">
                            <thead>
                            <tr>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            </tr>
                            </tbody>
                        </table>
                        <div>
                            <span id="delOrderButton"></span>
                        </div>
                    </div>
                </div>
                <div id="app">
                    <el-tabs v-model="activeName">
                        <el-tab-pane label="订单信息" name="first">
                            <el-table
                                    :data="orderRecordData"
                                    stripe
                                    border
                                    style="width: 100%">
                                <el-table-column
                                        prop="change_time"
                                        label="日期"
                                        width="180">
                                </el-table-column>
                                <el-table-column
                                        prop="content"
                                        label="内容">
                                </el-table-column>
                                <el-table-column
                                        prop="name"
                                        label="姓名"
                                        width="180">
                                </el-table-column>
                            </el-table>
                        </el-tab-pane>
                        <el-tab-pane label="产品信息" name="second">
                            <el-table
                                    :data="productData"
                                    stripe
                                    border
                                    style="width: 100%">
                                <el-table-column
                                        prop="product_name"
                                        label="产品名称">
                                </el-table-column>
                                <el-table-column
                                        prop="product_price"
                                        label="单价">
                                </el-table-column>
                                <el-table-column
                                        prop="product_num"
                                        label="数量">
                                </el-table-column>
                                <el-table-column
                                        prop="product_total_price"
                                        label="总价">
                                </el-table-column>
                            </el-table>
                        </el-tab-pane>
                        <el-tab-pane label="生产信息" name="third">
                            <el-table
                                    :data="productionPlanData"
                                    stripe
                                    border
                                    style="width: 100%">
                                <el-table-column
                                        prop="product_name"
                                        label="产品名称">
                                </el-table-column>
                                <el-table-column
                                        prop="production_status"
                                        label="生产状态">
                                </el-table-column>
                                <el-table-column
                                        prop="production_plan_number"
                                        label="计划数量">
                                </el-table-column>
                                <el-table-column
                                        prop="production_plan_rest_number"
                                        label="剩余生产数量">
                                </el-table-column>
                                <el-table-column
                                        prop="create_time"
                                        label="下单时间">
                                </el-table-column>
                                <el-table-column
                                        prop="delivery_time"
                                        label="期望交货时间">
                                </el-table-column>
                            </el-table>
                        </el-tab-pane>
                        <el-tab-pane label="出库信息" name="fourth">
                            <el-table
                                    :data="stockOutData"
                                    stripe
                                    border
                                    style="width: 100%">
                                <el-table-column
                                        prop="audit_order_number"
                                        label="出库单号">
                                </el-table-column>
                                <el-table-column
                                        prop="express_number"
                                        label="快递单号">
                                </el-table-column>
                                <el-table-column
                                        prop="product_name"
                                        label="产品名称">
                                </el-table-column>
                                <el-table-column
                                        prop="num"
                                        label="数量">
                                </el-table-column>
                                <el-table-column
                                        prop="warehouse_name"
                                        label="仓库">
                                </el-table-column>
                                <el-table-column
                                        prop="auditor_name"
                                        label="审核员">
                                </el-table-column>
                                <el-table-column
                                        prop="audit_status"
                                        label="状态">
                                </el-table-column>
                                <el-table-column
                                        prop="update_time"
                                        label="更新时间">
                                </el-table-column>
                            </el-table>
                        </el-tab-pane>
                    </el-tabs>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/Public/html/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/html/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/Public/html/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/Public/html/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="/Public/html/js/dwin/finance/common_finance.js"></script>
<script src="/Public/html/js/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.6/index.js"></script>
<script>
    var controller = "/Dwin/Finance";
    var module = "/Dwin";
    var  orderTable = $(".dataTables-orderList");
    var  orderTableTBodyDiv = $(".dataTables-orderList tbody");
    var delOrderDiv = $("#delOrderButton");
    var oTable
    $(document).ready(function () {
        console.log(module);
        oTable = orderTable.DataTable({
            "paging"       : true,
            "autoWidth"    : false,
            "pagingType"   : "full_numbers",
            "lengthMenu"   : [10, 20, 35, 50],
            "bDeferRender" : true,
            "processing"   : true,
            "searching"    : true, //是否开启搜索
            "serverSide"   : true,//开启服务器获取数据
            'scrollX'      : true,
            'scrollY'      : 400,
            'order' : [1,'desc'],
            "ajax"         : {  //获取数据
                "url"   : controller + "/showOrderList",
                "type"  : 'post',
                "data"  : {
                    "orderType": function () {
                    return document.getElementById('orderType').value;
                    },
                    'orderNum' : function () {
                    return document.getElementById('orderNum').value;
                    },
                }
            },
            "columns" :[ //定义列数据来源
                {'title' : "订单编号",   'data' : 'cpo_id'},
                {'title' : "订单时间",   'data' : 'time', 'class' : "mouseOn cusDetail"},
                {'title' : "业务员",     'data' : "staname"},
                {'title' : "订单类型", 'data' : "order_type_name"},
                {'title' : "客户名",     'data' : "cusname"},
                {'title' : "结算方式",   'data' : "settle_name"},
                {'title' : "票货情况",   'data' : "inv_situation"},
                {'title' : "付款方式",   'data' : "inv_type"},
                {'title' : "快递方式",   'data' : "log_type"},
                {'title' : "发货仓库",   'data' : "ware_house"},
                {'title' : '金额',       'data' : 'cur_num'},
                {'title' : "审核进度",   'data' : 'audit_status'},
                {'title' : "生产状态",   'data' : 'production_status'}, // 自定义列   {'title':"负责人",'data':null,'class':"align-center"}
                {'title' : "发货状态",   'data' : 'stock_status'} // 自定义列   {'title':"负责人",'data':null,'class':"align-center"}
            ],
            "columnDefs": [ //自定义列
                {
                    "targets": 12,
                    "data": 'production_status',
                    "render": function (data, type, row) {
                        var html = ['待下单','无需生产','生产中','完成'];
                        return html[data];
                    }
                },
                {
                    "targets": 13,
                    "data": 'stock_status',
                    "render": function (data, type, row) {
                        var html = ['待发货','出库中','出库完毕','未关联订单'];
                        return html[data];
                    }
                }
            ],
        });
    });
    // 点击高亮
    orderTableTBodyDiv.on( 'click', 'tr', function () {
        orderType = document.getElementById('orderType').value;
        oTable = orderTable.DataTable();
        if (orderType == "order_3") {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                oTable.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        }
    });
    orderTableTBodyDiv.on('click', 'td', function (e) {
        var index = $(this)[0]['cellIndex'];
        if (index == 0) {
            e.stopPropagation();
            var id = $(this).parent().attr('id');
            layer.open({
                type   : 2,
                title  : '销售单据',
                area   : ['100%', '100%'],
                content: controller + "/showInvoiceDetail/orderId/" + id //iframe的url
            })
        }
    });

    $(".changeOrder").on('click', function() {
        $(".changeOrder").css('color', '#337ab7');
        $(this).css('color','red');
        var kElement =  document.getElementById("orderType");
        var id = $(this).attr('id');
        kElement.value = id;
        if ( id == "order_3") {
            // 渲染按钮
            var html2 = "<input type='button' class='btn btn-outline btn-success deleteBtn' id='deleteButton' value='删除不合格订单'/>";
            delOrderDiv.html(html2);
        }

        oTable.ajax.reload();
    });
    changeCss('orderList', 0);
    changeCss('orderList', 11);
    $(".dataTables-orderList tbody").on('mouseover','td' ,function(e) {
        var index   = $(this).parent();
        var thisTd  = $(this);
        var orderId = $(this).parent()[0].id;
        var tdIndex = index['context']['cellIndex'];
        if (tdIndex == 11) {
            e.stopPropagation();
            var checkText = $(this).text();
            if (checkText == "不合格") {
                $.ajax({
                    type : 'GET',
                    url  : controller + "/showUnqualified/id/" + orderId,
                    success : function (ajaxData) {
                        var contents = "";
                        switch (tdIndex) {
                            case 11 :
                                contents = !(ajaxData) ? '未填写不合格原因' : "订单不合格原因：<br />" + (!ajaxData.deptfeedback ? "" : ajaxData.deptfeedback) + (!ajaxData.financefeedback ? "" : ajaxData.financefeedback);
                                layer.tips(contents, thisTd,
                                    {
                                        tips : [1, '#3595CC'],
                                        area : '500px'
                                    });
                                break;
                        }
                    }
                });
            } else {
                return false;
            }
        } else {
            return false;
        }
    });

    $(".dataTables-orderList tbody").on('mouseout','td' ,function(e) {
        layer.closeAll('tips');
    });
    //
    $(document).on('click', "#deleteButton", function() {
        $(this).attr('disabled', 'disabled');
        var orderId = orderTableTBodyDiv.find('.selected').attr('id');
        if (orderId) {
            $.ajax({
                type : "post",
                url  : module + '/Customer/delUnqualifiedOrder',
                data : {
                    order_id : orderId
                },
                success : function (ajaxData) {
                    layer.msg(ajaxData['msg'], {
                        time : 500
                    });
                    if (ajaxData['status'] == 200) {
                        oTable = orderTable.DataTable();
                        oTable.ajax.reload();
                    }
                    $("#deleteButton").attr('disabled', false);
                }
            });
        } else {
            layer.msg("没选中要删除的订单", {
                time : 500
            }, function () {
                $("#deleteButton").attr('disabled', false);
            });
            return false;
        }
    });
</script>
<script>
    var vm = new Vue({
        el: '#app',
        data: function () {
            return {
                activeName: 'first',
                orderRecordData: [],
                productData: [],
                productionPlanData: [],
                stockOutData: []
            }
        },
        methods: {
            getData: function () {

            }
        }
    })
    orderTableTBodyDiv.on('click', 'tr', function () {
        $('tr').removeClass('selected')
        $(this).addClass('selected')
        var obj = {}
        obj.id = oTable.row(this).data().id
        obj.cpoId = oTable.row(this).data().cpo_id
        obj.returnDataSet = ['stockOutData','productionPlanData','productData','orderRecordData']
        $.post('<?php echo U("getOrderInfo");?>', obj, function (res) {
            console.log(res);
            Object.assign(vm, res)
        })
    })
</script>
</body>
</html>