<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>项目列表-数据表格</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <!-- Data Tables -->

    <link href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">

    <style type="text/css">
        body {
            color: black;
        }
        .ibox-title {
            padding-top: 7px !important;
        }
        .mouseOn {
            cursor:pointer;
            background-color: blue;
        }
        .dataTables-commonPrj{
            white-space: nowrap !important;
            text-overflow: ellipsis;
        }
        p { white-space:nowrap; }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="col-sm-2">
                        <select name="prj-type-selector" class='form-control' id="prj-type-selecter">
                            <option value="1">进展中项目</option>
                            <option value="2">验收中项目</option>
                            <option value="3">月完成项目</option>
                        </select>
                    </div>

                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-commonPrj">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/Public/html/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<!--<script src="/Public/html/js/plugins/dataTables/jquery.dataTables.js"></script>-->
<script src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<!--<script src="http://cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.js"></script>-->
<!--<script src="/Public/html/js/plugins/dataTables/dataTables.bootstrap.js"></script>-->
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script>
    var controller = "/Dwin/Research";
    $(document).ready(function(){
        $(".dataTables-commonPrj").dataTable({
            "paging"       : true,
            "sScrollX": "100%",
            "sScrollXInner": "150%",
            "sScrollCollapse": true,
            "pagingType"   : "full_numbers",
            "lengthMenu"   : [10, 15, 20, 100],
            "bDeferRender" : true,
            "processing"   : true,
            "searching"    : true, //是否开启搜索
            "serverSide"   : true,//开启服务器获取数据
            "ajax"         :{ // 获取数据
                "url"   : controller + "/showAllPrjNow",
                "type"  : 'post',
                "data"  : {
                    "k": function () {
                        return document.getElementById('prj-type-selecter').value;
                    }
                }
            },
            "columns"      :[ //定义列数据来源
                 {'title' : "参与人",       'data' : 'pname'},
                 {'title' : "部门",         'data' : "dept_name"},
                 {'title' : "项目名称",     'data' : "prj_name"},
                 {'title' : "启动时间",     'data' : 'start_time'},
                 {'title' : "预计完成时间", 'data' : 'delivery_time'},
                 {'title' : "研发费",       'data' : 'bonus'},
                 {'title' : "维护",         'data' : 'maintenance'},
                 {'title' : "方案/临时",    'data' : 'temp'},
                 {'title' : "PCB设计",      'data' : 'pcb_design'},
                 {'title' : "代码设计",     'data' : 'code_design'},
                 {'title' : "文档撰写",     'data' : 'txt_design'},
                 {'title' : "项目绩效",     'data' : 'prj_price'},
                 {'title' : "内部验收时间", 'data' : 'prjdtime'},
                 {'title' : "实际完成时间", 'data' : 'complete_time'},
                 {'title' : "项目变更记录", 'data' : 'change_num'},
                 {'title' : "验收人",       'data' : 'builder_name'}
                /* {'title':"负责人",'data':null,'class':"align-center"} // 自定义列   {'title':"负责人",'data':null,'class':"align-center"} // 自定义列*/
            ],
            "columnDefs"   : [ //自定义列
                {
                    "targets" : 0,
                    "data" : 'pname',
                    "render" : function(data, type, row) {
                        var html = row.pname;
                        return html;
                    }
                },
                {
                    'targets' : 14,
                    'data'    : 'change_num',
                    'render'  : function (data, type, row) {
                        if (row.change_num != 0) {
                            // 显示记录
                            var innerHtml = row.change_num + "条";
                        } else {
                            // 无记录
                            var innerHtml = "无记录";
                        }
                        return innerHtml;
                    }
                }
            ],
            "language"     : { // 定义语言
                "sProcessing"     : "加载中...",
                "sLengthMenu"     : "每页显示 _MENU_ 条记录",
                "sZeroRecords"    : "没有匹配的结果",
                "sInfo"           : "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                "sInfoEmpty"      : "显示第 0 至 0 项结果，共 0 项",
                "sInfoFiltered"   : "(由 _MAX_ 项结果过滤)",
                "sInfoPostFix"    : "",
                "sSearch"         : "搜索:",
                "sUrl"            : "",
                "sEmptyTable"     : "表中数据为空",
                "sLoadingRecords" : "载入中...",
                "sInfoThousands"  : ",",
                "oPaginate"       : {
                    "sFirst"    : "首页",
                    "sPrevious" : "上一页",
                    "sNext"     : "下一页",
                    "sLast"     : "末页"
                },
                "oAria"           : {
                    "sSortAscending"  : ": 以升序排列此列",
                    "sSortDescending" : ": 以降序排列此列"
                }
            }
        });


        $("#prj-type-selecter").on('change', function () {
            var oTable = $(".dataTables-commonPrj").DataTable();
            oTable.ajax.reload();
        });


        $(".dataTables-commonPrj tbody").on('mouseenter','td' ,function(e) {
            var cellindex = $(this).parent();
            var thisIndex = $(this);
            var prjId = cellindex.attr('id');
            var tdIndex = cellindex['context']['cellIndex'];
            if (tdIndex == 11) {
                $(this).addClass('mouseOn');
                $.ajax({
                    type : 'POST',
                    url  : controller + "/showPerformanceDetail",
                    data : {
                        prj_id : prjId
                        },
                    success : function (ajaxData) {
                        if (ajaxData) {
                            layer.tips("绩效分配：<br/>" + ajaxData, thisIndex,
                                    {
                                        tips : [1, '#3595CC'],
                                        area : '100px',
                                    });
                        }
                    }
                });
            } else if (tdIndex == 14) {
                $(this).addClass('mouseOn');
                $.ajax({
                    type : 'POST',
                    url  : controller + "/showPrjChangeList",
                    data : {
                        prj_id : prjId
                        },
                    success : function (ajaxData) {
                        if (ajaxData) {
                            layer.tips("变更记录内容：<br/>" + ajaxData, thisIndex,
                            {
                                tips : [1, '#3595CC'],
                                area : '800px'
                            });
                        }
                    }
                });
            } else {
                return false;
            }
        });
        $(".dataTables-commonPrj tbody").on('mouseleave','td' ,function(e) {
            $(this).removeClass('mouseOn');
            layer.closeAll('tips');
        });
    });
    /*********************************end********************************************/
</script>
</body>
</html>