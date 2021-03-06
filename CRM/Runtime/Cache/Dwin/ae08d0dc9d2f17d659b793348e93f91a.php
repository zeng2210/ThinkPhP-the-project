<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.4/theme-chalk/index.css" rel="stylesheet">
    <style>
        .active{
            background: #f0c78a;
        }
        .select{
            margin-top: 50px;
            display: flex;
            justify-content: center;
        }
        .main{
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>
<body>
<div id="app">
    <div class="select">
        <el-select v-model="warehouseNumber" filterable placeholder="请选择仓库">
            <el-option
                    v-for="(item, index) in baseInfo.warehouseArr"
                    :key="item.rep_id"
                    :label="item.repertory_name"
                    :value="index">
            </el-option>
        </el-select>
    </div>
    <div>
        <div v-if="warehouseNumber !== ''">
            <div class="main">
                <div>
                    <h4>选择库管员</h4>
                    <el-transfer :titles="['所有库管员','现在的库管员']" v-model="baseInfo.warehouseArr[warehouseNumber].warehouse_manager_id" :data="baseInfo.manager"></el-transfer>
                </div>
                <div>
                    <h4>选择物流员</h4>
                    <el-transfer :titles="['所有物流员','现在的物流员']" v-model="baseInfo.warehouseArr[warehouseNumber].logistics_staff_id" :data="baseInfo.logistics"></el-transfer>
                </div>
            </div>
            <div class="select">
                <button type="button" class="btn btn-primary" @click="submit">保存当前配置</button>
            </div>
        </div>
        <div v-else class="select">
            <h2>请选择仓库</h2>
        </div>
    </div>

</div>
<script src="/Public/Admin/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="/Public/html/js/vue.js"></script>
<script src="/Public/html/js/bluebird.js"></script>
<script src="/Public/html/js/vee-validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.4/index.js"></script>
<script>
    var baseInfo = <?php echo (json_encode($data )); ?>;
    var vm = new Vue({
        el: '#app',
        data: function () {
            return {
                warehouseNumber: '',
                baseInfo: baseInfo
            }
        },
        methods: {
            submit: function () {
                var obj = {
                    logistics_staff_id: this.baseInfo.warehouseArr[this.warehouseNumber].logistics_staff_id.join(','),
                    warehouse_manager_id: this.baseInfo.warehouseArr[this.warehouseNumber].warehouse_manager_id.join(','),
                    rep_id: this.baseInfo.warehouseArr[this.warehouseNumber].rep_id
                };
                $.post('', obj, function (res) {
                    layer.msg(res.msg, function () {
                        location.reload();
                    });
                })
            }
        }
    })
</script>
</body>
</html>