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
        .ele-BUT{
            color: #1c84c6;
            border: 1px solid #1c84c6;
            border-radius:3px;
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
         /* 修改下拉 */
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
       /* layer.tiele delete */
       .layui-layer .layui-layer-title{
           display: none !important;
       }
       .notSelectData{
            color:#e4393c;text-align: center;font-size: 15px
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
            <h4>采购物料订单信息列表</h4>
            <div class="title_top">
                <div style="display: inline-block;width:100%;margin-top: 3px;">
                    <div class="fa-hover col-md-1 col-sm-3 change-css active-css but_floatFood" data-id="0" onclick="outbound(1)" style="margin:0 1% 0 0"><a href="javascript:;" class="active-css-child"><i class="fa fa-tv">审核中订单</i></a></div>
                    <div class="fa-hover col-md-1 col-sm-3 change-css but_floatFood" data-id="2" onclick="outbound(2)"><a href="javascript:;"><i class="fa fa-tv">已审核订单</i></a></div>
                    <div class="fa-hover col-md-1 col-sm-3 change-css but_floatFood" data-id="1" onclick="outbound(3)"><a href="javascript:;"><i class="fa fa-tv">不合格订单</i></a></div>
                    <input type="hidden" id="orderType" value="0">
                </div>
                <button class="btn btn-xs btn-outline btn-success refresh">刷 新</button>
                <button class="btn btn-xs btn-outline btn-success details_staff"><span class="glyphicon glyphicon-align-justify"></span>详 情</button>
                <p>
                    <button class="btn btn-xs btn-outline btn-success audit_staff"><span class="glyphicon glyphicon-adjust"></span>审 核</button>
                </p>
                <p>
                    <button class="btn btn-xs btn-outline btn-success indent_staff"><span class="glyphicon glyphicon-check  "></span>下推入库</button>
                </p>
                <p>
                    <button class="btn btn-xs btn-outline btn-success delete_staff"><span class="glyphicon glyphicon-remove"></span>删 除</button>
                </p>
                <button class="btn btn-xs btn-outline btn-success preview_staff"><span class="glyphicon glyphicon-list-alt"></span>合同预览</button>
                <select class="form-control chosen-select btn-outline ele-BUT push_down" name="userId" id="useId" style="width:6%;" tabindex="2">
                    <option value="1">--本人--</option>
                    <option value="2">--所有--</option>
                </select>
            </div>
            <div class="table-responsive">
                <table id="staff" class="table table-bordered table-hover table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>订单编号</th>
                            <th>制单人</th>
                            <th>供方名称</th>
                            <th>订单时间</th>
                            <th>总金额</th>
                            <!--<th>收货人</th>-->
                            <!--<th>交货地点</th>-->
                            <!--<th>收货电话</th>-->
                            <th>结算方式</th>
                            <!--<th>供方地址</th>-->
                            <th>供方法定代表</th>
                            <th>供方代表电话</th>
                            <!--<th>供方代表传真</th>-->
                            <!--<th>需方地址</th>-->
                            <!--<th>需方法定代表</th>-->
                            <!--<th>需方电话</th>-->
                            <!--<th>需方传真</th>-->
                            <th>采购模式</th>
                            <th>采购方式</th>
                            <th>审核状态</th>
                            <th>合同名称</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="ibox-content" id="app">
                <ul class="nav nav-tabs" role="tablist" v-if="unData">
                    <li role="presentation" class="active"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">物料订单信息</a></li>
                </ul>
                <div class="tab-content" v-if="unData">
                    <div role="tabpanel" class="tab-pane active" id="contact">
                        <table class="table table-striped table-hover table-border">
                            <tr>
                                <th>序号</th>
                                <th>物料名称</th>
                                <th>物料型号</th>
                                <th>购买数量</th>
                                <th>已入库数量</th>
                                <th>购买单价</th>
                                <th>金额</th>
                            </tr> 
                            <tr v-for="item in contact">
                                <td>{{item.sort_id  || ''}}</td>
                                <td>{{item.product_number  || ''}}</td>
                                <td>{{item.product_name  || ''}}</td>
                                <td>{{item.number  || ''}}</td>
                                <td>{{item.allinnum  || ''}}</td>
                                <td>{{item.single_price  || ''}}</td>
                                <td>{{item.total_price  || ''}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="notSelectData"  v-else>
                    您当前没有选中数据或无数据
                </div>
               <!-- 一级审核 -->
                <el-dialog
                    title="采购订单审核："
                    :visible.sync="dialogVisible"
                    width="30%"
                    >
                    <span>该供应商添加审核是否通过？</span>
                    <span slot="footer" class="dialog-footer">
                        <el-button @click="eleClick_that(1)">不通过</el-button>
                        <el-button type="primary" @click="eleClick_that(2)">通过</el-button>
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
    var auditMsg = <?php echo (json_encode($auditMsg)); ?>;
    var filterFlag = <?php echo (json_encode($checkFlag)); ?>;
    var table = $('#staff'). DataTable({
        ajax: {
            type: 'post',
            data: {
                function(){
                    if(obj){
                        obj.current_status = ''
                        obj.contractId = ''
                        obj.orderId    = ''   
                        obj.order_id   = '' 
                        obj.file_name   = '' 
                        vm.contact = []   
                    }
                },
                staffLimit (){
                    return document.getElementById('useId').value;
                },
                audit_status: function () {
                    return document.getElementById('orderType').value;
                }
            },
        },
        "scrollY": 440,
        "scrollX": true,
        "scrollCollapse": true,
        "destroy"      : true,
        "paging"       : true,
        "autoWidth"	   : true,
        "pageLength": 25,
        serverSide: true,
        // order:[[21, 'desc']],
        columns: [
            {searchable: true, data: 'purchase_order_id'},
            {searchable: true, data: 'name'},
            {searchable: true, data: 'supplier_name'},
            {searchable: true, data: 'order_time'},
            {searchable: true, data: 'total_amount'},
//            {searchable: true, data: 'receiver'},
//            {searchable: true, data: 'trading_location'},
//            {searchable: false, data: 'receiving_phone'},
            {searchable: false, data: 'billing_method'},
//            {searchable: false, data: 'supply_address'},
            {searchable: true, data: 'supplier_representative'},
            {searchable: true, data: 'supplier_phone'},
//            {searchable: true, data: 'supplier_fax'},
//            {searchable: true, data: 'demand_address'},
//            {searchable: true, data: 'purchaser_representative'},
//            {searchable: true, data: 'purchaser_phone'},
//            {searchable: true, data: 'purchaser_fax'},
            {searchable: true, data: 'purchase_mode'},
            {searchable: true, data: 'purchase_type'},
            {searchable: true, data: 'audit_status', render: function (data){return auditMsg[+data]}},
            {searchable: true, data: 'file_name'}
        ],
        'fnRowCallback':function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            /*
                nRow:每一行的信息 tr  是Object
                aData：行 index
            */
            for(let key in nRow){
                var AD_ad = nRow['childNodes'][nRow['childNodes'].length - 2]
                if(AD_ad.innerText == auditMsg[0]){
                    $(AD_ad).css('color','blue')
                }else if(AD_ad.innerText == auditMsg[1]){
                    $(AD_ad).css('color','red')
                }else if(AD_ad.innerText == auditMsg[2]){
                    $(AD_ad).css('color','green')
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
    // my/we
    $('.push_down').on('change', function () {
        table.ajax.reload()
    })
    var obj = {
        orderId:"",
        order_id:"",
        contractId:'',
        file_name:'',
        path:'',
        current_status:'',
        orderData:'',
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
            $.post('/Dwin/Purchase/getOrderProduct', {id: obj.orderId}, function (res) {
                vm.contact = res.data
            })
        },
        destroyData: function () {
            vm.contact = [];
            vm.orderId = "";
            this.orderId       = "",
            this.order_id      = "",
            this.contractId    = '',
            this.current_status = '',
            this.file_name = '',
            this.path = '',
            this.orderData     = '',
            this.selectedObj   = {},
            this.tabClickDiv   =  "",
            this.tabActiveDiv  =  "",
            this.kElement      =  ""
        },
        initData : function (that, flag) {
            this.tabClickDiv =  $('.change-css');
            this.tabActiveDiv =  $(".active-css")
            this.kElement =  document.getElementById("orderType")
            if (flag === true && table.row(that).data()) {
                obj.orderData  = table.row(that).data();
                obj.contractId = obj.orderData.contract_pid
                obj.orderId    = obj.orderData.id;   // 订单主键
                obj.order_id   = obj.orderData.purchase_order_id      //订单编号
                obj.current_status = obj.orderData.audit_status
                obj.file_name = obj.orderData.file_name
                obj.path = obj.orderData.path
            }
        }
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
                contact:[],
                unData:false,
                dialogVisible:false,
                orderId:obj.orderId,
                upLoadData:{
                    id:''
                }
            }
        },
        created() {
            if(!filterFlag){
                $('.push_down').css('display','none')
            }
        },
        watch:{
            contact:function(newValue){
                if(newValue[0]){
                    this.unData = true
                }else{
                    this.unData = false
                }
            }
        },
        methods: {
            // 审核确定
            eleClick_that(vul){
                var vm = this
                var data = {
                    'orderId': obj.orderId,
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
        if (obj.order_id === undefined || !obj.order_id){
            layer.msg('请选择订单信息')
        } else {
            var index = layer.open({
                type: 2,
                title: '采购订单入库',
                content: '/Dwin/Stock/addStockInWithPurchase?orderId=' + obj.orderId,
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
        if (obj.order_id === undefined || !obj.order_id){
            layer.msg('请选择订单信息')
        } else {
            var index = layer.open({
                type: 2,
                title: '湖南迪文科技有限公司采购订单详情',
                content: '/Dwin/Purchase/getOrderMsg?id=' + obj.orderId,
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
        if (obj.order_id === undefined || !obj.order_id){
            layer.msg('请选择订单信息')
        } else {
            var index = layer.open({
                type: 2,
                title: '湖南迪文科技有限公司采购订单编辑',
                content: '/Dwin/Purchase/editOrder?orderId=' + obj.orderId,
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
        if (obj.order_id === undefined || !obj.order_id){
            layer.msg('请选择要审核的订单')
        } else {
            if(obj.current_status == '0'){
                vm.dialogVisible = true
            }else if(obj.current_status == '1'){
                layer.msg('该项审核不通过')
            }else if(obj.current_status == '2'){
                layer.msg('该项审核已通过')
            }
        }
    })
    // 删除订单
    $('.delete_staff').on('click', function () {
        if (obj.order_id === undefined || !obj.order_id){
            layer.msg('请选择要删除的订单')
        } else {
            if(obj.current_status == '2'){
                layer.msg('该订单审核已通过,不能删除订单！')
            }else{
                var data = {
                    'orderId' : obj.orderId,
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
    // 预览合同
    $('.preview_staff').on('click', function () {
        if (obj.order_id === undefined || !obj.order_id ){
            layer.msg('请选择订单')
        } else {
            if(!obj.file_name){
                layer.msg('没有上传你要浏览的合同文件！')
            }else{
                if (!window.Uint8Array) {
                    layer.msg('旧版本浏览器无法正常显示此页面')
                    return false
                }
                if (obj.order_id){
                    if(obj.orderId){
                        // window.open('<?php echo U("previewPdf", [], "");?>/id/' + obj.orderId )
                        window.open(obj.path)
                    }else{
                        layer.msg('订单还没有上传附件！')   
                    }
                } else {
                    layer.msg('请选择一行数据') 
                }
            }
        }
    })
</script>
</body>
</html>