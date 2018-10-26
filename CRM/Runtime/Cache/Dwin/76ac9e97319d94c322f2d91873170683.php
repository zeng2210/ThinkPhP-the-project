<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CRM--结算管理</title>
    <!--<link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">-->
    <!--<link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">-->

    <!--<link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">-->
    <!--<link href="/Public/html/css/animate.min.css" rel="stylesheet">-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Public/html/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <style type="text/css">
        body {
            color: black;
        }
        .selected{
            background-color: #2a83cf !important;
        }
        .red-set{
            color:red;
        }
        .green-set{
            color:green;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins" id="order-div">
                <div class="tabs-container">
                <div class="ibox-title">
                    <h5>业绩管理</h5>
                    <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                </div>
                <div class="ibox-content">
                    <h5><span id="statistics"></span></h5>
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">结算信息</a>
                            </li>
                            <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false" id="settle2">按业务统计</a>
                            </li>
                            <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false" id="settle3">按客户统计</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="col-sm-12" style="margin: 10px 0;">
                                        <div class="fa-hover col-sm-4 col-sm-4">
                                            <div class="col-sm-5">
                                                <label>从</label>
                                                <input id="timeLimit1" type="text" class="form-control" onclick="laydate({ istime: true,format:'YYYY-MM-DD hh:mm:ss',choose:changeData()})">
                                            </div>
                                            <div class="col-sm-5">
                                                <label>到</label>
                                                <input id="timeLimit2" type="text" class="form-control" onclick="laydate({ istime: true,format:'YYYY-MM-DD hh:mm:ss',choose:changeData()})">
                                            </div>
                                            <div>
                                                <label>时间选择</label>
                                                <button type="button" class="btn btn-success btn-sm" id="timeConfirm">确认</button>
                                            </div>
                                        </div>
                                        <!--<div class="fa-hover col-sm-4 col-sm-2">
                                            <label for="deptId">部门分组</label>
                                            <select class='form-control chosen-select  chosen-customer-type' id="deptId">
                                                <option value="">所有</option>
                                                <?php if(is_array($dept)): $i = 0; $__LIST__ = $dept;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>-->
                                        <div class="fa-hover col-sm-4 col-sm-2">
                                            <label for="staffId">业务员</label>

                                            <select class='form-control chosen-select  chosen-customer-type' id="staffId">
                                                <option value="">所有</option>
                                                <?php if(is_array($staffIds)): $i = 0; $__LIST__ = $staffIds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="table-responsive1">
                                        <table class="table table-bordered table-hover table-striped dataTables-orderList">
                                            <thead>
                                            <tr style="white-space: nowrap;"></tr>
                                            </thead>
                                            <tbody>
                                            <tr></tr>
                                            </tbody>
                                        </table>
                                        <!--   <input class="btn btn-outline btn-success" type="button" id="orderCheck" value="审核选中项" />-->
                                    </div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <div class="col-sm-12" style="margin: 10px 0;">
                                        <div class="fa-hover col-sm-4 col-sm-4">
                                            <div class="col-sm-5">
                                                <label>从</label>
                                                <input id="timeLimit2_1" type="text" class="form-control" onclick="laydate({ istime: true,format:'YYYY-MM-DD hh:mm:ss',choose:changeData()})">
                                            </div>
                                            <div class="col-sm-5">
                                                <label>到</label>
                                                <input id="timeLimit2_2" type="text" class="form-control" onclick="laydate({ istime: true,format:'YYYY-MM-DD hh:mm:ss',choose:changeData()})">
                                            </div>
                                            <div>
                                                <label>时间选择</label>
                                                <button type="button" class="btn btn-success btn-sm" id="timeConfirm2">确认</button>
                                            </div>
                                        </div>
                                        <!--<div class="fa-hover col-sm-4 col-sm-2">
                                            <label for="deptId2">部门分组</label>
                                            <select class='form-control' id="deptId2">
                                                <option value="">所有</option>
                                                <?php if(is_array($dept)): $i = 0; $__LIST__ = $dept;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>-->
                                        <div class="fa-hover col-sm-4 col-sm-2">
                                            <label for="staffId2">业务员</label>

                                            <select class='form-control chosen-select  chosen-customer-type' id="staffId2">
                                                <option value="">所有</option>
                                                <?php if(is_array($staffIds)): $i = 0; $__LIST__ = $staffIds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="table-responsive2">
                                        <table class="table table-bordered table-hover table-striped dataTables-settleList2">
                                            <thead></thead>
                                            <tbody></tbody>
                                        </table>
                                        <!--   <input class="btn btn-outline btn-success" type="button" id="orderCheck" value="审核选中项" />-->
                                    </div>
                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                    <div class="col-sm-12" style="margin: 10px 0;">
                                        <div class="fa-hover col-sm-4 col-sm-4">
                                            <div class="col-sm-5">
                                                <label>从</label>
                                                <input id="timeLimit3_1" type="text" class="form-control" onclick="laydate({ istime: true,format:'YYYY-MM-DD hh:mm:ss',choose:changeData()})">
                                            </div>
                                            <div class="col-sm-5">
                                                <label>到</label>
                                                <input id="timeLimit3_2" type="text" class="form-control" onclick="laydate({ istime: true,format:'YYYY-MM-DD hh:mm:ss',choose:changeData()})">
                                            </div>
                                            <div>
                                                <label>时间选择</label>
                                                <button type="button" class="btn btn-success btn-sm" id="timeConfirm3">确认</button>
                                            </div>
                                        </div>
                                        <!--<div class="fa-hover col-sm-4 col-sm-2">
                                            <label for="deptId3">部门分组</label>
                                            <select class='form-control' id="deptId3">
                                                <option value="">所有</option>
                                                <?php if(is_array($dept)): $i = 0; $__LIST__ = $dept;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>-->
                                        <div class="fa-hover col-sm-4 col-sm-2">
                                            <label for="staffId3">业务员</label>
                                            <select class='form-control chosen-select  chosen-customer-type' id="staffId3">
                                                <option value="">所有</option>
                                                <?php if(is_array($staffIds)): $i = 0; $__LIST__ = $staffIds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="table-responsive2">
                                        <table class="table table-bordered table-hover table-striped dataTables-settleList3">
                                            <thead></thead>
                                            <tbody></tbody>
                                        </table>
                                        <!--   <input class="btn btn-outline btn-success" type="button" id="orderCheck" value="审核选中项" />-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<script src="/Public/html/js/jquery-1.11.3.min.js"></script>-->
<!--<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>-->
<!--<script src="/Public/html/js/plugins/dataTables/jquery.dataTables.js"></script>-->
<!--<script src="/Public/html/js/plugins/dataTables/dataTables.bootstrap.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="/Public/html/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="/Public/html/js/plugins/layer/laydate/laydate.js"></script>

<script>
    var controller = "/Dwin/Customer";
    var dataTableOrderListDiv = $(".dataTables-orderList");
    var dataTableOrderList2Div = $(".dataTables-settleList2");
    var dataTableOrderList3Div = $(".dataTables-settleList3");
    var staffSel = $("#staffId");
    var timeLimit1 = $("#timeLimit1");
    var timeLimit2 = $("#timeLimit2");
    var timeConfirmBtn = $("#timeConfirm");
    var chosenSel = $(".chosen-select");
    var settleA2 = $("#settle2");
    var staffSel2 = $("#staffId2");
    var timeConfirmBtn2 = $("#timeConfirm2");
    var settleA3 = $("#settle3");
    var staffSel3 = $("#staffId3");
    var timeConfirmBtn3 = $("#timeConfirm3");
    var nowT = new Date().getTime();
    var divData = [];
    var oTables,oTables2,oTables3;
    var spanHtml = '';

    function getHtml(data)
    {
        spanHtml = "";
        if (data.order_num_all != 0) {
            spanHtml += "订单总数量：" + data.order_num_all +  "; 业绩总额：" + parseFloat(data.settle_normal_price) + "; 总出货量：" + data.product_nums;
        }
        $("#statistics").html("");
        $("#statistics").html(spanHtml);
    }
    function getDate(times, flag)
    {
        var date =  new Date(times);
        Y = date.getFullYear() + '-';
        M = (date.getMonth() + 1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
        D = date.getDate() + ' ';
        h = date.getHours() + ':';
        m = date.getMinutes() + ':';
        s = date.getSeconds();
        return flag ? Y+M+D+h+m+s : Y+M+D+"00:00:00";
    }
    function changeData() {
        oTables = dataTableOrderListDiv.DataTable();
        oTables.ajax.reload();
        divData = oTables.data().context[0].json.statistics;
        getHtml(divData);

    }
    function timeInput(nowT, se2TimeLimit)
    {
        if($("#" + se2TimeLimit + "_2").val() == "") {
            $("#" + se2TimeLimit + "_2").val(getDate(nowT, true));
            $("#" +se2TimeLimit + "_1").val(getDate(nowT - 3600*24*1000,false));
        } else {
            return false;
        }

    }
    function reloadOTables(selector)
    {
        selector.DataTable().ajax.reload();
        divData = selector.DataTable().data().context[0].json.statistics;
        console.log(divData);
        getHtml(divData);
    }

    function chosenConfig(selector)
    {
        selector.chosen({
            no_results_text: "没搜索到您想要的结果",//搜索无结果时显示的提示
            search_contains:true,   //关键字模糊搜索，设置为false，则只从开头开始匹配
            allow_single_deselect:true, //是否允许取消选择
            width:'100%'
        });
    }
    function settleData2()
    {
        if (dataTableOrderList2Div.find('thead').html().length) {
            oTables2 = dataTableOrderList2Div.DataTable();
            oTables2.ajax.reload();
        } else {
            oTables2 = dataTableOrderList2Div.DataTable({
                "destory"      : true,
                "paging"       : true,
                "autoWidth"    : false,
                "pagingType"   : "full_numbers",
                "lengthMenu"   : [10, 20, 35, 50],
                "bDeferRender" : true,
                "processing"   : true,
                "searching"    : true, //是否开启搜索
                "serverSide"   : true,//开启服务器获取数据
                "ajax"         : {  //获取数据
                    "url"   : controller + "/showPerformanceResult",
                    "type"  : 'post',
                    "data"  : {
                        "dateT"      : 2,
                        "staffLimit" : function () {
                            return document.getElementById('staffId2').value;
                        },
                        "timeLimit1" : function () {
                            return document.getElementById('timeLimit2_1').value;
                        },
                        "timeLimit2" : function () {
                            return document.getElementById('timeLimit2_2').value;
                        }
                    }
                },
                "columns" :[ //定义列数据来源
                    {'title' : "业务",     'data' : "pic_name"},
                    {'title' : "部门",       'data' : "dept"},
                    {'title' : "结算订单", 'data' : "order_num_all"},
                    {'title' : "退货",   'data' : "settle_back_price"},
                    {'title' : "预收款",   'data' : "settle_pre_price"},
                    {'title' : '业绩', 'data' : "settle_normal_price"},
                    {'title' : "退货还款", 'data' : "back_price"},
                    {'title' : "折价还款", 'data' : "sale_price"},
                    {'title' : "工资抵账", 'data' : "performance_price"},
                    {'title' : "出货量", 'data' : "product_nums"}
                ]
            });
        }
        divData = oTables2.data().context[0].json.statistics;
        getHtml(divData);
    }
    function settleData3()
    {
        if (dataTableOrderList3Div.find('thead').html().length) {
            oTables3 = dataTableOrderList3Div.DataTable();
            oTables3.ajax.reload();

        } else {
            oTables3 = dataTableOrderList3Div.DataTable({
                "destory"      : true,
                "paging"       : true,
                "autoWidth"    : false,
                "pagingType"   : "full_numbers",
                "lengthMenu"   : [10, 20, 35, 50],
                "bDeferRender" : true,
                "processing"   : true,
                "searching"    : true, //是否开启搜索
                "serverSide"   : true,//开启服务器获取数据
                "ajax"         : {  //获取数据
                    "url"   : controller + "/showPerformanceResult",
                    "type"  : 'post',
                    "data"  : {
                        "dateT"      : 3,
                        "staffLimit" : function () {
                            return document.getElementById('staffId3').value;
                        },
                        "timeLimit1" : function () {
                            return document.getElementById('timeLimit3_1').value;
                        },
                        "timeLimit2" : function () {
                            return document.getElementById('timeLimit3_2').value;
                        }
                    }
                },
                "columns" :[ //定义列数据来源
                    {'title' : "客户",     'data' : "cus_name"},
                    {'title' : "现业务",     'data' : "pic_name"},
                    {'title' : "部门",       'data' : "dept"},
                    {'title' : "结算订单", 'data' : "order_num_all"},
                    {'title' : "退货",   'data' : "settle_back_price"},
                    {'title' : "预收款",   'data' : "settle_pre_price"},
                    {'title' : "总业绩", 'data' : "settle_normal_price"},
                    {'title' : "退货还款", 'data' : "back_price"},
                    {'title' : "折价还款", 'data' : "sale_price"},
                    {'title' : "工资抵账", 'data' : "performance_price"},
                    {'title' : "出货量", 'data' : "product_nums"}
                ]
            });
        }
        divData = oTables3.data().context[0].json.statistics;
        getHtml(divData);
    }

    function changeSel(deptId,selector,dataTableDiv)
    {
        $.ajax({
            type : "post",
            data : {
                deptIdchange : deptId
            },
            url : controller + "/showPerformanceResult",
            success : function (ajaxData) {
                var htmlStaff = "";
                selector.html(htmlStaff);
                htmlStaff += "<option value=''>所有</option>";
                for (var i = 0; i < ajaxData.length; i++) {
                    htmlStaff += "<option value='" + ajaxData[i]['id'] + "'>" + ajaxData[i]['name'] + "</option>";
                }
                selector.html(htmlStaff);
                reloadOTables(dataTableDiv);
                selector.trigger('chosen:updated');
                chosenConfig(selector);
            }
        });
    }

    staffSel.on('change', function () {
        reloadOTables(dataTableOrderListDiv);
    });
    timeConfirmBtn.on('click', function () {
        changeData();
    });
    timeConfirmBtn2.on('click', function () {
        reloadOTables(dataTableOrderList2Div);
    });
    staffSel2.on('change', function () {
        reloadOTables(dataTableOrderList2Div);
    });
    timeConfirmBtn3.on('click', function () {
        reloadOTables(dataTableOrderList3Div);
    });
    staffSel3.on('change', function () {
        reloadOTables(dataTableOrderList3Div);
    });

    settleA2.on('click', function (){
        timeInput(nowT, "timeLimit2");
        settleData2();
    });
    settleA3.on('click', function (){
        timeInput(nowT, "timeLimit3");
        settleData3();
    });



    $(document).ready(function () {
        chosenConfig(staffSel);
        chosenConfig(staffSel2);
        chosenConfig(staffSel3);

        var config = {
            columnsData : [ //定义列数据来源
                {'title' : "结算日期",   'data' : 'settle_time'},
                {'title' : "客户",   'data' : "cus_name"},
                {'title' : "现业务",       'data' : "pic_name"},
                {'title' : "部门",       'data' : "dept"},
                {'title' : "产品",     'data' : "product_name"},
                {'title' : "折算数量",   'data' : "product_num"},
                {'title' : "结算金额",   'data' : "settle_price"},
                {'title' : "订单",   'data' : "order_id"},
                {'title' : "结算类型",   'data' : "settle_type"},
                {'title' : "客户付款方式",   'data' : "settlement_name"},
                {'title' : "票据", 'data' : "invoice_type"}
            ]
        }
        timeLimit2.val(getDate(nowT, true));
        timeLimit1.val(getDate(nowT - 3600*24*1000, false));
        oTables =  dataTableOrderListDiv.DataTable({
            "paging"       : true,
            "autoWidth"    : false,
            "pagingType"   : "full_numbers",
            "lengthMenu"   : [10, 20, 35, 50],
            "bDeferRender" : true,
            "processing"   : true,
            "searching"    : true, //是否开启搜索
            "serverSide"   : true,//开启服务器获取数据
            "ajax"         : {  //获取数据
                "url"   : controller + "/showPerformanceResult",
                "type"  : 'post',
                "data"  : {
                    "staffLimit" : function () {
                        return document.getElementById('staffId').value;
                    },
                    "timeLimit1" : function () {
                        return document.getElementById('timeLimit1').value;
                    },
                    "timeLimit2" : function () {
                        return document.getElementById('timeLimit2').value;
                    }
                }
            },
            "columns" :config.columnsData
        });
        divData = typeof(dataTableOrderListDiv.DataTable().data().context[0]);
        console.log(divData);
        /*var dataTableSaleResultListDiv = $(".dataTables-saleResultList");
        var oTablesSale = dataTableSaleResultListDiv.dataTable({
            "paging"       : true,
            "autoWidth"    : false,
            "pagingType"   : "full_numbers",
            "lengthMenu"   : [10, 20, 35, 50],
            "bDeferRender" : true,
            "processing"   : true,
            "searching"    : true, //是否开启搜索
            "serverSide"   : true,//开启服务器获取数据
            "ajax"         : {  //获取数据
                "url"   : controller + "/showCollectionResult",
                "type"  : 'post',
                "data"  : {
                    "staffLimit" : function () {
                        return document.getElementById('staffId2').value;
                    },
                    "deptLimit" : function () {
                        return document.getElementById('deptId2').value;
                    },
                    "timeLimit1" : function () {
                        return document.getElementById('timeLimit3').value;
                    },
                    "timeLimit2" : function () {
                        return document.getElementById('timeLimit4').value;
                    }
                }
            },
            "columns" :[ //定义列数据来源
                {'title' : "业务", 'data' : "pic_name"},
                {'title' : "所属部门", 'data' : "dept"},
                {'title' : "产品", 'data' : "product_name"},
                {'title' : "数量", 'data' : "product_num"},
                {'title' : "结算金额",   'data' : "settle_price"},
                {'title' : "结算类型",   'data' : "settle_type"},
                {'title' : "客户付款方式",   'data' : "settlement_name"}
            ]
        });*/

    });
    /**改变单元格样式
     * @param string className:datatables's className;
     * @param int    tdNum:td's index*/
    function changeCss (className, tdNum){
        $(".dataTables-" + className + " tbody").on('mouseover', 'td', function () {
            var tdIndex = $(this).parent()['context']['cellIndex'];
            if(tdNum == tdIndex) {
                $(this).addClass('selected');
                $(this).css('cursor','pointer');
            }
        });
        $(".dataTables-" + className + " tbody").on('mouseout', 'td', function () {
            $(this).removeClass('selected');
        });
    }
    /*changeCss('orderList', 4);
    $(".dataTables-orderList tbody").on('click', 'td', function (e) {
        var index = $(this)[0]['cellIndex'];
        if (index == 4) {
        e.stopPropagation();
        var id = $(this).parent().attr('id');
        layer.open({
            type: 2,
            title: '销售单据',
            area: ['100%', '100%'],
            content: controller + "/showInvoiceDetail/orderId/" + id //iframe的url
        });
        }
    });   */
    $("#exportBtn").on('click', function () {
        //询问框

        layer.confirm('确认导出excel？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.ajax({
                type : "post",
                data : {
                    flag : 1
                },
                url : controller + "/getCusStatus",
                success : function (res) {
                    if (res.status === 400) {
                        layer.msg('无权限');
                    } else {
                        layer.open({
                            type : 2,
                            title :'导出',
                            area : ['30%','30%'],
                            content:controller + "/downCusStatistics?fname=" + res.data
                        })

                    }
                }
            });
        });
    })
</script>
</body>
</html>