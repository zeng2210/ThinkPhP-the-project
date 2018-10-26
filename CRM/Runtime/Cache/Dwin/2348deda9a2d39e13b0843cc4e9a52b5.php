<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>生产计划领料</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <!-- Data Tables -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.4/theme-chalk/index.css" rel="stylesheet">
    <style type="text/css">
        body {
            color: black;
            font-size: 12px;
        }
        .selected{
            background-color: #fbec88 !important;
        }

        .nav-tabs>li>a{
            color: #555;
        }
        .nav-tabs>.active>a{
            color: #000!important;
        }
        tr{
            white-space: nowrap!important;
        }
        tbody td{
            padding-top: 2px!important;
            padding-bottom: 2px!important;
        }
        .btn{
            margin-right: 1em;
        }
        .el-select-option-span{
            float: left;font-size: 12px;
        }
        .styleBtu{
            background-color: #fff !important;
            border-color: #1c84c6 !important;
            color: #1c84c6 !important; 
            border-radius: 3px !important;
            height: 23px;
            padding: 1px 5px; 
            font-size: inherit;       
        }
        .nav-tabs>.active>a{
            background-color: #1c84c6 !important;
            color: #fff !important;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins" id="productionDiv">
                <div class="ibox-content" >
                    <h3>生产计划</h3>
                    <form class="form-inline">
                        <button type="button" class="btn btn-info btn-sm refresh styleBtu">刷新</button>
                        <button type="button" class="btn btn-info btn-sm btn-material styleBtu" data-id="1" id="btn-material"><span class="glyphicon glyphicon-plus"></span>下推领料单</button>
                        <button type="button" class="btn btn-info btn-sm btn-transfer styleBtu" data-id="1" id="btn-transfer">料单调拨</button>
                        <label for="production_line" class="styleBtu">产线筛选</label>
                        <select name="" id="production_line" class="form-control change-data styleBtu" style="    font-size: 12px;">
                            <option value="">所有</option>
                            <?php if(is_array($line)): $i = 0; $__LIST__ = $line;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["production_line"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <!--<label for="production_line">排产状态筛选</label>-->
                        <!--<select name="" id="production_status" class="form-control change-data">-->
                            <!--<option value="">所有</option>-->
                            <!--<option value="0,1">排产中</option>-->
                            <!--<option value="2">排产完毕</option>-->
                        <!--</select>-->
                    </form>

                    <div class="table-responsive1">
                        <table class="table table-striped table-bordered table-hover dataTables-productionList" id="productionPlan" width="100%">
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive1" id="detailsModel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#source" aria-controls="material" role="tab" data-toggle="tab">源单</a></li>
                            <li role="presentation"><a href="#bom" aria-controls="bom_sum" role="tab" data-toggle="tab">BOM</a></li>
                            <li role="presentation"><a href="#material_out" aria-controls="material_out" role="tab" data-toggle="tab">领料情况</a></li>
                            <li role="presentation"><a href="#task" aria-controls="material" role="tab" data-toggle="tab">分配情况</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="source">
                                <table class="table table-striped table-bordered table-hover table-full-width dataTables-productionList">
                                    <thead>
                                    <tr>
                                        <th>产线</th>
                                        <th>生产单号</th>
                                        <th>产品名</th>
                                        <th>下单数量</th>
                                        <th>下单人</th>
                                        <th>已分配数</th>
                                        <th>开始时间</th>
                                        <th>交期要求</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="v in planTableData">
                                        <td>{{v.production_line_name}}</td>
                                        <td>{{v.production_order}}</td>
                                        <td>{{v.product_name}}</td>
                                        <td>{{v.production_plan_number}}</td>
                                        <td>{{v.staff_name}}</td>
                                        <td>{{v.actual_number}}</td>
                                        <td>{{v.delivery_time}}</td>
                                        <td>{{v.create_time}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="bom">
                                <table class="table table-striped table-bordered table-hover table-full-width dataTables-productionList">
                                    <thead>
                                    <tr>
                                        <th>BOM编号</th>
                                        <th>辅料</th>
                                        <th>物料数量</th>
                                        <th>是否有替代料</th>
                                        <th>BOM类别</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="v in bomTableData">
                                        <td>{{v.bom_id}}</td>
                                        <td>{{v.product_no}}</td>
                                        <td>{{v.num}}</td>
                                        <td>{{v.has_sub}}</td>
                                        <td>{{v.bom_cate}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="material_out">
                                <table class="table table-striped table-bordered table-hover table-full-width dataTables-productionList">
                                    <thead>
                                    <tr>
                                        <th>领料物料</th>
                                        <th>应出数量</th>
                                        <th>实出数量</th>
                                        <th>出库库房</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="v in stockOutTableData">
                                        <td>{{v.product_no}}</td>
                                        <td>{{v.num}}</td>
                                        <td>{{v.push_num}}</td>
                                        <td>{{v.repertory_name}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="task">
                                <table class="table table-striped table-bordered table-hover table-full-width dataTables-productionList">
                                    <thead>
                                    <tr>
                                        <th>任务单号</th>
                                        <th>源单</th>
                                        <th>生产物料</th>
                                        <th>任务数量</th>
                                        <th>生产班组</th>
                                        <th>开始时间</th>
                                        <th>预计完成</th>
                                        <th>已完成数量</th>
                                        <th>实际完成</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="v in taskTableData">
                                        <td>{{v.task_id}}</td>
                                        <td>{{v.production_code}}</td>
                                        <td>{{v.product_no}}</td>
                                        <td>{{v.task_number}}</td>
                                        <td>{{v.group_name}}</td>
                                        <td>{{v.start_t}}</td>
                                        <td>{{v.end_t}}</td>
                                        <td>{{v.complete_quantity}}</td>
                                        <td>{{v.actual_t}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/Public/html/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/vue.js"></script>
<script src="/Public/html/js/jquery.form.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<!--<script src="/Public/html/js/plugins/dataTables/jquery.dataTables.js"></script>-->
<!--<script src="/Public/html/js/plugins/dataTables/dataTables.bootstrap.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="/Public/html/js/dwin/finance/common_finance.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.4/index.js"></script>

<script>
    var oTable;
    var controller = "/Dwin/Stock";
    var tableDiv = $("#productionPlan");
    var selectedID,selectedOrder;
    var pushBtnFlag = '<?php echo ($pushBtn);?>';
    var transferBtnFlag = '<?php echo ($transferBtn); ?>';
    console.log(pushBtnFlag);
    console.log(transferBtnFlag);
    var materialBtn = $('#btn-material');
    var transferBtn = $('#btn-transfer');
    $(document).ready(function() {
        if (pushBtnFlag) {
            materialBtn.css('display','inline-block');
        } else {
            materialBtn.css('display','none');
        }
        if (transferBtnFlag) {
            transferBtn.css('display','inline-block');
        } else {
            transferBtn.css('display','none');
        }
        tableDiv.on('mouseenter','tbody td', function () {
            var tdIndex = $(this).parent()['context']['cellIndex'];
            if (tdIndex === 9) {
                var dataTips = $(this).find('span').attr('data');
                var num = $(this).parent();
                if (dataTips) {
                    layer.tips(
                        dataTips, num, {
                            tips: [1, '#3595CC'],
                            area: '900px',
                            time: 100000
                        });
                }
            } else {
                return false;
            }
        });
        tableDiv.delegate('tbody td', 'mouseleave',function(e) {
            layer.closeAll('tips');
        });

        oTable = tableDiv.DataTable({
        "scrollY": 400,
         "scrollX": true,
        "scrollCollapse": true,
        "destroy"      : true,
        "autoWidth"	   : false,
        "lengthMenu"   : [10, 25, 50, 100],
        "bDeferRender" : true,
        "processing"   : true,
        "searching"    : true, //是否开启搜索
        "serverSide"   : true, //开启服务器获取数据
        "ajax"         :{ // 获取数据
            "url"   : "/Dwin/Production/productionOrderIndex",
            "type"  : 'post',
            "data"  : {
                "lineLimit" : function () {
                    return document.getElementById('production_line').value;
                },
                'statusLimit' : function () {
                    return ""
                },
                'status' : 2
            }
        },
        "order": [[ 7, "desc" ]],
        "columns": [
            {data:'production_code', title:'计划单号'},
            {data:'production_line', title:'生产线'},
            {data:'product_no', title:'物料编码'},
            {data:'bom_id', title:'BOM编号'},
            {data:'plan_number', title:'生产数量'},
            {data:'assign_number', title:'排产数'},
            {data:'in_stock_num', title:'完工数'},
            {data:'start_t', title:'开始时间'},
            {data:'end_t', title:'计划完成时间'},
            {data:'remaining_day', title:'剩余天数'},
            {data:'assigned_number', title:'今日已分配数量'},
            {data:'need_assign_num', title:'今日需分配数量'},
            {data:'stock_status', title:'领料状态'},
            {data:'production_progress', title:'生产进度'},
            {data:'production_status', title:'排产状态'},
            {data:'tips' , title:'排产备注'}
        ],
        "columnDefs": [
            //自定义列
            {
                "targets" : 12,
                "data" : 'stock_status',
                "render" : function (data, type, row) {
                    var arr = ['未领料','领料中','领料完毕'];
                    var html;
                    switch (parseInt(data)) {
                        case 0 :
                            html = "<span style='color:red;'>" + arr[data] + "</span>";
                            break;
                        case 1 :
                            html = "<span style='color:blue;'>" + arr[data] + "</span>";
                            break;
                        case 2 :
                            html = "<span style='color:green;'>" + arr[data] + "</span>";
                            break;
                        default :
                            html = "<span style='color:red;'>" + arr[data] + "</span>";
                            break;
                    }
                    return html;
                }
            },
            {
                "targets" : 13,
                "data" : 'production_process',
                "render" : function (data, type, row) {
                    var arr = ['未生产','生产中','完结'];
                    var html;
                    switch (parseInt(data)) {
                        case 0 :
                            html = "<span style='color:red;'>" + arr[data] + "</span>";
                            break;
                        case 1 :
                            html = "<span style='color:blue;'>" + arr[data] + "</span>";
                            break;
                        case 2 :
                            html = "<span style='color:green;'>" + arr[data] + "</span>";
                            break;
                        default :
                            html = "<span style='color:red;'>" + arr[data] + "</span>";
                            break;
                    }
                    return html;
                }
            },

            {
                "targets" : 14,
                "data" : 'production_status',
                "render" : function (data, type, row) {
                    var arr = ['未排产','排产中','分配完毕'];
                    var html;
                    switch (parseInt(data)) {
                        case 0 :
                            html = "<span style='color:red;'>" + arr[data] + "</span>";
                            break;
                        case 1 :
                            html = "<span style='color:blue;'>" + arr[data] + "</span>";
                            break;
                        case 2 :
                            html = "<span style='color:green;'>" + arr[data] + "</span>";
                            break;
                        default :
                            html = "<span style='color:red;'>" + arr[data] + "</span>";
                            break;
                    }
                    return html;
                }
            },
            {
                "targets": 15,
                "data": 'tips',
                "render": function (data, type, row) {
                    if (row.tips.length > 14) {
                        var html = "<span data='" + row.tips + "'>" + row.tips.substring(0,14) + "...</span>";
                    } else {
                        var html = "<span>" + row.tips + "</span>";
                    }
                    return html;
                }
            }
        ]
        });

    });
    $(".change-data").on('change', function () {
        oTable.ajax.reload(null, false);
    });
    $('.refresh').on('click', function () {
        oTable.ajax.reload(null, false);
    });

    var tabVm = new Vue({
        el: '#detailsModel',
        data: function () {
            return {
                planTableData:[],
                taskTableData:[],
                bomTableData : [],
                stockOutTableData : []
            }
        },
        filters: {
            auditType: function (data) {
                var arr = ['单据审核', '产线确认'];
                return arr[data-2]
            },
            auditResult: function (data) {
                var arr = ['通过', '不通过'];
                return arr[data-1]
            }
        }
    });

    var planTBody = $("#productionPlan tbody");
    var selectedData = [];
    planTBody.on("click", "tr", function () {
        if (transferBtnFlag) {
            $("tr").removeClass('selected');
            $(this).addClass('selected');
        } else {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                $(this).addClass('selected');
            }
        }
        selectedID = oTable.row(this).data().id;
        selectedOrder = oTable.row(this).data().production_order;
        selectedData = oTable.row(this).data();
        $.post('/Dwin/Production/getRelationDataWithOrderId', {'productionOrderId': selectedID}, function (res) {
            tabVm.planTableData = res.sourcePlan;
            tabVm.taskTableData = res.productionTask;
            tabVm.bomTableData = res.bomData;
            tabVm.stockOutTableData = res.stockOutData;
        });
    });



    // 当dataTables变动时取消选中
    $('table').on('processing.dt', function () {
        selectedID = undefined;
        $('tr').removeClass('selected')
    });

    materialBtn.on('click', function () {
        var id =[];
        $(".selected").each(function () {
            console.log(this);
            id.push(oTable.row(this).data().id);
        })
        console.log(id);
        if(!id.length){
            layer.msg('请选择要领料的生产单')
        } else {
            var index = layer.open({
                type: 2,
                title: '湖南迪文有限公司添加领料单',
                content: '/Dwin/Stock/createStockOutProduction?id='+ id,
                // content: '/Dwin/Stock/createStockOutProduce?id='+ id,
                area: ['90%', '90%'],
                shadeClose:true,
                end: function () {
                    oTable.ajax.reload(null, false);
                }
            })
        }
    });
    transferBtn.on('click', function () {

        if (!selectedData) {
            layer.msg('请您选择生产计划');
        } else {
            if (0 === parseInt(selectedData.stock_status)) {
                layer.msg('该生产计划还未领料');
                return false;
            }
            if (2 === parseInt(selectedData.production_progress)) {
                layer.msg('该生产计划已经生产完毕，不能推调拨单');
                return false;
            }
            var index = layer.open({
                type: 2,
                title: '湖南迪文有限公司调拨单制单',
                content: '/Dwin/Stock/addStockTransferWithOrder?id='+ selectedID,
                area: ['90%', '90%'],
                shadeClose:true,
                end: function () {
                    oTable.ajax.reload(null, false);
                }
            })
        }
    });

</script>
</body>
</html>