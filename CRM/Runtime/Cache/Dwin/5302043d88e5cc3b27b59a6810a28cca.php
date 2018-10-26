<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>员工上传权限</title>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/html/css/animate.min.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/element-ui/2.3.6/theme-chalk/index.css" rel="stylesheet">
    <style>
        .selected{
            background: #d0d27e!important;
        }
        #staff_wrapper{
            overflow: hidden;
        }
        .dataTables_scrollBody thead{
            visibility: hidden;
        }
        div.dataTables_scrollBody table{
            margin-top: -18px!important;
            margin-left: 6px;
        }
        .tab-pane{
            overflow: auto;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="title">
                <h4>员工上传权限</h4>
                <div>
                    <button class="btn btn-info edit">修改</button>
                </div>
            </div>
            <div class="table-responsive">
                <table id="staff" class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>姓名</th>
                        <th>文件大小限制</th>
                        <th>文件类型限制</th>
                    </tr>
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
    // 文件类型, 修改此处需同时修改fileUploadAuthManager
    var fileType = [
        {
            label: '.rar',
            value: ['application/x-rar-compressed','application/rar','application/octet-stream']
        },
        {
            label: '.pdf',
            value: ['application/pdf']
        },
        {
            label: '.zip',
            value: ['application/x-zip-compressed','application/zip']
        },
        {
            label: '.xls',
            value: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-excel','application/x-excel']
        },
        {
            label: '.png/.jpg',
            value: ['image/jpeg','image/png','image/x-png']
        }
    ]
    var table = $('#staff'). DataTable({
        ajax: {
            type: 'post'
        },
        "scrollY": 400,
        "scrollX": true,
        "scrollCollapse": true,
        "destroy"      : true,
        "paging"       : true,
        "autoWidth"	   : false,
        pageLength: 15,
        serverSide: true,
        order:[[1, 'desc']],
        columns: [
            {data: 'name'},
            {data: 'max_upload_file_size', render: function (data) {
                if (!data){
                    return null
                }
                    return parseFloat(data / 1024 / 1024).toFixed(2) + 'MB'
                }},
            {data: 'allowed_upload_type', render: function (data) {
                    if (!data){
                        return null
                    }
                    var res = []
                    data = data.split(',')
                    data.forEach(function (v1) {
                        fileType.forEach(function (v2) {
                            if (v2.value.indexOf(v1) != -1 && res.indexOf(v2.label) == -1) {
                                res.push(v2.label)
                            }
                        })
                    })
                    return res.join(',')
                }}
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
    var data = null
    $('#staff tbody').on('click', 'tr', function () {
        $('tr').removeClass('selected')
        $(this).addClass('selected')
        data = table.row(this).data();
    })
    $('#staff').on('processing.dt', function () {
        data = null
        $('tr').removeClass('selected')
    })

    $('.edit').on('click', function () {
        if (data){
            var index = layer.open({
                type: 2,
                title: '修改员工权限',
                shadeClose:true,
                content: '/dwin/file/fileUploadAuthManager?id=' + data.id,
                area: ['50%', '70%'],
                end: function () {
                    table.ajax.reload()
                }
            })
        } else {
            layer.msg('请先选中一名员工')
        }
    })
</script>
</body>
</html>