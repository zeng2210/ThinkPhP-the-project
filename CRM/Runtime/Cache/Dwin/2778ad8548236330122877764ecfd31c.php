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
        /* input is errer */
        .errer_input{
           margin: -2px;
           border:1px solid #e4393c;
           border-radius: 4px;
       }
    </style>
</head>
<body>
<div id="app">
    <h3 style="margin: 20px;" class="text-center">供应商基本信息修改</h3>
    <el-form ref="form" :model="form"   label-width="150px">
        <el-row>
            <el-col :span="22" :offset="1">
            <el-row>
                <el-col :span="10">
                    <el-form-item label="供应商编号：">
                        <el-input  v-model="form.supplier_id" disabled></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="10" :offset="2">
                    <el-form-item label="供应商名称：">
                        <el-input  v-model="form.supplier_name" readonly="readonly" disabled></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="10">
                    <el-form-item label="注册资本(万)：">
                        <el-input v-model="form.registered_capital" :class="[this.flag?'errer_input':'']" @keyup.native = "onlyNum($event)" placeholder="请输入内容" type="number"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="10" :offset="2">
                    <el-form-item label="实收资本(万)：">
                        <el-input v-model="form.paid_up_capital" @keyup.native = "onlyNum1($event)" :class="[this.flag1?'errer_input':'']" placeholder="请输入内容" type="number"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="10">
                    <el-form-item label="法人代表：">
                            <el-input v-model="form.legal_name" placeholder="请输入法定代表"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="10" :offset="2">
                    <el-form-item label="营业执照号码：">
                        <el-input v-model="form.business_licence"  placeholder="请输入营业执照号码"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="10">
                    <el-form-item label="营业执照开始日期：">
                            <div class="block">
                                    <el-date-picker
                                        v-model="form.start_date"
                                        type="date"
                                        value-format="timestamp" 
                                        format="yyyy 年 MM 月 dd 日"
                                        placeholder="选择日期"
                                        :picker-options="pickerOptions_editGO"
                                        :clearable="false"
                                        >
                                    </el-date-picker>
                                </div>
                    </el-form-item>
                </el-col>
                <el-col :span="10" :offset="2">
                    <el-form-item label="营业执照结束日期：">
                            <div class="block">
                                    <el-date-picker
                                        v-model="form.end_date"
                                        type="date"
                                        value-format="timestamp"
                                        format="yyyy 年 MM 月 dd 日"
                                        placeholder="选择日期"
                                        :picker-options="pickerOptions_editEnd"
                                        :clearable="false"
                                        >
                                    </el-date-picker>
                                </div>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="10">
                    <el-form-item label="开户行：">
                        <el-input v-model="form.account_bank"  placeholder="请输入开户行"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="10" :offset="2">
                    <el-form-item label="银行账户账号：">
                        <el-input v-model="form.account_number"  @blur="onlyNum_telephome($event)"  placeholder="请输入内容"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="10">
                    <el-form-item label="股票代码：">
                        <el-input v-model="form.stock_code"  placeholder="请输入股票代码"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="10" :offset="2">
                    <el-form-item label="网址：">
                        <el-input v-model="form.websitea_address" :class="[this.www?'errer_input':'']" @blur = "isurl($event)" @keyup.native="wwwviefy()"  placeholder="请输入内容"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="9">
                    <el-form-item label="是否上市：">
                        <el-radio-group v-model="form.is_listed">
                            <el-radio label="0">未上市</el-radio>
                            <el-radio label="1">已上市</el-radio>
                        </el-radio-group>
                    </el-form-item>
                </el-col>
                <el-col :span="15">
                    <el-form-item label="企业性质：">
                            <el-radio-group v-model="form.enterprise_cate">
                                <el-radio label="国企"></el-radio>
                                <el-radio label="民营"></el-radio>
                                <el-radio label="合资合作"></el-radio>
                                <el-radio label="外资"></el-radio>
                                <el-radio label="政府机构"></el-radio>
                            </el-radio-group>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="10">
                    <el-form-item label="创建时间：">
                        <el-date-picker
                        disabled
                        style="width:100%"
                        v-model="form.create_time"
                        type="date"
                        value-format="yyyy-MM-dd"
                        format="yyyy 年 MM 月 dd 日"
                        placeholder="创建时间">
                        </el-date-picker>
                    </el-form-item>
                </el-col>
                <el-col :span="10" :offset="2">
                    <el-form-item label="审核状态：">
                        <!-- <el-input v-model="form.audit_status" readonly="readonly"></el-input> -->
                        <el-radio-group v-model="form.audit_status" disabled>
                                <el-radio label="0">未审核</el-radio>
                                <el-radio label="2">通过</el-radio>
                                <el-radio label="1">不通过</el-radio>
                        </el-radio-group>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="24">
                    <el-form-item label="主要业务范围：">
                        <el-input v-model="form.business_scope" placeholder="请输入主营范围" type="textarea"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="24">
                    <el-form-item label="其他需求说明：">
                        <el-input type="textarea" v-model="form.tips" style="width: 100%;"   placeholder="请输入其他需求说明"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <div class="text-center">
                <el-button type="primary" @click="submitForm(form)">提交</el-button>
            </div>
         </el-col>
        </el-row>
       
      </el-form>
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
    var Id = '<?php echo ($id); ?>';
    var vm = new Vue({
        el: "#app",
        data: function () {
            var vm = this
            return {
                form: {
                    "supplier_id": '', //供应商编号  不提供修改,
                    "supplier_name": '', //供应商名称 不提供修改,
                    "legal_name": '', //主键id 可修改 input,
                    "registered_capital": '', //注册资本 可修改 input,
                    "paid_up_capital": '', //实收资本 可修改 input,
                    "business_scope": '', //主要业务范围（营业执照）input,
                    "business_licence": '', //营业执照号码 input,
                    "start_date": '', // 执照开始日期 时间选择器,
                    "end_date": '', // 执照结束日期 时间选择器,
                    "is_listed": '', // 是否上市 0为未上市 select,
                    "stock_code": '', // 股票代码 input,
                    "account_bank": '', // 开户行 input,
                    "account_number": '', // 银行账户账号 input,
                    "websitea_address": '', // 网址 input,
                    "enterprise_cate": '', // 企业性质 radio or select,
                    "tips": '', // 其他需求说明信息 textarea,
                    "audit_status": '', // 审核状态 1 未修改 2 通过 3 不通过 不可改,
                    "create_time": '', // 创建时间 时间戳 不可改,
                    "creater": '', // 创建人 不可修改,
                },
                Id : Id,
                // 营业执照有效时间 开始不能大于结束
                pickerOptions_editGO:{
                    disabledDate: (time) => {
                        if (this.form.end_date != ""||this.form.end_date != "0") {
                            return time.getTime() > this.form.end_date;
                        } else {
                            return time.getTime();
                        }

                    }
                },
                pickerOptions_editEnd:{
                    disabledDate: (time) => {
                        return time.getTime() < this.form.start_date;
                    }
                },
            }
        },
        created: function () {
            var vm = this
            var data = {
                'id' : this.Id
            }
            $.post('<?php echo U("getSupplier");?>', data , function (res) {
                if(res.status == 200){
                    if(res.data != null){
                        res.data.start_date = res.data.start_date * 1000
                        res.data.end_date = res.data.end_date *1000
                        vm.form = res.data
                    }
                }
            })
        },
        methods: {
            /*
            *               =======  校验 GO
            */
             // 输入只能是数字
             onlyNum_telephome(event){
                var value = event.target.value;
                if(value){
                    if (!/^\+?[1-9][0-9]*$/.test(value)) {
                        this.$message({
                            showClose: true,
                            message: '只能输入数字',
                            type: 'warning'
                        });
                        // event.target.value.splice(value.length-1,1);
                        this.reulity = true
                    }
                }
            },
            // 网址 去除红边
            wwwviefy(){
                this.www = false
            },
            // 网址 // 验证url   
            isurl(str_url){
                if(str_url.target.value){
                    var strregex = "^((https|http|ftp|rtsp|mms)?://)"  
                            + "?(([0-9a-z_!~*'().&=+$%-]+: )?[0-9a-z_!~*'().&=+$%-]+@)?" // ftp的user@   
                            + "(([0-9]{1,3}.){3}[0-9]{1,3}" // ip形式的url- 199.194.52.184   
                            + "|" // 允许ip和domain（域名）   
                            + "([0-9a-z_!~*'()-]+.)*" // 域名- www.   
                            + "([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]." // 二级域名   
                            + "[a-z]{2,6})" // first level domain- .com or .museum   
                            + "(:[0-9]{1,4})?" // 端口- :80   
                            + "((/?)|" // a slash isn't required if there is no file name   
                            + "(/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+/?)$";   
                            var objExp=new RegExp(strregex);     
                            var consequence = objExp.test(str_url.target.value)
                    if(consequence){
                        // this.$message({
                        //     showClose: true,
                        //     message: '输入网址正确！！',
                        //     type: 'success'
                        // });
                    }else{
                        this.$message({
                            showClose: true,
                            message: '输入网址有误，请检查！',
                            type: 'warning'
                        });
                        this.www = true
                    }
                }
            },
            // 资金  注册
            onlyNum(event){
                var value = event.target.value;
                if(value){
                    if (!/^\+?[1-9][0-9]*$/.test(value)) {
                        this.$message({
                            showClose: true,
                            message: '资本只能输入单位为万的整数！',
                            type: 'warning'
                        });
                        this.flag = true
                        event.target.value.splice(value.length-1,1);
                    }else{
                       this.flag = false 
                    }
                }
            },
            // 资金  实收
            onlyNum1(event){
                var value1 = event.target.value;
                if(value1){
                    if (!/^\+?[1-9][0-9]*$/.test(value1)) {
                        this.$message({
                            showClose: true,
                            message: '资金只能输入单位为万的整数！',
                            type: 'warning'
                        });
                        this.flag1 = true
                        if(event.target.value){
                            event.target.value.splice(value1.length-1,1);
                        }
                    }else{
                       this.flag1 = false 
                    }
                }
            },
            /*
            *               =======  校验 END
            */
            // submit
            submitForm(form){
                var JSON_judge = true
                for(let i in form){
                    // debugger
                    if(i == 'is_listed'&&form[i] == 1){
                        if(form['stock_code'] == ''){
                            JSON_judge = false
                            layer.msg('上市公司股票代码为必填项！')
                            break
                        }
                    }
                    if(form[i] == ''){
                        if(i == 'websitea_address'|| i == 'tips' || i == 'stock_code'){
                            
                        }else{ 
                            JSON_judge = false
                            layer.msg('必填项数据填写不完整！')
                            break
                        }
                    }
                }
                if(JSON_judge){
                    form.start_date = form.start_date / 1000
                    form.end_date = form.end_date / 1000
                    var data = {
                        'id' : this.Id,
                        'type' : 'base',
                        'editData' : vm.form
                    }
                    $.post('<?php echo U("Dwin/purchase/editSupplierMsg");?>', data , function (res) {
                        if(res.status === 200){
                            // layer.open页面关闭
                            layer.msg(res.msg)
                            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                            parent.layer.close(index)
                            // END
                            // location.reload()
                        }else{
                            vm.form.start_date = vm.form.start_date * 1000
                            vm.form.end_date = vm.form.end_date * 1000
                        }
                        layer.msg(res.msg)
                    })
                }
            }
        }
    })
</script>
</body>
</html>