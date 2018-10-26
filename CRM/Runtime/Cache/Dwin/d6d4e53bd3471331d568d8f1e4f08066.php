<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>合同信息</title>
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
                <h4>合同信息</h4>
                <div>
                    <button class="btn btn-xs btn-outline btn-success contract_expire"><span class="glyphicon glyphicon-tree-conifer"></span>合同到期提醒</button>
                    <button class="btn btn-xs btn-outline btn-success remove"><span class="glyphicon glyphicon-remove"></span>删除</button>
                    <button class="btn btn-xs btn-outline btn-success addContract"><span class="glyphicon glyphicon-plus"></span>添加</button>
                    <button class="btn btn-xs btn-outline btn-success addContract"><span class="glyphicon glyphicon-edit"></span>修改</button>
                </div>
            </div>
            <div class="table-responsive">
                <table id="staff" class="table table-bordered table-hover table-striped">
                    <thead>
                    <th>职员编号</th>
                    <th>姓名</th>
                    <th>合同编号</th>
                    <th>合同类别</th>
                    <th>合同起始日期</th>
                    <th>合同终止日期</th>
                    <th>合同签订次数</th>
                    <th>合同签订期限</th>
                    <th>试用期起始日期</th>
                    <th>试用期到期日期</th>
                    <th>备注</th>
                    <th>更新时间</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
<script>
    var table = $('#staff'). DataTable({
        ajax: {
            type: 'post'
        },
        // "scrollY": 450,
        // "scrollX": true,
        serverSide: true,
        order:[[11, 'desc']],
        "pageLength": 25,
        columns: [
            {data: 'employee_id'},
            {data: 'name'},
            {data: 'contract_id'},
            {data: 'contract_type'},
            {data: 'start_time'},
            {data: 'end_time', render: function (data) {
                    return moment.unix(data).format("YYYY-MM-DD");
                }},
            {data: 'sign_count'},
            {data: 'duration'},
            {data: 'probation_start_time'},
            {data: 'probation_end_time'},
            {data: 'tips',
                render: function (value,a, row) {
                    if (value){
                        value =  value.replace(/\r\n|\n/g, '<br>')
                        var allData = table.data();
                        var index = allData.indexOf(row);
                        var className = 'tips' + index;
                        var str = ''
                        if (value.length > 10){
                            str = value.slice(0, 10) + '...'
                        } else {
                            str = value
                        }
                        str = str.replace(/\r\n|\n/g, '<br>')
                        return "<span class='tips' id='" + className + "'>" + str + "</span>"
                    }
                    return value
                }},
            {data: 'update_time'}
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
    $('tbody').on('mouseenter', 'span', function () {
        console.log($(this).hasClass('tips'));
        if ($(this).hasClass('tips') )
            var id = $(this).attr('id')
        var data = table.cell($(this).parents('td')).data()
        layer.tips(data, '#' + id, {time: 9999999})
    })
    $('tbody').on('mouseleave', 'td', function () {
        layer.closeAll();
    })
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
    // 合同到期提醒
    $('.contract_expire').on('click', function () {
        var index = layer.open({
            type: 2,
            title: '合同到期提醒',
            shadeClose:true,
            content: 'contractExpire',
            area: ['90%', '90%'],
            end: function () {
                table.ajax.reload()
            }
        })
    })
    
    //删除
    $('.remove').on('click', function () {
        console.log(currentId);
        console.log(id);
        if (currentId === undefined){
            layer.msg('请选择一名员工')
        } else {
            layer.confirm('确认删除?', function (index) {
                $.post('delContract', {id: id}, function (res) {
                    if (res.status == 200) {
                        table.ajax.reload()
                    }
                    layer.msg(res.msg)
                })
                layer.close(index)
            })
        }
    })

    $('.addContract').on('click', function () {
        if (currentId === undefined){
            layer.msg('请选择一名员工')
        } else {
            var index = layer.open({
                type: 2,
                title: '合同管理',
                shadeClose:true,
                content: '/dwin/admin/getContract/id/' + currentId,
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