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
        input {
            width: 100%;
            height: 100%;
            display: block;
            outline: none;
        }
        .el-table .warning-row {
             background: oldlace;
        }

        .el-table .success-row {
            background: #f0f9eb;
        }
        .head_thead{
            height: 40px;
            line-height: 40px;
            text-align: left;
            padding-left: 10px;
            font-size: 15px;
        }
        .el-autocomplete{
            width: 100%;
        }
        .el-button--primary {
            float: left;
        }
        .deal_cent th{
            text-align: center
        }
        .add_button_new {
            text-align: left
        }
    </style>
</head>
<body>
    <div id="app" style="text-align: center">
        <h1>采购合同编辑</h1>
        <br><br><br>
        <el-form ref="form" :model="form" label-width="200px" size="medium" @submit.native.prevent v-loading="loading">
            <el-row>
                <el-col :span="20" :offset="2">
                    <div class="head_thead" style="font-weight: bold;">一、物料合同基本信息修改</div>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="9">
                    <el-form-item label="id：" v-if="false">
                        <el-input v-model="form.id" disabled></el-input>
                    </el-form-item>
                    <el-form-item label="合同编号：" required>
                        <el-input v-model="form.contract_id" disabled ></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="9">
                    <el-form-item label="供   方：" required>
                            <el-input v-model="form.supplier_name" disabled ></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="9"  :offset="2">
                    <el-form-item label="签订地点：" required>
                        <el-input v-model="form.signing_place"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="9">
                    <el-form-item label="需  方：" required>
                        <el-input v-model="form.demand_side" disabled></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="9"  :offset="2">
                    <el-form-item label="签订时间：" required>
                        <el-date-picker
                        style="width: 100%;"
                        v-model="form.signing_time"
                        type="date"
                        value-format="timestamp" 
                        format="yyyy-MM-dd"
                        placeholder="选择日期">
                        </el-date-picker>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="9">
                    <el-form-item label="供方单位名称：" required>
                        <el-input v-model="form.supplier_name" disabled></el-input>
                    </el-form-item>
                </el-col>
                 <el-col :span="9" :offset="2">
                    <el-form-item label="需方单位名称：" required>
                        <el-input  value="湖南迪文科技有限公司" disabled></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="9">
                    <el-form-item label="供方单位地址：" required>
                        <el-autocomplete
                            class="inline-input"
                            v-model="form.supply_address"
                            :fetch-suggestions="querySearch_U"
                            placeholder="请输入供方单位地址"
                        ></el-autocomplete>
                    </el-form-item>
                </el-col>
                 <el-col :span="9"  :offset="2">
                    <el-form-item label="需方单位地址：" required>
                        <el-input value="湖南省常德市桃源县漳江创业园创业大道8号" disabled></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="9">
                    <el-form-item label="供方法定代表：" required>
                        <el-autocomplete
                            class="inline-input"
                            v-model="form.supplier_representative"
                            :fetch-suggestions="querySearch_law"
                            placeholder="请输入供方法人代表"
                            @select="handleSelect_of"
                        ></el-autocomplete>
                    </el-form-item>
                </el-col>
                <el-col :span="9"  :offset="2">
                    <el-form-item label="需方法定代表：" required>
                        <el-input v-model="form.purchaser_representative"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="9">
                    <el-form-item label="供方电话：" required>
                        <el-autocomplete
                            class="inline-input"
                            v-model="form.supplier_phone"
                            :fetch-suggestions="querySearch_call"
                            placeholder="请输入电话"
                        ></el-autocomplete>
                    </el-form-item>
                </el-col>
                <el-col :span="9" :offset="2">
                    <el-form-item label="需方电话：" required>
                        <el-input v-model="form.purchaser_phone"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="9">
                    <el-form-item label="供方传真：">
                        <el-autocomplete
                            class="inline-input"
                            v-model="form.supplier_fax"
                            :fetch-suggestions="querySearch_fax"
                            placeholder="请输入传真"
                        ></el-autocomplete>
                    </el-form-item>
                </el-col>
                <el-col :span="9" :offset="2">
                    <el-form-item label="需方传真：">
                        <el-input v-model="form.purchaser_fax"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>


            <el-row :getter="20">
                <el-col :span="22" :offset="1">
                <!-- 文字表格 -->
                <table class="table table-striped table-hover table-bordered" border>
                        <div class="head_thead" style="font-weight: bold;">二、物料合同交易内容修改</div>
                        <tbody>
                            <tr class="deal_cent">
                                <th>交货地点：</th>
                                <th style="width:20%">收货人：</th>
                                <th>收货人电话：</th>
                                <th>结算方式：</th>
                            </tr>
                            <tr>
                                <td>
                                    <el-input v-model="form.trading_location"></el-input>
                                </td>
                                <td>
                                    <el-input v-model="form.receiver"></el-input>
                                </td>
                                <td>
                                    <el-input v-model="form.receiving_phone"></el-input>
                                </td>
                                <td>
                                    <el-autocomplete
                                    class="inline-input"
                                    v-model="form.billing_method"
                                    :fetch-suggestions="querySearch_balance"
                                    placeholder="请输入内容"
                                    ></el-autocomplete>
                                </td>
                            </tr>
                        </tbody>
                    </table>
   
            
                    <table class="table table-striped table-hover table-bordered" border style="margin-bottom: 0">
                            <div class="head_thead">三、物料名称、型号、单位、金额、供货时间及数量</div>
                            <tbody>
                                <tr class="deal_cent">
                                    <th v-show="false">ID</th>      
                                    <th style="width: 50px" required>序号</th>      
                                    <th>系统内部编号</th>      
                                    <th>型号</th>
                                    <th>外部编号</th>      
                                    <th>单位</th>
                                    <th>数量</th>
                                    <th>单价(元)</th>
                                    <th>金额(元)</th>
                                    <th>交货日期</th>
                                    <th style="width: 80px;">操作</th>
                                </tr>
                                <tr v-for="(item, index) in product">
                                    <td v-show="false">
                                        <el-input v-model="item.product_id" ></el-input>
                                    </td>
                                    <td>
                                        {{index + 1}}
                                    </td>
                                    <td>
                                        {{item.product_number}}
                                    </td>
                                    <td>
                                        {{item.product_no}}
                                    </td>
                                    <td>
                                        <el-input v-model="item.product_number" placeholder="外部编号"></el-input>
                                    </td>
                                    <td>
                                        <el-input v-model="item.unit" placeholder="单位"></el-input>
                                    </td>
                                    <td>
                                        <el-input v-model="item.purchase_number" @keyup.native="calculationAmount(index)" placeholder="数量" onkeypress="return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode==46" ></el-input>
                                    </td>
                                    <td>
                                        <el-input v-model="item.purchase_single_price" @keyup.native="calculationAmount(index)"  placeholder="单价"  onkeypress="return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode==46" ></el-input>
                                    </td>
                                    <td>
                                        <el-input v-model="item.purchase_price" placeholder="金额"  readonly="readonly"  onkeypress="return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode==46" ></el-input>
                                    </td>
                                    <td>
                                        <el-date-picker
                                        style="width: 135px;"
                                        v-model="item.deliver_time"
                                        type="date"
                                        value-format="timestamp" 
                                        format="yyyy-MM-dd"
                                        placeholder="交货日期">
                                        </el-date-picker>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning" @click="delawards11(index)">删除</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="add_button_new">
                            <el-popover ref="add_product" placement="right" width="400" trigger="click">
                                    <div class="form-inline">
                                        <input type="text" class="form-control" placeholder="请输入产品名" v-model="searchProduct.name" @input="searchingProduct">
                                    </div>
                                    <el-table :data="searchProductRes" @cell-click="addProduct" highlight-current-row max-height="300" border>
                                        <el-table-column prop="product_id" v-if="false" label="物料编号" width="110"> </el-table-column>
                                        <el-table-column prop="product_no" label="系统内部编号"> </el-table-column>
                                        <el-table-column prop="product_name" label="型号"></el-table-column>
                                        <el-table-column prop="product_number" label="系统外部编号"></el-table-column>
                                    </el-table>
                                    <!-- <table class="table table-striped table-hover table-bordered">
                                        <tr>
                                            <th v-if="false">id</th>
                                            <th>系统内部编号</th>
                                            <th>型号</th>
                                            <th>系统外部编号</th>
                                        </tr>
                                        <tr v-for="item in searchProductRes" @click="addProduct(item)">
                                            <td v-if="false">{{item.product_id}}</td>
                                            <td>{{item.product_no}}</td>
                                            <td>{{item.product_name}}</td>
                                            <td>{{item.product_number}}</td>
                                        </tr>
                                    </table> -->
                                </el-popover>
                                <el-button v-popover:add_product type="primary">新增产品</el-button>
                        </div>
                    <br>
                    <el-row :gutter="20"  style="margin-top: 24px">
                        <el-col :span="13" label-width="150px" :offset="11">
                            <el-row>
                                <el-col :span="20">
                                    <el-form-item label="合计金额:">
                                        <el-input v-model="form.total_amount" disabled></el-input>
                                    </el-form-item>
                                </el-col>
                               </el-row>
                               <el-row>
                                <el-col :span="20">
                                    <el-form-item label="合计金额（大写）:">
                                        <el-input v-model="form.capital_amount"  disabled></el-input>
                                    </el-form-item>
                                 </el-col>
                               </el-row>
                        </el-col>
                    </el-row>


                </el-col>
            </el-row>
            <br><br>
            <el-button type="success" @click="onSubmit(form)">提 交</el-button>
            <br><br>
                
        </el-form>
    </div>
