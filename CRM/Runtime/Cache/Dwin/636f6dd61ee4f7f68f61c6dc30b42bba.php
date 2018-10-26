<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM--添加客户维修单</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/html/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/Public/html/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="/Public/html/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.6/theme-chalk/index.css" rel="stylesheet">
    <style type="text/css">
        body {
            color: black;
        } 
        .chosen-select{ 
            color : black!important;
        }   
    </style>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins" id="orders">
                <div class="ibox-title">
                    <h3>维修人员编辑</h3>
                    <div class="ibox-tools"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></div>
                </div>
                <div class="ibox-content" id="app">
                    <div class="table-responsive1">
                        <form id="addSaleRepairingForm1" method="post">
                            <h5>售后单基本信息</h5>
                            <el-table :data="recordData" stripe size="mini" style="border:1px solid #ccc" style="width: 100%">
                                <el-table-column prop="sale_number" label="售后单号" > </el-table-column>
                                <el-table-column prop="courier_number" label="快递单号"></el-table-column>
                                <el-table-column prop="is_repairorder" label="是否有售后维修单：" ></el-table-column>
                                <el-table-column label="客户" prop="cusname" > </el-table-column>
                                <el-table-column label="业务员"  prop="salename"></el-table-column>
                                <el-table-column label="返回地址"  prop="reback_address"></el-table-column>
                            </el-table>  
                            <br> 
                            <h4>售后单物料信息</h4>                                                                                 
                            <el-table :data="productData" stripe size="mini" style="border:1px solid #ccc" style="width: 100%">
                                <el-table-column prop="product_category_id" label="产品类别"></el-table-column>
                                <el-table-column prop="product_name" label="产品型号"></el-table-column>
                                <el-table-column prop="num" label="数量（件）"></el-table-column>
                                <el-table-column prop="barcode_date" label="条码日期"></el-table-column>
                                <el-table-column label="客户反馈问题" prop="customer_question"></el-table-column>
                                <el-table-column prop="sale_way" label="售后方式"></el-table-column>
                            </el-table>
                            </form>
                            <br>
                            <h4>售后单维修人员信息</h4>
                            <el-table :data="personData" stripe size="mini" style="border:1px solid #ccc" style="width: 100%">
                                <el-table-column prop="reperson_name" label="维修员" width="90"></el-table-column>
                                <el-table-column label="维修日期" width="100">
                                    <template slot-scope="scope">
                                        <!-- {{formatDateTime(scope.row.start_data)}} -->
                                        {{formatDateTime(1538755200)}}
                                    </template>
                                </el-table-column>
                                <el-table-column prop="re_num" label="数量（件）" width="90"></el-table-column>
                                <el-table-column prop="re_status" label="状态" width="140">
                                    <template slot-scope="scope">
                                        <el-select v-model="scope.row.re_status" :disabled="flag_boolend" filterable placeholder="请选择">
                                            <el-option
                                                v-for="item in rst"
                                                :key="item.id"
                                                :label="item.name"
                                                :value="item.id">
                                            </el-option>
                                        </el-select>
                                    </template>
                                </el-table-column>
                                <el-table-column label="故障现象" prop="situation" width="200">
                                    <template slot-scope="scope">
                                        <el-input type="textarea" v-model="scope.row.situation"></el-input>
                                    </template>
                                </el-table-column>
                                <el-table-column prop="re_mode" label="维修方式" width="160">
                                    <template slot-scope="scope">
                                        <el-select v-model="scope.row.re_mode" :disabled="flag_boolend" filterable placeholder="请选择">
                                            <el-option
                                                v-for="item in rst1"
                                                :key="item.id"
                                                :label="item.name"
                                                :value="item.id">
                                            </el-option>
                                        </el-select>
                                        <el-input type="textarea" v-model="scope.row.mode_info"></el-input>
                                    </template>
                                </el-table-column>
                                <el-table-column prop="reperson_question" label="故障类型" width="140">
                                    <template slot-scope="scope">
                                        <el-select v-model="scope.row.reperson_question" :disabled="flag_boolend" filterable placeholder="请选择">
                                            <el-option
                                                v-for="item in rst2"
                                                :key="item.id"
                                                :label="item.name"
                                                :value="item.id">
                                            </el-option>
                                        </el-select>
                                        <el-input type="textarea" v-model="scope.row.fault_info"></el-input>
                                    </template>
                                </el-table-column>
                                <el-table-column prop="piece_wage" label="维修费用(元)" width="100">
                                    <template slot-scope="scope">
                                        <el-input v-model="scope.row.piece_wage"></el-input>
                                    </template>
                                </el-table-column>
                                <el-table-column prop="meter_piece" label="计件工资" width="100">
                                    <template slot-scope="scope">
                                        <el-input v-model="scope.row.meter_piece"></el-input>
                                    </template>
                                </el-table-column>
                            </el-table>
                        <br>
                        <div style="width:100%;text-align: center">
                            <el-button @click="submit" type="success">保存提交</el-button><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/Public/html/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/html/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<script src="/Public/html/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/Public/html/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/Public/html/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/Public/html/js/content.min.js?v=1.0.0"></script>
<script src="/Public/html/js/plugins/validate/jquery.validate.min.js"></script>
<script src="/Public/html/js/plugins/validate/messages_zh.min.js"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="/Public/html/js/dwin/WdatePicker.js"></script>
<script src="/Public/html/js/dist/js/select2.min.js"></script>
<script src="/Public/html/js/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.6/index.js"></script>
<script>
var rst = <?php echo (json_encode($rst)); ?>;
var rst1 = <?php echo (json_encode($rst1)); ?>;
var rst2 = <?php echo (json_encode($rst2)); ?>;
var recordData1 = <?php echo (json_encode($recordData)); ?>;
var productData1 = <?php echo (json_encode($productData)); ?>;
var personData1 = <?php echo (json_encode($personData)); ?>;
console.log(personData1)
var vm = new Vue({
    el: '#app',
    data: function () {
        return {
            rst:rst,
            rst1:rst1,
            rst2:rst2,
            recordData:[],
            productData:productData1,
            personData:personData1,
            flag_boolend:false,  
            loading:true,
            results:[],
            options_yesNo:[
                {name:'是'},
                {name:'否'}
            ]
        }
    },
    created() {
        this.recordData.push(recordData1)
    },
    watch:{
        
    },
    methods: {
        submit(){
            var data = {
                data:this.personData
            }
            $.post('/Dwin/SaleService/editRepairpersonMsg', data, function (res) {
                layer.msg(res.msg)
                if(res.status == 200){
                    setTimeout(function(){
                        var index=parent.layer.getFrameIndex(window.name);//获取窗口索引
                        parent.layer.close(index)
                    },1500)
                }
            })
        },
        // 时间戳转化为时间
        formatDateTime:function (timeStamp) { 
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
    }
})

</script>
</body>
</html>