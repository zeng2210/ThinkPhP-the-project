<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="max-age=7200" />

    <title>CRM--待出库订单</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <style type="text/css">
        body {
            color: black!important;
        }
        .selected{
            background-color: #2a83cf !important;
        }
        .notSelectData{
            color:#e4393c;text-align: center;font-size: 15px
       }
        /* div.dataTables_paginate span{
            float: left;
            height: 100%;
            padding: 0.5% 2%;
            border: 1px solid #A9A9A9;
            margin: 0 1%;
        }
        div.dataTables_paginate span:nth-child(3){
            display: none
        }
        div.dataTables_paginate{
            width: 83%;
            margin-right: -21%;
        }
        div.dataTables_paginate input{
            width:12%;
            text-align: center;
            float: left;
        } */
        .styleBtu{
            background-color: #fff !important;
            border-color: #1c84c6 !important;
            color: #1c84c6 !important; 
            border-radius: 3px !important;
            height: 23px;
            padding: 1px 5px;
            font-size: inherit;
        }
        li.active > a{
            background-color: #1c84c6 !important;
            color: #fff !important;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins" id="orders">
                <div class="ibox-title">
                    <h5>待出库订单</h5>
                   <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                    <div class="ibox-content">
                        <form class="form-inline">
                            <select class='form-control styleBtu' name="orderT" id="orderT" style="width:11%; margin-right:0!important;">
                                <option value="3">所有订单</option>
                                <option value="2">待出库订单</option>
                                <option value="1">个人负责出库订单</option>
                            </select>

                            <select class='form-control styleBtu' name="orderLimit" id="orderLimit" style="width:11%; margin-right:0!important;">
                                <option value="1">正常销货单</option>
                                <option value="2">借物发货销货单</option>
                            </select>
                            <!-- <button class="btn btn-success btn-outline" type="button" id="stock-out-btn">出库单录入</button> -->
                            <button class="btn btn-success btn-outline styleBtu" style="margin-bottom: 0" type="button" id="market-out-btn"><span class="glyphicon glyphicon-plus"></span>销售出库单录入</button>
                        </form>


                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive1">
                        <table class="table table-bordered table-striped dataTables-orderTable">
                            <thead></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive1" id="detailsModel">
                        <ul class="nav nav-tabs" role="tablist" v-if="unData">
                            <li role="presentation" class="active"><a href="#audit" aria-controls="audit" role="tab" data-toggle="tab">审核日志</a></li>
                            <li role="presentation"><a href="#productionPlan" aria-controls="material" role="tab" data-toggle="tab">生产订单</a></li>
                            <li role="presentation"><a href="#productData" aria-controls="material" role="tab" data-toggle="tab">订单产品</a></li>
                            <li role="presentation"><a href="#stockOutLog" aria-controls="stock" role="tab" data-toggle="tab">出库记录</a></li>
                        </ul>
                        <div class="tab-content" v-if="unData">
                            <div role="tabpanel" class="tab-pane active" id="audit">
                                <table class="table table-striped table-bordered table-hover table-full-width dataTables-productionList" id="audit_table" >
                                    <thead>
                                    <tr>
                                        <th>变更日期</th>
                                        <th>变更内容</th>
                                        <th>变更人</th>
                                        <th>订单ID</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="v in auditorTableData" >
                                        <td>{{v.change_time || ''}}</td>
                                        <td>{{v.content || ''}}</td>
                                        <td>{{v.name || ''}}</td>
                                        <td>{{v.order_id || ''}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="productionPlan">
                                <table class="table table-striped table-bordered table-hover table-full-width dataTables-productionList">
                                    <thead>
                                    <tr>
                                        <th>创建时间</th>
                                        <th>生产单号</th>
                                        <th>生产线</th>
                                        <th>物料型号</th>
                                        <th>生产数量</th>
                                        <th>备库方式</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="v in productionPlanTableData">
                                        <td>{{v.create_time || ''}}</td>
                                        <td>{{v.production_order || ''}}</td>
                                        <td>{{v.production_line_name || ''}}</td>
                                        <td>{{v.product_name || ''}}</td>
                                        <td>{{v.production_plan_number || ''}}</td>
                                        <td>{{v.stock_cate_name || ''}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="productData">
                                <table class="table table-striped table-bordered table-hover table-full-width dataTables-productData">
                                    <thead>
                                    <tr>
                                        <th>单号</th>
                                        <th>产品分类</th>
                                        <th>产品名</th>
                                        <th>应发数量</th>
                                        <th>已出库数量</th>
                                        <th>待审核出库数</th>
                                        <th>出库状态</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="v in productData">
                                        <td>{{v.product_id || ''}}</td>
                                        <td>{{v.product_id || ''}}</td>
                                        <td>{{v.product_name || ''}}</td>
                                        <td>{{v.product_num || ''}}</td>
                                        <td>{{v.audit_num || ''}}</td>
                                        <td>{{v.no_audit_num || ''}}</td>
                                        <td><span v-if="v.audit_status">{{v.audit_status | productStockOutStatus}}</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="stockOutLog">
                                <table class="table table-striped table-bordered table-hover table-full-width dataTables-stockOutLog">
                                    <thead>
                                    <tr>
                                        <th>产品名</th>
                                        <th>出库单号</th>
                                        <th>出库仓库</th>
                                        <th>出库数量</th>
                                        <th>快递单号</th>
                                        <th>审核状态</th>
                                        <th>审核人</th>
                                        <th>出库人</th>
                                        <th>创建时间</th>
                                        <th>更新时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="v in stockOutLogData">
                                        <td>{{v.product_number || ''}}</td>
                                        <td>{{v.stock_out_id || ''}}</td>
                                        <td>{{v.repertory_id || ''}}</td>
                                        <td>{{v.num || ''}}</td>
                                        <td>{{v.express_no || ''}}</td>
                                        <td><span v-if="v.audit_status">{{v.audit_status | stockStatus}}</span></td>
                                        <td>{{v.audit_name || ''}}</td>
                                        <td>{{v.send_name || ''}}</td>
                                        <td>{{formatDateTime(v.create_time) || ''}}</td>
                                        <td>{{formatDateTime(v.update_time) || ''}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="notSelectData"  v-else>
                            当前您没有选中数据，请单击数据进行查看
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="/Public/html/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/vue.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/html/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/Public/html/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/Public/html/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<!-- <script src="//cdn.datatables.net/plug-ins/1.10.19/pagination/input.js"></script> -->
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="/Public/html/js/dwin/finance/common_finance.js"></script>
<script>
    var stockOutMap = <?php echo (json_encode($stockOutMap)); ?>;
    var repMap = <?php echo (json_encode($repMap)); ?>;
    var auditMap = <?php echo (json_encode($auditMap)); ?>;
    var controller = "/Dwin/Stock";
    var orderTableDiv = $(".dataTables-orderTable");
    var orderTableTBodyDiv = $(".dataTables-orderTable tbody");
    var addOutStockLogBtn = $("#stock-out-btn");
    var addOtherFormStockBtn = $("#market-out-btn");
    var oTable;
    $(document).ready(function () {
        $.fn.dataTable.ext.errMode = 'none';
        oTable = orderTableDiv.DataTable({
            "paging"       : true,
            "autoWidth"    : false,
            "pagingType"   : "full_numbers",
            "lengthMenu"   : [10, 20, 35, 50],
            "bDeferRender" : true,
            "processing"   : true,
            "searching"    : true, //是否开启搜索
            "serverSide"   : true,//开启服务器获取数据
            "ajax"         : { // 获取数据
                "url"   : controller + "/showPendingOrderList",
                "type"  : 'post',
                'data'  : {
                    'pendingData' : function () {
                        return document.getElementById('orderT').value;
                    },
                    'orderLimit' : function () {
                        return document.getElementById('orderLimit').value;
                    }
                }
            },
            "columns" :[ //定义列数据来源
                {'title' : "订单编号",   'data' : 'cpo_id','class' : 'orderDetail'},
                {'title' : "订单类型",'data' : 'type_name'},
                {'title' : "财务审核时间",'data' : 'finance_audit_time'},
                {'title' : "业务员",     'data' : "staname"},
                {'title' : "业务员电话",  'data' : "staff_phone"},
                {'title' : "客户",       'data' : "cusname"},
                {'title' : "财务审核状态",   'data' : 'check_status_name'},
                {'title' : "出库状态",   'data' : "stock_out_status"},
                {'title' : "快递方式",   'data' : "log_type"},
                {'title' : "发货仓库",   'data' : "ware_house"},
                {'title' : "是否分批出库", 'data' : "is_batch_delivery"},
                {'title' : "生产物流备注", 'data' : "logistices_tip"}
                // 自定义列   {'title':"负责人",'data':null,'class':"align-center"}
            ],
            "columnDefs"   : [ //自定义列
                {
                    "targets" : 7,
                    "data" : "stock_out_status",
                    render : function(data, type, row) {
                        data = parseInt(data);
                        // var arr = ['未处理', '出库中', '出库完毕','未对接订单,无需处理'];
                        var html = "";
                        switch (data) {
                            case 0 :
                                html = "<span style='color:red'>";
                                break;
                            case 1 :
                                html = "<span style='color:blue'>";
                                break;
                            case 2 :
                                html = "<span style='color:green'>";
                                break;
                            default:
                                html = "<span>";
                        }
                        html += stockOutMap[data] + "</span>";
                        return html;
                    }
                },
                {
                    "targets" : 10,
                    "data" : "is_batch_delivery",
                    render : function(data, type, row) {
                        data = parseInt(data);
                        var arr = ['不分批', '分批'];
                        var html = "";
                        switch (data) {
                            case 0 :
                                html = "<span style='color:red'>";
                                break;
                            case 1 :
                                html = "<span style='color:green'>";
                                break;
                            default:
                                html = "<span>";
                        }
                        html += arr[data] + "</span>";
                        return html;
                    }
                }
            ],
            "oLanguage": {
                "sProcessing":   "处理中...",
                "sLengthMenu":   "显示 _MENU_ 项结果",
                "sZeroRecords":  "没有匹配结果",
                "sInfo":         "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                "sInfoEmpty":    "显示第 0 至 0 项结果，共 0 项",
                "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
                "sInfoPostFix":  "",
                "sSearch":       "搜索:",
                "sUrl":          "",
                "sEmptyTable":     "表中数据为空",
                "sLoadingRecords": "载入中...",
                "sInfoThousands":  ",",
                "oPaginate": {
                    "sFirst":    "首页",
                    "sPrevious": "上页",
                    "sNext":     "下页",
                    "sLast":     "末页"
                },
                "oAria": {
                    "sSortAscending":  ": 以升序排列此列",
                    "sSortDescending": ": 以降序排列此列"
                }
            }
        });
    });
    $("#orderT").on('change', function () {
        oTable.ajax.reload();
    });
    $("#orderLimit").on('change', function () {
        oTable.ajax.reload();
    });
    orderTableTBodyDiv.on('click', 'td', function (e) {
        var index = $(this)[0]['cellIndex'];
        if (index == 0) {
            e.stopPropagation();
            var id = $(this).parent().attr('id');
            if(id != undefined){
                layer.open({
                    type   : 2,
                    title  : '销售单据',
                    area   : ['100%', '100%'],
                    content: "/Dwin/Customer/showInvoiceDetail/orderId/" + id //iframe的url
                })
            }
        }
    });


    changeCss('orderTable', 0);
    // 点击高亮
    addOutStockLogBtn.on('click',function () {
        selectedID = orderTableTBodyDiv.find('.selected').attr('id');
        if (selectedID) {
            var index = layer.open({
                type: 2,
                title: '出库单录入',
                content: "addStockOut/orderId/" + selectedID,
                area: ['90%', '90%'],
                end: function () {
                    oTable.ajax.reload()
                }
            });
        }else {
            layer.alert('请选中待出库的订单');
        }
    });
    // 销售出库单录入
    addOtherFormStockBtn.on('click',function () {
        selectedID = orderTableTBodyDiv.find('.selected').attr('id');
        if (selectedID) {
            var index = layer.open({
                type: 2,
                title: '出库单录入',
                content: "/Dwin/Stock/createStockOutOrderform?id=" + selectedID,
                area: ['90%', '90%'],
                success: function () {
                    // oTable.ajax.reload()
                    oTable.draw(false);
                }
            });
        }else {
            layer.alert('请选中待出库的订单');
        }
    });
    var vm = new Vue({
        el: '#detailsModel',
        data: function () {
            return {
                unData:false,
                auditorTableData : [],
                productionPlanTableData : [],
                productData : [],
                stockOutLogData : []
            }
        },
        computed : {
        },
        watch:{
            auditorTableData:function(newValue){
                if(newValue){
                    this.unData = true
                }else{
                    this.unData = false
                }
            },
            productionPlanTableData:function(newValue){
                if(newValue){
                    this.unData = true
                }else{
                    this.unData = false
                }
            },
            productData:function(newValue){
                if(newValue){
                    this.unData = true
                }else{
                    this.unData = false
                }
            },
            stockOutLogData:function(newValue){
                if(newValue){
                    this.unData = true
                }else{
                    this.unData = false
                }
            }
        },
        methods: {
            // 时间戳转化为时间
            formatDateTime:function (timeStamp) {
                if(timeStamp != ''&&timeStamp != 0){
                    var date = new Date();
                    date.setTime(timeStamp * 1000);
                    var y = date.getFullYear();    
                    var m = date.getMonth() + 1;    
                    m = m < 10 ? ('0' + m) : m;    
                    var d = date.getDate();    
                    d = d < 10 ? ('0' + d) : d;    
                    var h = date.getHours();  
                    h = h < 10 ? ('0' + h) : h;  
                    var minute = date.getMinutes();  
                    var second = date.getSeconds();  
                    minute = minute < 10 ? ('0' + minute) : minute;    
                    second = second < 10 ? ('0' + second) : second;   
                    // return y + '-' + m + '-' + d+' '+h+':'+minute+':'+second;  
                    return y + '-' + m + '-' + d;  
                }else{
                    return ''
                }
            } 
        },
        filters : {
            stockStatus: function (status) {
                // var arr = ['', '未审核', '审核通过', '审核不通过'];
                return auditMap[status]
            },
            productStockOutStatus : function (status) {
                var arr = ['未出库','出库中','出库完毕'];
                return arr[status];
            }
        }
    });

    var selectedOrder,selectedID;

    orderTableTBodyDiv.on( 'click', 'tr', function () {
        selectedOrder = $(this).attr('id');
        oTable = orderTableDiv.DataTable();
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            oTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        $.post('showPendingOrderList',{'orderId': selectedOrder}, function (res) {
            vm.auditorTableData = res['orderRecordData'];
            vm.productionPlanTableData = res['productionPlanData'];
            vm.productData  = res['productData'];
            vm.stockOutLogData = res['stockOutData'];
            for(var i = 0 ; i < res['stockOutData'].length;i++){
                for(var j = 0 ; j < repMap.length;j++){
                    if(res['stockOutData'][i].repertory_id == repMap[j].rep_id){
                        res['stockOutData'][i].repertory_id = repMap[j].repertory_name
                    }
                }
            }
        });
    });



</script>
</html>