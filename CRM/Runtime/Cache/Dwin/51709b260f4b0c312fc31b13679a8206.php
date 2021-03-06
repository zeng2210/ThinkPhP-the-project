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
    
    </style>
</head>
<body>
<div id="app" v-loading="loading">
    <h3 style="margin: 20px;" class="text-center" v-if="id == '1'">新员工录入</h3>
    <h3 style="margin: 20px;" class="text-center" v-else>供应商地址信息</h3>
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>地址</th>
            <th>地址描述</th>
            <th>操作</th>
        </tr>
        <tr v-for="(item, index) in contact" v-if="flag!=='del'">
            <td>
                <el-input v-model="item.address" placeholder="地址"></el-input>
            </td>
            <td>
                <el-input type="textarea" v-model="item.addr_description" placeholder="地址描述"></el-input>
            </td>
            <td style="width: 150px;">
                <button class="btn btn-warning" @click="delContact(index)" v-if="flag == 'get'">删除</button>
                <button class="btn btn-primary" @click="saveContact(index)" v-if="flag == 'get'">保存</button>
            </td>
        </tr>
    </table>
    <button class="btn btn-info" @click="addContact" style="margin-left: 50px;">新增地址信息项</button>
    <button class="btn btn-info" @click="allSaveContact" style="margin-left: 50px;">保存所有数据</button>
    
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
<script src="https://cdn.bootcss.com/element-ui/2.3.6/index.js"></script>
<script>
    var id = '<?php echo ($id); ?>';
    var vm = new Vue({
        el: "#app",
        data: function () {
            var vm = this
            
            return {
                loading: true,
                id:id,
                flag:'get',
                num:0,
                contact:[]
            }
        },
        created: function () {
            this.getData()
        },
        methods: {
            // 获取数据
            getData: function () {
                var vm = this;
                this.loading = true;
                $.post('<?php echo U("/Dwin/Purchase/getAddress");?>', {'id' : id}, function (res) {
                    if(res.status == 200){
                        vm.loading = false
                        vm.contact = res.data
                        vm.num = vm.contact.length
                    }
                })
            },
            // 数据删除
            delContact: function (index) {
                var indexs = index + 1
                var vm = this
                if(indexs > vm.num){
                    this.contact.splice(index,1)
                }else if(indexs <= vm.num){
                    if(this.contact.length > vm.num){
                        layer.msg('请先保存修改的内容或删除')
                    }else{
                        var data = {
                            'id' : id,
                            'type':'address',
                            'data' : this.contact[index]
                        }
                        layer.confirm('确认删除?', function (aaa) {
                            $.post('<?php echo U("/Dwin/Purchase/delSupplierOtherMsg");?>', data, function (res) {
                                if (res.status == 200) {
                                    vm.getData()
                                    location.reload();
                                }
                                layer.msg(res.msg)
                            })
                        })
                    }
                }
            },
            // 单条 数据 保存
            saveContact: function (index) {
                var vm = this
                var data = {
                    'id' : id,
                    'type':'address',
                    'data' : this.contact[index]
                }
                $.post('<?php echo U("/Dwin/Purchase/editOrAddSupplierOneMsg");?>', data, function (res) {
                    if(res.status == 200){
                        vm.getData(); 
                        location.reload();
                    }
                    layer.msg(res.msg)
                }) 
            },
            // 新增一行空数据
            addContact: function () {
                if(this.contact[this.contact.length - 1] != undefined){
                    if(this.contact[this.contact.length - 1].address){
                        var obj = {}
                        this.contact.push(obj)
                    }else{
                        layer.msg('已有新增行，不能重复新增！')
                    }
                }else{
                    var obj = {}
                    this.contact.push(obj)
                }
            },
            // 保存所有数据
            allSaveContact () {
                var vm = this
                // 修改的数据
                var allAmend = this.contact.slice(0,vm.num)
                // 新增的数据
                var addNumber = this.contact.length - vm.num
                var allAdd = this.contact.slice(vm.num)
                var data = []
                var params = {
                    'id' : id,
                    'type':'address',
                    'editData': allAmend,
                    'addData': allAdd
                }
                $.post('<?php echo U("/Dwin/Purchase/editSupplierMsg");?>', params, function (res) {
                    if(res.status == 200){
                        vm.getData();
                        // 关闭弹框 刷新父页面
                        var index=parent.layer.getFrameIndex(window.name);//获取窗口索引
                        parent.layer.close(index)
                    }
                    layer.msg(res.msg)
                })  
            }
        }
    })
</script>
</body>
</html>