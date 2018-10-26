<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM--业绩奖金</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/html/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/html/css/plugins/select2/select2.min.css" rel="stylesheet">
    <!--<link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">-->
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
        .table-responsive2{
            font-size:10px!important;
        }
        .export-div{
            margin-top: 23px;
            margin-left: 40px;
        }
        th,td { white-space: nowrap; } 
        #Noclick{
            margin-top: 5px;
            padding-top:4px; 
            /* padding: 5px 10px !important; */
            font-size: 12px;
            line-height: 1.5;
            border-radius: 3px;
            color: #fff;
            background-color: #5cb85c !important;
            border-color: #4cae4c;
             border: 1px solid #fff !important;
            /*background-color: #fff;
            outline:none; */
        }
        /* #Noclick label{
            
        }    */
    </style>
</head> 
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins" id="order-div">
                <div class="tabs-container">
                <div class="ibox-title">
                </div>
                <div class="ibox-content">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <div class="col-sm-12" style="margin: 10px 0;">
                                    <div class="fa-hover col-sm-4">
                                        <div class="col-sm-5">
                                            <label>起：收货时间</label>
                                            <input id="timeLimit1" type="text" class="form-control" onclick="laydate({ istime: true,format:'YYYY-MM-DD hh:mm:ss',choose:changeData()})">
                                        </div>
                                        <div class="col-sm-5">
                                            <label>止：收货时间</label>
                                            <input id="timeLimit2" type="text" class="form-control" onclick="laydate({ istime: true,format:'YYYY-MM-DD hh:mm:ss',choose:changeData()})">
                                        </div>
                                        <div>
                                            <label>时间选择</label>
                                            <button type="button" class="btn btn-success btn-sm" id="timeConfirm">确认</button>
                                        </div>
                                    </div>                                    
                                    <div class="fa-hover  col-sm-2">
                                        <label for="deptId">客户名称</label>
                                        <div>
                                            <select id="select2_sample" name="customer" style="width:75%;" id="deptId" onchange="changeData();">
                                                <option value="">所有</option>    
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="fa-hover col-sm-4">
                                        <div class="export-div">
                                            <button type="button" class="btn btn-danger btn-sm" id="exportBtn">导出数据</button>
                                        </div>
                                    </div> -->
                                    <div class="fa-hover  col-sm-6">
                                        <div>
                                            <label>高级选项</label>
                                        </div>
                                        <div>
                                            <label>按：</label>
                                            <select name="condition" id="condition" onchange="changeData();">
                                                <option value="">请选择</option>    
                                                <option value="1">CRM单号</option>    
                                                <option value="2">产品型号</option>    
                                            </select>
                                            <label>分组</label>
                                        </div>
                                    </div>
                                    <div class="fa-hover  col-sm-8">
                                        <button id="Noclick"  onclick="exportToExcel()">
                                            <label>导出Excel</label>
                                        </button>
                                        <div></div>
                                    </div>

                                </div> 
                                <div id="app"></div>
                                <div class="table-responsive1" id="tableArea">
                                    <table class="table table-striped table-bordered table-hover dataTables-orderList" style="overflow-x: auto;" cellspacing="0">
                                        <thead>
                                        </thead>
                                        <tbody>
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
    </div>
