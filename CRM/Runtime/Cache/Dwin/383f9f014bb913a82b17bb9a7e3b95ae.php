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
        /* .el-button--primary {
            float: left;
        } */
        .add_button_new {
            text-align: left
        }
    </style>
</head>
<body>
    <div id="app" style="text-align: center">
        <h1>湖南迪文科技有限公司销售出库单添加</h1>
        <br><br><br>
        <el-row>
            <el-col :span="22" :offset="1">
                    <el-form ref="form" :model="form" label-width="100px" size="medium" @submit.native.prevent v-loading="loading" :rules="rules">
                            <el-row>
                                <el-col :span="9">
                                    <el-form-item label="销售编号：" required>
                                        <el-input v-model="form.stock_out_id" style="width: 60%;" readonly></el-input>
                                        <el-input v-if="false" v-model="form.id" style="width: 65%;" readonly></el-input>
                                        <el-button type="primary" plain @click="getNumber()">获取编号</el-button>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7"  v-show="false">
                                    <el-form-item label="申请单编号：">
                                        <el-input v-model="form.source_id" style="width: 100%;" disabled></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7">
                                    <el-form-item label="购买单位：">
                                            <el-input v-model="form.cus_name" style="width: 100%;" disabled></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7" :offset="1">
                                    <el-form-item label="收货人：">
                                            <el-input v-model="form.receiver" style="width: 100%;" disabled></el-input>
                                            <!-- <el-input v-show="false" v-model="form.picking_dept_id" style="width: 100%;" disabled></el-input> -->
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row>
                                <el-col :span="8">
                                    <el-form-item label="收货电话：">
                                            <el-input v-model="form.receiver_phone" style="width: 100%;" disabled></el-input>
                                            <!-- <el-input v-show="false" v-model="form.picking_dept_id" style="width: 100%;" readonly></el-input> -->
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7" :offset="1">
                                     <el-form-item label="运费支付：">
                                        <el-input v-model="form.freight_payment_method" style="width: 100%;" disabled></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7" :offset="1">
                                    <el-form-item label="发货仓库：">
                                            <el-input v-model="form.delivery_ware_house" style="width: 100%;" disabled></el-input>
                                        </el-form-item>
                                </el-col>
                            </el-row>

                            <el-row>
                                <el-col :span="8">
                                    <el-form-item label="邮寄方式：">
                                        <el-input v-model="form.logistics_type_name" style="width: 100%;" disabled></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7" :offset="1">
                                    <el-form-item label="快递单号：" prop="express_no">
                                        <el-input v-model="form.express_no" style="width: 100%;" onkeypress="return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode==46"  placeholder="请填写快递单号"></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7" :offset="1">
                                    <el-form-item label="源单类型：">
                                        <!-- <el-input v-model="form.source_kind" style="width: 100%;"></el-input> -->
                                        <el-select v-model="form.source_kind" value-key="id" filterable placeholder="请选择出货仓库">
                                            <el-option
                                                v-for="item in options_source_kind"
                                                disabled
                                                :key="item.id"
                                                :label="item.name"
                                                :value="item.id"
                                                >
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </el-col>
                                
                
                            </el-row>
                            <el-row>
                                <el-col :span="8">
                                   <el-form-item label="选单号：" prop="choose_no">
                                        <el-input v-model="form.choose_no" style="width: 100%;"></el-input>
                                        <!-- <el-input v-model="form.cate_id" style="width: 100%;" readonly></el-input> -->
                                    </el-form-item> 
                                </el-col>
                                <el-col :span="7" :offset="1">
                                    <p></p>
                                </el-col>
                                <el-col :span="7" :offset="1">
                                    <el-form-item label="打印次数：">
                                        <el-input v-model="form.printing_times" style="width: 100%;" disabled></el-input>
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row>
                                <el-col :span="24">
                                    <el-form-item label="收货地址：">
                                        <el-input v-model="form.receiver_addr" style="width: 100%;" disabled></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="4" :offset="1">
                                    
                                </el-col>
                            </el-row>
                            <el-row :gutter="20">
                                <el-col :span="22" :offset="1">
                                            <!-- 表格 -->
                                            <div>
                                                <el-table ref="multipleTable" :data="product" tooltip-effect="dark" style="width: 100%" @selection-change="handleSelectionChange" border>
                                                <el-table-column v-if="false" label="source_id" prop="id" type="index" align="center" header-align="center" width="50"></el-table-column>
                                                <el-table-column v-if="false" label="product_id" prop="product_id" align="center" header-align="center"></el-table-column>
                                                <el-table-column label="序号" type="index" :index="indexMethod"> </el-table-column>
                                                <el-table-column label="物料名称" prop="product_number" align="center" header-align="center"> </el-table-column>
                                                <el-table-column label="物料型号" prop="product_name" align="center" header-align="center"> </el-table-column>
                                                <el-table-column label="物料编号" prop="product_no" align="center" header-align="center"></el-table-column>
                                                <el-table-column label="订单数量" prop="product_num" align="center" header-align="center"></el-table-column>
                                                <el-table-column label="待出库数量" prop="out_processing" align="center" header-align="center"></el-table-column>
                                                <el-table-column label="锁库数量" prop="o_audit" align="center" header-align="center"></el-table-column>
                                                <el-table-column label="库存数量" prop="stock_number" align="center" header-align="center"></el-table-column>
                                                <el-table-column label="已出库数量" prop="used_num" align="center" header-align="center"></el-table-column>
                                                <el-table-column label="出库数量" width="100px" align="center" header-align="center" type="text">
                                                        <template slot-scope="scope">
                                                            <el-input type="text" v-model="scope.row.num" @keyup.native="calculationAmount(scope.$index,scope.row)" placeholder="数量" onkeypress="return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode==46" ></el-input>
                                                        </template>
                                                </el-table-column>
                                                <el-table-column label="出货仓库" width="150px" align="center" header-align="center" type="text">
                                                    <template slot-scope="scope">
                                                        <el-select  v-model="scope.row.rep_pid" value-key="id" @visible-change="" @change ="select_rep_pid(scope.$index,scope.row)" filterable placeholder="请选择出货仓库">
                                                                <el-option
                                                                    v-for="item in options_rep_pid"
                                                                    :key="item.id"
                                                                    :label="item.repertory_name"
                                                                    :value="item.rep_id"
                                                                    
                                                                    >
                                                                </el-option>
                                                            </el-select>
                                                    </template>    
                                                </el-table-column>
                                                <!-- <el-table-column label="操作">
                                                        <template slot-scope="scope">
                                                            <el-button size="mini" type="danger" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                                                        </template>
                                                </el-table-column> -->
                                                </el-table>
                                            </div>
                                    <br>
                                        
                            <br>
                            <el-row> 
                                <el-col :span="7">
                                    <el-form-item label="业务员：" required>
                                            <el-input  v-model="form.pic_name" style="width: 100%;" readonly title="业务员（不可选）"></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7" :offset="1">
                                        <el-form-item label="制单人：" required>
                                            <el-input v-if="false" v-model="form.create_id" style="width: 100%;"></el-input>
                                            <el-input v-model="form.create_name" style="width: 100%;" readonly title="制单人（不可选）"></el-input>
                                        </el-form-item>
                                </el-col>
                                <el-col :span="7" :offset="1">
                                    <el-form-item label="发货人：" required>
                                        <el-input v-if="false" v-model="form.send_id" style="width: 100%;"></el-input>
                                        <el-input v-if="false" v-model="form.send_name" style="width: 100%;" readonly></el-input>
                                        <el-select v-model="send_name001" value-key="id" filterable placeholder="请选择">
                                            <el-option
                                                v-for="item in options_send_name"
                                                :key="item.id"
                                                :label="item.name"
                                                :value="item"
                                                >
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row>
                                <el-col :span="7" >
                                    <el-form-item label="审核人：" required>
                                            <el-input v-if="false" v-model="form.audit_id" style="width: 100%;"></el-input>
                                            <el-input v-if="false" v-model="form.audit_name" style="width: 100%;"></el-input>
                                        <el-select v-model="audit_name001" value-key="id" filterable placeholder="请选择">
                                            <el-option
                                                v-for="item in options_audit_name"
                                                :key="item.id"
                                                :label="item.name"
                                                :value="item"
                                                >
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="7" :offset="1">
                                        <el-form-item label="创建日期：" required>
                                            <el-date-picker
                                            style="width: 100%;"
                                            v-model="form.create_time"
                                            type="date"
                                            value-format="timestamp"
                                            format="yyyy-MM-dd"
                                            placeholder="创建日期：">
                                            </el-date-picker>
                                        </el-form-item>
                                </el-col>
                                <el-col :span="7" :offset="1">
                                    <el-form-item label="记账人：" required>
                                        <el-input v-if="false" v-model="form.finance_check_id" style="width: 100%;" readonly></el-input>
                                            <el-input v-model="form.finance_check_name" style="width: 100%;"></el-input>
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row>
                                <el-col :span="7">
                                    <el-form-item label="保管人：" required>
                                        <el-input v-if="false" v-model="form.keep_id" style="width: 100%;"></el-input>
                                        <el-input v-if="false" v-model="form.keep_name" style="width: 100%;" readonly></el-input>
                                        <el-select v-model="keep_name001" value-key="id" filterable placeholder="请选择">
                                            <el-option
                                                v-for="item in options_keep_name"
                                                :key="item.id"
                                                :label="item.name"
                                                :value="item"
                                                >
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </el-col>
                                
                            </el-row>
                            <el-row>
                                <el-col>
                                    <el-form-item label="入库备注：">
                                        <el-input type="textarea" v-model="form.tips" style="width: 100%;"></el-input>
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            
                            <br><br>
                            <el-button type="success" @click="onSubmit(form)">提 交</el-button>
                            <br><br>
                                </el-col>
                            </el-row>
                        </el-form>
            </el-col>
        </el-row>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.6/index.js"></script>