</body>
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
    var data = JSON.parse('<?php echo (json_encode($contractData)); ?>')
    var supplierData = JSON.parse('<?php echo (json_encode($supplierData)); ?>')
    var vm = new Vue({
        el: '#app',
        data : function(){
            return {
                loading:true,
                serial_Number:'1',  //序号
                clue_yes:['主键','供应商表主键','合同编号','签订时间','签订地点','总金额','需方名称','供方名称','供方地址','供方法定代表','需方法定代表','供方电话','需方电话','交货地点','收货人','收货电话','结算方式','大写总金额'],
                form :{
                    id:data.contract.id,
                    supplier_pid:data.contract.supplier_pid,
                    contract_id:data.contract.contract_id,  //合同编码
                    signing_time: data.contract.signing_time,
                    signing_place: data.contract.signing_place,
                    total_amount:data.contract.total_amount,
                    demand_side:data.contract.demand_side,
                    supplier_name:data.contract.supplier_name,
                    supply_address:data.contract.supply_address,
                    supplier_representative:data.contract.supplier_representative,
                    purchaser_representative:data.contract.purchaser_representative,
                    supplier_phone:data.contract.supplier_phone,
                    purchaser_phone:data.contract.purchaser_phone,
                    purchaser_fax:data.contract.purchaser_fax,
                    supplier_fax:data.contract.supplier_fax,
                    trading_location:data.contract.trading_location,
                    receiver:data.contract.receiver,
                    receiving_phone:data.contract.receiving_phone,
                    billing_method:data.contract.billing_method,
                    capital_amount:data.contract.capital_amount
                },
                newdata:data,
                searchProduct: {
                    name: ''
                },
                searchProductRes: [],
                restaurants: [],  // 供应
                address_U:[],  //供方地址
                legal_law:[],   //法人代表
                legal_sign:[],  // 签字人
                company_call:[],  // 电话
                company_fax:[],   //传真
                product_name:[],
                add_operate:[],   //新增保存数组
                edit_operate:[],    //修改保存数组
                delete_operate:[],   //删除保存数组
                initial_row:[],      //初始物料数组
                balance:[
                    {'value':'结算方式一'},
                    {'value':'结算方式二'},
                    {'value':'结算方式三'},
                    {'value':'结算方式四'}
                ],
                timeout:  null,
                product:[]
            }
        },
        created : function () {
            this.initial_row.length = 0
            this.loading = false
            this.product = data.product
            this.form.signing_time = data.contract.signing_time * 1000
            for(var i = 0;i<data.product.length;i++){
                this.product[i].deliver_time = data.product[i].deliver_time * 1000
            }
            for(var i = 0;i< data.product.length;i++){
                this.initial_row.push(data.product[i])
            }
        },
        mounted() {
            // 供方单位地址  下拉
            for(var i = 0;i < supplierData.address.length;i++){
                this.address_U.push({"value":supplierData.address[i].address})
            }
            // 法人代表 
            this.legal_law.push({"value":supplierData.base.legal_name})
            this.form.supplier_representative = supplierData.base.legal_name
            // 电话
            for(var i = 0;i < supplierData.contact.length;i++){
                this.company_call.push({"value":supplierData.contact[i].telephone})   
            }
            // 传真fax
            for(var i = 0;i < supplierData.contact.length;i++){
                this.company_fax.push({"value":supplierData.contact[i].fax})   
            }
        },
        methods :{
            // 获取三个产品值
            searchingProduct: function() {
                $.post('<?php echo U("Dwin/Purchase/getProductMsg");?>', {'condition':this.searchProduct.name}, function(res) {
                    vm.searchProductRes = res.data
                })
            },
            // 下拉选中时
            addProduct: function(row) {
                function Item(product) {
                    this.product_id = product.product_id
                    this.product_no = product.product_no
                    this.product_name = product.product_name
                    this.product_number = product.product_number
                }
                var obj = new Item(row)
                this.product.push(obj)
            },
            // 传真 下拉
            querySearch_fax(queryString, cb) {
                var company_fax = this.company_fax;
                var results = queryString ? company_fax.filter(this.createFilter_fax(queryString)) : company_fax;
                // 调用 callback 返回建议列表的数据
                cb(results);
            },
            createFilter_fax(queryString) {
                return (restaurant) => {
                return (restaurant.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
                };
            },
            // 结算方式
            querySearch_balance(queryString, cb) {
                var balance = this.balance;
                var results = queryString ? balance.filter(this.createFilter_fax(queryString)) : balance;
                // 调用 callback 返回建议列表的数据
                cb(results);
            },
            createFilter_fax(queryString) {
                return (restaurant) => {
                return (restaurant.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
                };
            },
            // 电话  下拉
            querySearch_call(queryString, cb) {
                var company_call = this.company_call;
                var results = queryString ? company_call.filter(this.createFilter_call(queryString)) : company_call;
                // 调用 callback 返回建议列表的数据
                cb(results);
            },
            createFilter_call(queryString) {
                return (restaurant) => {
                return (restaurant.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
                };
            },
            // 供方法人代表  下拉
            querySearch_law(queryString, cb) {
                var legal_law = this.legal_law;
                var results = queryString ? legal_law.filter(this.createFilter_law(queryString)) : legal_law;
                // 调用 callback 返回建议列表的数据
                cb(results);
            },
            createFilter_law(queryString) {
                return (restaurant) => {
                return (restaurant.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
                };
            },
            handleSelect_of(item,index) {
  
            },
            // 供方单位地址  下拉
            querySearch_U(queryString, cb) {
                var address_U = this.address_U;
                var results = queryString ? address_U.filter(this.createFilter_U(queryString)) : address_U;
                // 调用 callback 返回建议列表的数据
                cb(results);
            },
            createFilter_U(queryString) {
                return (restaurant) => {
                return (restaurant.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
                };
            },
            // 产品名称 模糊查询
            querySearchAsync_name(queryString, cb) {
                var product_name = this.product_name;
                var results = queryString ? product_name.filter(this.createStateFilter_name(queryString)) : product_name;
                this.timeout = setTimeout(() => {
                cb(results);
                }, 1000 * Math.random());
            },
            createStateFilter_name(queryString) {
                return (state) => {
                return (state.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
                };
            },
            handleSelect_name: function (item) {
                for(var i = 0;i<vm.product.length;i++){
                    vm.product[vm.product.length - 1].product_name = item.address
                    vm.product[vm.product.length - 1].product_id = item.product_id
                    vm.product[vm.product.length - 1].product_no = item.product_no
                } 
            },
            // 获取金额
            calculationAmount (index) {
                if(vm.product[index].purchase_number == undefined || vm.product[index].purchase_single_price == undefined){

                }else{
                    vm.product[index].purchase_price = vm.product[index].purchase_number * vm.product[index].purchase_single_price
                    var zong_money = 0;
                    for(var i = 0;i < vm.product.length;i++){
                        zong_money = zong_money + Number(vm.product[i].purchase_price)
                    }
                    vm.form.total_amount = zong_money;
                }
            },
            // 添加一行
            adds () {
                var num_box = vm.product.length
                if(num_box == 1){        
                    if(vm.product[0].product_number == ''){
                        layer.msg('请填写产品名称！')
                    }else{
                        var obj = {}
                        vm.product.push(obj)
                    }
                }else{
                    if(vm.product[num_box - 1].product_number == undefined){
                        layer.msg('请填写产品名称！')
                    }else{
                        var obj = {}
                        vm.product.push(obj)
                    }
                }
               
            },
            // 删除
            delawards11 (index) { 
                if(this.product.length > this.initial_row.length){
                    vm.form.total_amount = vm.form.total_amount - this.product[index].purchase_price
                    vm.product.splice(index,1)
                }else{
                    // 删除
                    layer.confirm('是否要确认删除？',{btn:['确定','取消']},function(){
                        var data = {
                            'contractId':vm.newdata.contract.id,
                            'productId':vm.product[index].id
                        }
                        $.post('<?php echo U("Dwin/Purchase/delContractProduct");?>',data,function(res){
                            if(res.status == 200){
                                layer.msg(res.msg)
                                vm.product.splice(index,1) 
                                // 总金额减数
                                vm.form.total_amount = res.data.total_amount
                                vm.form.capital_amount = res.data.capital_amount
                            }
                        })
                    })
                }
             },   
            tableRowClassName({row, rowIndex}) {
                if (rowIndex === 1) {
                return 'warning-row';
                } else if (rowIndex === 3) {
                return 'success-row';
                }
                return '';
            },
            // 提交
            onSubmit(form){
                var judge_up = true
                var k = -1
                var list_num = 0
                var values = []
                for(var key in form){
                    if(key == 'purchaser_fax' || key == 'supplier_fax'){

                    }else{
                        values.push(form[key])
                    }
                } 
                values.forEach(function(e){ 
                    k++
                   if(e == '' || e == null){
                       layer.msg(vm.clue_yes[k]+'不能为空！')
                       judge_up = false
                   }
                })
                values.length = 0
                if(judge_up){
                    this.product.forEach(function (e) {
                        for(var key in e){
                            if(key == 'product_no' || key == 'product_name' || key == 'product_number' || key == 'unit' || key == 'purchase_number' || key == 'purchase_single_price' || key == 'purchase_price' || key == 'deliver_time'){
                                list_num++
                                if(e[key] == null || e[key] == 0){
                                    layer.msg('物料名称、型号、单位、金额、供货时间及数量都是必填项,请填写完整！')
                                    judge_up = false
                                }
                            }
                        }
                        if(judge_up){
                            if(list_num < 8){
                                layer.msg('物料名称、型号、单位、金额、供货时间及数量都是必填项,请填写完整！')
                                judge_up = false
                            }
                        }
                        list_num = 0
                    })
                }
                if(judge_up){
                    // 判断数据是修改还是新增还是删除
                    for(var j = 0;j<this.product.length;j++){
                        if(this.product[j].id == undefined){   // 说明不存在
                            this.add_operate.push(this.product[j])
                        }else{
                            this.edit_operate.push(this.product[j])
                        }
                    }
                    for(var i = 0;i<vm.product.length;i++){
                        vm.product[i].deliver_time =  vm.product[i].deliver_time / 1000
                    }
                    vm.form.signing_time = vm.form.signing_time / 1000
                    var data = {
                        'contract':this.form,
                        'edit_product' : this.edit_operate,
                        'new_product' : this.add_operate
                    }
                    $.post('<?php echo U("Dwin/Purchase/editContract");?>', data , function (res) {
                        if(res.status == 200){
                            // 关闭弹框 刷新父页面
                            layer.msg(res.msg)
                            var index=parent.layer.getFrameIndex(window.name);//获取窗口索引
                            parent.layer.close(index)
                        }else{
                            for(var i = 0;i<vm.product.length;i++){
                                vm.product[i].deliver_time =  vm.product[i].deliver_time * 1000
                            }
                            vm.form.signing_time = vm.form.signing_time * 1000
                        }
                        layer.msg(res.msg)
                    })
                    this.edit_operate.length = 0
                    this.add_operate.length = 0   
                }
            }
        }
    })
</script>
</html>