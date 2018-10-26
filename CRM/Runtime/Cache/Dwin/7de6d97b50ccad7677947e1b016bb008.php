<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM--结算管理</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
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
        th, td { white-space: nowrap;
            font-size:10px!important;
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
            <div class="ibox float-e-margins" id="order-div">
                <div class="ibox-title">
                    <h5>结算管理</h5>
                    <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                </div>
                <div class="ibox-content">
                    <div class="col-sm-12" style="margin: 10px 0;">
                        <div class="fa-hover col-sm-4 col-sm-2">
                            <label for="orderT">销货单类型</label>
                            <select class='form-control chosen-select  chosen-customer-type' id="orderT">
                                <option value="">所有</option>
                                <?php if(is_array($orderT)): $i = 0; $__LIST__ = $orderT;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["type_id"]); ?>" <?php if(($vol["type_id"]) == "3"): ?>selected<?php endif; ?> ><?php echo ($vol["order_type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="fa-hover col-sm-4 col-sm-2">
                            <label for="orderP">业绩类型</label>
                            <select class='form-control chosen-select  chosen-customer-type' id="orderP">
                                <option value="">所有</option>
                                <?php if(is_array($orderP)): $i = 0; $__LIST__ = $orderP;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["type_id"]); ?>"><?php echo ($vol["performance_type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="fa-hover col-sm-4 col-sm-2">
                            <label for="orderS">结算进度</label>

                            <select class='form-control chosen-select  chosen-customer-type' id="orderS">
                                <option value="">所有</option>
                                <?php if(is_array($orderS)): $i = 0; $__LIST__ = $orderS;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["type_id"]); ?>" <?php if(($vol["type_id"]) == "2"): ?>selected<?php endif; ?>><?php echo ($vol["settlement_type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive1">
                        <table class="table table-bordered table-hover table-striped dataTables-orderList">
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
<script src="/Public/html/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/html/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/Public/html/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/Public/html/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="/Public/html/js/plugins/layer/laydate/laydate.js"></script>

