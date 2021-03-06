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
        /* 表头也滑动 */
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
           margin-top: 3% !important;
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
                <div class="title_top">
                    <h4>采购合同列表</h4>
                    <div style="display: inline-block;width:100%;margin-top: 3px;">
                        <div class="fa-hover col-md-1 col-sm-3 change-css active-css but_floatFood" data-id="0"  onclick="outbound(1)" style="margin:0 1% 0 0"><a href="javascript:;" class="active-css-child"><i class="fa fa-tv">总经理待审核</i></a></div>
                        <div class="fa-hover col-md-1 col-sm-3 change-css but_floatFood" data-id="2" onclick="outbound(2)"><a href="javascript:;"><i class="fa fa-tv">法务待审核</i></a></div>
                        <div class="fa-hover col-md-1 col-sm-3 change-css but_floatFood" data-id="3" onclick="outbound(3)"><a href="javascript:;"><i class="fa fa-tv">合格合同</i></a></div>
                        <div class="fa-hover col-md-1 col-sm-3 change-css but_floatFood" data-id="1" onclick="outbound(4)"><a href="javascript:;"><i class="fa fa-tv">不合格合同</i></a></div>
                        <input type="hidden" id="orderType" value="0">
                    </div>
                    <button class="btn btn-xs btn-outline btn-success refresh">刷 新</button>
                    <p>
                        <button class="btn btn-xs btn-outline btn-success audit_staff"><span class="glyphicon glyphicon-adjust"></span>总经理审核</button>
                        <button class="btn btn-xs btn-outline btn-success edit_staff"><span class="glyphicon glyphicon-edit"></span>编 辑</button>
                    </p>
                    <p>
                        <button class="btn btn-xs btn-outline btn-success audit_staff"><span class="glyphicon glyphicon-adjust"></span>法务审核</button>
                        <button class="btn btn-xs btn-outline btn-success affix_staff"><span class="glyphicon glyphicon-cloud-upload"></span>合同回传</button>
                        <button class="btn btn-xs btn-outline btn-success preview_staff"><span class="glyphicon glyphicon-list-alt"></span>预 览</button>
                    <button class="btn btn-xs btn-outline btn-success print_staff"><span class="glyphicon glyphicon-download-alt"></span>下 载</button>
                    </p>
                    <p>
                        <button class="btn btn-xs btn-outline btn-success preview_staff"><span class="glyphicon glyphicon-list-alt"></span>预 览</button>
                        <button class="btn btn-xs btn-outline btn-success print_staff"><span class="glyphicon glyphicon-download-alt"></span>下 载</button>
                        <button class="btn btn-xs btn-outline btn-success indent_staff"><span class="glyphicon glyphicon-log-out"></span>下 推</button>
                    </p>
                    <p>
                        <button class="btn btn-xs btn-outline btn-success edit_staff"><span class="glyphicon glyphicon-edit"></span>编 辑</button>
                        <button class="btn btn-xs btn-outline btn-success delete_staff"><span class="glyphicon glyphicon-remove"></span>删 除</button>
                        <button class="btn btn-xs btn-outline btn-success preview_staff"><span class="glyphicon glyphicon-list-alt"></span>预 览</button>
                    <button class="btn btn-xs btn-outline btn-success print_staff"><span class="glyphicon glyphicon-download-alt"></span>下 载</button>
                    </p>
                    <button class="btn btn-xs btn-outline btn-success details_staff"><span class="glyphicon glyphicon-align-justify"></span>详 情</button>
                    <select class="form-control chosen-select btn-outline ele-BUT push_down" name="userId" id="useId" style="width:6%;" tabindex="2">
                        <option value="1">--本人--</option>
                        <option value="2">--所有--</option>
                    </select>
                </div>
            <div class="table-responsive">
                <table id="staff" class="table table-bordered table-hover table-striped">
                    <thead>
                    </thead>
                    <tbody style="text-align: center">
                    </tbody>
                </table>
            </div>
            <div class="ibox-content" id="app">
                <ul class="nav nav-tabs" role="tablist" v-if="unData">
                    <li role="presentation" class="active"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">物料信息</a></li>
                </ul>
                <div class="tab-content" v-if="unData">
                    <div role="tabpanel" class="tab-pane active" id="contact">
                        <table class="table table-striped table-hover table-border">
                            <tr>
                                <th>产品名</th>
                                <th>型号</th>
                                <th>单位</th>
                                <th>数量</th>
                                <th>单价</th>
                                <th>金额</th>
                                <th>交货日期</th>
                            </tr> 
                            <tr v-for="item in contact">
                                <td>{{item.product_number  || ''}}</td>
                                <td>{{item.product_name  || ''}}</td>
                                <td>{{item.unit  || ''}}</td>
                                <td>{{item.purchase_number  || ''}}</td>
                                <td>{{item.purchase_single_price  || ''}}</td>
                                <td>{{item.purchase_price  || ''}}</td>
                                <td>{{item.deliver_time  || ''}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="notSelectData"  v-else>
                    您当前没有选中数据，请单击数据进行查看
                </div>
                <!-- 审核 弹框 -->
                <el-dialog
                    title="采购合同审核："
                    :visible.sync="dialogVisible"
                    width="30%"
                    >
                    <span>该采购合同是否通过？</span>
                    <span slot="footer" class="dialog-footer">
                        <el-button @click="eleClick_that(1)">不通过</el-button>
                        <el-button type="primary" @click="eleClick_that(audit_number)">通过</el-button>
                    </span>
                </el-dialog>  
                <!-- 上传附件 弹框 -->
                <el-dialog title="上传合同附件：" class="selsctDialog" style="margin-botton:10px" :visible.sync="dialogAffix" width="45%">
                    <el-row class="row_top">
                        <el-col :span="12" :offset="1">
                            <b>合同编号：</b>{{upData_data.currentData.contract_id}}
                        </el-col>
                        <el-col :span="11">
                            <b>创建人：</b>{{upData_data.currentData.name}}
                        </el-col>
                    </el-row>   
                    <el-row class="row_top" style="margin-top:10px;">
                        <el-col :span="12" :offset="1">
                            <b>公司名称：</b>{{upData_data.currentData.supplier_name}}
                        </el-col>
                        <el-col :span="11">
                            <b>供方代表：</b>{{upData_data.currentData.supplier_representative}}
                        </el-col>
                    </el-row>   
                    <el-upload
                        class="uploadResume"
                        action="<?php echo U('/dwin/purchase/uploadContractFile');?>"
                        :data="upLoadData"
                        :on-success="papersUploadSuccess"
                        :on-error="uploadError"
                        :show-file-list="student_study"
                        :auto-upload="true"
                        style="text-align: center"
                    >
                    <el-button size="small" type="primary" @click="click_upload">上传合同附件</el-button>
                </el-upload>
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
    var filterFlag = <?php echo (json_encode($checkFlag)); ?>;
    var auditMsg = <?php echo (json_encode($auditMsg)); ?>;
    var table = $('#staff'). DataTable({
        ajax: {
            type: 'post',
            data: {
                function(){
                    if(obj){
                        obj.currentId = ''
                        obj.current_id = ''
                        obj.current_status = ''
                        obj.file_url  = ''
                        obj.file_name = ''
                        obj.previewid = ''    
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
        "scrollX": false,
        "scrollCollapse": true,
        "destroy"      : true,
        "paging"       : true,
        "autoWidth"	   : false,
        "pageLength": 25,
        serverSide: true,
        // order:[[21, 'desc']],
        columns: [
            {title:'合同编号',title:'合同编号',searchable: true, data: 'contract_id'},
            {title:'创建人',searchable: true, data: 'name'},
            {title:'供方名称',searchable: true, data: 'supplier_name'},
//            {title:'供方地址',searchable: true, data: 'supply_address'},
            {title:'签订时间',searchable: true, data:  'signing_time',render: function(data){return formatDateTime(data)}},
//            {title:'签订地点',searchable: true, data: 'signing_place'},
            {title:'总金额',searchable: false, data: 'total_amount'},
//            {title:'收货人',searchable: false, data: 'receiver'},
//            {title:'交货地点',searchable: false, data: 'trading_location'},
//            {title:'收货电话',searchable: true, data: 'receiving_phone'},
            {title:'结算方式',searchable: true, data: 'billing_method'},
            {title:'供方法定代表',searchable: true, data: 'supplier_representative'},
            {title:'供方代表电话',searchable: true, data: 'supplier_phone'},
//            {title:'供方代表传真',searchable: true, data: 'supplier_fax'},
            {title:'是否回传合同附件',searchable: true, class:'suc' , data: 'is_return_contract', render: function (data){return ['未回传', '已回传'][+data]}},
            {title:'订单状态',searchable: true, data: 'order_status', render: function (data){return ['未生成订单','已生成订单','已生成订单','已生成订单','已生成订单'][+data]}},
            {title:'审核状态',searchable: true, data: 'audit_status', render: function (data){return auditMsg[+data]}},
            {title:'合同附件',searchable: true, data: 'file_name'}
        ],
        'fnRowCallback':function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            /*
                nRow:每一行的信息 tr  是Object
                aData：行 index
            */
            for(let key in nRow){
                var AD_ad = nRow['childNodes'][nRow['childNodes'].length - 2]
                var AD_os = nRow['childNodes'][nRow['childNodes'].length - 3]
                var ADataStatus = nRow['childNodes'][8].innerText
                if(ADataStatus == '未回传'){
                    $(nRow['childNodes'][8]).css("color",'red')
                }else if(ADataStatus == '已回传'){
                    $(nRow['childNodes'][8]).css("color",'green')
                }
                if(AD_os.innerText == '未生成订单'){
                    $(AD_os).css("color",'red')
                }else if(AD_os.innerText == '已生成订单'){
                    $(AD_os).css("color",'green')
                }
                if(AD_ad.innerText == auditMsg[0]){
                    $(AD_ad).css('color','blue')
                }else if(AD_ad.innerText == auditMsg[1]){
                    $(AD_ad).css('color','red')
                }else if(AD_ad.innerText == auditMsg[2]){
                    $(AD_ad).css('color','#CC66CC')
                }else{
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
        currentId:"",
        current_id:"",
        current_status:'',
        file_url:'',
        file_name:'',
        previewid:'',
        currentData:[],
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
            $('tr').removeClass('selected');
            val.addClass('selected');
            $.post('/Dwin/Purchase/getContractProduct', {id: obj.currentId}, function (res) {
                for(var i = 0;i< res.data.length;i++){
                    res.data[i].deliver_time = formatDateTime(res.data[i].deliver_time)
                }
                vm.contact = res.data
            })
        },
        destroyData: function () {
            vm.contact = [];
            this.currentId = ""
            this.current_id = ""
            this.current_status = ''
            this.file_url = ''
            this.file_name = ''
            this.previewid = ''
            this.currentData = []
            this.selectedObj = {}
            this.tabClickDiv  =  $('.change-css')
            this.tabActiveDiv  =  $(".active-css")
            $('tr').removeClass('selected');
        },
        initData : function (that, flag) {
            this.tabClickDiv =  $('.change-css');
            this.tabActiveDiv =  $(".active-css")
            this.kElement =  document.getElementById("orderType")
            if (flag === true && table.row(that).data()) {
                obj.currentData = table.row(that).data();
                obj.currentId = obj.currentData.id;
                obj.current_id = obj.currentData.contract_id
                obj.current_status = obj.currentData.audit_status
                obj.file_url  = obj.currentData.file_url
                obj.file_name = obj.currentData.file_name
                obj.previewid = obj.currentData.id
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
                student_study:false,
                contact:[],
                upData_data:obj,
                dialogVisible:false,
                dialogAffix:false,
                unData:false,
                currentId:obj.currentId,
                upLoadData:{
                    id:''
                },
                audit_number:1
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
            eleClick_that: function (vul){
                var vm = this
                var data = {
                    'id': obj.currentId,
                    'status':vul
                }
                $.post('<?php echo U("Dwin/Purchase/auditContract");?>', data , function (res) {
                    if(res.status == 200){
                        obj.destroyData()
                        table.ajax.reload()
                        vm.dialogVisible = false
                        vm.audit_number = 1
                    }
                    layer.msg(res.msg)
                })
            },
            // 上传附件
            papersUploadSuccess: function (res,file) {
                if(res.status == 200){
                    this.student_study = false
                    table.draw(false)
                    this.dialogAffix = false
                }else{
                    this.student_study = false
                }
                layer.msg(res.msg)
                
            },
            uploadError: function (res){
                // layer.msg(res.msg)
                // this.dialogAffix = false
            },
            // 上传附件
            up_contract_affix:function(){
                var data = {
                    'id' : id,
                    'type':'team',
                    'data' : this.team[index]
                }
                layer.confirm('确认上传?', function (aaa) {
                    $.post('<?php echo U("/Dwin/Purchase/uploadContractFile");?>', data, function (res) {
                        if (res.status == 200) {
                            vm.getData();
                            layer.msg(res.msg)
                        }else{
                            layer.msg(res.msg)
                        }
                    })
                })
            },
            click_upload:function (){
                vm.upLoadData.id = obj.currentId
            },
            closeDialog: function () {
                $('tr').removeClass('selected');
            }
        }
    })
    // 生成订单
    $('.indent_staff').on('click', function () {
        if (obj.current_id === undefined || !obj.current_id){
            layer.msg('请选择采购合同')
        } else {
            if(obj.current_status == '3'){
                var index = layer.open({
                    type: 2,
                    title: '采购生成订单',
                    content: '/Dwin/Purchase/createOrderWithContract?contractId=' + obj.currentId,
                    area: ['90%', '90%'],
                    shadeClose:true,
                    end: function () {
                        obj.destroyData()
                    }
                })
            }else if(obj.current_status == '0'){
                layer.msg('该合同还未审核')
            }else if(obj.current_status == '1'){
                layer.msg('该合同审核未通过')
            }
        }
    })
    // del订单
    $('.delete_staff').on('click', function () {
        if (obj.current_id === undefined || !obj.current_id){
            layer.msg('请选择采购合同')
        } else {
            if(obj.current_status == '2'){
                layer.msg("单据已经审核不能删除");
            }else {
                layer.confirm('确认删除?', function () {
                    $.post('<?php echo U("/Dwin/Purchase/delContract");?>', {
                        contractId: obj.currentId
                    }, function (res) {
                        if (res.status == 200) {
                            layer.msg(res.msg);
                        }else{
                            layer.msg(res.msg)
                        }
                    })
                })
            }
        }
    })
    // 点击 合同详情
    $('.details_staff').on('click', function () {
        if (obj.current_id === undefined || !obj.current_id){
            layer.msg('请选择采购合同')
        } else {
            var index = layer.open({
                type: 2,
                title: '湖南迪文科技有限公司采购合同详情',
                content: '/Dwin/Purchase/getContractAllMsg?id=' + obj.currentId,
                area: ['90%', '90%'],
                shadeClose:true,
                end: function () {
                    obj.destroyData()
                }
            })
        }
    })
    // 点击 编辑
    $('.edit_staff').on('click', function () {
        if (obj.current_id === undefined || !obj.current_id ){
            layer.msg('请选择采购合同')
        } else {
            if(obj.current_status == '2'){
                layer.msg('该合同审核已通过')
            }else{
                var index = layer.open({
                    type: 2,
                    title: '湖南迪文科技有限公司采购合同编辑',
                    content: '/Dwin/Purchase/editContract?contractId=' + obj.currentId,
                    area: ['90%', '90%'],
                    shadeClose:true,
                    end: function () {
                        table.ajax.reload()
                        obj.destroyData()
                    }
                })
            }
        }
    })
    // 刷新
    $('.refresh').on('click', function () {
        table.order([[5, 'desc']])
        obj.destroyData()
    })
    // 审核
    $('.audit_staff').on('click', function () {
        if (obj.current_id === undefined || !obj.current_id ){
            layer.msg('请选择采购合同')
        } else {
            vm.audit_number = 1
            if(document.getElementById('orderType').value == 0){
                vm.audit_number = 2;
            }
            else
            {
                vm.audit_number = 3;
            }
            vm.dialogVisible = true
        }
    })
    // 上传合同附件
    $('.affix_staff').on('click', function () {
        if (obj.current_id === undefined || !obj.current_id ){
            layer.msg('请选择采购合同')
        } else {
            vm.dialogAffix = true
        }
    })
    // 预览文件
    $('.preview_staff').on('click', function () {
        if (obj.current_id === undefined || !obj.current_id ){
            layer.msg('请选择采购合同')
        } else {
            if(!obj.file_name){
                layer.msg('没有上传你要浏览的合同文件！')
            }else{
                if (!window.Uint8Array) {
                    layer.msg('旧版本浏览器无法正常显示此页面')
                    return false
                }
                if (obj.current_id){
                    if(obj.previewid){
                        window.open('<?php echo U("previewPdf", [], "");?>/id/' + obj.previewid )
                    }else{
                        layer.msg('合同还没有上传附件！')   
                    }
                } else {
                    layer.msg('请选择一行数据') 
                }
            }
        }
    })
    // 打印合同
    $('.print_staff').on('click', function () {
        if (obj.current_id === undefined || !obj.current_id ){
            layer.msg('请选择采购合同')
        } else {
            layer.confirm('确定打印吗？', {
                icon: 6,
                btn:['打印','取消'] //按钮
            }, function(){
                $.post('/Dwin/Purchase/uploadContract', {id:obj.currentId}, function (res) {
                    layer.msg(res.msg)
                    if (res.status == 200) {
                        window.open(res.data.file_url)
                    }
                })
            })
        }
    })
    // 时间戳转化为时间
    function formatDateTime(timeStamp) { 
        if(timeStamp != null&&timeStamp != 0){
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
</script>
</body>
</html>