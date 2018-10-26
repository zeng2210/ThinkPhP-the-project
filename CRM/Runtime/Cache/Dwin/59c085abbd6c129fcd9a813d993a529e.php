<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>排产中生产计划</title>
    <link href="/Public/html/css/bootstrap.min14ed.css" rel="stylesheet">
    <!--<link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css" rel="stylesheet">
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
        .selectedHigh{
            background-color: deepskyblue !important;
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
        }
        /*.delayComplain{*/
            /*display: none;*/
        /*}*/
        /*.dataTables_scrollHeadInner{*/
            /*width: 100%!important;*/
        /*}*/
        /*.dataTables_scrollHeadInner table{*/
            /*width: 100%!important;*/
        /*}*/
        .nav-tabs>.active>a {
            background-color: #1c84c6 !important;
            color: #fff !important;
            font-weight: bold;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins" id="productionDiv">
                <div class="ibox-content" >
                    <h3>排产中生产计划</h3>
                    <form class="form-inline">
                        <button type="button" class="btn btn-info btn-sm refresh">刷新</button>
                        <button type="button" class="btn btn-info btn-sm btn-bom" data-id="1">BOM确认</button>
                        <button type="button" class="btn btn-info btn-sm btn-audit" data-id="1">审 核</button>
                        <button type="button" class="btn btn-info btn-sm btn-editor" data-id="1">编 辑</button>
                        <button type="button" class="btn btn-info btn-sm btn-remover" data-id="1">删 除</button>
                        <button type="button" class="btn btn-info btn-sm btn-push" data-id="1">下推分配任务</button>
                        <!--<button type="button" class="btn btn-info btn-sm btn-material" data-id="1">下推领料单</button>-->
                        <label for="production_line">产线筛选</label>
                        <select name="" id="production_line"  class="form-control styleBtu change-data">
                            <option value="">所有</option>  
                            <?php if(is_array($line)): $i = 0; $__LIST__ = $line;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["production_line"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <label for="production_line">排产状态筛选</label>
                        <select name="" id="production_status" class="form-control change-data styleyBtu">
                            <option value="">所有</option>
                            <option value="0,1">排产中</option>
                            <option value="2">排产完毕</option>
                        </select>
                        <label for="production_line">审核状态筛选</label>
                        <select name="" id="production_audit" class="form-control change-data">
                            <option value="3">未确认配料</option>
                            <option value="0">未审核</option>
                            <option value="1">不合格</option>
                            <option value="2">审核合格</option>
                        </select>
                    </form>

                    <div class="table-responsive1">
                        <table class="table table-striped table-bordered table-hover table-full-width dataTables-productionList" id="productionPlan">
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

            <div class="ibox float-e-margins" id="tasks">
                <el-dialog title="生产计划任务分配" :visible.sync="dialogFormVisible" width="100%">
                        <table class="table table-striped table-bordered table-hover table-full-width dataTables-productionList" id="productionPreOrder">
                            <thead>
                            <tr>
                                <th>物料编号</th>
                                <th>物料名称</th>
                                <th>生产线</th>
                                <th>生产班组</th>
                                <th>分配数量</th>
                                <th>源单编号</th>
                                <th>任务起止时间</th>
                                <th>生产备注</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(v, k) in taskData" >
                                <td>{{v.product_no}}</td>
                                <td>{{v.product_name}}</td>
                                <td>{{v.task_line_name}}</td>
                                <td>
                                    <template>
                                        <el-select v-model="v.task_group"
                                                   placeholder="请选择"
                                                   @change="updatePreNum(-1)"
                                        >
                                            <el-option
                                                    v-for="item in groupInfoData"
                                                    v-if="item.pid == v.task_line"
                                                    :key="item.id"
                                                    :value="item.id"
                                                    :label="item.group_name">
                                                <span class="el-select-option-span">{{ item.group_name }}&emsp;</span>
                                                <span class="el-select-option-span">当前分配数量：{{ item.pre_num }}&emsp;</span>
                                                <span class="el-select-option-span">可分配数量：{{ item.can_assign_number }}&emsp;</span>
                                                <span class="el-select-option-span">默认产能：{{ item.group_ability }}&emsp;</span>
                                                <span class="el-select-option-span">今日已分配：{{ item.assign_number_with_time }}&emsp;</span>
                                                <span class="el-select-option-span">未完成数量：{{ item.unfinished_number }}&emsp;</span>
                                                <span class="el-select-option-span">生产型号：{{ item.task_product_no }}&emsp;</span>
                                                <span class="el-select-option-span">生产源单：{{ item.assign_task }}&emsp;</span>
                                            </el-option>
                                        </el-select>
                                    </template>
                                </td>
                                <td>
                                    <el-input
                                            type="number"
                                            placeholder="请输入计划数量"
                                            v-model="v.task_number"
                                            style="min-width: 80px;"

                                            @keyup.native="updatePreNum(k)"
                                    >
                                    </el-input>
                                </td>
                                <td>{{v.source_order_string}}</td>
                                <td>
                                    <template>
                                        <div class="block">
                                            <el-date-picker
                                                    v-model="v.timeRangeSetting"
                                                    type="daterange"
                                                    align="right"
                                                    readonly
                                                    unlink-panels
                                                    range-separator="至"
                                                    start-placeholder="开始生产日期"
                                                    end-placeholder="计划完成日期"
                                                    >
                                            </el-date-picker>
                                        </div>
                                    </template>
                                </td>
                                <td>
                                    <el-input
                                            type="textarea"
                                            :rows="1"
                                            placeholder="请输入备注"
                                            v-model="v.tips">
                                    </el-input>
                                </td>
                                <td>
                                    <el-button type="danger" icon="el-icon-delete" circle @click="delAction(v, k)">
                                    </el-button>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>

                            <tr style="border:none;">
                                <td>
                                    <input type="text" class="form-control" readonly v-model="totalNum">
                                </td>
                                <td style="border:none;">
                                    <el-button type="success" size="mini"  round @click="submitTask()">提交排产任务</el-button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                </el-dialog>
                <el-dialog title="计划生产编辑：" :visible.sync="dialogFormVisible_editor" width="60%">
                        <el-form :data="edit_list">
                        <el-row>
                            <el-col :span="9" :offset="1">
                                <el-form-item label="计划单号: " :label-width="formLabelWidth">
                                    {{edit_list.production_code}}
                                </el-form-item>
                            </el-col>
                            <el-col :span="9" :offset="1">
                                <el-form-item label="生产线: " :label-width="formLabelWidth">
                                        {{edit_list.production_line}}
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="9" :offset="1">
                                <el-form-item label="物料编码: " :label-width="formLabelWidth">
                                    {{edit_list.product_no}}
                                </el-form-item>
                            </el-col>
                            <el-col :span="9" :offset="1">
                                <el-form-item label="BOM编号: " :label-width="formLabelWidth">
                                    {{edit_list.bom_id}}
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="9" :offset="1">
                                <el-form-item label="计划数: " :label-width="formLabelWidth">
                                  <el-input v-model="edit_list.plan_number" auto-complete="off"></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="9" :offset="1">
                                <el-form-item label="领料数: " :label-width="formLabelWidth">
                                    {{edit_list.stock_out_num}}
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="9" :offset="1">
                                <el-form-item label="排产数: " :label-width="formLabelWidth">
                                    {{edit_list.assign_number}}
                                </el-form-item>
                            </el-col>
                            <el-col :span="9" :offset="1">
                                <el-form-item label="完工数: " :label-width="formLabelWidth">
                                    {{edit_list.in_stock_num}}
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="9" :offset="1">
                                <el-form-item label="开始时间: " :label-width="formLabelWidth">
                                    <el-date-picker
                                        style="width: 100%"
                                        v-model="edit_list.start_t"
                                        value-format="yyyy-MM-dd"
                                        type="date"
                                        placeholder="开始时间">
                                    </el-date-picker>
                                </el-form-item>
                            </el-col>
                            <el-col :span="9" :offset="1">
                                <el-form-item label="完成时间: " :label-width="formLabelWidth">    
                                    <el-date-picker
                                        style="width: 100%"
                                        v-model="edit_list.end_t"
                                        value-format="yyyy-MM-dd"
                                        type="date"
                                        placeholder="完成时间">
                                    </el-date-picker>   
                                </el-form-item>
                            </el-col>
                        </el-row>
                          
                        </el-form>
                        <div slot="footer" class="dialog-footer" style="text-align:center">
                                <el-button type="primary" @click="edit_DialogForm">保 存</el-button>
                          <el-button @click="dialogFormVisible = false">取 消</el-button>
                        </div>
                </el-dialog>
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
    var controller = "/Dwin/Production";
    var tableDiv = $("#productionPlan");
    var selectedID,selectedOrder;
    var auditMap = <?php echo (json_encode($auditMap)); ?>;
    $(document).ready(function() {
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
            "url"   : controller + "/productionOrderIndex",
            "type"  : 'post',
            "data"  : {
                "lineLimit" : function () {
                    return document.getElementById('production_line').value;
                },
                'statusLimit' : function () {
                    return document.getElementById('production_status').value;
                },
                'status' : function () {
                    return document.getElementById('production_audit').value;
                }
            }
        },
        "order": [[ 7, "desc" ]],
        "columns": [
            {data:'production_code', title:'计划单号'},
            {data:'production_line', title:'生产线'},
            {data:'product_no', title:'物料编码'},
            {data:'bom_id', title:'BOM编号'},
            {data:'plan_number', title:'计划数'},
            {data:'assign_number', title:'排产数'},
            {data:'in_stock_num', title:'完工数'},
            {data:'start_t', title:'开始时间'},
            {data:'end_t', title:'计划<br>完成时间'},
            {data:'remaining_day', title:'剩余天数'},
            {data:'assigned_number', title:'今日<br>已分配'},
            {data:'need_assign_num', title:'今日<br>需分配'},
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
    var planTBodyData
    planTBody.on("click", "tr", function () {
        $("tr").removeClass("selected");

        $(this).addClass('selected');
        selectedID = oTable.row(this).data().id;
        planTBodyData = oTable.row(this).data();
        selectedOrder = oTable.row(this).data().production_order;
        $.post('getRelationDataWithOrderId', {'productionOrderId': selectedID}, function (res) {
            tabVm.planTableData = res.sourcePlan;
            tabVm.taskTableData = res.productionTask;
            tabVm.bomTableData = res.bomData;
            tabVm.stockOutTableData = res.stockOutData;
        });
    });

    var preTaskVm = new Vue({
        el : '#tasks',
        data : function () {
            return {
                preTaskData : [],
                taskData : [],
                edit_list:'',
                groupInfoData : [],
                updData : [],
                formLabelWidth:'40%',
                dialogFormVisible : false,
                dialogFormVisible_editor:false
            }
        },
        computed : {
            totalNum : function () {
                var tmpTotalNumber = 0;
                for (var p = 0; p < this.taskData.length;p++) {
                    tmpTotalNumber += parseInt(this.taskData[p].task_number);
                    this.updData[p].id = this.taskData[p].order_pid;
                    this.updData[p].num = this.taskData[p].task_number;
                }
                return tmpTotalNumber;
            }
        },
        methods: {
            updatePreNum: function (index) {
                if (index !== -1) {
                    if (!this.taskData[index].task_number || parseInt(this.taskData[index].task_number) <= 0){
                        layer.msg('数量不可以低于1');
                        this.taskData[index].task_number = 1;
                    }
                    if (parseInt(this.taskData[index].task_number) > parseInt(this.taskData[index].source_order.pro_num)) {
                        layer.msg('分配数量超过了源单未分配数量，非法');
                        this.taskData[index].task_number = parseInt(this.taskData[index].source_order.pro_num);
                    }
                    if (parseInt(this.taskData[index].task_number) > parseInt(this.taskData[index].source_order.t2)) {
                        layer.msg('可能未下推足够的生产原材料，超过了可下推的数量限制，当前最多可下推数量:' +parseInt(this.taskData[index].source_order.t2));
                        this.taskData[index].task_number = parseInt(this.taskData[index].source_order.t2);
                    }
                }

                for (var m = 0; m < preTaskVm.groupInfoData.length; m++) {
                    preTaskVm.groupInfoData[m]['pre_num'] = 0;
                    for (var n = 0; n < preTaskVm.taskData.length; n++) {
                        if (parseInt(preTaskVm.taskData[n].task_group) === parseInt(preTaskVm.groupInfoData[m].id)) {
                            preTaskVm.groupInfoData[m]['pre_num'] += parseInt(preTaskVm.taskData[n]['task_number']);
                        }
                    }
                }
            },
            delAction: function (val,key) {
                this.taskData.splice(key, 1);
                this.updData.splice(key, 1);
                this.updatePreNum(-1);
            },
            submitTask : function () {
                this.updatePreNum(-1);

                if (!this.taskData.length) {
                    layer.msg('没有要提交的数据');
                    preTaskVm.dialogFormVisible = false;
                    return false;
                }
                for(var p = 0; p < this.taskData.length;p++) {
                    if (parseInt(this.taskData[p].task_number) <= 0) {
                        layer.msg('数据有误，不能提交');
                        return false;
                    }
                }
                layer.confirm('确认提交这些生产任务?',
                    {
                        icon: 3,
                        title:'提示'
                    }, function(index){
                        $.post('/Dwin/Production/addProductionTask', {
                            data : preTaskVm.taskData,
                            updData : preTaskVm.updData
                        },function (res) {
                            if (res.status == 200){
                                layer.msg('提交成功', function () {
                                    preTaskVm.taskData = [];
                                    preTaskVm.preTaskData = [];
                                    preTaskVm.updData = [];
                                    oTable.ajax.reload(null,false);
                                });
                            } else {
                                layer.msg(res.msg)
                            }
                            preTaskVm.dialogFormVisible = false;
                        });
                        layer.close(index);
                });
            },
            edit_DialogForm(){
                var data = {
                    'id':this.edit_list.id,
                    'plan_start_time':this.edit_list.start_t,
                    'plan_end_time':this.edit_list.end_t,
                    'plan_number':this.edit_list.plan_number
                }
                $.post('/Dwin/Production/editProductionOrder', data , function (res) {
                    if(res.status == 200){
                        oTable.ajax.reload()
                        this.dialogFormVisible_editor = false
                    }
                    layer.msg(res.msg)
                })
            }
        }
    });



    // 当dataTables变动时取消选中
    $('table').on('processing.dt', function () {
        selectedID = undefined;
        $('tr').removeClass('selected')
    });

    function getTempObj(obj, preObj) {
        obj.product_id  = preObj.product_id;
        obj.product_no  = preObj.product_no;
        obj.product_name  = preObj.source_order.product_name;
        obj.order_pid   = preObj.order_pid;
        obj.task_line   = preObj.task_line;
        obj.task_group_name  = preObj.task_group_name;
        obj.task_line_name  = preObj.task_line_name;
        obj.task_group  = preObj.task_group;
        obj.task_number = parseInt(preObj.task_number);
        obj.source_order_string = preObj.source_order_string;
        obj.task_start_time = parseInt(preObj.task_start_time * 1000);
        obj.task_end_time   = parseInt(preObj.task_end_time * 1000);
        obj.timeRangeSetting = [obj.task_start_time, obj.task_end_time];
        obj.tips = "";
        obj.source_order = preObj.source_order;
        obj.base_group = preObj.base_group;
        return obj;
    }

    function getUpdObj(updObj, preObj) {
        updObj.id  = preObj.order_pid;
        updObj.num = updObj.task_number;
        return updObj;
    }

    var pushBtn = $('.btn-push');
    pushBtn.on('click', function () {
        preTaskVm.preTaskData = [];
        preTaskVm.taskData    = [];
        preTaskVm.updData       = [];
        preTaskVm.groupInfoData = [];
        var str = [];
        var typeId = $(this).attr('data-id');
        planTBody.children('tr').each(function () {
            if ($(this).hasClass('selected')) {
                preTaskVm.preTaskData.push(oTable.row(this).data());
                str.push(oTable.row(this).data().id);
            }
        });
        if(!preTaskVm.preTaskData.length) {
            var returnSet = ['','下推'];
            var msg = returnSet[typeId];
            layer.msg('未选中要' + msg + "的生产计划");
        } else {
            $.post('/Dwin/Production/getPreTaskData', {
                orderIds : str
            },function (res) {
                if (res.status !== 200) {
                    layer.msg(res.msg);
                    return false;
                }
                preTaskVm.preTaskData   = res.data.taskData;
                preTaskVm.groupInfoData = res.data.assignData;

                var obj = {}, objTmp ={},updTmp ={},upd = {};

                for (var i = 0; i < preTaskVm.preTaskData.length; i++) {
                    updTmp = {};
                    upd    = {};
                    obj = {};
                    objTmp = {};
                    objTmp = getTempObj(obj, preTaskVm.preTaskData[i]);
                    preTaskVm.taskData.push(objTmp);
                    upd = getUpdObj(updTmp, preTaskVm.preTaskData[i]);
                    preTaskVm.updData.push(upd);
                }
                preTaskVm.dialogFormVisible = true;
            });
        }
    });
    var materialOutBtn = $(".btn-material");
    materialOutBtn.on('click', function () {
        if(selectedID == undefined){
            layer.msg('请选择一个出库申请单')
        }else{
            var index = layer.open({
                type: 2,
                title: '湖南迪文有限公司添加领料单',
                content: '/Dwin/Stock/createStockOutProduce?id='+ selectedID,
                area: ['90%', '90%'],
                shadeClose:true,
                end: function () {
                    oTable.ajax.reload(null, false);
                }
            })
        }
    });
    $(".btn-audit").on('click', function () {
        if(selectedID == undefined){
            layer.msg('请选择一个生产计划')
        }else{
            layer.confirm('审核是否通过？',{
                icon:6,
                title:'审核',
                btn: ['通过', '不通过'],
                end:function (){
                    oTable.ajax.reload(null,false);
                }
            }, function(index, layero){
                var data = {
                    'id':selectedID,
                    'audit_status':2
                }
                $.post('/Dwin/Production/productionOrderAudit', data , function (res) {
                    layer.msg(res.msg);
                })
            }, function(index){
                var data = {
                    'id':selectedID,
                    'audit_status':1
                }
                $.post('/Dwin/Production/productionOrderAudit', data , function (res) {
                    layer.msg(res.msg)
                })
            })
        }
    })
    $(".btn-editor").on('click', function () {
        if(selectedID == undefined){
            layer.msg('请选择一个生产计划')
        }else{
            preTaskVm.edit_list = planTBodyData
            preTaskVm.dialogFormVisible_editor = true
        }
    })
    $(".btn-remover").on('click', function () {
        if(selectedID == undefined){
            layer.msg('请选择一个生产计划')
        }else{
            layer.confirm('是否确定删除？',{
                icon:4,
                title:'删除',
            }, function(index, layero){
                var data = {
                    'id':selectedID,
                }
                $.post('/Dwin/Production/delProductionOrder', data , function (res) {
                    if(res.status == 200){
                        oTable.ajax.reload()
                    }
                    layer.msg(res.msg)
                })
            })
        }
    })

    $(".btn-bom").on('click', function () {
        if(selectedID == undefined){
            layer.msg('请选择一个生产计划')
        }else{
            var layIndex = layer.confirm('是否开始确认物料bom信息（替代料的确认）？',{
                icon:6,
                title:'',
                btn: ['是', '否'],
            }, function(index, layero){
                var index = layer.open({
                    type: 2,
                    title: 'BOM配料确认',
                    content: '/Dwin/Production/productionOrderCreateBom?id='+ selectedID,
                    area: ['90%', '90%'],
                    shadeClose:true,
                    end: function () {
                        oTable.ajax.reload(null, false);
                    }
                });
                layer.close(layIndex);

            })
        }
    })
</script>
</body>
</html>