<script>
    var orderformData = <?php echo (json_encode($orderformData)); ?>;  //订单基本信息
    var productData = <?php echo (json_encode($productData)); ?>;  //订单物料信息
    var staffData = <?php echo (json_encode($staffData)); ?>;  //员工列表
    var deptData = <?php echo (json_encode($deptData)); ?>;  //部门列表
    var create_name = <?php echo (json_encode($create_name)); ?>;  //创建人
    var cate_id = <?php echo (json_encode($cate_id)); ?>;  //当前出库单类型ID
    var repMap = <?php echo (json_encode($repMap)); ?>;  //仓库名称
    var sourceTypeMap = <?php echo (json_encode($sourceTypeMap)); ?>;  //仓库名称
    var sourceTypeId = <?php echo (json_encode($sourceTypeId)); ?>;  //仓库名称
    var vm = new Vue({
        el: '#app',
        data : function(){
            return {
                loading:true,
                form :{
                        stock_out_id:'',    //出库单编号',
                        source_id:'',   //源单主键',
                        tips:'',    //入库备注',

                        // xin
                        id:'',
                        send_name:'',   //发货人
                        send_id:'',   //发货人id
                        printing_times:'',  //打印次数',
                        audit_id:'',    //审核人ID',
                        audit_name:'',  //审核人姓名',
                        keep_id:'',     //保管人id',
                        keep_name:'',   //保管人姓名',
                        create_id:'',   //制单人id',
                        create_name:'',     //制单人姓名',
                        create_time:new Date(),     //创建时间',
                        choose_no:'',   //选单号',
                        cate_id:'',     //出库类型id',
                        source_kind:'',     //源单类型',
                        express_no:'',  //快递单号',
                        

                        // jiu
                        logistics_type_name:'',  //物流信息
                        pic_name:'',    //业务员姓名',
                        finance_check_id:'', //记账人id
                        finance_check_name:'',  //记账人
                        cus_name:'',   //购买单位
                        receiver:'',   //联系人
                        receiver_phone:'',  //收货人电话
                        freight_payment_method:'',   //运费支付
                        receiver_addr:'',    //收货地址
                        delivery_ware_house:'',  //订单仓库

                },
                

                audit_name001:'',
                keep_name001:'',
                send_name001:'',
                options_audit_name:[],
                options_keep_name:[],
                options_send_name:[],
                product:[],
                options_rep_pid:[],
                options_source_kind:[],
                rep_Save_name:'',
                rules:{
                    express_no:[{required:true,message:'快递单号不能为空',trigger:'blur'}],
                    choose_no:[{required:true,message:'选单号不能为空',trigger:'blur'}]
                }
                // 保存 product
                // product_old:[]
                // 选中三个值 ，新增数据
                // searchProduct: {
                //     name: ''
                // },
                // searchProductRes: [],
                
            }
        },
        created : function () {
            // this.product_old.length = 0 
            this.loading = false
            this.form.pic_name = orderformData.pic_name,    //业务员姓名',
            this.form.cus_name = orderformData.cus_name,   //购买单位
            this.form.receiver = orderformData.receiver,   //联系人
            this.form.receiver_phone = orderformData.receiver_phone,  //收货人电话
            this.form.freight_payment_method = orderformData.freight_payment_method,   //运费支付
            this.form.receiver_addr = orderformData.receiver_addr    //收货地址
            for(let x = 0;x<repMap.length;x++){
                if(orderformData.delivery_ware_house == repMap[x].rep_id){
                    this.form.delivery_ware_house = repMap[x].repertory_name
                }
            }
            this.form.tips = orderformData.tips,   
            this.form.source_id = orderformData.id,    //源单主键' 
            this.form.logistics_type_name = orderformData.logistics_type_name, //物流信息
            // 制单人
            this.form.create_name = create_name
            for(var i = 0;i< staffData.length;i++){
                if(create_name == staffData[i].name){
                    this.form.create_id = staffData[i].id
                }
            }
            //记账人
            this.form.finance_check_id = orderformData.finance_check_id //记账人
            for(var i = 0;i< staffData.length;i++){
                if(this.form.finance_check_id == staffData[i].id){
                    this.form.finance_check_name = staffData[i].name
                }
            }
            // 出库类型
            this.form.cate_id = cate_id

            //人员信息
            this.options_audit_name = staffData
            this.options_keep_name = staffData
            this.options_send_name = staffData
            
            // 出库下拉
            this.options_rep_pid = repMap

            // // 物料赋值
            for(let i in productData){
                var obJ = {
                    source_id:'',
                    product_id:'',
                    product_number:'',
                    product_name:'',
                    product_no:'',
                    product_num:'',
                    out_processing:'',
                    o_audit :'',
                    stock_number:'',
                    used_num:'',
                    num  :'',
                    // product_type :'',
                    rep_pid:'',

                }

                this.product.push(obJ)
                this.product[i].source_id = productData[i].id
                this.product[i].product_id = productData[i].product_id
                this.product[i].product_number = productData[i].product_number
                this.product[i].product_name = productData[i].product_name
                this.product[i].product_no = productData[i].product_no
                this.product[i].product_num = productData[i].product_num
                this.product[i].o_audit = productData[i].o_audit
                this.product[i].stock_number = productData[i].stock_number
                this.product[i].used_num = productData[i].used_num
                this.product[i].out_processing = productData[i].out_processing
                // this.product[i].product_type = productData[i].product_type
                for(let x = 0;x<repMap.length;x++){
                    if(productData[i].rep_pid == repMap[x].rep_id){
                        this.product[i].rep_pid = repMap[x].repertory_name
                    }
                }
            }
            // this.product_old.push(this.product.length)
            // 源单类型

            // this.options_source_kind = sourceTypeMap
            for(let key in sourceTypeMap){
                this.form.source_kind = String(sourceTypeId)
                this.options_source_kind.push({'id':key,'name':sourceTypeMap[key]})
            }
        },
        mounted() {
        },
        methods :{
            handleSelectionChange(val){
                console.log(val)
            },
            // 序号
            indexMethod(index){
                return index + 1 
            },
            // 输入判断
            calculationAmount (index,row) {
                if(Number(row.num) > Number(row.o_audit + row.stock_number)){
                    layer.msg("出库数量不能大于在库数量，请再次确认填写！")
                    row.num = ""
                }
                if(Number(row.num)>Number(row.product_num - row.used_num)){
                    layer.msg("出库数量不能大于订单未出库数量，请再次确认填写！")
                    row.num = ""
                }
            },
            // 选择下拉
            select_rep_pid(index,row){
                var data = {    
                    materialId:row.product_id,
                    repId:row.rep_pid
                }
                $.post('<?php echo U("Dwin/Stock/getStockMsgOne");?>',data,function(res){
                    if(res.status == 200){   
                        vm.product[index].out_processing = res.data.out_processing
                        vm.product[index].o_audit = res.data.o_audit
                        vm.product[index].stock_number = res.data.stock_number
                        if(Number(res.data.stock_number + res.data.o_audit) < Number(row.num)){
                            row.num = ''
                        }
                    }else{
                        layer.msg(res.msg)
                    }
                })
            },
            // handleDelete(index, row) {
            //     if(index + 1 > this.product_old[0]){
            //         // 新添加的
            //         this.product.splice(index,1)
            //     }else{
            //         // 原有的
            //         var data = {
            //             id:row.source_id
            //         }
            //         $.post('<?php echo U("Dwin/Stock/delStockOutOrderformMaterial");?>',data,function(res){
            //             layer.msg(res.msg)
            //             if(res.status == 200){
            //                 location.reload()
            //             }
            //         })
            //     }
            // },
            // 获取编号
            getNumber(){
                this.loading = true;
                var data = {
                    'source_kind':sourceTypeId
                }
                $.post('<?php echo U("Dwin/Stock/createStockOutId");?>',data, function (res) {
                    if(res.status == 200){
                        vm.loading = false
                        vm.form.stock_out_id = res.data.idString 
                        vm.form.id = res.data.id
                    }else{
                        layer.msg(res.msg)
                        vm.loading = false
                    }
                })
            },

            // 提交
            onSubmit(form){
                    var onSubmit_tf = true
                    var baseMsg = {
                        'id':form.id,
                        'stock_out_id' : form.stock_out_id,           //'出库单编号',
                        'source_id' : form.source_id,           //'源单主键',
                        'cate_id' : form.cate_id,           //'出库类型id',
                        'source_kind' : form.source_kind,          //'源单类型',
                        'printing_times' : form.printing_times,           //'打印次数',
                        'express_no' : form.express_no,           //'快递单号',
                        'choose_no' : form.choose_no,           //'选单号',
                        'create_id' : form.create_id,           //'制单人id',
                        'create_name' : form.create_name,           //'制单人姓名'
                        'create_time' : String((new Date(form.create_time)).getTime() / 1000),           //'创建时间',
                        'tips' : form.tips,           //'入库备注',
                        'audit_name' : vm.audit_name001.name,
                        'audit_id' : vm.audit_name001.id,


                        'keep_name' : vm.keep_name001.name,
                        'keep_id' : vm.keep_name001.id,

                        'send_name' : vm.send_name001.name,
                        'send_id' : vm.send_name001.id
                    }
                    // 时间小数点判断  截取
                    for(var i = 0;i < baseMsg.length ; i++){
                        if(baseMsg.create_time == '.'){
                            baseMsg.create_time = baseMsg.create_time.substring(0,10) 
                        }
                    }
                    for(var i = 0;i < baseMsg.length;i++){
                        if(baseMsg[i] == ''){
                            if(baseMsg.printing_times != ''&&baseMsg.tips != ''){
                                layer.msg("请填写完整数据！")
                                onSubmit_tf = false
                            }
                        }
                    }
                    var productSave1 = []
                    for(let i = 0;i < vm.product.length;i++){
                        for(let x = 0;x<repMap.length;x++){
                            if(vm.product[i].rep_pid == repMap[x].repertory_name){
                                vm.product[i].rep_pid = repMap[x].rep_id
                            }
                        }
                        if(vm.product[i].num != "" && vm.product[i].num != '0'){
                            productSave1.push({
                                'source_id':vm.product[i].source_id,
                                'product_id':vm.product[i].product_id,
                                'product_no':vm.product[i].product_no,
                                'num':vm.product[i].num,
                                'rep_pid':vm.product[i].rep_pid
                            })
                        }
                    }
                    if(vm.product.length > productSave1.length){
                        layer.confirm('确认提交吗？',function(aaa){
                            if(onSubmit_tf){
                                var data = {
                                    'baseMsg':baseMsg,
                                    'materialData' : productSave1
                                }
                                $.post('<?php echo U("Dwin/Stock/createStockOutOrderform");?>', data , function (res) {
                                    if(res.status == 200){
                                        // 关闭弹框 刷新父页面
                                        layer.msg(res.msg)
                                        location.reload();
                                    }
                                    layer.msg(res.msg)
                                })
                            }
                        })
                    }else{
                        if(onSubmit_tf){
                            var data = {
                                'baseMsg':baseMsg,
                                'materialData' : productSave1
                            }
                            $.post('<?php echo U("Dwin/Stock/createStockOutOrderform");?>', data , function (res) {
                                if(res.status == 200){
                                    // 关闭弹框 刷新父页面
                                    layer.msg(res.msg)
                                    location.reload();
                                }
                                layer.msg(res.msg)
                            })
                        }
                    }
                    
                
            },
            // // 获取三个产品值
            // searchingProduct: function() {
            //     $.post('<?php echo U("Dwin/Purchase/getProductMsg");?>', {'condition':this.searchProduct.name}, function(res) {
            //         vm.searchProductRes = res.data
            //     })
            // },
            // // 下拉选中时
            // addProduct: function(item) {
            //     var num_box = vm.product.length
            //     function Item(product) {
            //         this.product_id = product.product_id
            //         this.product_no = product.product_no
            //         this.product_name = product.product_name
            //         this.product_number = product.product_number
                    
            //     }
            //     var obj = new Item(item)
            //     this.product.push(obj)
            // },
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
</script>
</html>