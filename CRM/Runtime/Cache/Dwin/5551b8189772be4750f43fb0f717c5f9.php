<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.6/theme-chalk/index.css" rel="stylesheet">
    <style>
        body{
            padding: 10px 10px 10px 20px;
        }
        .el-table td{
            padding: 5px 0;
        }
        .el-table th{
            padding: 0;
            margin: 0;
        }
        .current-row{
            color:red!important;
        }
        .el-table--striped .el-table__body tr.el-table__row--striped.current-row td, .el-table__body tr.current-row>td, .el-table__body tr.hover-row.current-row>td, .el-table__body tr.hover-row.el-table__row--striped.current-row>td, .el-table__body tr.hover-row.el-table__row--striped>td, .el-table__body tr.hover-row>td
        {
            background-color:lightskyblue;
        }
    </style>
</head>
<body>
<div id="app" v-loading="loading">
    <h3>{{title}}</h3>
    <el-row>
        <el-col :span="6" v-if="table != 1">
            <el-select v-model="where.map.file_category" size="small" palceholder="选择分类" @change="search">
                <el-option
                        v-for="item in cate"
                        :key="item.category_name"
                        :label="item.category_name"
                        :value="item.category_name">
                </el-option>
            </el-select>
        </el-col>
        <el-col :span="6">
            <el-input v-model="where.map.file_name" size="small" placeholder="搜索文件名" clearable @change="search">
                <el-button slot="append" type="primary" size="small" icon="el-icon-search" @click="search">搜索</el-button>
            </el-input>

        </el-col>
        <el-col :span="12">
            <el-button type="success" size="small" icon="el-icon-upload" class="btn btn-primary" @click="openUpload">上传</el-button>
            <el-button v-if="table == '1'" type="primary" size="small" icon="el-icon-document" class="btn btn-warning" @click="preview">阅读</el-button>
            <el-button v-else type="primary" size="small" icon="el-icon-download" class="btn btn-primary" @click="download">下载</el-button>

            <el-button type="warning" size="small" icon="el-icon-edit" class="btn btn-info" @click="edit">编辑</el-button>
            <el-button type="danger" size="small" icon="el-icon-del" class="btn btn-warning" @click="del">删除</el-button>
        </el-col>
        <el-col :span="2">
        </el-col>
        <el-col :span="1" >
        </el-col>
        <el-col :span="1" >

        </el-col>
        <el-col :span="1">
        </el-col>
        <el-col :span="1">

        </el-col>

    </el-row>
    <hr>
    <el-table
            :default-sort = "{prop: 'update_time', order: 'descending'}"
            :data="tableData.data"
            border
            highlight-current-row
            @current-change="clickRow"
            @sort-change="orderChange"
            style="width: 100%">
        <el-table-column
                prop="file_id"
                label="编号"
                sortable="'custom'"
                width="150px"
                >
        </el-table-column>
        <el-table-column
                prop="file_name"
                label="文件名"
                sortable="'custom'"
                >
        </el-table-column>
        <el-table-column
                prop="file_category"
                sortable="'custom'"
                width="120px"
                label="文件分类"
                v-if="table != '1'"
        >
        </el-table-column>
        <el-table-column
                prop="file_tip"
                sortable="'custom'"
                label="文件描述">
        </el-table-column>
        <el-table-column
                prop="update_time"
                sortable="'custom'"
                width="180px"
                label="上传日期">
        </el-table-column>
        <el-table-column
                prop="update_name"
                sortable="'custom'"
                label="上传人"
                width="100px"
        >
        </el-table-column>
    </el-table>
    <el-pagination
            layout="prev, pager, next"
            :current-page="where.page"
            @current-change="pageChange"
            :total="+tableData.total">
    </el-pagination>
</div>
<script src="/Public/html/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/vue.js"></script>
<!--<script src="/Public/html/js/jquery.form.js"></script>-->
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.6/index.js"></script>
<script>
    var cate = <?php echo (json_encode($cate )); ?>;
    var table = <?php echo (json_encode($tableID )); ?>;
    var vm = new Vue({
        el: '#app',
        data: function () {
            return {
                tables: [0, 1, 2],
                table: table,
                cate: cate,
                tableData: {
                    data: [],
                    total: 0
                },
                loading: false,
                where: {
                    map: {
                        file_name: '',
                        file_category: ''
                    },
                    order: '',
                    page: 1
                },
                currentRow: null
            }
        },
        computed: {
            title: function () {
                var titles = ['文件下载','公司制度', '工艺文件']
                return titles[this.table]
            }
        },
        created: function(){
            if ( this.table == 0){
                this.where.map.file_category = '通讯录'
            }
            this.getData()
        },
        methods: {
            getData: function () {
                // this.where.page = this.where
                this.currentRow = null
                this.loading = true
                var vm = this
                $.post('', {where: vm.where, table: vm.table}, function (res) {
                    vm.tableData = res
                    vm.loading = false
                })
            },
            pageChange: function (page) {
                this.where.page = page
                this.getData();
            },
            orderChange: function (sort) {
                console.log(sort.order);
                var str = sort.prop
                if (sort.order === null){
                    str += ' desc'
                }else if (sort.order[0] == 'a'){
                    str += ' asc'
                } else {
                    str += ' desc'
                }
                this.where.order = str
                this.getData()
            },
            search: function () {
                this.where.page = 1
                this.getData()
            },
            openUpload: function () {
                var vm = this
                var index = layer.open({
                    type: 2,
                    title: '新建上传',
                    shadeClose:true,
                    content: '/Dwin/File/postFile' + vm.table,
                    area: ['70%', '80%'],
                    end: function () {
                        vm.getData()
                    }
                })
            },
            clickRow: function (row) {
                this.currentRow = row
            },
            edit: function () {
                var vm = this
                if (this.currentRow){
                    $.post('/Dwin/File/fileCheckAuth', {table: vm.table, id: vm.currentRow.id}, function (res) {
                        if (res.res != 1){
                            layer.msg('只有上传者本人才可以修改')
                            return false
                        }else {
                            var index = layer.open({
                                type: 2,
                                title: '修改',
                                shadeClose:true,
                                content: '/Dwin/File/getFile' + vm.table + '/id/' + vm.currentRow.id,
                                area: ['70%', '80%'],
                                end: function () {
                                    vm.getData()
                                }
                            })
                        }
                    })
                } else {
                    layer.msg('请选择一行数据')
                }
            },
            del: function () {
                var vm = this
                if (this.currentRow){
                    layer.confirm('确认删除?', function () {
                        vm.loading = true
                        $.post('/Dwin/File/delFile' + vm.table + '/id/' + vm.currentRow.id, {}, function (res) {
                            vm.loading = false
                            layer.msg(res.msg)
                            vm.getData()
                        })
                    })
                } else {
                    layer.msg('请选择一行数据')
                }
            },
            download: function () {
                if (this.currentRow){
                    window.open('/Dwin/File/getFileUrl'+ vm.table  + '/id/' + this.currentRow.id)
                } else {
                    layer.msg('请选择一行数据')
                }
            },
            preview: function () {
                if (!window.Uint8Array) {
                    layer.msg('旧版本浏览器无法正常显示此页面')
                    return false
                }
                if (this.currentRow){
                    window.open('<?php echo U("previewPdf", [], "");?>/id/' + this.currentRow.id)
                } else {
                    layer.msg('请选择一行数据')
                }
            }
        }
    })
</script>
</body>
</html>