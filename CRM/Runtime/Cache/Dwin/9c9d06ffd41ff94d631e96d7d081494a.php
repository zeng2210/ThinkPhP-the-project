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
    <link href="https://cdn.bootcss.com/element-ui/2.3.6/theme-chalk/index.css" rel="stylesheet">

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
        /* .el-dialog__body{
            text-align: center
        } */
        /* 上传 */
        .uploadResume .el-upload .el-upload__input{
           display: none !important;
       }
       table tr{
           height: 35px;
       }
       #staff tr td:nth-child(1):hover{
           background-color: blue
       }
       .float-e-margins .btn {
            margin-bottom: 3px !important;
        }
       .ele-BUT{
           display: inline-block;
           font-size: 12px;
           height: 21px;
            color: #1c84c6;
            border: 1px solid #1c84c6;
            border-radius:3px;
       }
       .form-control{
           padding: 0;
       }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
                <div class="title">
                        <h4>湖南迪文有限公司未出库单记录列表</h4>
                        <div>
                            <button class="btn btn-xs btn-outline btn-success refresh">刷 新</button>
                            <!-- <button class="btn btn-xs btn-outline btn-success audit_staff"><span class="glyphicon glyphicon-adjust"></span>其他出库审核</button> -->
                            <!-- <button class="btn btn-xs btn-outline btn-success edit_staff"><span class="glyphicon glyphicon-plus"></span>其他出库新增</button> -->
                            <!-- <button class="btn btn-xs btn-outline btn-success delete_staff"><span class="glyphicon glyphicon-remove"></span>其他出库删除</button> -->
                            <!-- <button class="btn btn-xs btn-outline btn-success revamp_staff"><span class="glyphicon glyphicon-align-justify"></span>其他出库修改</button> -->
                            <!-- <button class="btn btn-xs btn-outline btn-success details_staff"><span class="glyphicon glyphicon-cloud-upload"></span>其他出库详情页</button> -->
                            <!-- <button class="btn btn-xs btn-outline btn-success indent_staff"><span class="glyphicon glyphicon-cloud-download"></span>导出Execl</button> -->
                            <select class="form-control chosen-select btn-outline ele-BUT push_down" id="select_vol" name="userId" style="width:9%;" tabindex="2">
                                <option value="">--筛选类型--</option>
                                <?php if(is_array($cateMap)): $i = 0; $__LIST__ = $cateMap;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vol); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
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
                 <!-- <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">出库物料单</a></li>
                    <li role="presentation"><a href="#record" aria-controls="record" role="tab" data-toggle="tab">获取出库记录</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="contact">
                        <table class="table table-striped table-hover table-border">
                            <tr>
                                <th>物料编号</th>
                                <th>物料型号</th>
                                <th>物料名称</th>
                                <th>默认出入仓库</th>
                                <th>制单出入库数量</th>
                                <th>创建时间</th>
                                <th>更新时间</th>
                            </tr>
                            <tr v-for="item in bomInfo">
                                <td>{{item.product_no  || ''}}</td>
                                <td>{{item.product_name  || ''}}</td>
                                <td>{{item.product_number  || ''}}</td>
                                <td>{{item.qualified_repertory_name  || ''}}</td>
                                <td>{{item.num  || ''}}</td>
                                <td>{{item.create_time  || ''}}</td>
                                <td>{{item.update_time  || ''}}</td>
                            </tr>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="record">
                        <table class="table table-striped table-hover table-border">
                            <tr>
                                <th>物料编号</th>
                                <th>出库库房</th>
                                <th>出库数量</th>
                                <th>审核状态</th>
                                <th>创建时间</th>
                                <th>更新时间</th>
                            </tr>
                            <tr v-for="item in record_info">
                                <td>{{item.product_no  || ''}}</td>
                                <td>{{item.qualified_repertory_name  || ''}}</td>
                                <td>{{item.num  || ''}}</td>
                                <td>{{item.status  || ''}}</td>
                                <td>{{item.create_time  || ''}}</td>
                                <td>{{item.update_time  || ''}}</td>
                            </tr>
                        </table>
                    </div>
                </div>-->
                <!-- 审核 弹框
                 <el-dialog title="其他出库单审核：" class="selsctDialog" :visible.sync="dialogVisible" width="30%">
                   <el-button type="primary" @click="eleClick_that(2)">合 &nbsp;格</el-button>
                   <el-button type="primary" @click="eleClick_that(1)" style="margin-left: 15%;margin-bottom: 10%">不合格</el-button>
               </el-dialog>  -->
               <el-dialog
                    title="提示"
                    :visible.sync="dialogVisible"
                    width="30%"
                    >
                    <span>出库单记录审核是否通过？</span>
                    <span slot="footer" class="dialog-footer">
                        <el-button @click="reviewButton(2)">不通过</el-button>
                        <el-button type="primary" @click="reviewButton(1)">通<span>&nbsp;&nbsp;</span> 过</el-button>
                    </span>
                </el-dialog>
                
                <!-- 审核 下载Execl -->
                <!--<el-dialog title="导出BOM EXECL：" class="selsctDialog" :visible.sync="dialogUpdataExecl" width="50%">
                    <div>
                                <span>BOM编号：</span>
                                <el-select v-model="dialog.bomNumber" multiple filterable placeholder="请选择BOM编号">
                                    <el-option
                                        v-for="item in BomNUM"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                    </el-option>
                                </el-select>
                                
                                <span  style="margin-left: 10%"> 审核状态：</span>
                                <el-select v-model="dialog.auditMSG" placeholder="请选择">
                                    <el-option
                                        v-for="item in options_audit"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                    </el-option>
                                </el-select>
                        </div>
                        <div   style="margin-top: 20px">
                               <span> 是否删除：</span>
                                <el-select v-model="dialog.del_status" placeholder="请选择">
                                    <el-option
                                        v-for="item in options_del"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                    </el-option>
                                </el-select>

                                <span   style="margin-left: 10%">BOM组别：</span>
                                <el-select v-model="dialog.groung_status" placeholder="请选择">
                                    <el-option
                                        v-for="item in options_status"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                    </el-option>
                                </el-select>
                        </div>
                     
                        <div  style="margin-top: 20px">
                            <el-button type="primary" @click="updataExeclBUT">下载 Execl</el-button>
                        </div>
                    
                </el-dialog> -->
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
<script src="https://cdn.bootcss.com/element-ui/2.3.6/index.js"></script>