<script>
    var controller = "/Dwin/Finance";
    var dataTableOrderListDiv = $(".dataTables-orderList");
    var dataTableOrderListTBody = $(".dataTables-orderList tbody");
    var orderCheckBtn = $("#orderCheck");
    var orderTDiv = $("#orderT");
    var orderPDiv = $("#orderP");
    var orderSDiv = $("#orderS");
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
    function timeInput(nowT, se2TimeLimit)
    {
        if($("#" + se2TimeLimit + "_2").val() == "") {
            $("#" + se2TimeLimit + "_2").val(getDate(nowT, true));
        } else {
            return false;
        }
    }

    $(document).ready(function () {
        var oTables = dataTableOrderListDiv.dataTable({
            "paging"       : true,
            "scrollX"      : true,
            "autoWidth"    : false,
            "pagingType"   : "full_numbers",
            "lengthMenu"   : [10, 20, 35, 50],
            "bDeferRender" : true,
            "processing"   : true,
            "searching"    : true, //是否开启搜索
            "serverSide"   : true,//开启服务器获取数据
            "ajax"         : {  //获取数据
                "url"   : controller + "/checkedOrderManagement",
                "type"  : 'post',
                "data"  : {
                    "orderT": function () {
                        return document.getElementById('orderT').value;
                    },
                    "orderP" : function () {
                        return document.getElementById('orderP').value;
                    },
                    "orderS" : function () {
                        return document.getElementById('orderS').value;
                    }
                }
            },
            "columns" :[ //定义列数据来源
                {'title' : "系统<br>单号",   'data' : 'id'},
                {'title' : "订单<br>时间",   'data' : "otime"},
                {'title' : "客户",       'data' : "cus_name"},
                {'title' : "业务",       'data' : "pic_name"},
                {'title' : "K3编号",     'data' : "order_id"},
                {'title' : "订单<br>类型",   'data' : "order_type"},
                {'title' : "业绩<br>类型",   'data' : "static_type"},
                {'title' : "审核<br>时间",   'data' : "settlement_time"},
                {'title' : "结算<br>进度",   'data' : "settlement_stat"},
                {'title' : "订单<br>总金额", 'data' : "oprice"},
                {'title' : "结算<br>金额",   'data' : "done_price"},
                {'title' : "操作",       'data' : null,'orderable' :false}// 自定义列   {'title':"负责人",'data':null,'class':"align-center"}
            ],
            "columnDefs"   : [ //自定义列
                {
                    "targets" : 11,
                    "data" : "id",
                    "render" : function(data, type, row) {
                        var html = "";
                        if (row.settlement_stat == "应收结算中") {
                            html += '<button type="button" class="btn btn-xs btn-warning btn-rounded rejection-btn">驳回</button>' +
                                '<button type="button" class="btn btn-xs btn-primary btn-rounded edit-btn">修改</button>' +
                               '<button type="button" class="btn btn-xs btn-info btn-rounded settle-btn">结算</button>';
                        } else {
                            html +='<button type="button" class="btn btn-xs btn-warning btn-rounded rejection-btn">驳回</button>' +
                                '<button type="button" class="btn btn-xs btn-primary btn-rounded edit-btn">结算信息修改</button>';
                        }
                        return html;
                    }
                }
            ]
        });

        // 订单类型
        orderTDiv.on('change', function () {
            var oTables = dataTableOrderListDiv.DataTable();
            oTables.ajax.reload();
        });
        // 业绩类型
        orderPDiv.on('change', function () {
            var oTables = dataTableOrderListDiv.DataTable();
            oTables.ajax.reload();
        });
        // 订单结算状态
        orderSDiv.on('change', function () {
            var oTables = dataTableOrderListDiv.DataTable();
            oTables.ajax.reload();
        });
        var a_num = 0;
        dataTableOrderListDiv.delegate(".edit-btn", "click", function () {
            //编辑结算信息，先取出再编辑
            var btnIndex = $(this);
            var orderId = $(this).parent().parent().attr('id');

            btnIndex.attr('disabled', true);

            $.ajax({
                'type' : 'get',
                'url' : controller + "/editFinanceRecord",
                'data' : {
                    orderId : orderId
                },
                success : function (ajaxData) {
                    btnIndex.attr('disabled', false);
                    var recordHtml =
                        "<div class='container-fluid' style='margin-top:40px;'>" +
                        "<div class='row'>" +
                        "<div class='col-xs-12'>" +
                            "<table class='table table-bordered table-hover table-striped'>" +
                                "<tr>" +
                                    "<td>K3编号</td>" +
                                    "<td>订单总金额</td>" +
                                    "<td>产品</td>" +
                                    "<td>单价</td>" +
                                    "<td>收款时间</td>" +
                                    "<td>收款类型</td>" +
                                    "<td>收款金额</td>" +
                                    "<td>数量</td>" +
                                    "<td>结算人</td>" +
                                    "<td>编辑</td>" +
                                "</tr>";
                    for (var i = 0; i < ajaxData['settlementData'].length; i++) {
                        if (i == 0) {
                            recordHtml +=
                                "<tr id='" + ajaxData['settlementData'][i]['id'] + "'>" +
                                    "<td rowspan='" + ajaxData['settlementData'].length +"'>" + ajaxData['settlementData'][i]['order_id']     + "</td>" +
                                    "<td rowspan='" + ajaxData['settlementData'].length +"'>" + ajaxData['settlementData'][i]['oprice']       + "</td>" +
                                "<td>" + ajaxData['settlementData'][i]['product_name'] + "</td>" +
                                "<td class='product-price'>" + ajaxData['settlementData'][i]['single_price'] + "</td>" +
                                "<td style='width:20%;'>" +
                                        "<div class='form-group'>" +
                                            "<div class='col-sm-12' style='padding:0;'>" +
                                                "<input id='hello' class=' form-control layer-date' name='settle_time' value='" + ajaxData['settlementData'][i]['settle_time'] + "' onclick='laydate({istime: true,format:\"YYYY-MM-DD hh:mm:ss\"})'>" +
                                            "</div>" +
                                        "</div>" +
                                    "</td>" +
                                    "<td style='width:10%;'>" +
                                        "<div class='form-group'>" +
                                            "<div class='col-sm-12' style='padding:0;'>" +
                                                "<select  name='settle_type' class='form-control' style='width:100%;'>";
                            for (var j = 0; j < ajaxData['typeData'].length; j++) {
                                recordHtml +=
                                    "<option value='" + ajaxData['typeData'][j]['id'];
                                    if(ajaxData['settlementData'][i]['settle_type_id'] == ajaxData['typeData'][j]['id']) {
                                        recordHtml += "' selected >";
                                    } else {
                                        recordHtml += "'  >";
                                    }
                                recordHtml+= ajaxData['typeData'][j]['collection_type'] + "</option>";
                            }
                            recordHtml +=
                                                "</select>" +
                                            "</div>" +
                                        "</div>" +
                                    "</td>" +
                                    "<td>" +  "<input type='text' name='settle_price' class='form-control settle-price' data-settle='" + ajaxData['settlementData'][i]['settle_price'] + "' value='" + ajaxData['settlementData'][i]['settle_price'] + "'></td>" +
                                    "<td>" +  "<input type='text' name='settle_num' class='form-control settle-num' value='" + ajaxData['settlementData'][i]['product_num'] + "'></td>" +
                                    "<td>" +  ajaxData['settlementData'][i]['settle_id']    + "</td>" +
                                    "<td style='white-space: nowrap;'>" +
                                        "<button type='button' class='btn btn-outline btn-danger btn-xs editSubmitBtn'>修改</button>" +
                                    "</td>" +
                                "</tr>";
                        } else {
                            recordHtml +=
                                "<tr id='" + ajaxData['settlementData'][i]['id'] + "'>" +
                                "<td>" + ajaxData['settlementData'][i]['product_name'] + "</td>" +
                                "<td class='product-price'>" + ajaxData['settlementData'][i]['single_price'] + "</td>" +
                                "<td style='width:20%;'>" +
                                    "<div class='form-group'>" +
                                        "<div class='col-sm-12' style='padding:0;'>" +
                                            "<input id='hello' name='settle_time' class=' form-control layer-date' value='" + ajaxData['settlementData'][i]['settle_time'] + "' onclick='laydate({ istime: true,format:\"YYYY-MM-DD hh:mm:ss\"})'>" +
                                        "</div>" +
                                    "</div>" +
                                "</td>" +
                                "<td>" +
                                    "<div class='form-group'>" +
                                        "<div class='col-sm-12' style='padding:0;'>" +
                                            "<select name='settle_type' class='form-control'>";
                            for (var j = 0; j < ajaxData['typeData'].length; j++) {
                                recordHtml +=
                                    "<option value='" + ajaxData['typeData'][j]['id'];
                                if(ajaxData['settlementData'][i]['settle_type_id'] == ajaxData['typeData'][j]['id']) {
                                    recordHtml += "' selected >";
                                } else {
                                    recordHtml += "'>";
                                }
                                recordHtml += ajaxData['typeData'][j]['collection_type'] + "</option>";
                            }
                            recordHtml +=
                                            "</select>" +
                                        "</div>" +
                                    "</div>" +
                                "</td>" +
                                "<td>" +  "<input type='text' name='settle_price' class='form-control settle-price' data-settle='" + ajaxData['settlementData'][i]['settle_price'] + "' value='" + ajaxData['settlementData'][i]['settle_price'] + "'></td>" +
                                "<td style='width:95px;'>" +  "<input type='text' name='settle_num' class='form-control settle-num' value='" + ajaxData['settlementData'][i]['product_num'] + "'></td>" +
                                "<td>" +  ajaxData['settlementData'][i]['settle_id']    + "</td>" +
                                "<td style='white-space: nowrap;'>" +
                                    "<button type='button' class='btn btn-xs btn-outline btn-danger editSubmitBtn'>修改</button>" +
                                "</td>" +
                                "</tr>";
                        }
                    }
                    recordHtml += "</table></div></div></div>";
                    var layerEditIndex = layer.open({
                        type : 1,
                        skin : 'layui-layer-rim', //加上边框
                        area : ['80%', '340px'], //宽高
                        content :  recordHtml
                    },function () {
                        // 时间选择
                        laydate({
                            elem:"#hello",
                            event:"focus"}
                        );
                    });
                    var settlePrice = $(".settle-price");
                    settlePrice.on('keyup', function () {
                        var thisTr   = $(this).parent().parent();
                        var sePrice  = parseFloat($(this).val()).toFixed(2);
                        var allPrice = parseFloat($(this).attr('data-settle')).toFixed(2);
                        var perPrice = parseFloat(thisTr.find('.product-price').text()).toFixed(2);

                        if (parseFloat(allPrice) < parseFloat(sePrice)) {
                            $(this).val("");
                            thisTr.find('.settle-num').val("");
                        } else {
                            var numSet = Math.round(sePrice / perPrice);
                            if (numSet >= 0) {
                                thisTr.find('.settle-num').val(numSet);
                            }
                        }
                    });
                    //点击编辑按钮触发修改方法 post 传数据
                    var editSubmitBtn = $(".editSubmitBtn");
                    editSubmitBtn.off('click');
                    editSubmitBtn.on("click", function () {
                        var thisEdit = $(this);
                        var trIndex = thisEdit.parent().parent();
                        var trId = trIndex.attr('id');//要修改的记录id
                        var settleData = [];
                        settleData['settleTime']  = trIndex.find("[name='settle_time']").val();
                        settleData['settlePrice'] = trIndex.find("[name='settle_price']").val();
                        settleData['settleNum']   = trIndex.find("[name='settle_num']").val();
                        settleData['settleType']  = trIndex.find('[name="settle_type"] option:selected').val();
                        // settleData 提交数据
                        thisEdit.attr('disabled', true);
                        if (settleData['settleTime'] && settleData['settleType'] && settleData['settleNum'] && settleData['settlePrice']) {

                            var editIndexLayer = layer.load(0, {shade: false});
                            $.ajax({
                                type :'post',
                                url  : controller + "/editFinanceRecord",
                                data :{
                                    collectionId : trId,
                                    settleT   : settleData['settleTime'],
                                    settleP   : settleData['settlePrice'],
                                    settleE   : settleData['settleType'],
                                    settleN   : settleData['settleNum']
                                },
                                success : function (ajaxData) {
                                    layer.close(editIndexLayer);
                                    thisEdit.attr('disabled', false);
                                    layer.msg(ajaxData['msg']);
                                    // layer.close(layerEditIndex);
                                },
                                error : function () {
                                    layer.close(editIndexLayer);
                                    thisEdit.attr('disabled', false);
                                    layer.close(layerEditIndex);
                                }
                            });
                        } else {
                            layer.msg("您有信息未填写");
                            thisEdit.attr('disabled', false);
                        }
                    });
                }
            });
        });
        dataTableOrderListDiv.delegate(".settle-btn", "click",function () {
            var ids = $(this).parent().parent().attr('id');
            var nowT = new Date().getTime();
            $.ajax({
               'type'  : "get",
                'url'  : controller + "/addFinanceRecord",
                'data' : {
                    orderId : ids
                },
                success : function (data) {
                    var settleTimeDefault = getDate(nowT, true);
                    var html = "";
                    var unSettle = parseFloat(parseFloat(data['orderInfo']['oprice']) - parseFloat(data['orderInfo']['done_price'])).toFixed(2);
                    html +=
                        "<div class='container-fluid'>" +
                        "<div class='row'>" +
                        "<div class='col-xs-12'>" +
                        "<lable>订单销货信息</lable>" +
                            "<label>&emsp14;订单系统编号：" + data['orderInfo']['id'] + "&emsp14;订单总金额" + data['orderInfo']['oprice'] + "<span class='green-set'>&emsp14;已结算：" + data['orderInfo']['done_price'] +"</span><span class='red-set'>&emsp14;待结算：" + unSettle + "</span></label>" +
                        "<table class='table' >" +
                        "<thead><tr>" +
                        "<th>系统编号</th>" +
                        "<th>产品型号</th>" +
                        "<th>销售单价</th>" +
                        "<th>售出数量</th>" +
                        "<th>总价</th>" +
                        "<th>已结算价格</th>" +
                        "<th>待结算价格</th>" +
                        "<th>已结算数量</th>" +
                        "<th>待结算数量</th>" +
                        "</tr></thead>";
                    for (var p = 0; p < data['productData'].length; p++) {
                        html += "<tr>" +
                            "<td>" + data['productData'][p]['product_id']    + "</td>" +
                            "<td>" + data['productData'][p]['product_name']  + "</td>" +
                            "<td>" + data['productData'][p]['product_price'] + "元</td>" +
                            "<td>" + data['productData'][p]['product_num']   + "</td>" +
                            "<td>" + data['productData'][p]['product_total_price'] + "元</td>" +
                            "<td class='green-set'>" + data['productData'][p]['settled_price'] + "元</td>" +
                            "<td class='red-set'>"   + data['productData'][p]['un_price'] + "元</td>" +
                            "<td class='green-set'>" + data['productData'][p]['settled_num'] + "</td>" +
                            "<td class='red-set'>"   + data['productData'][p]['un_number'] + "</td>" +
                            "</tr>";
                    }
                    html += "</table></div>";
                    html +=
                        "<div class='col-xs-12'>" +
                        "<label for=''>冲应收结算记录</label>" +
                        "<table class='table'>" +
                        "<thead><tr>" +
                        "<th>产品型号</th>" +
                        "<th class='td-width-set'>单价</th>" +
                        "<th class='td-width-set'>数量</th>" +
                        "<th>还款类型</th>" +
                        "<th>还款金额</th>" +
                        "<th>结算时间</th>" +
                        "</tr></thead>";
                    for (var j = 0; j < data['settlementData'].length; j++) {
                        html +=
                            "<tr>" +
                                "<td>" + data['settlementData'][j]['product_name'] + "</td>" +
                                "<td>" + data['settlementData'][j]['single_price'] + "</td>" +
                                "<td>" + data['settlementData'][j]['product_num']  + "</td>" +
                                "<td>" + data['settlementData'][j]['settle_type']  + "</td>" +
                                "<td>" + data['settlementData'][j]['settle_price'] + "</td>" +
                                "<td>" + data['settlementData'][j]['settle_time']  + "</td>" +
                            "</tr>";
                    }
                    html += "</table></div>";
                    html +=
                        "<div class='col-xs-12'>" +
                        "<label for=''>冲应收结算记录添加</label>" +
                        "<form name='addSettlementRecord' id='addRecordForm'>" +
                        "<table class='table' >" +
                        "<thead><tr>" +
                        "<th class='td-width-set'>系统编号</th>" +
                        "<th>产品型号</th>" +
                        "<th class='td-width-set'>待结数量</th>" +
                        "<th class='td-width-set'>单价</th>" +
                        "<th>待结总价</th>" +
                        "<th>结算时间</th>" +
                        "<th>还款类型</th>" +
                        "<th>还款金额</th>" +
                        "<th class='td-width-set'>折算产品数量</th>" +
                        "<th class='td-width-set'>结算备注</th>" +
                        "</tr></thead>";
                    for (var p = 0; p < data['productData'].length; p++) {
                        if (parseFloat(data['productData'][p]['un_number']) > 0 || parseFloat(data['productData'][p]['un_price'])) {
                            html += "<tr>" +
                                "<input type='hidden' class='form-control' name='product_type' value='" + data['productData'][p]['product_type'] + "'>" +
                                "<input type='hidden' class='form-control' name='product_id'   value='" + data['productData'][p]['product_id'] + "'>" +
                                "<input type='hidden' class='form-control' name='product_name' value='" + data['productData'][p]['product_name'] + "'>" +
                                "<input type='hidden' class='form-control' name='product_num' value='" + data['productData'][p]['product_num'] + "'>" +
                                "<input type='hidden' class='form-control product_price' name='product_price' value='" + data['productData'][p]['product_price'] + "'>" +
                                "<input type='hidden' class='form-control product_total_price' name='product_total_price' value='" + data['productData'][p]['product_total_price'] + "'>" +
                                "<td>" + data['productData'][p]['product_id'] +
                                "</td>" +
                                "<td>" + data['productData'][p]['product_name'] + "</td>" +
                                "<td>" + data['productData'][p]['un_number'] + "</td>" +
                                "<td>" + data['productData'][p]['product_price'] + "</td>" +
                                "<td class='un_price'>" + data['productData'][p]['un_price'] + "</td>" +
                                "<td>" + "<input id='hello' name='settle_time' class='form-control layer-date add-settle-time' value='" + settleTimeDefault + "' onclick='laydate({ istime: true,format:\"YYYY-MM-DD hh:mm:ss\"})'>"  + "</td>" +
                                "<td>" +
                                "<select name='settle_type' class='form-control' id='settleType'>" +
                                "<option value='7'>正常还款</option>" +
                                "<option value='6'>退货还款</option>" +
                                "<option value='8'>折价还款</option>" +
                                "<option value='9'>业务工资还款</option>" +
                                "</select>" +
                                "</td>" +
                                "<td>" + "<input type='number' name='settle_price' class='form-control settle-price' >" + "</td>" +
                                "<td>" + "<input type='number' name='settle_num' class='form-control settle-num'>" + "</td>" +
                                "<td>" + "<input type='text' name='settlement_tips' class='form-control settle-tips'>" + "</td>" +
                                "</tr>";
                        }
                    }
                    html += "</table></form></div>";
                    html +=
                        "<div class='col-xs-12' style='margin-top:50px;'>" +
                        "<button type='button' class='btn btn-outline btn-success' id='submitSettleBtn'>提交冲应收记录</button>&emsp;" +
                        "<button type='button' class='btn btn-outline btn-success' id='closeSettleBtn'>关闭</button>" +
                        "</div>";
                    var layerIndex = layer.open({
                        type : 1,
                        skin : 'layui-layer-rim', //加上边框
                        area : ['80%', '80%'], //宽高
                        content : html
                    },function () {
                        // 时间选择
                        laydate({
                            elem:"#hello",
                            event:"focus"}
                        );
                    });

                    var settlePrice = $(".settle-price");
                    settlePrice.on('keyup', function () {
                        var sePrice = parseFloat($(this).val()).toFixed(2);
                        var thisTr = $(this).parent().parent();
                        var perPrice = parseFloat(thisTr.find('.product_price').val()).toFixed(2);
                        var allPrice = parseFloat(thisTr.find('.un_price').text()).toFixed(2);
                        if (parseFloat(allPrice) < parseFloat(sePrice)) {
                            $(this).val("");
                            thisTr.find('.settle-num').val("");
                        } else {
                            var numSet = Math.round(sePrice / perPrice);
                            thisTr.find('.settle-num').val(numSet);
                        }
                    });
                    var submitSettleBtn = $("#submitSettleBtn");//提交应收记录按钮
                    submitSettleBtn.off('click');
                    submitSettleBtn.on('click', function () {
                        submitSettleBtn.attr('disabled', true);
                        var indexLayer = layer.load(0, {shade: false});
                        var submitData = $("#addRecordForm").serializeArray();
                        submitSettleBtn.attr('disabled', true);
                        $.ajax({
                            type :'post',
                            url  : controller + "/addFinanceRecord",
                            data :{
                                orderId : ids,
                                addData : submitData,
                                inputNum : 11
                            },
                            success : function (ajaxData) {
                                layer.close(indexLayer);
                                submitSettleBtn.attr('disabled', false);
                                layer.msg(ajaxData['msg']);
                                layer.close(layerIndex);
                            },
                            error : function () {
                                layer.close(indexLayer);
                            }
                        });
                    });
                    $(document).delegate("#closeSettleBtn", 'click', function () {
                        layer.msg("结束，如有到款请重新打开该页面");
                        layer.close(layerIndex);
                    });
                }
            });



        });
        dataTableOrderListDiv.delegate(".rejection-btn", "click", function () {
            var ids = $(this).parent().parent().attr('id');
            var orderId = ($(this).parent().parent()[0].cells[4].innerText + "(系统单号" + ids + ")");
            var index1 = layer.confirm("确定驳回该订单?：<br>" + orderId, function () {
                layer.close(index1);
                layer.prompt({title: '请输入驳回原因后点击确定', formType: 2},
                    function(text, index){
                        layer.close(index);
                        $.ajax({
                            type : 'POST',
                            url  : controller + '/rejectOrder',
                            data : {
                                orderId : ids,
                                textContent : text
                            },
                            success : function(returnData) {
                                layer.msg(returnData['msg']);
                            }
                        });
                    });
            });
        });
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
    changeCss('orderList', 4);
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
    });    
</script>
</body>
</html>