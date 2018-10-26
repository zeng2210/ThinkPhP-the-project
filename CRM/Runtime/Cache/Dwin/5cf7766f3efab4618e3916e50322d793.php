<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>客户列表-数据表格</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <!-- Data Tables -->
    <link href="/Public/html/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <style type="text/css">
        body {
            color: black;
        }
        td{
            cursor:pointer;
        }
        .hidden{
            display:none;
        }
        /* 自适应 */
        .dataTables_scrollHeadInner{
            width: 100% !important;
        }
        .dataTables_scrollHeadInner table{
            width: 100% !important;
        }
        .dataTables_scrollBody table{
            width: 100% !important;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>供应商负责人变更</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <input class="btn btn-outline btn-success" type="button" id="assignAll" value="变更所有" style="width: 10%; text-align: center;">
                    <input class="btn btn-outline btn-success" type="button" id="assignSel" value="变更选中" style="width: 10%; text-align: center;">
                </div>
                <div class="ibox-content">
                    <select class="form-control chosen-select" name="userId" id="useId" style="width:30%;" tabindex="2">
                        <option value="">请选择需要转移客户的业务员姓名</option>
                        <?php if(is_array($staffData)): $i = 0; $__LIST__ = $staffData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <span>================================>>></span>
                    <!-- <div id="useId_2"></div> -->
                    <select class="form-control chosen-select" name="userIdto" id="useId_2" style="width:30%;" tabindex="2">
                        <option value="">请选择把客户转移给哪位业务员</option>
                        <?php if(is_array($staffData)): $i = 0; $__LIST__ = $staffData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <table class="table table-striped table-bordered table-hover dataTables-assignTable">
                        <tbody>
                        <tr class="gradeX">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <input type="hidden" name="charger" id="charger" value="">
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
    </div>
</div>
<script src="/Public/html/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/html/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/Public/html/js/demo/form-advanced-demo.min.js"></script>
<script src="/Public/html/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/Public/html/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="/Public/html/js/dwin/customer/common_func.js"></script>
<script>
var controller = "/Dwin/Purchase";
var selected = [];
var co;
var kid = $("#charger").val();

$(document).ready(function() {

    $(".dataTables-assignTable").dataTable({
        "sPaginationType": "bootstrap",
        "paging"       : true,
        'pagingType'   : 'input',
        "pagingType"   : "full_numbers",
        "lengthMenu"   : [5, 10, 25, 50],
        "bDeferRender" : true,
        "processing"   : true,
        "searching"    : true, //是否开启搜索
        "serverSide"   : true,//开启服务器获取数据
        "ajax"         :{ // 获取数据
            "url"   : '/Dwin/Purchase/supplierChargeList',
            "type"  : 'post',
            data    : {
                charger : function () {
                 return document.getElementById('useId').value;
                },
            }
        },
        "columns"      :[ //定义列数据来源
            // {'title' : "供应商编号", 'id':"id"},//隐藏
            {'title' : "ID",'data':"id",'sClass':'hidden'},//隐藏
            {'title' : "供应商编号",'data':"supplier_id"},
            {'title' : "供应商名称", 'data' : "supplier_name"},
            {'title' : "营业执照", 'data' : "business_licence"},
            {'title' : "营业范围", 'data' : "business_scope"},
            {'title' : "企业性质", 'data' : "enterprise_cate"},
            {'title' : "法人代表", 'data' : "legal_name"},
            {'title' : "开户行", 'data' : "account_bank"},
            {'title' : "账号", 'data' : "account_number"},
            {'title' : "审核状态", 'data' : "audit_status", render: function (data){return ['未审核', '不合格','合格'][+data]}},
            {'title' : "质控审核状态", 'data' : "second_audit", render: function (data){return ['审核', '审核不合格','合格完成'][+data]}}
            
        ],
        "rowCallback"  : function( row, data ) {
            if ( $.inArray(data.id, selected) !== -1 ) {
                $(row).addClass('selected');
            }
        },
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
    });//table end
});
 //inintTable END

$("#useId").on('change', function () {
   var oTable1 = $(".dataTables-assignTable").DataTable();
   oTable1.ajax.reload();
});

$(".dataTables-assignTable tbody").on('mouseover', function() {
    co = $(this).css('background-color');
    return co;
});
$('.dataTables-assignTable tbody').on('click', 'tr', function () {
    var iii = 0
    var nTds = $("td",this);
    var id = $(nTds[0]).text();
    var index = $.inArray(id, selected);
    // 包含
    if ( index === -1) {
        selected.push( id );
        $(this).css('background-color','yellow');
        // 不包含
    } else {
        selected.splice( index, 1 );
        $(this).css('background-color',co);
    }
    $(this).toggleClass('selected');
});


 //  变更所有 
$("#assignAll").on('click', function () {
    $(this).attr('disabled', 'disabled');
    // 需要变更人
    var fromId = $('#useId').val();
    // 接受人
    var toId   = $('#useId_2').val();

    var fromName = $('#useId option:selected').text();
    var toName = $('#useId_2 option:selected').text();
    if (fromId == '') {
        layer.alert('请选择需要变更的负责人');
        $("#assignAll").attr('disabled', false);
        return false;
    }
    if (toId == '') {
        layer.alert('请选择接受人姓名');
        $("#assignAll").attr('disabled', false);
        return false;
    }
    layer.confirm(
        '确定把' + fromName + '的负责人移交给' + toName + '?',
        {
            btn : ['确定','返回'],
            end : function () {
                    $("#assignAll").attr('disabled', false);
                }
        },
        function (){
            $.ajax({
                type : 'POST',
                url  : '/Dwin/Purchase/editSupplierCharge',
                data : {
                    oldChargeId : fromId,
                    newChargeId : toId,
                    newChargeName : toName,
                    type:2
                },
                success :function (msg) {
                    if (msg['status'] == 200) {
                        layer.msg(msg['msg'],
                            {
                                time : 2000
                            },
                            function(){
                                var oTable1 = $(".dataTables-assignTable").DataTable();
                                oTable1.ajax.reload();
                                selected = [];
                                $("#assignAll").attr('disabled', false);
                        });
                    } else {
                        layer.msg(msg['msg']);
                        $("#assignAll").attr('disabled', false);
                    }
                }
            });
        },
        function () {
            $("#assignAll").attr('disabled', false);
        });
});

 //  变更选中
$("#assignSel").on('click', function () {
 $(this).attr('disabled', 'disabled');
    var fromId = $('#useId').val();
    var toId = $('#useId_2').val();
    var fromName = $('#useId option:selected').text();
    var toName = $('#useId_2 option:selected').text();
    if (fromId == '') {
        layer.alert('请选择需要变更的负责人');
        $("#assignSel").attr('disabled', false);
        return false;
    }
     if (toId == '') {
        layer.alert('请选择接受人姓名');
        $("#assignSel").attr('disabled', false);
        return false;
    }
    if (selected[0] == undefined) {
        layer.alert('没有选中要变更的客户');
        $("#assignSel").attr('disabled', false);
        return false;
    } else {
        layer.confirm('确定把选中的' + fromName + '的供应商应交给' + toName + '?',
            {
                btn : ['确定','返回'],
                end : function () {
                    $("#assignSel").attr('disabled', false);
                }
            },
            function () {
                $.ajax({
                    type : 'POST',
                    url  : '/Dwin/Purchase/editSupplierCharge',
                    data : {
                        oldChargeId : fromId,
                        newChargeId : toId,
                        newChargeName : toName,
                        type:1,
                        id:selected
                    },
                    success :function (msg) {
                        if (msg['status'] == 200) {
                            layer.msg(msg['msg'],
                                {
                                    time : 2000
                                },
                                function(){
                                    var oTable1 = $(".dataTables-assignTable").DataTable();
                                    // oTable1.ajax.reload();
                                    oTable1.draw(false);
                                    selected.splice(0,selected.length);
                                    $("#assignSel").attr('disabled', false);
                            });
                        } else {
                            layer.msg(msg['msg']);
                            $("#assignSel").attr('disabled', false);
                        }
                    }
                });
            },
            function () {
                $("#assignSel").attr('disabled', false);
            });
    }
});

</script>
</body>
</html>