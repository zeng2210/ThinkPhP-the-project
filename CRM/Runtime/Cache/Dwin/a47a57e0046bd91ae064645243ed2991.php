<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.6/theme-chalk/index.css" rel="stylesheet">

    <style>
        body{
            color:black;
        }
        .selected{
            background: #d0d27e!important;
        }
        #staff th,td{
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
        /*.table-responsive{*/
            /*height: 400px;*/
            /*overflow: auto;*/
        /*}*/
        .dataTables_scroll{
            overflow: auto !important;
        }
        .dataTables_scrollHead{
            overflow: initial !important;
        }
        .dataTables_scrollBody{
            overflow:initial !important;
        }
        .table2000{
            width: 2000px;
        }
        #staff_wrapper{
            overflow: hidden;
        }
        .dataTables_scrollBody thead{
            visibility: hidden;
        }
        div.dataTables_scrollBody table{
            margin-top: -25px!important;
            margin-left: 1px;
        }
        .tab-pane{
            overflow: auto;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding:3px!important;
        }
        .el-dialog__body{
            text-align: center
        }
        /* 上传 */
        .uploadResume .el-upload .el-upload__input{
           display: none !important;
       }
       .float-e-margins .btn {
            margin-bottom: 3px !important;
        }
       .ele-BUT{
            color: #1c84c6;
            border: 1px solid #1c84c6;
            border-radius:3px;
       }
       li.active > a{
            background-color: #1c84c6 !important;
            color: #fff !important;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
                <div class="title">
                        <h4>湖南迪文有限公司入库申请单列表</h4>
                        <div>
                            <button class="btn btn-xs btn-outline btn-success refresh">刷 新</button>
                            <button class="btn btn-xs btn-outline btn-success revamp_staff"><span class="glyphicon glyphicon-align-justify"></span>修改</button>
                            <button class="btn btn-xs btn-outline btn-success details_staff"><span class="glyphicon glyphicon-cloud-upload"></span>下推</button>
                            <button class="btn btn-xs btn-outline btn-success indent_staff"><span class="glyphicon glyphicon-remove"></span>删除</button>
                        </div>
                    </div>
            <div class="table-responsive">
                <table id="staff" class="table table-bordered table-hover table-striped">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="ibox-content" id="app">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">物料清单</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="contact">
                        <table class="table table-striped table-hover table-border">
                            <tr>
                                <th>物料编号</th>
                                <th>物料型号</th>
                                <th>物料名称</th>
                                <th>入库数</th>
                                <th>入库仓库</th>
                                <th>入库备注</th>
                            </tr>
                            <tr v-for="item in bomInfo">
                                <td>{{item.product_no  || ''}}</td>
                                <td>{{item.product_name  || ''}}</td>
                                <td>{{item.product_number  || ''}}</td>
                                <td>{{item.shipment_num  || ''}}</td>
                                <td>{{item.rep_name || ''}}</td>
                                <td>{{item.shipment_tips || ''}}</td>
                            </tr>
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
<script src="/Public/html/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/Public/html/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/Public/html/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.6/index.js"></script>

<script>
    var stockInTypeMap = <?php echo (json_encode($stockInTypeMap)); ?>;
    var stockInMap = <?php echo (json_encode($stockInMap)); ?>;

    // var stock_out_type1 = 1
    var stock_out_type1
    var table = $('#staff'). DataTable({
        ajax: {
            type: 'post',
            url : '/Dwin/Stock/otherStockInApplyIndex',
            data: {     
                flag: 1
            }
        },
        "scrollY": 440,
        "scrollX": false,
        "scrollCollapse": true,
        "destroy"      : true,
        "paging"       : true,
        "autoWidth"	   : false,
        "pageLength": 25,
        serverSide: true,
        // order:[[21, 'desc']],
        columns: [
            {title:'单据编号', searchable: true, data: 'receipt_number'},
            {title:'入库类型',searchable: true, data: 'storage_type',render:function(data){return stockInTypeMap[+data]}},
            {title:'入库部门',searchable: true, data: 'storage_division'},
            {title:'入库源单编号',searchable: true, data: 'storage_former_number'},
            {title:'制单人',searchable: true, data: 'single_name'},
            {title:'制单时间',searchable: true, data: 'single_time'},
            {title:'入库状态',searchable: true, data:  'storage_status',render:function(data){return stockInMap[+data]}}
        ],
        oLanguage: {
            "oAria": {
                "sSortAscending": " - click/return to sort ascending",
                "sSortDescending": " - click/return to sort descending"
            },
            "LengthMenu": "显示 _MENU_ 记录",
            "ZeroRecords": "对不起，查询不到任何相关数据",
            "EmptyTable": "未有相关数据",
            "LoadingRecords": "正在加载数据-请等待...",
            "Info": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录。",
            "InfoEmpty": "当前显示0到0条，共0条记录",
            "InfoFiltered": "（数据库中共为 _MAX_ 条记录）",
            "Processing": "<img src='../resources/user_share/row_details/select2-spinner.gif'/> 正在加载数据...",
            "Search": "搜索：",
            "Url": "",
            "Paginate": {
                "sFirst": "首页",
                "sPrevious": " 上一页 ",
                "sNext": " 下一页 ",
                "sLast": " 尾页 "
            }
        }
    })
    var ApplyId
    var bom_id
    var contractId
    var Apply_status
    var ApplyData
    $('tbody').on('click', 'tr', function () {
        ApplyData = table.row(this).data();
        // contractId = ApplyData.contract_pid
        ApplyId = ApplyData.id;   // 订单主键
        bom_id = ApplyData.bom_id      //订单编号
        Apply_status = ApplyData.audit_status
        $('tr').removeClass('selected')
        $(this).addClass('selected')
        $.post('/Dwin/Stock/getOtherStockInApplyMaterial', {id: ApplyId}, function (res) {

            if (res.status == 200) {
                vm.bomInfo = res.data
            }
        })
    })
    var vm = new Vue({
        el: '#app',
        data: function () {
            return {
                bomInfo:[],
                // dialogVisible:false,
                dialogVisible_delete:false,
                dialogUpdataExecl:false,
                dialog:{
                    bom_id:'',
                    auditMSG:2,
                    groung_status:1,
                    del_status:0,
                    bomNumber:[]
                },
                BomNUM: [],
                options_status:[],
                options_del:[],
                options_audit:[],
                upLoadData:{
                    id:''
                }
            }
        },
        methods: {
             // 获取编号
             getBomNumber_num:function(item) {
                $.get('createBomId',function (res) {
                    if(res.status==200){
                        vm.dialog.bom_id=res.data.bomIdString
                        vm.$message({
                            showClose: true,
                            message: res.msg,
                            type: 'success'
                        });
                    }else{
                        vm.$message({
                            showClose: true,
                            message: res.msg,
                            type: 'error'
                        });
                    }
                    
                })
            }
        }
    })
    // delete 申请单
    $('.indent_staff').on('click', function () {
        $.post('<?php echo U("Dwin/Stock/delStockInApply");?>', {applyId:ApplyId} , function (res) {
            if(res.status == 200){
                table.ajax.reload()
            }
            layer.msg(res.msg)
        })
    })
    // 出库单下推
    $('.details_staff').on('click', function () {
        if (ApplyId === undefined || !ApplyId){
            layer.msg('请选择一个出库申请单')
        } else {
            if(Apply_status == '1'){
                layer.msg('当前生请单没通过审核不能下推！')
            }else if(Apply_status == '0'){
                layer.msg('当前生请单未通过审核不能下推申请单！')
            }else{
                var index = layer.open({
                    type: 2,
                    title: '湖南迪文有限公司出库申请单下推',
                    content: '/Dwin/Stock/putStockInApply?id=' + ApplyId,
                    area: ['90%', '90%'],
                    shadeClose:true,
                    end: function () {
                        table.ajax.reload()
                    }
                }) 
            } 
        }
    })
    
    // BOM  修改
    $('.revamp_staff').on('click', function () {
        if(ApplyId == undefined || !ApplyId){
            layer.msg('请选择一个出库申请单')
        }else{
            if(Apply_status == '2'){
                layer.msg('当前项已启用，不能修改！')
            }else{
                var index = layer.open({
                    type: 2,
                    title: '湖南迪文有限公司出库申请单修改',
                    content: '/Dwin/Stock/editStockInApply?id='+ ApplyId,
                    area: ['90%', '90%'],
                    shadeClose:true,
                    end: function () {
                        table.ajax.reload()
                    }
                }) 
            }
        }
    })
    // 刷新
    $('.refresh').on('click', function () {
        table.order([[5, 'desc']])
        table.ajax.reload()
    })
</script>
</body>
</html>