</div>
<script src="/Public/html/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/html/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/Public/html/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/Public/html/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/Public/html/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/Public/html/js/dist/js/select2.min.js"></script>
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="/Public/html/js/vue.js"></script>
<script src="/Public/html/js/plugins/layer/laydate/laydate.js"></script>
<script>

    //客户模糊搜索
    $(document).ready(function(){
        $("#select2_sample").select2({
            ajax: {
                delay   : 500,
                url     : "/Dwin/SaleService/addSelect",//请求的API地址
                dataType: 'json',//数据类型
                data    : function(params){

                    return {
                        q   : params.term//此处是最终传递给API的参数
                    }
                }, function(data){
                    return data;
                }//返回的结果
            }
        });//启动select2
    });
    
    var controller = "/Dwin/SaleService";
    var dataTableOrderListDiv = $(".dataTables-orderList");
    var deptSel  = $("#deptId");
    var staffSel = $("#staffId");
    var timeLimit1 = $("#timeLimit1");
    var timeLimit2 = $("#timeLimit2");
    var timeConfirmBtn = $("#timeConfirm");
    var chosenSel = $(".chosen-select");
    var nowT = new Date().getTime();

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
        var oTables = dataTableOrderListDiv.DataTable();
        oTables.ajax.reload();
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
    timeConfirmBtn.on('click', function () {
        changeData();
    });
    var vm = new Vue({
        el:'#app',
        data () {
            return {

            }
        },
        created() {
            
        },
    })
    var clicktag = 0;
    function exportToExcel(){
        $('#Noclick').attr("disabled",true)
        var data  = {
            "timeLimit1" : function () {
                return document.getElementById('timeLimit1').value;
            },
            "timeLimit2" : function () {
                return document.getElementById('timeLimit2').value;
            },
            "deptLimit" : function () {
                return $("select[name='customer'] option:selected").attr("value");
            },
            "groupCondition" : function () {
                return $("select[name='condition'] option:selected").attr("value");
            }
        }
        $.post('/Dwin/SaleService/exportToExcel', data, function (res) {
            if(res.status == 200){
                var url = res.data.file_url;
                layer.msg(res.msg)
                var index = layer.confirm("文件生成完毕，是否下载到本地？",{
                    btn:['是','否']
                },function () {
                    window.open(url);
                    layer.close(index);
                })
            }else {
                alert(res.msg);
            }
            $('#Noclick').attr("disabled",false)
        })
    }


    $(document).ready(function () {
        timeLimit2.val(getDate(nowT, true));
        timeLimit1.val(getDate(nowT - 3600*24*1000,false));
        var oTables = dataTableOrderListDiv.dataTable({
            "scrollX"      : true,
            "order"        : [[0,'desc']],
            "paging"       : true,
            "autoWidth"    : false,
            "pagingType"   : "full_numbers",
            "lengthMenu"   : [10, 25, 50, 100],
            "bDeferRender" : true,
            "processing"   : true,
            "searching"    : true, //是否开启搜索
            "serverSide"   : true,//开启服务器获取数据
            "ajax"         : {  //获取数据
                "url"   : controller + "/saledataExport",
                "type"  : 'post',
                "data"  : {
                    "timeLimit1" : function () {
                        return document.getElementById('timeLimit1').value;
                    },
                    "timeLimit2" : function () {
                        return document.getElementById('timeLimit2').value;
                    },
                    "deptLimit" : function () {
                        return $("select[name='customer'] option:selected").attr("value");                       
                    },
                    "groupCondition" : function () {
                        return $("select[name='condition'] option:selected").attr("value");                       
                    }
                }
            },
            "columns" :[ //定义列数据来源
                {'title' : "CRM单号",        'data' : "sale_number"},
                {'title' : "收货单号",       'data' : 'courier_number'},
                {'title' : "送修日期",       'data' : 'start_date'},
                {'title' : "客户名称",       'data' : "cusname"},
                {'title' : "产品型号",       'data' : "product_name"},
                {'title' : "数量",           'data' : "num"},
                {'title' : "条码日期",       'data' : "barcode_date"},
                {'title' : "业务员",         'data' : "salename"},
                {'title' : "业务审核",       'data' : 'is_show'},
                {'title' : "状态",           'data' : "is_ok"},
                {'title' : "维修员",         'data' : "reperson_name"},
                {'title' : "售后方式",       'data' : "sale_mode"},
                {'title' : "客户反馈",       'data' : "customer_question"},
                {'title' : "故障现象",       'data' : "situation"},
                {'title' : "维修反馈",       'data' : null},
                {'title' : "维修费用(元)", 'data' : "piece_wage"},
                {'title' : "费用明细",       'data' : "fault_info"},
                {'title' : "发货单号",       'data' : "track_number"},
                {'title' : "发货批次",       'data' : "bactch"},
                {'title' : "发货/入库数量",  'data' : "send_num"},
                {'title' : "发货/入库时间",  'data' : null},
                {'title' : "发货/入库人",    'data' : "send_man"},
                {'title' : "备注",           'data' : "note"},
                ],
            "columnDefs"   : [ //自定义列                         
                {
                    "targets" : 2,
                    "data" : 'start_date',
                    //送修时间
                    "render" : function(data, type, row) {                    
                        var time = row.start_date;
                        if((time == null) || (time == " ")){
                            var a = "";
                            return a;
                        }else{
                            var newtime = time*1000;//这里需要注意js时间戳精确到毫秒,所以要乘以1000后转换.       
                            function gettime(t){
                                var _time=new Date(t);
                                var   year=_time.getFullYear();//2017
                                var   month=_time.getMonth()+1;//7
                                var   date=_time.getDate();//10
                                var   hour=_time.getHours();//10
                                var   minute=_time.getMinutes();//56
                                var   second=_time.getSeconds();//15
                                return   year+"-"+month+"-"+date+"   "+hour+":"+minute+":"+second;//这里自己按自己需要的格式拼接
                            }
                            return (gettime(newtime));//输出2017年7月10日 10:56:15  
                        }                       
                    }
                },
                {
                    "targets" : 8, 
                    "data" : 'is_show',
                    "render" : function(data, type, row) {                    
                        var html = row.is_show;
                        if(html == 1){
                            html = '有效';
                            return html;
                        }else if(html == 2){
                            html = '无效';
                            return html;
                        }else {
                            html = '未审核';
                            return html;
                        }
                    }
                },
                {
                    "targets" : 9,
                    "data" : 'status',
                    //状态
                    "render" : function(data, type, row) {                    
                        var html = row.status;
                        if(html ==1){
                            html = '待检测';
                        }else if(html == 2){
                            html = '待维修';
                        }else if(html == 3){
                            html = '已发货';
                        }else{
                            html = '已入库';
                        }
                        return html;    
                    }
                },
                {
                    "targets" : 14,
                    "data" : 're_mode',
                    //维修反馈
                    "render" : function(data, type, row) {                    
                        var html = row.re_mode;
                        var html1 = row.mode_info;
                        if(html == 0 && html1 ==0){
                            html = '';
                            html1 = '';
                            return html + html1;   
                        }else if(html == 0 && html1 != 0){   
                            return html1;
                        }else if(html != 0 && html1 ==0){
                            return html;
                        }else{
                            return html + html1;  
                        }                     
                    }
                },
                {
                    "targets" : 20,
                    "data" : 'send_date',
                    //发货/入库时间
                    "render" : function(data, type, row) {                    
                        if(row.sale_way == 0){
                            var time = row.send_date;
                        }else{
                            var time = row.over_time;
                        }
                        if((time == null) || (time == " ")){
                            var a = "";
                            return a;
                        }else{
                            var newtime = time*1000;//这里需要注意js时间戳精确到毫秒,所以要乘以1000后转换.       
                            function gettime(t){
                                var _time=new Date(t);
                                var   year=_time.getFullYear();//2017
                                var   month=_time.getMonth()+1;//7
                                var   date=_time.getDate();//10
                                var   hour=_time.getHours();//10
                                var   minute=_time.getMinutes();//56
                                var   second=_time.getSeconds();//15
                                return   year+"-"+month+"-"+date+"   "+hour+":"+minute+":"+second;//这里自己按自己需要的格式拼接
                            }
                            return (gettime(newtime));//输出2017年7月10日 10:56:15  
                        }                       
                    }
                },
            ]
        });
    });      
</script>
</body>
</html>