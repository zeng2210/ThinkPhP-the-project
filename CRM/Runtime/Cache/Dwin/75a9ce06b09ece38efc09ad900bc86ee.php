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
                        <h4>采购物料订单信息</h4>
                        <div>
                            <button class="btn btn-xs btn-outline btn-success refresh">刷 新</button>
                            <button class="btn btn-xs btn-outline btn-success indent_staff"><span class="glyphicon glyphicon-log-out"></span>订单下推入库</button>
                        </div>
                    </div>
            <div class="table-responsive1">
                <table id="staff" class="table table-bordered table-hover table-striped">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="ibox-content" id="app">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">物料订单信息</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="contact">
                        <table class="table table-striped table-hover table-border">
                            <tr>
                                <th>序号</th>
                                <th>物料编号</th>
                                <th>物料型号</th>
                                <th>购买数量</th>
                                <th>入库数量</th>
                                <th>可入库数</th>
                            </tr> 
                            <tr v-for="item in contact">
                                <td>{{item.sort_id  || ''}}</td>
                                <td>{{item.product_no  || ''}}</td>
                                <td>{{item.product_name  || ''}}</td>
                                <td>{{item.allnum  || ''}}</td>
                                <td>{{item.allinnum  || ''}}</td>
                                <td>{{item.surplusnum  || ''}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- 审核 弹框 -->
                <el-dialog title="采购订单审核：" class="selsctDialog" :visible.sync="dialogVisible" width="30%">
                   <el-button type="primary" @click="eleClick_that(2)">合 格</el-button>
                   <el-button type="primary" @click="eleClick_that(1)">不合格</el-button>
               </el-dialog>
                <!--删除 弹框 -->
                <el-dialog title="采购订单审核：" class="selsctDialog" :visible.sync="dialogVisible_delete" width="30%">
                   <el-button type="primary" @click="eleClick_that(2)">合 格</el-button>
                   <el-button type="primary" @click="eleClick_that(1)">不合格</el-button>
               </el-dialog>
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
    var table = $('#staff'). DataTable({
        ajax: {
            type: 'post',
            data: {
                flag: 1
            },
        },
        "scrollY": 440,
        "scrollX": true,
        "scrollCollapse": true,
        "destroy"      : true,
        "paging"       : true,
        "autoWidth"	   : false,
        "pageLength": 25,
        serverSide: true,
        columns: [
            {searchable: true, data: 'order_time',title:'订单时间'},
            {searchable: true, data: 'contract_id',title:'合同号'},
            {searchable: true, data: 'purchase_order_id',title:'订单编号'},
            {searchable: true, data: 'supplier_name',title:'供应商'},
            {searchable: true, data: 'create_name',title:'制单人'},
            {searchable: false, data: 'billing_method',title:'结算方式'},
            {searchable: true, data: 'purchase_mode',title:'采购模式'},
            {searchable: true, data: 'purchase_type',title:'采购方式'},
            {searchable: true, data: 'stock_status',title:'入库进度', render: function (data){return ['未入库', '入库中','入库完成'][+data]}},
            {searchable: true, data: 'audit_status',title:'审核进度', render: function (data){return ['未审核', '不通过','审核通过'][+data]}}
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
    var orderId
    var order_id
    var contractId
    var current_status
    // var id
    var orderData
    $('tbody').on('click', 'tr', function () {
        orderData = table.row(this).data();
        contractId = orderData.contract_pid
        orderId = orderData.id;   // 订单主键
        order_id = orderData.purchase_order_id      //订单编号
        current_status = orderData.audit_status
        $('tr').removeClass('selected')
        $(this).addClass('selected')
        $.post('/Dwin/Stock/getOrderProduct', {id: orderId}, function (res) {
            vm.contact = res.data
        })
    })
    var vm = new Vue({
        el: '#app',
        data: function () {
            return {
                contact:[],
                dialogVisible:false,
                dialogVisible_delete:false,
                orderId:orderId,
                upLoadData:{
                    id:''
                }
            }
        },
        methods: {
            // 审核确定
            eleClick_that(vul){
                var vm = this
                var data = {
                    'orderId': orderId,
                    'status':vul
                }
                $.post('<?php echo U("Dwin/Purchase/auditOrder");?>', data , function (res) {
                    if(res.status == 200){
                        table.ajax.reload()
                        vm.dialogVisible = false
                    }
                    layer.msg(res.msg)
                })
            }
        }
    })
    // 下推入库
    $('.indent_staff').on('click', function () {
        if (order_id === undefined){
            layer.msg('请选择一家供应商')
        } else {
            var index = layer.open({
                type: 2,
                title: '采购订单入库',
                content: '/Dwin/Stock/addStockInWithPurchase?orderId=' + orderId,
                area: ['90%', '90%'],
                shadeClose:true,
                end: function () {
                    table.ajax.reload()
                }
            })
        }
    })
    // 点击 订单详情
    $('.details_staff').on('click', function () {
        if (order_id === undefined){
            layer.msg('请选择一家供应商')
        } else {
            var index = layer.open({
                type: 2,
                title: '湖南迪文科技有限公司采购订单详情',
                content: '/Dwin/Purchase/getOrderMsg?id=' + orderId,
                area: ['90%', '90%'],
                shadeClose:true,
                end: function () {
                    table.ajax.reload()
                }
            })
        }
    })
    // 点击 编辑
    $('.edit_staff').on('click', function () {
        if (order_id === undefined){
            layer.msg('请选择一家供应商')
        } else {
            var index = layer.open({
                type: 2,
                title: '湖南迪文科技有限公司采购订单编辑',
                content: '/Dwin/Purchase/editOrder?orderId=' + orderId,
                area: ['90%', '90%'],
                shadeClose:true,
                end: function () {
                    table.ajax.reload()
                }
            })
        }
    })
    // 刷新
    $('.refresh').on('click', function () {
        table.order([[5, 'desc']])
        table.ajax.reload()
    })
    // 审核
    $('.audit_staff').on('click', function () {
        if (order_id === undefined){
            layer.msg('请选择一家供应商')
        } else {
            if(current_status == '0'){
                vm.dialogVisible = true
            }else if(current_status == '1'){
                layer.msg('该项审核不通过')
            }else if(current_status == '2'){
                layer.msg('该项审核已通过')
            }
        }
    })
    // 删除订单
    $('.delete_staff').on('click', function () {
        if (order_id === undefined){
            layer.msg('请选择一家供应商')
        } else {
            if(current_status == '2'){
                layer.msg('该订单审核已通过,不能删除订单！')
            }else if(current_status == '0'){
                layer.msg('该订单未通过,不能删除订单！')
            }else{
                var data = {
                    'orderId' : orderId,
                }
                layer.confirm('确认删除?', function (aaa) {
                    $.post('<?php echo U("/Dwin/Purchase/deleteOrder");?>', data, function (res) {
                        if (res.status == 200) {
                            table.ajax.reload()
                        }
                        layer.msg(res.msg)
                    })
                })
            }
        }
    })
</script>
</body>
</html>