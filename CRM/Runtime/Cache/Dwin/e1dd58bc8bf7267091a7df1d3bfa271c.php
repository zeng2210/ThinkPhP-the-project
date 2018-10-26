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
        /* .el-button--primary {
            float: left;
        } */
        .add_button_new {
            text-align: left
        }
        .el-row{
            margin-bottom: 10px;
        }
        .cenNo{
            text-align: left
        }
    </style>
</head>
<body>
    <div id="app" style="text-align: center">
        <h1>湖南迪文科技有限公司其他出库单回退</h1>
        <br><br><br>
        <el-form ref="form" :model="form"  size="medium" v-loading="loading">
            <el-row>
                <el-col :span="7" :offset="2" class="cenNo">
                    <span>
                        出库编号：
                    </span>{{form.stock_out_id}}
                </el-col>
                <el-col :span="7" :offset="1" class="cenNo">
                    <span>
                            领料类型：
                    </span>{{this.pickingType[form.picking_kind]}}
                </el-col>
                <el-col :span="6" :offset="1" class="cenNo">
                        <span>
                            申领部门：
                        </span>{{formatDateTime(form.audit_time)}}
                    </el-col>
            </el-row>
            <el-row>
                <el-col :span="7" :offset="2" class="cenNo">
                    <span>
                        用途：
                    </span>{{form.purpose}}
                </el-col>
                <el-col :span="7" :offset="1" class="cenNo">
                    <span>
                        选单号：
                    </span>{{form.choose_no}}
                </el-col>
                <el-col :span="6" :offset="1" class="cenNo">
                    <span>
                        出库类别：
                    </span>{{purchase_cate_name001}}
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="22" :offset="2" class="cenNo">
                    <span>
                        工程项目：
                    </span>{{form.engine_item}}
                </el-col>
            </el-row>
            <el-row :gutter="20">
                <el-col :span="22" :offset="1">
                        <table class="table table-striped table-hover table-bordered" border style="margin-bottom: 0">
                                <div class="head_thead">一、产品名称、型号、单位、金额、需求时间及申请数量</div>
                                <tbody>
                                    <tr  class="deal_cent">
                                        <th v-show="false">id</th>      
                                        <th v-show="false">source_id</th>      
                                        <th v-show="false">ID</th>      
                                        <th >物料名称</th>      
                                        <th >物料型号</th>      
                                        <th >物料编号</th>     
                                        <th>库存</th>
                                        <th>申请数量</th>
                                        <th>出货仓库</th>
                                        <th >备注</th>
                                        <th>操作</th>
                                    </tr>
                                    <tr v-for="(item, index) in product">
                                        <td v-show="false">
                                            <el-input v-model="item.id" ></el-input>
                                        </td>
                                        <td v-show="false">
                                            <el-input v-model="item.source_id" ></el-input>
                                        </td>
                                        <td v-show="false">
                                            <el-input v-model="item.product_id" ></el-input>
                                        </td>
                                        <td>
                                            {{item.product_number}}
                                        </td>
                                        <td>
                                            {{item.product_name}}
                                        </td>
                                        <td>
                                            {{item.product_no}}
                                        </td>
                                        <td>
                                            {{Number(item.stock_number) + Number(item.o_audit)}}
                                        </td>
                                        <td>
                                            {{item.num}}
                                        </td>
                                        <td>
                                            {{item.rep_pid}}
                                        </td>
                                        <td>
                                            {{item.tips}}
                                        </td>
                                         <td style="width:200px">
                                            <button  type='button' class="btn btn-warning" @click="segment_go(index)" style="float:left;width: 80px">部分回退</button>
                                            <button  type='button' class="btn btn-success" @click="segmentAll_go(index)" style="float: right;width: 80px;">全部回退</button>
                                        </td> 
                                    </tr>
                                </tbody>
                            </table>
                            <el-dialog title="部分回退："  class="cenNo" :visible.sync="dialogFormVisible_segment">
                                <el-form-item label="回退数量：">
                                    <el-input v-model="segment_num" style="width:78%" @keyup.native="num_InputKey(segment_num)"></el-input>
                                </el-form-item>
                                <div slot="footer" class="dialog-footer">
                                    <el-button @click="dialogFormVisible_segment = false">取 消</el-button>
                                    <el-button type="primary" @click="segment_gooK()">回 退</el-button>
                                </div>
                            </el-dialog> 
                    <br>  
            <br>
            <el-row>
                    <el-col  :span="6" :offset="1" class="cenNo">
                        <span>
                                负责人：
                        </span>{{charge_name001}}
                    </el-col>
                    <el-col :span="7" :offset="1"  class="cenNo">
                            <span>
                                    制单人：
                            </span>{{form.create_name}}
                </el-col>
                <el-col :span="7" :offset="1" class="cenNo">
                    <span>
                            审核人：
                    </span>{{audit_name001}}
                </el-col>
            </el-row>
            <el-row>
                <el-col  :span="6" :offset="1" class="cenNo">
                    <span>
                            领料人：
                    </span> {{collect_name001}}
                </el-col>
                <el-col :span="7" :offset="1" class="cenNo">
                    <span>
                            发货人：
                    </span>{{send_name001}}
                </el-col>
                <el-col :span="7" :offset="1" class="cenNo">
                    <span>
                            记账人：
                    </span> {{account_name001}}
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="6" :offset="1"  class="cenNo">
                    <span>
                        业务员：
                    </span> {{form.business_name}}
                </el-col>
            </el-row>
            <el-row>
                <el-col :offset="1" :span="22"  class="cenNo">
                    <span>
                        备注：
                    </span>{{form.tips}}
                </el-col>
            </el-row>
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
    var stockData = <?php echo (json_encode($stockData)); ?>;  //其他出库类型基本信息
    var materialData = <?php echo (json_encode($materialData)); ?>;  //申请单物料数据
    var outOfTreasuryType = <?php echo (json_encode($outOfTreasuryType)); ?>;  //其他出库类型中的出库类别
    var repMap = <?php echo (json_encode($repMap)); ?>;  //仓库名称
    var staffData = <?php echo (json_encode($staffData)); ?>;  //员工列表
    var deptData = <?php echo (json_encode($deptData)); ?>;  //部门列表
    var cate_id = <?php echo (json_encode($cate_id)); ?>;  //当前出库单类型ID
    var cate_name = <?php echo (json_encode($cate_name)); ?>;  //出库类型名称
    var pickingType = <?php echo (json_encode($pickingType)); ?>;  //出库类型名称
    console.log(stockData)
    console.log(materialData)
    console.log(outOfTreasuryType)
    console.log(repMap)
    console.log(staffData)
    console.log(deptData)
    console.log(cate_id)
    console.log(cate_name)
    console.log(pickingType)
    var vm = new Vue({
        el: '#app',
        data : function(){
            return {
                loading:true,
                serial_Number:'1',  //序号
                pickingType:pickingType,
                form :{
                    id:'',
                    stock_out_id:'',
                    source_id:'',
                    picking_kind:'',
                    // apply_dept_name:'',
                    total_amount :'0',
                    capital_amount:'零',
                    // apply_reason:'',
                    audit_time:0,
                    cate_name:'',
                    create_id:'',
                    create_name:'',
                    audit_name:'',
                    send_name:'',
                    account_name:'',
                    business_name:'',
                    charge_name:'',
                    purpose:'',
                    choose_no:'',
                    purchase_cate_name:'',
                    purchase_cate_id:'',
                    charge_id:'',
                    collect_id:'',
                    audit_id:'',
                    send_id:'',
                    account_id:'',
                    business_id:'',
                    tips:''
                },
                purchase_cate_name001:'',
                charge_name001:'',
                // create_name001:'',
                audit_name001:'',
                collect_name001:'',
                send_name001:'',
                account_name001:'',
                business_name001:'',
                searchProduct: {
                    name: ''
                },
                searchProductRes:[],
                options_picking_kind:[],
                options_source_type:[],
                options_apply_dept_name:[],
                options_rep_pid:[],
                options_purchase_cate_name:[],
                options_create_name:[],
                options_audit_name:[],
                options_collect_name:[],
                options_charge_name:[],
                options_send_name:[],
                options_business_name:[],
                options_account_name:[],
                timeout:  null,
                product:[],
                initial_row:[],
                add_operate:[],
                edit_operate:[],
                // 部分回退
                segment_num:'',
                pro_id:'',
                indexSave:'',
                dialogFormVisible_segment:false
            }
        },
        created : function () {
            this.loading = false
            this.initial_row.length = 0
            this.options_picking_kind.length = 0
            this.options_apply_dept_name.length = 0
            this.form.id = stockData.id
            this.form.source_id = stockData.source_id
            this.form.stock_out_id = stockData.stock_out_id
            this.form.picking_kind = stockData.picking_kind
            this.form.picking_dept_name = stockData.picking_dept_name
            this.form.picking_dept_id = stockData.picking_dept_id
            this.form.audit_time =  stockData.audit_time
            this.form.business_name = stockData.business_name
            this.form.business_id = stockData.business_id
            this.form.purpose = stockData.purpose
            this.form.choose_no = stockData.choose_no
            this.form.engine_item = stockData.engine_item
            this.form.printing_times = stockData.printing_times
            
            // 人员选择 默认
            this.form.account_id = stockData.account_id
            this.form.account_name = stockData.account_name
            this.account_name001 = stockData.account_name
            this.form.audit_id = stockData.audit_id
            this.form.audit_name = stockData.audit_name
            this.audit_name001 = stockData.audit_name
            this.form.collect_id = stockData.collect_id
            this.form.collect_name = stockData.collect_name
            this.collect_name001 = stockData.collect_name
            this.form.send_id = stockData.send_id
            this.form.send_name = stockData.send_name
            this.send_name001 = stockData.send_name
            this.form.charge_id = stockData.charge_id
            this.form.charge_name = stockData.charge_name
            this.charge_name001 = stockData.charge_name
            
            // 类别
            for(var key in outOfTreasuryType){
                this.options_purchase_cate_name.push({'id':key,'value':outOfTreasuryType[key]})
            }
            this.form.purchase_cate_id = stockData.purchase_cate_id
            this.form.purchase_cate_name = stockData.purchase_cate_name
            this.purchase_cate_name001 = stockData.purchase_cate_name
            // this.form.audit_time =  this.form.audit_time * 1000
            // 物料赋值
            for(let i in materialData){
                var obJ = {
                    source_id:'',
                    product_id:'',
                    product_number:'',
                    product_name:'',
                    product_no:'',
                    num:'',
                    rep_pid:''
                }
                this.product.push(obJ)
                this.product[i].id = materialData[i].id
                this.product[i].source_id = materialData[i].source_id
                this.product[i].product_id = materialData[i].product_id
                this.product[i].product_number = materialData[i].product_number
                this.product[i].product_name = materialData[i].product_name
                this.product[i].product_no = materialData[i].product_no
                // this.product[i].unite = materialData[i].unite
                this.product[i].num = materialData[i].num
                this.product[i].stock_number = materialData[i].stock_number
                this.product[i].o_audit = materialData[i].o_audit
                for(let x = 0;x<repMap.length;x++){
                    if(materialData[i].rep_pid == repMap[x].rep_id){
                        this.product[i].rep_pid = repMap[x].repertory_name
                    }
                }
            }
            for(var i = 0;i< this.product.length;i++){
                this.initial_row.push(this.product[i])
            }

            this.form.cate_name = cate_name
            this.form.create_id =  stockData.cate_id
            this.form.create_name = stockData.create_name
            this.form.tips = stockData.tips
            this.options_rep_pid = repMap

            this.options_audit_name = staffData
            this.options_collect_name = staffData
            this.options_send_name = staffData
            this.options_account_name = staffData
            this.options_business_name = staffData
            this.options_charge_name = staffData
        },
        mounted() {
        },
        methods :{
            // 部分数量检测
            num_InputKey(value){
                if(value >=  this.product[this.indexSave].num){
                    layer.msg('部分回退回退数量不能大于等于申请数量')
                    this.segment_num = ''
                }
            },
            // 部分回退
            segment_go (index) {
                this.indexSave = index
                this.pro_id = this.product[index].id
                this.dialogFormVisible_segment = true
            }, 
            segment_gooK(){
                var data = {
                    'id':this.pro_id,
                    'source_kind':cate_id,
                    'num':this.segment_num
                }
                $.post('/Dwin/Stock/rollBackStockOutOnePartMaterial',data,function(res){
                    if(res.status == 200){
                        vm.dialogFormVisible_segment = false
                    }
                    layer.msg(res.msg)
                })
            },
            // 全部回退
            segmentAll_go (index) {  
                var data = {
                    'id':this.product[index].id,
                    'source_kind':cate_id
                }
                $.post('/Dwin/Stock/rollBackStockOutOneMaterial',data,function(res){
                    console.log(res)
                    if(res.status == 200){
                        location.reload()
                    }
                    layer.msg(res.msg)
                })
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
</script>
</html>