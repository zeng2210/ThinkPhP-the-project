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
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
                <div class="title_top">
                        <h4>湖南迪文有限公司已出库单记录列表</h4>
                        <div style="display: inline-block;width:100%;margin-top: 3px;">
                            <div class="fa-hover col-md-1 col-sm-3 change-css active-css but_floatFood" data-id="1" onclick="outbound(1)" style="margin:0 1% 0 0"><a href="javascript:;" class="active-css-child"><i class="fa fa-tv">已出审核</i></a></div>
                            <div class="fa-hover col-md-1 col-sm-3 change-css but_floatFood" data-id="2" onclick="outbound(2)"><a href="javascript:;"><i class="fa fa-tv">未出记录</i></a></div>
                            <input type="hidden" id="orderType" value="1">
                        </div>
                        <p>
                            <button class="btn btn-xs btn-outline btn-success refresh">刷 新</button>
                        </p>
                        <p>
                            <button class="btn btn-xs btn-outline btn-success refresh">刷 新</button>
                            <!-- <button class="btn btn-xs btn-outline btn-success details_staff"><span class="glyphicon glyphicon-cloud-upload"></span>详 情</button> -->
                            <!-- <button class="btn btn-xs btn-outline btn-success rollback_staff"><span class="glyphicon glyphicon-print"></span>回退物料</button> -->
                            <!-- <button class="btn btn-xs btn-outline btn-success rollbackAll_staff"><span class="glyphicon glyphicon-print"></span>回退单据</button> -->
                            <!-- <button class="btn btn-xs btn-outline btn-success indent_staff"><span class="glyphicon glyphicon-print"></span>下载单据</button> -->
                        </p>
                        <select class="form-control chosen-select btn-outline ele-BUT push_down" id="select_vol" name="userId" style="width:9%;" tabindex="2">
                            <option value="">--筛选类型--</option>
                            <?php if(is_array($cateMap)): $i = 0; $__LIST__ = $cateMap;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vol); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
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
    var cateMap = <?php echo (json_encode($cateMap)); ?>;  //出库类型名称
    var audit_status = <?php echo (json_encode($auditMap)); ?>;  //出库类型名称
    var repMap = <?php echo (json_encode($repMap)); ?>;  //出库库房名
    var select = select = document.getElementById('select_vol')
    var table = $('#staff'). DataTable({
        ajax: {
            // url:'/Dwin/Stock/auditStockOut',
            type: 'post',
            data: {
                checkStatus: function () {
                    return document.getElementById('orderType').value;
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
            {searchable: true, title:'出库单编号', data: 'stock_no'},
            {searchable: true, title:'制单出库数量', data:'num'},
            {searchable: true, title:'库存数量', data:'stock_number'},
            {searchable: true, title:'出库类型', data: 'cate_id',
                render:function(data){
                    if(cateMap[data]){
                        return cateMap[data]
                    }else{
                        return ''
                    }
                }
            },
            {searchable: true, title:'出库仓库', data: 'repertory_id',render: function(data){for(let key in repMap){if(data == repMap[key].rep_id){return data = repMap[key].repertory_name}}}},
            {searchable: true, title:'创建时间', data: 'create_time',render: function(data){return vm.formatDateTime(data)}},
            {searchable: true, title:'更新时间', data: 'update_time',render: function(data){return vm.formatDateTime(data)}},
            {searchable: true, title:'审核状态', data: 'status',render: function (data){return audit_status[+data]}},
        ],
        fnRowCallback:function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            for(let key in nRow){
                var AD_status = nRow['children'][nRow['children'].length - 1]
                switch(AD_status.innerText){
                    case audit_status[0]:
                        $(AD_status).css('color','blue')
                        break
                    case audit_status[1]:
                        $(AD_status).css('color','red')
                        break
                    case audit_status[2]:
                        $(AD_status).css('color','green')
                        break
                }   
            }
        },
        fnServerParams: function (aoData) {
            aoData['source_kind'] = select.value
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
            if (flag === true) {
                obj.elseData  = table.row(that).data();
                console.log(obj.elseData)
                obj.elseId = obj.elseData.id
                obj.else_id    = obj.elseData.supplier_id;   // 订单主键
                obj.else_status = obj.elseData.audit_status
                obj.source_kind = obj.elseData.cate_id
            }
        },
    }
    $.post('/Dwin/Stock/stockOutOtherMaterial', {id: obj.elseId}, function (res) {
        vm.bomInfo = res.data
    }),
    $.post('/Dwin/Stock/getStockOutRecord', {id: obj.elseId},function (res) { 
        vm.record_info = res.data
    })

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
    var elseId
    var else_id
    var else_status
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
      // 出库单下推
    $('.push_down').on('change', function () {
        table.ajax.reload()
    })
    // 根据未出/已出 判断
    var outAndin = document.getElementById('orderType').value;
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
                if(vul == 1){
                    var data={"id":obj.elseId,"status":1};
                    $.post('<?php echo U("/Dwin/Stock/auditStockOut");?>', data , function (res) {
                        if(res.status == 200){
                            table.ajax.reload()
                            vm.dialogVisible = false
                        }
                        layer.msg(res.msg)
                    })
                }else{
                    var data={"id":obj.elseId,"status":2};
                    $.post('<?php echo U("/Dwin/Stock/auditStockOut");?>', data , function (res) {
                        if(res.status == 200){
                            table.ajax.reload()
                            vm.dialogVisible = false
                        }
                        layer.msg(res.msg)
                    })
                }
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
        if (obj.elseId === undefined || !obj.elseId){
            layer.msg('请选择一个条出库单记录')
            return false;
        }
        var index = layer.confirm("确认打印该单据？",{
            btn  : ['确认', '取消'],
            icon : 6
        }, function () {
            console.log(obj.source_kind)
            if(obj.source_kind === undefined){
                layer.msg('请选择一个条出库单记录')
                return false;
            }
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
            layer.msg('请选择一个出库单记录')
        } else {
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
        }
    })
    // 回退
    $('.rollback_staff').on('click', function () {
        if (obj.elseId === undefined || !obj.elseId){
            layer.msg('请选择一个出库单记录')
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
            layer.msg('请选择一个出库单记录')
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
    // 其他出库单 修改
    $('.revamp_staff').on('click', function () {
        if(obj.elseId == undefined || !obj.elseId){
            layer.msg('请选择一个出库单记录')
        }else{
            if(obj.else_status == '3'){
                layer.msg('该库房审核已完毕，不能修改！')
            }else{
                var index = layer.open({
                    type: 2,
                    title: '湖南迪文有限公司出库申请单修改',
                    content: '/Dwin/Stock/editOtherStockOut?id='+ obj.elseId,
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
        if (obj.elseId === undefined || !obj.elseId){
            layer.msg('请选择一个出库单记录')
        } else {
            if(obj.else_status >= '2'){
                vm.$message({
                    showClose: true,
                    message: '该项审核已通过,不能再次审核！！',
                    type: 'warning'
                });
            }else{
                vm.dialogVisible = true
            }
        }
    })
</script>
</body>
</html>