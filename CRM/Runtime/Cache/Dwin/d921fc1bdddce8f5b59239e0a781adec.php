<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>排产中生产计划</title>
    <link href="/Public/html/css/bootstrap.min14ed.css" rel="stylesheet">
    <!--<link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">-->
    <link href="https://cdn.bootcss.com/datatables/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/element-ui/2.3.4/theme-chalk/index.css" rel="stylesheet">
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
        .ibox{
            padding:20px;
        }
        .el-select-option-span{
            float: left;font-size: 12px;
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
                        <button type="button" class="btn btn-info btn-sm btn-push" data-id="1">下推领料单信息</button>
                        <label for="production_line">产线筛选</label>
                        <select name="" id="production_line" class="form-control change-data">
                            <option value="">所有</option>
                            <?php if(is_array($line)): $i = 0; $__LIST__ = $line;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["production_line"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <label for="production_line">排产状态筛选</label>
                        <select name="" id="production_status" class="form-control change-data">
                            <option value="">所有</option>
                            <option value="0,1">排产中</option>
                            <option value="2">排产完毕</option>
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
        <!--<div class="col-sm-12">-->
            <!--<div class="ibox float-e-margins" id="productionGroupDiv">-->
                <!--<div class="ibox-content">-->
                    <!--<h3>班组排产情况</h3>-->
                    <!--<form class="form-inline">-->
                        <!--<button type="button" class="btn btn-info btn-sm refresh">刷新</button>-->
                    <!--</form>-->

                    <!--<div class="table-responsive1">-->
                        <!--<table class="table table-striped table-bordered table-hover table-full-width dataTables-productionList" id="productionGroup">-->
                            <!--<thead>-->
                            <!--</thead>-->
                            <!--<tbody>-->
                            <!--</tbody>-->
                        <!--</table>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    </div>
    <div class="row">
        <div class="col-sm-12">

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins" id="tasks">
                <div class="ibox-content">
                    <div class="table-responsive1">
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
                                                   @change="updatePreNum"
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
                                            @change="updatePreNum"
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
<script src="https://cdn.bootcss.com/datatables/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.bootcss.com/datatables/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="/Public/html/js/dwin/finance/common_finance.js"></script>
<script src="https://cdn.bootcss.com/element-ui/2.3.4/index.js"></script>
<script>
    var stockOutMap = <?php echo (json_encode($stockOutMap)); ?>;
    console.log(stockOutMap)
    var oTable;
    var controller = "/Dwin/Production";
    var tableDiv = $("#productionPlan");
    var selectedID,selectedOrder;

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
        // "scrollX": true,
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
                }
            }
            // success:function(res){
            //     console.log(res)
            // }
        },
        "order": [[ 7, "desc" ]],
        "columns": [
            {data:'production_code', title:'计划单号'},
            {data:'production_line', title:'生产线'},
            {data:'product_no', title:'物料编码'},
            {data:'plan_number', title:'生产数量'},
            {data:'assign_number', title:'已排产数量'},
            {data:'start_t', title:'开始时间'},
            {data:'end_t', title:'计划完成时间'},
            {data:'production_status', title:'排产状态'},
            // {data:'stock_status'},
            {data:'stock_status',render:function(data){return stockOutMap[+data]}, title:'出库状态'},
            {data:'tips' , title:'排产备注'}
        ],
        "columnDefs": [ //自定义列
//            {
//                "targets": 9,
//                "data": 'tips',
//                "render": function (data, type, row) {
//                    if (row.tips.length > 14) {
//                        var html = "<span data='" + row.tips + "'>" + row.tips.substring(0,14) + "...</span>";
//                    } else {
//                        var html = "<span>" + row.tips + "</span>";
//                    }
//                    return html;
//                }
//            }
        ]
        });

    });
    $(".change-data").on('change', function () {
        oTable.ajax.reload();
    });
    $('.refresh').on('click', function () {
        oTable.ajax.reload();
    });

    var tabVm = new Vue({
        el: '#detailsModel',
        data: function () {
            return {
                planTableData:[],
                taskTableData:[]
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
    planTBody.on("click", "tr", function () {
        $(this).addClass('selected').siblings().removeClass('selected')
        // if ($(this).hasClass('selected')) {
        //     $(this).removeClass('selected');
        // } else {
        //     $(this).addClass('selected');
        // }
        selectedID = oTable.row(this).data().id;
        console.log(selectedID)
        selectedOrder = oTable.row(this).data().production_order;
        $.post('getRelationDataWithOrderId', {'productionOrderId': selectedID}, function (res) {
            tabVm.planTableData = res.sourcePlan;
            tabVm.taskTableData = res.productionTask;
        });
    });

    var preTaskVm = new Vue({
        el : '#tasks',
        data : function () {
            return {
                preTaskData : [],
                taskData : [],
                groupInfoData : [],
                updData : []
            }
        },
        computed : {
            totalNum : function () {
                var tmpTotalNumber = 0;
                for (var p = 0; p < this.taskData.length;p++) {
                    if (!this.taskData[p].task_number || parseInt(this.taskData[p].task_number) <= 0){
                        layer.msg('数量不可以低于1');
                        this.taskData[p].task_number = 1;
                    }
                    if (parseInt(this.taskData[p].task_number) > parseInt(this.taskData[p].source_order.pro_num)) {
                        layer.msg('分配数量超过了源单未分配数量，非法');
                        this.taskData[p].task_number = parseInt(this.taskData[p].source_order.pro_num);
                    }
                    tmpTotalNumber += parseInt(this.taskData[p].task_number);
                    this.updData[p].id = this.taskData[p].order_pid;
                    this.updData[p].num = this.taskData[p].task_number;
                }
                return tmpTotalNumber;
            }
        },
        methods: {
            updatePreNum : function () {
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
                this.updatePreNum();
            },
            submitTask : function () {
                this.updatePreNum();
                if (!this.taskData.length) {
                    layer.msg('没有要提交的数据');
                    return false;
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
                                    oTable.ajax.reload();
                                });
                            } else {
                                layer.msg(res.msg)
                            }
                        });
                        layer.close(index);
                });
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

    // BOM  修改
    $('.btn-push').on('click', function () {
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
                    oTable.ajax.reload()
                }
            })     
        }
    })



    // var pushBtn = $('.btn-push');
    // pushBtn.on('click', function () {
    //     preTaskVm.preTaskData = [];
    //     preTaskVm.taskData    = [];
    //     preTaskVm.updData       = [];
    //     preTaskVm.groupInfoData = [];
    //     var str = [];
    //     var typeId = $(this).attr('data-id');
    //     planTBody.children('tr').each(function () {
    //         if ($(this).hasClass('selected')) {
    //             preTaskVm.preTaskData.push(oTable.row(this).data());
    //             str.push(oTable.row(this).data().id);
    //         }
    //     });
    //     if(!preTaskVm.preTaskData.length) {
    //         var returnSet = ['','下推'];
    //         var msg = returnSet[typeId];
    //         layer.msg('未选中要' + msg + "的生产计划");
    //     } else {
    //         $.post('/Dwin/Production/getPreTaskData', {
    //             orderIds : str
    //         },function (res) {
    //             if (res.status !== 200) {
    //                 layer.msg(res.msg);
    //                 return false;
    //             }
    //             preTaskVm.preTaskData   = res.data.taskData;
    //             preTaskVm.groupInfoData = res.data.assignData;

    //             var obj = {}, objTmp ={},updTmp ={},upd = {};

    //             for (var i = 0; i < preTaskVm.preTaskData.length; i++) {
    //                 updTmp = {};
    //                 upd    = {};
    //                 obj = {};
    //                 objTmp = {};
    //                 objTmp = getTempObj(obj, preTaskVm.preTaskData[i]);
    //                 preTaskVm.taskData.push(objTmp);
    //                 upd = getUpdObj(updTmp, preTaskVm.preTaskData[i]);
    //                 preTaskVm.updData.push(upd);
    //             }
    //         });
    //     }
    // });
</script>
</body>
</html>