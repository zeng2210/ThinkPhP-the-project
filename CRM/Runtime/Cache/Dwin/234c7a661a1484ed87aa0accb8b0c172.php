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
            padding: 20px;
        }
    </style>
</head>
<body>
<div id="app">
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>职员编号</th>
            <th>姓名</th>
            <th>部门</th>
            <th>职位</th>
            <th>入职时间</th>
        </tr>
        <tr>
            <td>{{staffInfo.employee_id}}</td>
            <td>{{staffInfo.name}}</td>
            <td>{{staffInfo.department}}</td>
            <td>{{staffInfo.position}}</td>
            <td>{{staffInfo.entry_time}}</td>
        </tr>
    </table>
    <el-form ref="form" :rules="rules" :model="form" label-width="100px" :inline="true" @submit.native.prevent v-loading="loading">
        <el-row>
            <el-col :span="8">
                <el-form-item label="离职原因" prop="departure_reason">
                    <el-select v-model="form.departure_reason" placeholder="请选择">
                        <el-option
                                :key="1"
                                :label="'个人原因'"
                                :value="'个人原因'">
                        </el-option>
                        <el-option
                                :key="2"
                                :label="'工作原因'"
                                :value="'工作原因'">
                        </el-option>
                    </el-select>
                </el-form-item>
            </el-col>
            <el-col :span="8">
                <el-form-item label="离职类别" prop="departure_type">
                    <el-select v-model="form.departure_type" placeholder="请选择">
                        <el-option
                                :key="1"
                                :label="'主动辞职'"
                                :value="'主动辞职'">
                        </el-option>
                        <el-option
                                :key="2"
                                :label="'辞退'"
                                :value="'辞退'">
                        </el-option>
                    </el-select>
                </el-form-item>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="8">
                <el-form-item label="离职日期" prop="departure_time">
                    <el-date-picker
                            v-model="form.departure_time"
                            type="date"
                            value-format="timestamp"
                            placeholder="选择日期">
                    </el-date-picker>
                </el-form-item>
            </el-col>
            <el-col :span="8">
                <el-form-item label="备注">
                    <el-input type="textarea" :rows="2" autosize v-model="form.tips"></el-input>
                </el-form-item>
            </el-col>
        </el-row>
        <el-form-item>
            <el-button type="primary" @click="submit">提交</el-button>
        </el-form-item>
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
    var staffInfo = <?php echo (json_encode($staffInfo)); ?>;
    var vm = new Vue({
        el: "#app",
        data: function () {
            return {
                form: {},
                staffInfo: staffInfo,
                rules: {
                    departure_reason:[{required: true, message:'请选择',trigger: 'blur'}],
                    departure_type:[{required: true, message:'请选择',trigger: 'blur'}],
                    departure_time:[{required: true, message:'请选择',trigger: 'blur'}],
                    tips:[]
                },
                loading: false
            }
        },
        created: function () {

        },
        methods: {
            submit: function () {
                var vm = this;
                this.$refs['form'].validate(function (res) {
                    if (res){
                        layer.confirm('确认提交?', function (index) {
                            Object.assign(vm.form, vm.staffInfo)
                            vm.form.departure_time /= 1000
                            vm.loading = true
                            $.post('', {data: vm.form}, function (res) {
                                layer.msg(res.msg)
                                vm.loading = false
                                var index = parent.layer.getFrameIndex(window.name);
                                parent.layer.close(index);
                            })
                        })
                    }else {
                        layer.msg('有未填项')
                        vm.loading = false
                    }
                })
            }
        }
    })
</script>
</body>
</html>