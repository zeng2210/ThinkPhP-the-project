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
            /* overflow:initial !important; */
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
        /* .el-dialog__body{
            text-align: center
        } */
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
                        <h4>采购物料清单列表信息</h4>
                        <div>
                            <button class="btn btn-xs btn-outline btn-success refresh">刷 新</button>
                            <button class="btn btn-xs btn-outline btn-success edit_staff"><span class="glyphicon glyphicon-plus"></span>替换物料新增</button>
                            <!-- <button class="btn btn-xs btn-outline btn-success audit_staff"><span class="glyphicon glyphicon-adjust"></span>替换物料审核</button> -->
                            <button class="btn btn-xs btn-outline btn-success revamp_staff"><span class="glyphicon glyphicon-align-justify"></span>替换物料修改</button>
                            <!-- <button class="btn btn-xs btn-outline btn-success delete_staff"><span class="glyphicon glyphicon-remove"></span>删除替换物料</button> -->
                        </div>
                    </div>
            <div class="table-responsive">
                <table id="staff" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>物料编号</th>
                            <th>规格型号</th>
                            <th>物料名称</th>
                            <th>更新时间</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="ibox-content" id="app">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">替换物料</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="contact">
                        <table class="table table-striped table-hover table-border">
                            <tr>
                                <th>物料编号</th>
                                <th>物料型号</th>
                                <th>物料名称</th>
                                <th>更新时间</th>
                            </tr>
                            <tr v-for="item in bomInfo">
                                <td>{{item.product_no  || ''}}</td>
                                <td>{{item.product_id  || ''}}</td>
                                <td>{{item.product_number  || ''}}</td>
                                <td>{{item.update_time || ''}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- 一级审核 -->
                <el-dialog
                    title="BOM审核："
                    :visible.sync="dialogVisible"
                    width="30%"
                    >
                    <span>替换物料审核是合格？</span>
                    <span slot="footer" class="dialog-footer">
                        <el-button @click="eleClick_that(1)">不合格</el-button>
                        <el-button type="primary" @click="eleClick_that(2)">合格</el-button>
                    </span>
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
            }
        },
        "scrollY": 440,
        "scrollX": true,
        "scrollCollapse": true,
        "destroy"      : true,
        "paging"       : true,
        "autoWidth"	   : false,
        "pageLength": 25,
        serverSide: true,
        // order:[[21, 'desc']],
        columns: [
            {searchable: true, data: 'product_no'},
            {searchable: true, data: 'product_name'},
            {searchable: true, data: 'product_number'},
            {searchable: true, data: 'update_time',render: function(data){return vm.formatDateTime(data)}},
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
    var materialId
    var orderData
    $('tbody').on('click', 'tr', function () {
        orderData = table.row(this).data();
        // console.log(orderData)
        materialId = orderData.product_id
        $('tr').removeClass('selected')
        $(this).addClass('selected')
        $.post('/Dwin/bom/materialReplaceListByProductId', {id: materialId}, function (res) {
            vm.bomInfo = res.data
            // console.log(res)
            for(var i = 0 ; i < res.data.length ;i ++){
                vm.bomInfo[i].update_time = vm.formatDateTime(vm.bomInfo[i].update_time)
            }
        })
    })
    var vm = new Vue({
        el: '#app',
        data: function () {
            return {
                bomInfo:[],
                dialogVisible:false,
                dialogVisible_delete:false,
                dialogExecl:false,
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
            // 审核确定
            eleClick_that(vul){
                var vm = this
                var data = {
                    'bomId': materialId,
                    'status':vul
                }
                // $.post('<?php echo U("auditBom");?>', data , function (res) {
                //     // console.log(res)
                //     if(res.status == 200){
                //         table.ajax.reload()
                //         vm.dialogVisible = false
                //     }
                //     layer.msg(res.msg)
                // })
            },
             // 获取编号
             getBomNumber_num:function(item) {
                //  console.log(item.key)
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
            },
            // 下载 Execl
            updataExeclBUT () {
                var data = {
                    'bom_status':vm.dialog.auditMSG,
                    'is_del':vm.dialog.del_status,
                    'bomArr' : vm.dialog.bomNumber,
                    'bom_type':vm.dialog.groung_status
                }
                var index = layer.load('正在生成xlsx文件');
                $.post('exportToExcel', data, function (res) {
                    layer.close(index);
                    if (res.status != 200) {
                        vm.$message({
                            showClose:true,
                            message:res.msg,
                            type:'success'
                        })
                    } else {
                        if (res.data.file_url) {
                            window.open(res.data.file_url);
                        } else {
                            vm.$message({
                                showClose:true,
                                message:res.msg,
                                type:'success'
                            })
                        }
                    }
                })
            },
            // 上传 EXECL =>
            papersUploadSuccess: function (res) {
                layer.msg(res.msg)
            },
            // 上传 Execl 失败
            uploadError (res) {
                layer.msg(res.msg)
            },
            // 时间戳转化为时间
            formatDateTime:function (timeStamp) { 
                var date = new Date();
                date.setTime(timeStamp * 1000);
                var y = date.getFullYear();    
                var m = date.getMonth() + 1;    
                m = m < 10 ? ('0' + m) : m;    
                var d = date.getDate();    
                d = d < 10 ? ('0' + d) : d;    
                var h = date.getHours();  
                h = h < 10 ? ('0' + h) : h;  
                var minute = date.getMinutes();  
                var second = date.getSeconds();  
                minute = minute < 10 ? ('0' + minute) : minute;    
                second = second < 10 ? ('0' + second) : second;   
                // return y + '-' + m + '-' + d+' '+h+':'+minute+':'+second;  
                return y + '-' + m + '-' + d;  
            }
        }
    })
    
    // 替换物料  修改
    $('.revamp_staff').on('click', function () {
        if(materialId == undefined){
            layer.msg('请选择一个BOM项')
        }else{
            var index = layer.open({
                type: 2,
                title: '湖南迪文有限公司替换物料修改',
                content: '/Dwin/Bom/editMaterialReplace?id='+ materialId,
                area: ['90%', '90%'],
                shadeClose:true,
                end: function () {
                    table.ajax.reload()
                }
            }) 
            
        }
    })
    // 替换物料  新增
    $('.edit_staff').on('click', function () { 
        if(materialId == undefined){
            layer.msg('请选择一项物料！')
        }else{
            var index = layer.open({
                type: 2,
                title: '湖南迪文有限公司替换物料新增',
                content: '/Dwin/Bom/addMaterialReplace?id='+ materialId,
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
        if (materialId === undefined){
            layer.msg('请选择一家供应商')
        } else {
                vm.dialogVisible = true

            // if(bom_status == '0'){
            //     vm.dialogVisible = true
            // }else if(bom_status == '1'){
            //     vm.$message({
            //         showClose: true,
            //         message: '该项审核不通过,请去修改！',
            //         type: 'warning'
            //     });
            // }else if(bom_status == '2'){
            //     vm.$message({
            //         showClose: true,
            //         message: '该项审核已通过,不能再次审核！',
            //         type: 'warning'
            //     });
            // }
        }
    })
    // 删除Bom
    $('.delete_staff').on('click', function () {
        if (bom_id === undefined){
            layer.msg('请选择一家供应商')
        } else {
            if(bom_status == '2'){
                layer.msg('该订单审核已通过,不能删除BOM！')
            }else{
                var data = {
                    'bomId' : bomId,
                }
                layer.confirm('确认删除?', function (aaa) {
                    $.post('<?php echo U("/Dwin/bom/deleteBom");?>', data, function (res) {
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