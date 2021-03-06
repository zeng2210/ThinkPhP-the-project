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
       /* #staff tr td:nth-child(1):hover{
           background-color: blue
       } */
       #staff tr td:hover{
           background-color: #ccc
       }
       .colorBG{
           background-color: red
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
       .change-css{
            cursor: pointer;
            text-align: center!important;
            line-height: 20px;
            background-color:whitesmoke;
        }
        .active-css{
            background-color: lightskyblue;
            border-radius: 2px;
        }
        /* and */
        .active-css-child{
            color:red!important;
            line-height: 20px;
        }
        .hover-css{
            background-color: gainsboro;
            color:dimgray!important;
            border-radius: 2px;
            line-height: 20px;
        }
        .but_floatFood{
            display: inline-block !important;
            width: auto;
            min-height: 30px;
            margin: 0 1%;
            line-height: 30px;
        }
        .notSelectData{
            color:#e4393c;text-align: center;font-size: 15px
       }
       .nav-tabs>.active>a{
            background-color: #1c84c6 !important;
            color: #fff !important;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
                <div class="title_top">
                    <h4>湖南迪文有限公司出库单列表</h4>
                    <div style="display: inline-block;width:100%;margin-top: 3px;">
                        <div class="fa-hover col-md-1 col-sm-3 change-css active-css but_floatFood" data-id="1" onclick="outbound(1)" style="margin:0 1% 0 0"><a href="javascript:;" class="active-css-child"><i class="fa fa-tv">已出单据</i></a></div>
                        <div class="fa-hover col-md-1 col-sm-3 change-css but_floatFood" data-id="2" onclick="outbound(2)"><a href="javascript:;"><i class="fa fa-tv">未出单据</i></a></div>
                        <input type="hidden" id="orderType" value="1">
                    </div>
                    <button class="btn btn-xs btn-outline btn-success refresh">刷 新</button>
                    <button class="btn btn-xs btn-outline btn-success details_staff"><span class="glyphicon glyphicon-align-justify"></span>详 情</button>
                    <p>
                        <button class="btn btn-xs btn-outline btn-success rollback_staff"><span class="glyphicon glyphicon-arrow-left"></span>回退物料</button>
                        <button class="btn btn-xs btn-outline btn-success rollbackAll_staff"><span class="glyphicon glyphicon-backward"></span>回退单据</button>
                        <!-- <button class="btn btn-xs btn-outline btn-success indent_staff"><span class="glyphicon glyphicon-print"></span>下载/打印</button> -->
                    </p>
                    <p>
                        <button class="btn btn-xs btn-outline btn-success audit_staff"><span class="glyphicon glyphicon-adjust"></span>审 核</button>
                        <button class="btn btn-xs btn-outline btn-success revamp_staff"><span class="glyphicon glyphicon glyphicon-edit"></span>修 改</button>
                        <button class="btn btn-xs btn-outline btn-success delete_staff"><span class="glyphicon glyphicon-remove"></span>删 除</button>
                    </p>
                    <button class="btn btn-xs btn-outline btn-success indent_staff"><span class="glyphicon glyphicon-print"></span>下载/打印</button>
                    <select class="form-control chosen-select btn-outline ele-BUT push_down" id="select_vol" name="userId" id="useId" style="width:9%;" tabindex="2">
                        <option value="">--筛选类型--</option>
                        <?php if(is_array($cateMap)): $i = 0; $__LIST__ = $cateMap;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vol); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            <div class="table-responsive">
                <table id="staff" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>出库单编号</th>
                            <th>出库单类型</th>
                            <th>出库状态</th>
                            <th>创建人</th>
                            <th>审核人</th>
                            <th>发货人</th>
                            <th>创建时间</th>
                            <th>源单编号</th>
                            <th>打印次数</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="ibox-content" id="app">
                <ul class="nav nav-tabs" role="tablist"  v-if="unData">
                    <li role="presentation" class="active"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">出库物料单</a></li>
                    <li role="presentation"><a href="#record" aria-controls="record" role="tab" data-toggle="tab">获取出库记录</a></li>
                </ul>
                <div class="tab-content"  v-if="unData">
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
                                <td>{{formatDateTime(item.create_time)  || ''}}</td>
                                <td>{{formatDateTime(item.update_time)  || ''}}</td>
                            </tr>
                        </table>
                        <div v-show="bomInfo.length">
                            <el-pagination 
                                @size-change="handleSizeChange" background 
                                @current-change="handleCurrentChange" align='center' 
                                :page-sizes="[5,10,20]" 
                                :current-page="current.pageNo" 
                                :page-size="current.pageSize" 
                                :total="current.total" 
                                layout="total, sizes, prev, pager, next, jumper" 
                                style="margin-top:15px">
                            </el-pagination>
                        </div>
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
                                <td>{{this.recordAuditMap[item.status]  || ''}}</td>
                                <td>{{formatDateTime(item.create_time)  || ''}}</td>
                                <td>{{formatDateTime(item.update_time) || ''}}</td>
                            </tr>
                        </table>
                        <div v-show="record_info.length">
                            <el-pagination 
                                @size-change="handleSizeChange_record" background 
                                @current-change="handleCurrentChange_record" align='center' 
                                :page-sizes="[5,10,20]" 
                                :current-page="record.pageNo" 
                                :page-size="record.pageSize" 
                                :total="record.total" 
                                layout="total, sizes, prev, pager, next, jumper" 
                                style="margin-top:15px">
                            </el-pagination>
                        </div>
                    </div>
                </div>
                <div class="notSelectData"  v-else>
                    当前您没有选中数据或数据为空
                </div>
                <!-- 审核 弹框 -->
               <el-dialog
                    title="提示"
                    :visible.sync="dialogVisible"
                    width="30%"
                    >
                    <span>待出库单据审核是否通过？</span>
                    <span slot="footer" class="dialog-footer">
                        <el-button @click="dialogVisible = false">取 消</el-button>
                        <el-button type="primary" @click="reviewButton">确 定</el-button>
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
    var audit_status = <?php echo (json_encode($auditMap)); ?>;  //出库单状态
    var repMap = <?php echo (json_encode($repMap)); ?>;  //库房名称
    var cateMap = <?php echo (json_encode($cateMap)); ?>;  //出库单类型
    var recordAuditMap = <?php echo (json_encode($recordAuditMap)); ?>;  //审核状态
    var select = document.getElementById('select_vol')
    var table = $('#staff'). DataTable({
        ajax: {
            type: 'post',
            data: {
                function () {
                    if(obj){
                        obj.elseId = ''
                        obj.else_id    = ''   // 订单主键
                        obj.else_status = ''
                        obj.source_kind = ''
                        vm.bomInfo = []
                        vm.record_info = []
                    }
                },
                checkStatus: function () {
                    return document.getElementById('orderType').value;
                },
                flag: 1
            }
        },
        "scrollY": 400,
        "scrollX": true,
        "scrollCollapse": true,
        "destroy"      : true,
        "paging"       : true,
        "autoWidth"	   : true,
        "pageLength": 25,
        serverSide: true,
        // order:[[21, 'desc']],
        fnServerParams: function (aoData) {
            aoData['source_kind'] = select.value
        },   
        columns: [                                                                                                                       
            {searchable: true, data: 'stock_out_id'},
            {searchable: false, data: 'source_kind',render: function (data){
                var keyArr = []
                for(let key in cateMap){
                    keyArr.push(key)
                }
                if(keyArr.indexOf(data) == -1){
                    return ''
                }else{
                    return cateMap[+data]
                }
            }},
            {searchable: false, data: 'audit_status',render: function (data){return audit_status[+data]}},
            {searchable: true, data: 'create_name'},
            {searchable: true, data: 'audit_name'},
            {searchable: true, data: 'send_name'},
            {searchable: true, data:  'create_time',render: function(data){return vm.formatDateTime(data)}},
            {searchable: true, data: 'source_id',width:'100'},
            {searchable: true, data: 'printing_times',width:'50'},
        ],
        fnRowCallback:function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            var AD_as = nRow['children'][nRow['children'].length - 7]
            for(let key in nRow){
                for(let x = 0; x < audit_status.length;x++){
                    switch(AD_as.innerText){
                        case audit_status[x]:
                            if(x == 0){
                                $(AD_as).css('color','blue')
                            }else if(x == 1){
                                $(AD_as).css('color','red')
                            }else if(x == 2){
                                $(AD_as).css('color','#CC66CC')
                            }else if(x == 3){
                                $(AD_as).css('color','green')
                            }
                    }
                }
            }
        },
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
    var obj = {
        elseId:"",
        else_id:"",
        else_status:'',
        source_kind:'',
        elseData:[],
        selectedObj:{},
        tabClickDiv : $('.change-css'),
        tabActiveDiv : $(".active-css"),
        kElement : document.getElementById("orderType"),
        tabMouseEnter: function (val) {
            var that = this;
            this.initData(that,false);
            this.tabClickDiv.removeClass('hover-css');
            this.tabClickDiv.children('a').removeClass('hover-css');
            val.children('a').addClass('hover-css');
            val.addClass('hover-css');
        },
        tabMouseLeave:function() {
            var that = this;
            this.initData(that,false);
            this.tabClickDiv.removeClass('hover-css');
            this.tabClickDiv.children('a').removeClass('hover-css');
        },
        tabClick:function (val) {
            var that = this;
            this.initData(that,false);
            this.tabClickDiv.removeClass('active-css');
            this.tabClickDiv.children('a').removeClass('active-css-child');
            val.children('a').addClass('active-css-child');
            val.addClass('active-css');
            var tmpOrderType = document.getElementById("orderType");
            tmpOrderType.value = $(".active-css").attr('data-id');
            table.ajax.reload();
            this.destroyData();
        },
        tbodyTrClick:function (val,that) {
            this.initData(that,true);
            $('tr').removeClass('selected')
            val.addClass('selected')
            // vm.getButtonTitle(this.elseId)
        },
        destroyData: function () {
            vm.contact = [];
            vm.orderId = "";
            this.orderId       = "",
                this.elseId      = "",
                this.else_id    = '',
                this.else_status = '',
                this.source_kind = '',
                this.elseData    = [],
                this.selectedObj   = {},
                this.tabClickDiv   =  "",
                this.tabActiveDiv  =  "",
                this.kElement      =  ""
        },
        initData : function (that, flag) {
            this.tabClickDiv =  $('.change-css');
            this.tabActiveDiv =  $(".active-css")
            this.kElement =  document.getElementById("orderType")
            vm.num_show = 0
            if (flag === true && table.row(that).data()) {
                obj.elseData  = table.row(that).data();
                vm.unData = false
                obj.elseId = obj.elseData.id
                obj.else_id    = obj.elseData.supplier_id;   // 订单主键
                obj.else_status = obj.elseData.audit_status
                obj.source_kind = obj.elseData.source_kind
                $.post('/Dwin/Stock/getStockOutRecord', {id: obj.elseId},function (res) { 
                    vm.save_record_info = res.data
                    vm.record.total = res.data.length
                    vm.record_info = vm.save_record_info.slice(0,vm.record.pageSize)
                }),
                $.post('/Dwin/Stock/stockOutOtherMaterial', {id: obj.elseId}, function (res) {
                    vm.save_bomInfo = res.data
                    vm.current.total = res.data.length
                    vm.bomInfo = vm.save_bomInfo.slice(0,vm.current.pageSize)
                })
            }
        },
    }

    obj.tabClickDiv.on('mouseenter', function () {
        obj.selectedObj = $(this);
        obj.tabMouseEnter(obj.selectedObj);
    });
    obj.tabClickDiv.on('mouseleave', function () {
        obj.tabMouseLeave();
    });
    obj.tabClickDiv.on('click', function () {
        obj.selectedObj = $(this);
        obj.tabClick(obj.selectedObj);
    });
    $('tbody').on('click', 'tr', function () {
        var that = this;
        var objThis = $(this);
        obj.tbodyTrClick(objThis,that);
    })
    // 选中一行
    var elseId
    var else_id
    var else_status
    var source_kind
    // var id
    var elseData
    // 切换操作行
    $('.title_top').children('p:eq(0)').css('display',"inline")
    $('.title_top').children('p:eq(0)').siblings('p').css('display',"none")
    function outbound(val){
        switch(val){
            case val:
                $('.title_top').children('p:eq('+ (val - 1) +')').css('display',"inline")
                $('.title_top').children('p:eq('+ (val - 1) +')').siblings('p').css('display',"none")
                break
        }
    }
    var vm = new Vue({
        el: '#app',
        data: function () {
            return {
                record_info:[],
                bomInfo:[],
                recordAuditMap:recordAuditMap,
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
                unData:false,            
                BomNUM: [],
                options_status:[],
                options_del:[],
                options_audit:[],
                upLoadData:{
                    id:''
                },
                num_show:0,
                save_bomInfo:[],
                save_record_info:[],
                current: {
                    pageNo: 1,
                    pageSize:5,
                    total: 0
                },
                record: {
                    pageNo: 1,
                    pageSize:5,
                    total: 0
                },
            }
        },
        watch:{ 
            record_info:function(newValue){
                if(newValue[0]){
                    this.num_show++
                }
            },
            bomInfo:function(newValue){
                if(newValue[0]){
                    this.num_show++
                }
            },
            num_show:function(newValue){
                if(newValue > 0){
                    this.unData = true
                }else{
                    this.unData = false
                }
            }
        },
        methods: {
            // 每页显示几条
            handleSizeChange (val) {
                console.log('几条'+ val)
                this.current.pageSize = val
                // 开始  = 页 * 条 -1 
                var start = (this.current.pageNo * this.current.pageSize) - 1;
                var end = start + val;
                if(start >= this.current.total - 1){
                    start = this.current.total - (this.current.total % val) 
                    end = this.current.total
                    this.bomInfo = this.save_bomInfo.slice(start,end);
                    return false
                }
                if(end > this.current.total - 1){
                    end = this.current.total
                }
                this.bomInfo = this.save_bomInfo.slice(start, end);
            },
            // 当前页数
            handleCurrentChange (val) {
                this.current.pageNo = val;
                var start = (this.current.pageNo - 1) * this.current.pageSize;
                var end = val * this.current.pageSize;
                if(start >= this.current.total - 1){
                    start = 0
                    end = this.current.total + 1 
                    alert(start,end)
                    this.bomInfo = this.save_bomInfo.slice(start,end);
                    return false
                }
                if(end > this.current.total - 1){
                    end = this.current.total
                }
                this.bomInfo = this.save_bomInfo.slice(start, end);
            },
            // 每页显示几条
            handleSizeChange_record (val) {
                console.log('几条'+ val)
                this.record.pageSize = val
                // 开始  = 页 * 条 -1 
                var start = (this.record.pageNo * this.record.pageSize) - 1;
                var end = start + val;
                if(start >= this.record.total - 1){
                    start = this.record.total - (this.record.total % val) 
                    end = this.record.total
                    this.record_info = this.save_record_info.slice(start,end);
                    return false
                }
                if(end > this.record.total - 1){
                    end = this.record.total
                }
                this.record_info = this.save_record_info.slice(start, end);
            },
            // 当前页数
            handleCurrentChange_record (val) {
                this.record.pageNo = val;
                var start = (this.record.pageNo - 1) * this.record.pageSize;
                var end = val * this.record.pageSize;
                if(start >= this.record.total - 1){
                    start = 0
                    end = this.record.total + 1 
                    alert(start,end)
                    this.record_info = this.save_record_info.slice(start,end);
                    return false
                }
                if(end > this.record.total - 1){
                    end = this.record.total
                }
                this.record_info = this.save_record_info.slice(start, end);
            },
            // 合格/不合格
           reviewButton(){
                var data={"id":obj.elseId,"source_kind":obj.source_kind}
                $.post('/Dwin/Stock/auditWholeStockOut', data , function (res) {
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
        var index = layer.confirm("确认打印该单据？",{
            btn  : ['确认', '取消'],
            icon : 6
        }, function () {
            layer.open({
                type: 2,
                title: '单据打印',
                shadeClose: true,
                end: function () {
                    table.ajax.reload(false, null);
                },
                area: ['220mm', '110mm'],
                content: 'printOutHtml?id=' + obj.elseId + "&source_kind=" + obj.source_kind //iframe的url
            });
            layer.close(index);
        });
    })

    // 详情页
    $('.details_staff').on('click', function () {
        if (obj.elseId === undefined || !obj.elseId){
            layer.msg('请选择一个出库单')
        } else {
            /*
            *1:"其他出库类型"
             2:"销售出库类型"
             3:"生产领料类型"
             4:"委外加工类型"
            */
            if(obj.source_kind == 1){
                var index = layer.open({
                    type: 2,
                    title: '湖南迪文有限公司其他出库详情页',
                    content: '/Dwin/Stock/otherStockOutAllMsg?id=' + obj.elseId,
                    area: ['90%', '90%'],
                    shadeClose:true,
                    end: function () {
                        table.ajax.reload()
                    }
                })
            }else if(obj.source_kind == 2){
                var index = layer.open({
                    type: 2,
                    title: '湖南迪文有限公司销售出库详情页',
                    content: '/Dwin/Stock/stockOutOrderMsg?id=' + obj.elseId,
                    area: ['90%', '90%'],
                    shadeClose:true,
                    end: function () {
                        table.ajax.reload()
                    }
                })
            }else if(obj.source_kind == 4){
                var index = layer.open({
                    type: 2,
                    title: '湖南迪文有限公司领料单详情页',
                    content: '/Dwin/Stock/stockOutProduceMsg?id=' + obj.elseId,
                    area: ['90%', '90%'],
                    shadeClose:true,
                    end: function () {
                        table.ajax.reload()
                    }
                })
            }   
        }
    })
    // 回退
    $('.rollback_staff').on('click', function () {
        if (obj.elseId === undefined || !obj.elseId){
            layer.msg('请选择一个出库单')
            return false;
        }
        var index = layer.confirm("该出库单已出库是否要去回退？",{
            btn  : ['确认', '取消'],
            icon : 5
        }, function () {
            layer.open({
                type: 2,
                title: '出库单回退',
                shadeClose: true,
                area: ['90%','90%'],
                content: '/Dwin/Stock/rollBackMaterial?id=' + obj.elseId +"&source_kind=" + obj.source_kind,
                end: function () {
                    table.draw(false);
                },
            });
            layer.close(index);
        });
    })
    // 回退单据
    $('.rollbackAll_staff').on('click', function () {
        if (obj.elseId === undefined || !obj.elseId){
            layer.msg('请选择一个出库单')
            return false;
        }
        var index = layer.confirm("确定要回退整个单据？",{
            btn  : ['确认', '取消'],
            icon : 5
        }, function () {
            var data={"id":obj.elseId,"source_kind":obj.source_kind}
            $.post('/Dwin/Stock/rollBackStockOut', data , function (res) {
                if(res.status == 200){
                    table.draw(false);
                    layer.close(index);
                }else{
                    layer.msg(res.msg)
                }
            })
        });
    })
    // 删除出库申请单
    $('.delete_staff').on('click', function () {
        if (obj.elseId === undefined  || !obj.elseId){
            layer.msg('请选择一个出库单')
        } else {
            if(obj.else_status == '2'){
                layer.msg('该订单审核已通过,不能删除BOM！')
            }else{
                layer.confirm('确认删除?', function (aaa) {
                    var data = {
                        'id' : obj.elseId,
                        'source_kind': obj.source_kind
                    }
                    $.post("/Dwin/Stock/delStockOut", data, function (res) {
                        if (res.status == 200) {
                            table.ajax.reload()
                        }
                        layer.msg(res.msg)
                    })
                })
            }
        }
    })
    // 出库单下推
    $('.push_down').on('change', function () {
        table.ajax.reload()
    })
    // 其他出库单 修改
    $('.revamp_staff').on('click', function () {
        if(obj.elseId == undefined || !obj.elseId){
            layer.msg('请选择一个出库单')
        }else{
            /*
            *1:"其他出库类型"
             2:"销售出库类型"
             3:"生产领料类型"
             4:"委外加工类型"
            */
            if(obj.source_kind == 1){
                var index = layer.open({
                    type: 2,
                    title: '湖南迪文有限公司其他出库修改',
                    content: '/Dwin/Stock/editOtherStockOut?id='+ obj.elseId,
                    area: ['90%', '90%'],
                    shadeClose:true,
                    end: function () {
                        table.ajax.reload()
                    }
                }) 
            }else if(obj.source_kind == 2){
                var index = layer.open({
                    type: 2,
                    title: '湖南迪文有限公司销售出库单修改',
                    content: '/Dwin/Stock/editStockOutOrderform?id='+ obj.elseId,                    // content: '/Dwin/Stock/editOtherStockOutApply?id='+ ,
                    area: ['90%', '90%'],
                    shadeClose:true,
                    end: function () {
                        table.ajax.reload()
                    }
                }) 
            }else if(obj.source_kind == 4){
                var index = layer.open({
                    type: 2,
                    title: '湖南迪文有限公司领料出库单修改',
                    content: '/Dwin/Stock/editStockOutProduce?id='+ obj.elseId,
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
        if (obj.elseId === undefined  || !obj.elseId){
            layer.msg('请选择一个出库单')
        } else {
            vm.dialogVisible = true
        }
    })
</script>
</body>
</html>