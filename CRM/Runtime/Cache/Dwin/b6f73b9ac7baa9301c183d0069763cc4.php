<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>生产任务</title>
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
            /* margin-right: 200px!important; */
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
                    <h3>其他入库制单</h3>
                    <div  v-cloak class="span-warning" id="buttonVm">
                            <el-form :inline="true" ref="form" label-width="80px">
                                <el-alert
                                title="填写点击确定后提交入库单，审核后生效"
                                type="success"
                                show-icon
                                >
                            </el-alert>
                            <el-row>
                                <el-col :span="6" :offset="1">
                                    <el-form-item label="单据类型:">
                                        <span class="span-info">其他入库</span>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7">
                                    <el-form-item label="入库编号:">
                                        <el-input v-model="defaultInfo" readonly></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7">
                                    <el-form-item label="入库类型:">
                                        <el-select v-model="stock.type_id" filterable placeholder="请选择类型" @change="typeSelect()">
                                            <el-option
                                                    v-for="key1 in stockInCateArr"
                                                    :key="key1.value"
                                                    :label="key1.label"
                                                    :value="key1.value">
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row>
                                <el-col :span="6" :offset="1">
                                    <el-form-item label="源单编号:">
                                        <span class="span-info">无</span>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7">
                                    <el-form-item label="供应商:">
                                        <el-input v-model="stock.supplier_id"></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7">
                                    <el-form-item label="部门:">
                                        <el-select v-model="stock.dept_id" filterable placeholder="请选择部门">
                                            <el-option
                                                    v-for="key1 in selectInfo.dept"
                                                    :key="key1.id"
                                                    :label="key1.name"
                                                    :value="key1.id">
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            </el-form>
                            <el-form ref="form">
                                <el-row>
                                    <el-col :span="22" :offset="1">
                                        <el-form-item label="入库备注:">
                                            <el-input type="textarea" v-model="stock.tips" style="width:82%"></el-input>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                            </el-form>
                                <el-row>
                                    <el-col :span="22" :offset="1">
                                        <table class="table table-border table-hover table-striped">
                                            <tr style="border-left:1px solid #ccc;border-right:1px solid #ccc;">
                                                <th>物料编号</th>
                                                <th>产品名</th>
                                                <th>数量</th>
                                                <th>入库仓库</th>
                                                <th style="width:80px;">操作</th>
                                            </tr>
                                            <tr v-for="(product,index) in productData"  style="border-left:1px solid #ccc;border-right:1px solid #ccc;">
                                                <td>{{product.product_no}}</td>
                                                <td>{{product.product_name}}</td>
                                                <td>
                                                    <el-input
                                                            data-vv-as="入库数量"
                                                            type="number"
                                                            v-model="product.num">
                                                    </el-input>
                                                </td>
                                                <td>
                                                    <el-select v-model="product.default_rep_id" placeholder="请选择物料入库仓库">
                                                        <el-option
                                                        v-for="key1 in selectInfo.warehouse"
                                                        :key="key1.warehouse_id"
                                                        :label="key1.warehouse_name"
                                                        :value="key1.warehouse_id">
                                                        </el-option>
                                                    </el-select>
                                                </td>
                                                <td>
                                                    <el-button type="button" size="sm" class="btn btn-warning" @click="productData.splice(index, 1)">删除</el-button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
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
                                                            </tr>
                                                            <tr v-for="item in searchProductRes" @click="addProduct(item)">
                                                                <td>{{item.product_no}}</td>
                                                                <td>{{item.product_number}}</td>
                                                                <td>{{item.product_name}}</td>
                                                                <td>{{item.warehouse_name}}</td>
                                                            </tr>
                                                        </table>
                                                    </el-popover>
                                                    <el-button size="small" v-popover:add_product type="danger">新增物料</el-button>
                                                </td>
                                            </tr>
                                        </table>
                                    </el-col>
                                </el-row>
                        <el-form :inline="true" ref="form" label-width="100px">
                            <el-row>
                                <el-col :span="7" :offset="1">
                                    <el-form-item label="审核人:">
                                        <el-select v-model="stock.auditor_id" @change="auditorSelect()" required placeholder="请选择审核人">
                                            <el-option
                                                v-for="item in selectInfo.auditor"
                                                :key="item.auditor_id"
                                                :label="item.auditor_name"
                                                :value="item.auditor_id">
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7">
                                    <el-form-item label="验收人:">
                                        <el-select v-model="stock.check_id"  @change="checkerSelect()" required placeholder="请选择验收人">
                                            <el-option
                                                    v-for="item in selectInfo.staff"
                                                    :key="item.id"
                                                    :label="item.name"
                                                    :value="item.id">
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7">
                                    <el-form-item label="保管人:">
                                        <el-select v-model="stock.keep_id"  @change="keeperSelect()" required placeholder="请选择保管人">
                                            <el-option
                                                    v-for="item in selectInfo.staff"
                                                    :key="item.id"
                                                    :label="item.name"
                                                    :value="item.id">
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row>
                                <el-col :span="24" style="text-align:center">
                                    <el-button size="medium" type="primary" @click="submitStock">提交其他入库单</el-button>
                                </el-col>
                            </el-row>
                            </el-form>

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
                    stockInCateArr : [],
                    stock : {
                        "supplier_id": '',
                        "dept_id"    : '',
                        "auditor_id" : '',
                        "check_id"   : '',
                        "keep_id"    : '',
                        "type_id"    : ''
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
                    for (let key in vm.selectInfo.stockInCate){
                        vm.stockInCateArr.push({'value':key,'label':vm.selectInfo.stockInCate[key]})
                    }
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
                        this.default_rep_id  = product.warehouse_id;
                        this.fail_rep_id   = product.warehouse_id;
                        this.num    = 0;
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
                warehouseSelect: function(){
                    var id = this.productData.warehouse_id;
                    var warehouse = this.selectInfo.warehouse;
                    var name = '';
                    for (var i = 0; i < warehouse.length; i++){
                        if (id === warehouse[i].warehouse_id){
                            name = warehouse[i].warehouse_name
                        }
                    }
                    Vue.set(this.productData, 'warehouseArr', id + '_' + name)
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
                    if (!vm.stock.auditorArr) {
                        this.$notify({
                            title: '未选择审核人',
                            message: '警告',
                            type: 'warning'
                        });
                        return false;
                    }
                    if (!vm.stock.check_id) {
                        this.$notify({
                            title: '未选择验收人',
                            message: '警告',
                            type: 'warning'
                        });
                        return false;
                    }
                    if (!vm.stock.keep_id) {
                        this.$notify({
                            title: '未选择保管人',
                            message: '警告',
                            type: 'warning'
                        });
                        return false;
                    }
                    if (vm.productData.length == 0) {
                        this.$notify({
                            title: '不能不提交入库的物料',
                            message: '警告',
                            type: 'warning'
                        });
                        return false;
                    }
                    for (var i = 0; i < vm.productData.length; i++) {
                        if (!vm.productData[i].default_rep_id) {
                            this.$notify({
                                title: '未选择默认仓库',
                                message: '警告',
                                type: 'warning'
                            });
                            return false;
                        }
                        if (!vm.productData[i].fail_rep_id) {
                            this.$notify({
                                title: '未选择不良仓库',
                                message: '警告',
                                type: 'warning'
                            });
                            return false;
                        }
                        if (!vm.productData[i].num) {
                            this.$notify({
                                title: '入库数量有问题',
                                message: '警告',
                                type: 'warning'
                            });
                            return false;
                        }
                        if (vm.productData[i].num < 0) {
                            this.$notify({
                                title: '入库数非法',
                                message: '警告',
                                type: 'warning'
                            });
                            return false;
                        }
                    }
                    return true;
                },
                submitStock : function () {
                    var flag = this.beforeSubmit();
                    if (!flag) {
                        return false;
                    } else {
                        $.ajax({
                            url : "/Dwin/Stock/addStockInWithOther",
                            type : 'post',
                            data : {
                                base : vm.stock,
                                material : vm.productData
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
                    }

                }
            }
        })

    });
</script>
</body>
</html>