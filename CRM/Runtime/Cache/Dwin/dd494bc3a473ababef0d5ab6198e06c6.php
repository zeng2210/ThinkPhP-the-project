<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>人员调动</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.6/theme-chalk/index.css" rel="stylesheet">

    <style>
        body{
            color:black;
        }
        .selected{
            background: #d0d27e!important;
        }
        .el-table thead{
            color:black!important;
        }

        .el-table td, .el-table th{
            padding-top: 2px!important;
            padding-bottom: 2px!important;
        }
        .el-pagination__jump{
            color:black!important;
        }

        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding:3px!important;
        }

    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="title">
                <h4>人员调动</h4>
            </div>
            <div class="table-responsive">
                <button class="btn btn-xs btn-outline btn-success addContract"><span class="glyphicon glyphicon-edit"></span>修改信息</button>
                <button class="btn btn-xs btn-outline btn-success exportStaffInfo"><span class="glyphicon glyphicon-tree-conifer"></span>导出到Excel</button>
                <button class="btn btn-xs btn-outline btn-success printBtn"><span class="glyphicon glyphicon-tree-conifer">打印异动表</button>
                <button class="btn btn-xs btn-outline btn-success printBtn2"><span class="glyphicon glyphicon-tree-conifer">打印转正表</button>
                <button class="btn btn-xs btn-outline btn-success remove"><span class="glyphicon glyphicon-remove"></span>删除信息</button>
                <table id="staff" class="table table-bordered table-hover table-striped">
                    <thead>
                    <th>职员编号</th>
                    <th>姓名</th>
                    <th>异动类型</th>
                    <th>异动日期</th>
                    <th>异动前部门</th>
                    <th>异动后部门</th>
                    <th>异动前职位</th>
                    <th>异动后职位</th>
                    <th>异动前薪资</th>
                    <th>异动后薪资</th>
                    <th>正式执行日期</th>
                    <th>备注</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
    var table = $('#staff'). DataTable({
        ajax: {
            type: 'post'
        },
        serverSide: true,
        order:[[3, 'desc']],
        "pageLength": 25,
        columns: [
            {data: 'employee_id'},
            {data: 'name'},
            {data: 'change_type'},
            {data: 'change_time'},
            {data: 'change_old_dept'},
            {data: 'change_new_dept'},
            {data: 'change_old_position'},
            {data: 'change_new_position'},
            {data: 'change_old_salary'},
            {data: 'change_new_salary'},
            {data: 'exec_time'},
            {data: 'tips'}
        ],
        oLanguage: {
            "oAria": {
                "sSortAscending": " - click/return to sort ascending",
                "sSortDescending": " - click/return to sort descending"
            },
            "LengthMenu": "显示 _MENU_ 记录",
            "ZeroRecords": "对不起，查询不到任何相关数据",
            "EmptyTable": "未有相关数据",
            "LoadingRecords": "正在加载数据-请等待...",
            "Info": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录。",
            "InfoEmpty": "当前显示0到0条，共0条记录",
            "InfoFiltered": "（数据库中共为 _MAX_ 条记录）",
            "Processing": "<img src='../resources/user_share/row_details/select2-spinner.gif'/> 正在加载数据...",
            "Search": "搜索：",
            "Url": "",
            "Paginate": {
                "sFirst": "首页",
                "sPrevious": " 上一页 ",
                "sNext": " 下一页 ",
                "sLast": " 尾页 "
            }
        }
    })
    var currentId
    var id
    var currentData
    $('tbody').on('click', 'tr', function () {
        currentData = table.row(this).data();
        currentId = currentData.employee_id;
        id = currentData.id;
        $('tr').removeClass('selected')
        $(this).addClass('selected')
    })
    $('table').on('processing.dt', function () {
        currentId = undefined;
        id = undefined;
        $('tr').removeClass('selected')
    })
    $('.printBtn').on('click', function () {
        if (id){
            window.open('staffChangeForm?id=' + id)
        } else {
            layer.msg('请先选中一项')
        }
    })

    $('.printBtn2').on('click', function () {
        if (id){
            window.open('regularStaffForm?id=' + id)
        } else {
            layer.msg('请先选中一项')
        }
    })
    // 从Excel导出
    $('.exportStaffInfo').on('click', function () {
        $(".exportStaffInfo").attr('disabled', true);
        var index = layer.load('正在生成xlsx文件');
        $.post('exportStaffChange', {}, function (res) {
            layer.close(index);
            $(".exportStaffInfo").attr('disabled', false);
            if (res.status == 403) {
                layer.msg(res.msg);
            } else {
                if (res.data) {
                    window.open(res.data);
                } else {
                    layer.msg(res.msg);
                }
            }
        })
    })
    // 删除
    $('.remove').on('click', function () {
        if (currentId === undefined){
            layer.msg('请选择一名员工')
        } else {
            layer.confirm('确认删除?', function (index) {
                $.post('delChange', {id: id}, function (res) {
                    if (res.status == 200) {
                        table.ajax.reload()
                    }
                    layer.msg(res.msg)
                })
                layer.close(index)
            })
        }
    })
    // 编辑异动信息
    $('.addContract').on('click', function () {
        if (currentId === undefined){
            layer.msg('请选择一名员工')
        } else {
            var index = layer.open({
                type: 2,
                title: '异动员工编辑',
                shadeClose:true,
                content: '/dwin/admin/editChange/id/' + id,
                area: ['100%', '80%'],
                end: function () {
                    table.draw(true);
                }
            })
        }
    })
</script>
</body>
</html>