<script>
    var audit_status = <?php echo (json_encode($auditMap)); ?>;  //出库类型名称
    var cateMap = <?php echo (json_encode($cateMap)); ?>;  //出库类型名称
    var repMap = <?php echo (json_encode($repMap)); ?>;  //出库库房名
    var table = $('#staff'). DataTable({
        ajax: {
            type: 'post',
            data: {
                source_kind () {
                    var select = document.getElementById('select_vol')
                    if(select.value == 0){
                        return ''
                    }else{
                        return Number(select.value)
                    }
                },
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
            {searchable: true, title:'物料名称', data: 'product_number'},
            {searchable: true, title:'物料编号', data: 'product_no'},
            {searchable: true, title:'物料型号', data: 'product_name'},
            {searchable: true, title:'出库单编号', data: 'stock_no'},
            {searchable: true, title:'制单出库数量', data:'num'},
            {searchable: true, title:'库存数量', data:'stock_number'},
            {searchable: true, title:'锁库数量', data:'o_audit'},
            // {searchable: true, title:'出库类型', data: 'cate_id'},
            {searchable: true, title:'出库类型', data: 'cate_id',render:function(data){return cateMap[+data]}},
            {searchable: true, title:'出库仓库', data: 'repertory_id',render: function(data){for(let key in repMap){if(data == repMap[key].rep_id){return data = repMap[key].repertory_name}}}},
            {searchable: true, title:'创建时间', data: 'create_time',render: function(data){return vm.formatDateTime(data)}},
            {searchable: true, title:'更新时间', data: 'update_time',render: function(data){return vm.formatDateTime(data)}},
            {searchable: true, title:'审核状态', data: 'status',render: function (data){return audit_status[+data]}},
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
    var elseId
    var else_id
    var contractId
    var else_status
    // var id
    var ApplyData
    $('tbody').on('click', 'tr', function () {
        elseData = table.row(this).data();
        // contractId = ApplyData.contract_pid
        elseId = elseData.id;   // 订单主键
        else_id = elseData.bom_id      //订单编号
        else_status = elseData.status
        $('tr').removeClass('selected')
        $(this).addClass('selected')
    })
    // 出库单下推
    $('.push_down').on('change', function () {
        table.ajax.reload()
    })
    var vm = new Vue({
        el: '#app',
        data: function () {
            return {
                record_info:[],
                bomInfo:[],
                dialogVisible:false,
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
        created() {

        },
        methods: {
             // 合格/不合格
             reviewButton(vul){
                var data={"id":elseId,"status":vul}
                $.post('<?php echo U("/Dwin/Stock/auditStockOut");?>', data , function (res) {
                    if(res.status == 200){
                        table.ajax.reload()
                        vm.dialogVisible = false
                    }
                    layer.msg(res.msg)
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
                if(timeStamp != ''&&timeStamp != 0){
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
                }else{
                    return ''
                }
            }
        }
    })
    // updata Execl
    $('.indent_staff').on('click', function () {
        vm.options_del.length = 0
        vm.options_audit.length = 0
        vm.options_status.length = 0
        vm.BomNUM.length = 0
        vm.dialog.auditMSG = ''
        vm.dialog.del_status  = ''
        vm.dialog.bomNumber = ''
        vm.dialog.groung_status = ''
        for(let i in groupMap){
            vm.options_status.push({'value':String(i), 'label':groupMap[i]})
        }
        for(let i in statusMap){
            vm.options_del.push({'value':String(i), 'label':statusMap[i]})
        }
        for(let i in auditMap){
            vm.options_audit.push({'value':String(i), 'label':auditMap[i]})
        }
        $.post('<?php echo U("getBomIdList");?>', {'bom_id':''} , function (res) {
            for(var i = 0;i < res.data.length;i++){
                vm.BomNUM.push({'value':res.data[i].bom_id , 'label':res.data[i].bom_id})
            }
        })
        vm.dialogUpdataExecl = true 
    })
    // 详情页
    $('.details_staff').on('click', function () {
        if (elseId === undefined){
            layer.msg('请选择一个出库申请单')
        } else {
            var index = layer.open({
                type: 2,
                title: '湖南迪文有限公司其他出库详情页',
                content: '/Dwin/Stock/otherStockOutAllMsg?id=' + elseId,
                area: ['90%', '90%'],
                shadeClose:true,
                end: function () {
                    table.ajax.reload()
                }
            })    
        }
    })
    // 其他出库单 修改
    $('.revamp_staff').on('click', function () {
        if(elseId == undefined){
            layer.msg('请选择一个出库申请单')
        }else{
            if(else_status == '3'){
                layer.msg('该库房审核已完毕，不能修改！')
            }else{
                var index = layer.open({
                    type: 2,
                    title: '湖南迪文有限公司出库申请单修改',
                    content: '/Dwin/Stock/editOtherStockOut?id='+ elseId,
                    // content: '/Dwin/Stock/editOtherStockOutApply?id='+ ,
                    area: ['90%', '90%'],
                    shadeClose:true,
                    end: function () {
                        table.ajax.reload()
                    }
                }) 
            }
        }
    })
    // BOM  新增
    $('.edit_staff').on('click', function () { 
        var index = layer.open({
            type: 2,
            title: '湖南迪文有限公司新增出库申请单',
            content: '/Dwin/Stock/createOtherStockOutApply',
            area: ['90%', '90%'],
            shadeClose:true,
            end: function () {
                table.ajax.reload()
            }
        }) 
    })
    // 刷新
    $('.refresh').on('click', function () {
        table.order([[5, 'desc']])
        table.ajax.reload()
    })
    // 审核
    $('.audit_staff').on('click', function () {
        if (elseId === undefined){
            layer.msg('请选择一家供应商')
        } else {
            if(else_status == '0'){
                vm.dialogVisible = true
            }else{
                vm.$message({
                    showClose: true,
                    message: '该项审核已通过,不能再次审核！！',
                    type: 'warning'
                });
            }
        }
    })
    // 删除出库申请单
    $('.delete_staff').on('click', function () {
        if (ApplyId === undefined){
            layer.msg('请选择一家供应商')
        } else {
            if(Apply_status == '2'){
                layer.msg('该订单审核已通过,不能删除BOM！')
            }else{
                var data = {
                    'applyId' : ApplyId,
                }
                layer.confirm('确认删除?', function (aaa) {
                    $.post('<?php echo U("/Dwin/Stock/createOtherStockOut");?>', data, function (res) {
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