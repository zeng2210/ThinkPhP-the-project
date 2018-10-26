<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>调拨制单</title>
    <link href="/Public/html/css/bootstrap.min14ed.css" rel="stylesheet">
    <!--<link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.4/theme-chalk/index.css" rel="stylesheet">
    <style type="text/css">
        body {
            color: black;
            font-size: 14px;
        }
        .selected{
            background-color: #fbec88 !important;
        }

        .nav-tabs>li>a{
            color: #555;
        }
        .nav-tabs>.active>a{
            color: #000!important;
        }
        tr{
            white-space: nowrap!important;
        }
        tbody td{
            padding-top: 2px!important;
            padding-bottom: 2px!important;
        }

        [v-cloak] {
            display: none;
        }
        .btn{
            margin-right: 1em;
        }
        .ibox{
            padding:20px;
        }
        .el-select-option-span{
            float: left;font-size: 12px;
        }
        .el-form-item__label{
            width: 80px!important;
        }
        .el-form-item__content{
            margin-left: 10px!important;
        }
        .el-form-item__content{
            margin-right: 200px!important;
        }
        /*.delayComplain{*/
            /*display: none;*/
        /*}*/
        /*.dataTables_scrollHeadInner{*/
            /*width: 100%!important;*/
        /*}*/
        /*.dataTables_scrollHeadInner table{*/
            /*width: 100%!important;*/
        /*}*/

        .span-warning{
            font-weight: 500;
            color:red;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins" id="productionDiv">
                <div class="ibox-content" >
                    <h3>调拨制单</h3>
                    <div  v-cloak class="span-warning" id="buttonVm">
                            <el-form :inline="true" ref="form" label-width="80px">
                                <el-alert
                                        title="填写点击确定后提交调拨单，二次审核后生效（制单人一审，出库库房二审）"
                                        type="success"
                                        show-icon
                                >
                                </el-alert>
                                <el-form-item label="单据类型:">
                                    <span class="span-info">其他调拨</span>
                                </el-form-item>
                                <el-form-item label="入库编号:">
                                    <el-input v-model="defaultInfo" readonly></el-input>
                                </el-form-item>

                                <el-form-item label="源单编号:">
                                    <span class="span-info">无</span>
                                </el-form-item>
                            </el-form>
                        <el-form ref="form" label-width="120px">
                            <el-form-item label="调拨备注:">
                                <el-input type="textarea" v-model="stock.tips"></el-input>
                            </el-form-item>

                        </el-form>
                                <table class="table table-border table-hover table-striped">
                                    <tr>
                                        <th>物料编号</th>
                                        <th>产品名</th>
                                        <th>出库库房<br>即时库存</th>
                                        <th>调拨数量</th>
                                        <th>出库仓库</th>
                                        <th>入库仓库</th>
                                        <th>调拨原因</th>
                                        <th>操作</th>
                                    </tr>
                                    <tr v-for="(product,index) in productData">
                                        <td>{{product.product_no}}</td>
                                        <td>{{product.product_name}}</td>
                                        <td>{{product.stock_total_number}}</td>
                                        <td>
                                            <el-input
                                                    size="small"
                                                    data-vv-as="入库数量"
                                                    type="number"
                                                    v-model="product.num"
                                            >
                                            </el-input>
                                        </td>
                                        <td>
                                            <el-select size="small" @change="repOutSelect(index)" v-model="product.rep_id_out" placeholder="请选择物料出库仓库">
                                                <el-option
                                                v-for="key1 in selectInfo.warehouse"
                                                :key="key1.warehouse_id"
                                                :label="key1.warehouse_name"
                                                :value="key1.warehouse_id">
                                                </el-option>
                                            </el-select>
                                        </td>
                                        <td>
                                            <el-select size="small" @change="repInSelect(index)" v-model="product.rep_id_in" placeholder="请选择物料入库仓库">
                                                <el-option
                                                        v-for="key1 in selectInfo.warehouse"
                                                        :key="key1.warehouse_id"
                                                        :label="key1.warehouse_name"
                                                        :value="key1.warehouse_id">
                                                </el-option>
                                            </el-select>
                                        </td>
                                        <td>

                                            <el-input
                                                    type="textarea"
                                                    size="small"
                                                    :rows="1"
                                                    data-vv-as="入库数量"
                                                    v-model="product.reason">
                                            </el-input>
                                        </td>
                                        <td>
                                            <el-button size="small" type="button" size="sm" class="btn btn-warning" @click="productData.splice(index, 1)">删除</el-button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8">
                                            <el-popover
                                                    ref="add_product"
                                                    placement="right"
                                                    width="70%"
                                                    trigger="click">
                                                <div class="form-inline">
                                                    <input type="text" class="form-control" placeholder="请输入产品名" v-model="searchProduct.name" @input="searchingProduct">
                                                </div>
                                                <table class="table table-striped table-hover table-bordered">
                                                    <tr>
                                                        <th>物料编号</th>
                                                        <th>产品名</th>
                                                        <th>产品型号</th>
                                                        <th>默认仓库</th>
                                                        <th>默认仓库库存</th>
                                                    </tr>
                                                    <tr v-for="item in searchProductRes" @click="addProduct(item)">
                                                        <td>{{item.product_no}}</td>
                                                        <td>{{item.product_number}}</td>
                                                        <td>{{item.product_name}}</td>
                                                        <td>{{item.warehouse_name}}</td>
                                                        <td>{{item.stock_total_number}}</td>
                                                    </tr>
                                                </table>
                                            </el-popover>
                                            <el-button size="small" v-popover:add_product type="danger">新增物料</el-button>
                                        </td>
                                    </tr>
                                </table>
                        <!--<el-form :inline="true" ref="form" label-width="10%">-->
                                <!--<el-form-item label="审核人:">-->
                                    <!--<el-select size="small" v-model="stock.auditor_id"  @change="auditorSelect()" required placeholder="请选择审核人">-->
                                        <!--<el-option-->
                                                <!--v-for="item in selectInfo.auditor"-->
                                                <!--:key="item.auditor_id"-->
                                                <!--:label="item.auditor_name"-->
                                                <!--:value="item.auditor_id">-->
                                        <!--</el-option>-->
                                    <!--</el-select>-->
                                <!--</el-form-item>-->
                                <!--<el-form-item label="验收人:">-->
                                    <!--<el-select size="small" v-model="stock.check_id"  @change="checkerSelect()" required placeholder="请选择验收人">-->
                                        <!--<el-option-->
                                                <!--v-for="item in selectInfo.staff"-->
                                                <!--:key="item.id"-->
                                                <!--:label="item.name"-->
                                                <!--:value="item.id">-->
                                        <!--</el-option>-->
                                    <!--</el-select>-->
                                <!--</el-form-item>-->
                                <!--<el-form-item label="保管人:">-->
                                    <!--<el-select size="small" v-model="stock.keep_id"  @change="keeperSelect()" required placeholder="请选择保管人">-->
                                        <!--<el-option-->
                                                <!--v-for="item in selectInfo.staff"-->
                                                <!--:key="item.id"-->
                                                <!--:label="item.name"-->
                                                <!--:value="item.id">-->
                                        <!--</el-option>-->
                                    <!--</el-select>-->
                                <!--</el-form-item>-->

                            <!--</el-form>-->
                        <el-button size="medium" type="primary" @click="submitStock">提交调拨单</el-button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/Public/html/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/vue.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="/Public/html/js/dwin/finance/common_finance.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.4/index.js"></script>
<script>

    $(document).ready(function() {
        var vm = new Vue({
            el: "#buttonVm",
            data : function () {
                return {
                    defaultInfo : "自动生成",
                    selectInfo : [],
                    stock : {
                        transferType : 2
                    },
                    productData: [],
                    searchProduct: {
                        name: ''
                    },
                    searchProductRes: []
                }
            },
            created: function (){
                $.post('/Dwin/Stock/getSelectInfo', {
                    type : 'getDept'
                },function (res) {
                    if (res.status !== 200) {
                        layer.msg(res.msg);
                        return false;
                    }
                    vm.selectInfo = [];
                    vm.selectInfo   = res.data;
                    var obj = {};
                });



            },
            computed : {
                checkInfo : function () {
                    this.taskUpdData.num = this.stockMaterial.num;
                    return parseInt(this.preStock.task_number) - parseInt(this.preStock.complete_quantity);
                }
            },
            methods: {
                addProduct: function (item) {
                    function Item(product){
                        this.product_id     = product.product_id;
                        this.product_no     = product.product_no;
                        this.product_name   = product.product_name;
                        this.warehouse_name = product.warehouse_name;
                        this.rep_id_out  = product.warehouse_id;
                        this.rep_id_in   = product.warehouse_id;
                        this.stock_total_number   = product.stock_total_number;
                        this.num = 0;
                        var warehouse = vm.selectInfo.warehouse;
                        for (var i = 0; i < warehouse.length; i++){
                            if (this.rep_id_in === warehouse[i].warehouse_id) {
                                this.rep_name_in = warehouse[i].warehouse_name
                            }
                            if (this.rep_id_out === warehouse[i].warehouse_id) {
                                this.rep_name_out = warehouse[i].warehouse_name
                            }
                        }
                        this.repOutArr = this.rep_id_out + "_" + this.rep_name_out;
                        this.repInArr = this.rep_id_in + "_" + this.rep_name_in;
                    }
                    var obj = new Item(item);
                    for (var i = 0; i< this.productData.length; i++) {
                        if (obj.product_id === this.productData[i].product_id) {
                            layer.msg("禁止添加重复物料");
                            return false;
                        }
                    }
                    this.productData.push(obj);
                },
                searchingProduct: function () {
                    $.post('/Dwin/Stock/getProductMsg', {
                        condition : vm.searchProduct.name
                    }, function (res) {
                        if (res.status == 200) {
                            vm.searchProductRes = res.data;
                        }

                    })
                },
                repInSelect: function(index) {
                    var id = this.productData[index].rep_id_in;
                    var warehouse = this.selectInfo.warehouse;
                    var name = '';
                    for (var i = 0; i < warehouse.length; i++) {
                        if (id === warehouse[i].warehouse_id){
                            name = warehouse[i].warehouse_name
                        }
                    }
                    Vue.set(this.productData[index], 'repInArr', id + '_' + name)
                },
                repOutSelect: function(index){
                    var id = this.productData[index].rep_id_out;
                    var warehouse = this.selectInfo.warehouse;
                    var name = '';
                    for (var i = 0; i < warehouse.length; i++){
                        if (id === warehouse[i].warehouse_id) {
                            name = warehouse[i].warehouse_name
                        }
                    }
                    Vue.set(this.productData[index], 'repOutArr', id + '_' + name)
                    var product_id = this.productData[index].product_id;
                    var thatIndex =this;
                    $.post('/Dwin/Stock/getProductStockNumber', {
                        product_id : product_id,
                        warehouse_id : id
                    }, function (res) {
                        if (res.status === 200) {
                            thatIndex.productData[index].stock_total_number = res.data;
                        } else {
                            thatIndex.productData[index].stock_total_number = 0;
                        }
                    })
                },
                auditorSelect: function () {
                    var id = this.stock.auditor_id;
                    var auditorIds = this.selectInfo.auditor;
                    var aud_name = "";
                    for (var i = 0; i < auditorIds.length; i++){
                        if (id === auditorIds[i].auditor_id){
                            aud_name = auditorIds[i].auditor_name
                        }
                    }
                    Vue.set(this.stock, 'auditorArr', id + '_' + aud_name)
                },
                checkerSelect: function () {
                    var id = this.stock.check_id;
                    var staffIds = this.selectInfo.staff;
                    var aud_name = "";
                    for (var i = 0; i < staffIds.length; i++){
                        if (id === staffIds[i].id){
                            aud_name = staffIds[i].name
                        }
                    }
                    Vue.set(this.stock, 'checkArr', id + '_' + aud_name)
                },
                keeperSelect: function () {
                    var id = this.stock.keep_id;
                    var auditorIds = this.selectInfo.staff;
                    var aud_name = "";
                    for (var i = 0; i < auditorIds.length; i++){
                        if (id === auditorIds[i].id){
                            aud_name = auditorIds[i].name
                        }
                    }
                    Vue.set(this.stock, 'keepArr', id + '_' + aud_name)
                },
                typeSelect: function () {
                    var id = this.stock.type_id;
                    var auditorIds = this.selectInfo.stockInCate;
                    var aud_name = "";
                    for (var i = 0; i < auditorIds.length; i++){
                        if (id === auditorIds[i].id){
                            aud_name = auditorIds[i].name
                        }
                    }
                    Vue.set(this.stock, 'typeArr', id + '_' + aud_name)
                },
                beforeSubmit : function(){
//                    if (!vm.stock.auditorArr) {
//                        this.$notify({
//                            title: '未选择审核人',
//                            message: '警告',
//                            type: 'warning'
//                        });
//                        return false;
//                    }
//                    if (!vm.stock.check_id) {
//                        this.$notify({
//                            title: '未选择验收人',
//                            message: '警告',
//                            type: 'warning'
//                        });
//                        return false;
//                    }
//                    if (!vm.stock.keep_id) {
//                        this.$notify({
//                            title: '未选择保管人',
//                            message: '警告',
//                            type: 'warning'
//                        });
//                        return false;
//                    }
                    if (vm.productData.length == 0) {
                        this.$notify({
                            title: '不能不提交入库的物料',
                            message: '失败',
                            type: 'warning'
                        });
                        return false;
                    }
                    for (var i = 0; i < vm.productData.length; i++) {
                        var j = i+1;
                        if (!vm.productData[i].rep_id_out) {
                            this.$notify({
                                title: '第' + j + '行出库仓库未选择',
                                message: '失败',
                                type: 'warning'
                            });
                            return false;
                        }
                        if (!vm.productData[i].rep_id_in) {
                            this.$notify({
                                title: '第' + j +'行入库仓库未选择',
                                message: '失败',
                                type: 'warning'
                            });
                            return false;
                        }
                        if (vm.productData[i].rep_id_in === vm.productData[i].rep_id_out) {
                            this.$notify({
                                title: '第' + j +'行调拨仓库有问题，出库仓库和入库仓库相同！',
                                message: '失败',
                                type: 'warning'
                            });
                            return false;
                        }
                        if ((!vm.productData[i].num) || ((vm.productData[i].num - vm.productData[i].stock_total_number) > 0)) {
                            this.$notify({
                                title: '第' + j +'行调拨数量有问题(未填写或大于可出库库存)' + vm.productData[i].num + "|||" + vm.productData[i].stock_total_number,
                                message: '失败',
                                type: 'warning'
                            });
                            return false;
                        }
                        if (vm.productData[i].num <= 0) {
                            this.$notify({
                                title: '第' + j +'行调拨数量非法',
                                message: '失败',
                                type: 'warning'
                            });
                            return false;
                        }
                        if (!vm.productData[i].reason) {
                            this.$notify({
                                title: '第' + j +'行调拨原因未填写，请进行填写',
                                message: '失败',
                                type: 'warning'
                            });
                            return false;
                        }

                    }
                    return true;
                },
                isInArray : function(arr,value) {
                    var index = $.inArray(value,arr);
                    if (index >= 0) {
                        return true;
                    }
                    return false;
                },
                preSubmit : function () {
                    var tmpOut = [],tmpIn = [];
                    tmpOut.push(vm.productData[0].rep_id_out);
                    tmpIn.push(vm.productData[0].rep_id_in);
                    for (var p = 1; p < vm.productData.length; p++) {
                        if (!vm.isInArray(tmpOut, vm.productData[p].rep_id_out)) {
                            tmpOut.push(vm.productData[p].rep_id_out);
                        }
                        if (!this.isInArray(tmpIn, vm.productData[p].rep_id_in)) {
                            tmpIn.push(vm.productData[p].rep_id_in);
                        }
                    }

                    return tmpIn.length >= tmpOut.length ? tmpIn.length : tmpOut.length;
                },
                submitStock : function () {
                    var flag = this.beforeSubmit();
                    if (!flag) {
                        return false;
                    } else {
                        var data = this.preSubmit();
                        layer.confirm('根据您填写的数据，将生成' + data + "条调拨单据，生成时间等信息默认在调拨备注中显示，确认数据无误并提交？", {
                            btn: ['确定','再检查一下'] //按钮
                        }, function(){
                            $.ajax({
                                url : "/Dwin/Stock/addStockTransfer",
                                type : 'post',
                                data : {
                                    base : vm.stock,
                                    material : vm.productData,
                                    length : data
                                },
                                success: function (res) {
                                    if (res.status == 200) {
                                        vm.$notify({
                                            title: '成功',
                                            message: '成功添加',
                                            type: 'success',
                                            onClose :function () {
                                                location.replace(location.href)
                                            }
                                        });
                                    } else {
                                        vm.$notify({
                                            title: '报错',
                                            message: res.msg,
                                            type: 'warning'
                                        });
                                    }
                                }
                            })
                        });

                    }

                }
            }
        })

    });
</script>
</body>
</html>