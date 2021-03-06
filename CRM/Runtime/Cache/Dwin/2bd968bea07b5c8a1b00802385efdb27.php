<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-cn">
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
        body {
            padding: 20px;
        }
        table{
            text-align: center!important;
        }
        th{
            text-align: center!important;
        }
    </style>
</head>
<body>
<div id="app" v-loading="loading">
    <h3 style="padding: 20px;">合同管理</h3>
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>职员编号</th>
            <th>姓名</th>
            <th>部门</th>
            <th>职位</th>
        </tr>
        <tr>
            <td>{{staffInfo.employee_id}}</td>
            <td>{{staffInfo.name}}</td>
            <td>{{staffInfo.department}}</td>
            <td>{{staffInfo.position}}</td>
        </tr>
    </table>
    <hr>
    <table class="table table-striped table-hover table-bordered">
        <tr class="text-center">
            <th>合同编号</th>
            <th width="200">合同类别</th>
            <th>合同起止时间</th>
            <th>合同签订次数</th>
            <th>合同签订期限</th>
            <th>试用期起止时间</th>
            <th>操作</th>
        </tr>
        <tr v-for="(item, index) in contract" v-if='item.flag!=="del"'>
            <td>
                <span v-if="item.flag == 'get'">
                    {{item.contract_id}}
                </span>
                <el-input v-model="item.contract_id" v-else></el-input>
            </td>
            <td>
                <span v-if="item.flag == 'get'">
                    {{item.contract_type}}
                </span>
                <el-select v-model="item.contract_type" v-else placeholder="请选择" @change="chooseType(index)">
                    <el-option
                            :key="'第一份劳动合同'"
                            :label="'第一份劳动合同'"
                            :value="'第一份劳动合同'">
                    </el-option>
                    <el-option
                            :key="'第二份劳动合同'"
                            :label="'第二份劳动合同'"
                            :value="'第二份劳动合同'">
                    </el-option>
                    <el-option
                            :key="'无固定期限合同'"
                            :label="'无固定期限合同'"
                            :value="'无固定期限合同'">
                    </el-option>
                    <el-option
                            :key="'实习合同'"
                            :label="'实习合同'"
                            :value="'实习合同'">
                    </el-option>
                </el-select>
            </td>
            <td>
                <el-date-picker
                        v-model="item.start_time"
                        type="date"
                        value-format="timestamp"
                        format="yyyy-MM-dd"
                        :readonly="item.flag == 'get'"
                        placeholder="选择开始日期">
                </el-date-picker>
                <el-date-picker
                        v-model="item.end_time"
                        type="date"
                        format="yyyy-MM-dd"
                        value-format="timestamp"
                        :readonly="item.flag == 'get'"
                        placeholder="选择结束日期">
                </el-date-picker>
            </td>
            <td>
                <span v-if="item.flag == 'get'">
                    {{item.sign_count}}
                </span>
                <el-input v-model="item.sign_count" v-else></el-input>
            </td>
            <td>
                <span v-if="item.flag == 'get'">
                    {{item.duration}}
                </span>
                <el-input v-model="item.duration" v-else></el-input>
            </td>
            <td>
                <el-date-picker
                        v-model="item.probation_start_time"
                        type="date"
                        value-format="timestamp"
                        format="yyyy-MM-dd"
                        :readonly="item.flag == 'get'"
                        placeholder="选择开始日期">
                </el-date-picker>
                <el-date-picker
                        v-model="item.probation_end_time"
                        type="date"
                        format="yyyy-MM-dd"
                        value-format="timestamp"
                        :readonly="item.flag == 'get'"
                        placeholder="选择结束日期">
                </el-date-picker>
            </td>
            <td>
                <button class="btn btn-warning" @click="delContract(index)" v-if="item.flag == 'get'">删除</button>
                <button class="btn btn-info" @click="editContract(index)" v-if="item.flag == 'get' && addAble">修改</button>
                <button class="btn btn-primary" @click="saveContract(index)" v-if="item.flag != 'get'">保存</button>
            </td>
        </tr>
    </table>
    <button class="btn btn-info" @click="addContract" style="margin-left: 50px;" v-if="addAble">新增</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script>
    var staffInfo = <?php echo (json_encode($staffInfo )); ?>;
    var id = <?php echo (json_encode($id )); ?>;
    var vm = new Vue({
        el: "#app",
        data: function () {
            return {
                contract: [],
                staffInfo: staffInfo,
                loading: true,
                id: id
            }
        },
        created: function () {
            this.getData();
        },
        computed: {
            addAble: function () {
                return this.contract.every(function (value) {
                    return value.flag == 'get'
                })
            }
        },
        methods: {
            getData: function () {
                this.loading = true;
                var vm = this;
                $.post('', function (res) {
                    vm.contract = res.data;
                    vm.loading = false
                })
            },
            delContract: function (index) {
                var vm = this
                layer.confirm('确认删除?', function (aaa) {
                    $.post('<?php echo U("delContract");?>', {id: vm.contract[index].id}, function (res) {
                        if (res.status == 200) {
                            vm.getData();
                        }
                        layer.msg(res.msg)
                        layer.close(aaa)
                    })
                })
            },
            editContract: function (index) {
                this.contract[index].flag = 'put'
            },
            saveContract: function (index) {
                var vm = this
                var data = this.contract[index]
                if (data.flag == 'add') {
                    data.employee_id = vm.staffInfo.employee_id
                    data.name = vm.staffInfo.name
                    $.post('<?php echo U("addContract");?>', {data: data}, function (res) {
                        if (res.status == 200) {
                            vm.getData();
                            vm.contract[index].flag = 'get'
                        }
                        layer.msg(res.msg)
                    })
                }
                if (data.flag == 'put') {
                    $.post('<?php echo U("putContract");?>', {data: vm.contract}, function (res) {
                        if (res.status == 200) {
                            vm.getData();
                            vm.contract[index].flag = 'get'
                        }
                        layer.msg(res.msg)
                    })
                }
            },
            addContract: function () {
                var obj = {
                    flag: 'add',
                    contract_id: this.staffInfo.employee_id,
                    name: this.staffInfo.name,
                    start_time: null,
                    end_time: null,
                    probation_end_time: null,
                    probation_start_time: null
                }
                this.contract.push(obj)
            },
            submit: function () {
                var vm = this;
                layer.confirm('确认提交?', function (index) {
                    this.loading = true;
                    $.post('', {data: vm.contract, method: 'put'}, function (res) {
                        layer.msg(res.msg)
                        vm.getData();
                    })
                })
            },
            // 根据选择合同类型的不同选择不同时间
            chooseType: function (index) {
                var value = this.contract[index].contract_type
                this.contract[index].start_time = null
                this.contract[index].end_time = null
                this.contract[index].probation_start_time = null
                this.contract[index].probation_end_time = null
                this.contract[index].sign_count = index + 1
                if (value == '第一份劳动合同') {
                    this.contract[index].start_time = moment().unix()*1000
                    this.contract[index].end_time = moment().add(3, 'y').unix()*1000
                    this.contract[index].duration = '3年'

                }
                if (value == '第二份劳动合同') {
                    this.contract[index].start_time = moment().unix()*1000
                    this.contract[index].end_time = moment().add(4, 'y').unix()*1000
                    this.contract[index].duration = '4年'
                }
                if (value == '无固定期限合同') {
                    this.contract[index].start_time = moment().unix()*1000
                    this.contract[index].end_time = moment().add(50, 'y').unix()*1000
                    this.contract[index].duration = '无固定期限'
                }
                if (value == '实习合同') {
                    this.contract[index].probation_start_time = moment().unix()*1000
                    this.contract[index].probation_end_time = moment().add(3, 'M').unix()*1000
                    this.contract[index].duration = '3个月'
                }
            }
        }
    })
</script>
</body>
</html>