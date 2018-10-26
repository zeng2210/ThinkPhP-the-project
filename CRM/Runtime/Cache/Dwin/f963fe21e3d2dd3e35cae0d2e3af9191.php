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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <style>
        body{
            color:black;
        }
        .selected{
            background: #d0d27e!important;
        }
        #staff th,td{
            white-space: nowrap!important;
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
        .table2000{
            width: 2000px;
        }
        #staff_wrapper{
            overflow: hidden;
        }
        .dataTables_scrollBody thead{
            visibility: hidden;
        }
        div.dataTables_scrollBody table{
            margin-top: -25px!important;
            margin-left: 1px;
        }
        .tab-pane{
            overflow: auto;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding:3px!important;
        }

        /* 一级弹层 */
        
        #main { 
            /* height:1800px; 
            padding-top:90px;  */
            text-align:center; 
        } 
        #fullbg { 
            background-color:gray; 
            left:0; 
            opacity:0.5; 
            position:absolute; 
            top:0; 
            z-index:3; 
            filter:alpha(opacity=50); 
            -moz-opacity:0.5; 
            -khtml-opacity:0.5; 
        } 
        #dialog { 
            background-color:#fff; 
            border:5px solid rgba(0,0,0, 0.4); 
            height:170px; 
            left:50%; 
            margin:-200px 0 0 -200px; 
            padding:1px; 
            position:fixed !important; /* 浮动对话框 */ 
            position:absolute; 
            top:60%; 
            width:357px; 
            z-index:5; 
            border-radius:5px; 
            display:none; 
        } 
        #dialog p { 
            margin:0 0 12px; 
            height:24px; 
            line-height:24px; 
            background:#CCCCCC; 
        } 
        #dialog p.close { 
            text-align:right; 
            padding-right:10px; 
        } 
        #dialog p.close a { 
            color:#fff; 
            text-decoration:none; 
        } 
        #dialog div{
            height: 100%;
            width: 100%;
            text-align: center;
            line-height: 160px;
        }
        .dia_but1{
            height: 50px;
            width: 100px;
            font-size: 15px;
            text-align: center;
            line-height: 50px;
            font-weight: bold;
            margin-left: 44px;
        }
        /* 二级弹层 */
        
        #main_secondTime { 
            /* height:1800px; 
            padding-top:90px;  */
            text-align:center; 
        } 
        #fullbg_secondTime { 
            background-color:gray; 
            left:0; 
            opacity:0.5; 
            position:absolute; 
            top:0; 
            z-index:3; 
            filter:alpha(opacity=50); 
            -moz-opacity:0.5; 
            -khtml-opacity:0.5; 
        } 
        #dialog_secondTime { 
            background-color:#fff; 
            border:5px solid rgba(0,0,0, 0.4); 
            height:500px; 
            left:37%; 
            margin:-200px 0 0 -200px; 
            padding:1px; 
            position:fixed !important; /* 浮动对话框 */ 
            position:absolute; 
            top:40%; 
            width:800px; 
            z-index:5; 
            border-radius:5px; 
            display:none; 
        } 
        #dialog_secondTime p { 
            margin:0 0 12px; 
            height:24px; 
            line-height:24px; 
            background:#CCCCCC; 
        } 
        #dialog_secondTime p.close { 
            text-align:right; 
            padding-right:10px; 
        } 
        #dialog_secondTime p.close a { 
            color:#fff; 
            text-decoration:none; 
        } 
        #dialog_secondTime div{
            height: 100%;
            width: 100%;
            text-align: center;
            line-height: 160px;
        }
        #changeData tr{
            height: 60px;
        }
        .tb_with{
            width: 150px;
        }
        #changeData button{
            width: 70px;
            height: 35px;
            font-weight: bold;
            margin-top: 10px;
        }
        .head_t{
            background-color: #CCCCCC;
            font-weight: bold;
            font-size: 15px;
            height: 50px;
        }
        .head_but{
            width: 100px;
        }
        /* 二级 再弹框 */
        #main_thereTime { 
            /* height:1800px; 
            padding-top:90px;  */
            text-align:center; 
        } 
        #fullbg_thereTime { 
            background-color:gray; 
            left:0; 
            opacity:0.5; 
            position:absolute; 
            top:0; 
            z-index:6; 
            filter:alpha(opacity=50); 
            -moz-opacity:0.5; 
            -khtml-opacity:0.5; 
        } 
        #dialog_thereTime { 
            background-color:#fff; 
            border:5px solid rgba(0,0,0, 0.4); 
            height:300px; 
            left:44%; 
            margin:-200px 0 0 -200px; 
            padding:1px; 
            position:fixed !important; /* 浮动对话框 */ 
            position:absolute; 
            top:55%; 
            width:600px; 
            z-index:7; 
            border-radius:5px; 
            display:none; 
        } 
        #dialog_thereTime p { 
            margin:0 0 12px; 
            height:24px; 
            line-height:24px; 
            background:#CCCCCC; 
        } 
        #dialog_thereTime p.close { 
            text-align:right; 
            padding-right:10px; 
        } 
        #dialog_thereTime p.close a { 
            color:#fff; 
            text-decoration:none; 
        } 
        /* #dialog_thereTime div{
            height: 100%;
            width: 100%;
            text-align: center;
            line-height: 160px;
        } */
        ul li{           
            padding:0;
            margin:0;
            list-style:none;
        }
        .ul_name{
            float: left;
            width: 150px;
            padding: 30px 0 0px 30px;
            height: 217px;
        }
        .ul_name li{
            width: 100%;
            height: 45px;
            line-height: 45px;
            text-align: center;
            border: 1px solid #ccc;
        }
        .ul_val{
            float: left;
            width: 385px;
            padding: 30px 0 0px 0;
            height: 217px;
        }
        .ul_val li{
            width: 100%;
            height: 45px;
            line-height: 45px;
            border: 1px solid #ccc;
        }
        .close div{
            float: left;
            width: 500px;
            height: 50px;
        }
        .love_button{
            background-color: #ccc;
            font-weight: bold;
            cursor:pointer;
        }
        .love_button:hover{
            background-color: #909399;
        }
        #main_revamp { 
            /* height:1800px; 
            padding-top:90px;  */
            text-align:center; 
        } 
        #fullbg_revamp { 
            background-color:gray; 
            left:0; 
            opacity:0.5; 
            position:absolute; 
            top:0; 
            z-index:3; 
            filter:alpha(opacity=50); 
            -moz-opacity:0.5; 
            -khtml-opacity:0.5; 
        } 
        #dialog_revamp { 
            background-color:#fff; 
            border:5px solid rgba(0,0,0, 0.4); 
            height:600px; 
            left:35%; 
            margin:-200px 0 0 -200px; 
            padding:1px; 
            position:fixed !important; /* 浮动对话框 */ 
            position:absolute; 
            top:35%; 
            width:900px; 
            z-index:5; 
            border-radius:5px; 
            display:none; 
        } 
        #dialog_revamp p { 
            margin:0 0 12px; 
            height:24px; 
            line-height:24px; 
            background:#CCCCCC; 
        } 
        #dialog_revamp p.close { 
            text-align:right; 
            padding-right:10px; 
        } 
        #dialog_revamp p.close a { 
            color:rgb(102, 96, 96); 
            text-decoration:none; 
        } 
        /* 修改 */
        /* 修改 选择框 */
        #main_select { 
            /* height:1800px; 
            padding-top:90px;  */
            text-align:center; 
        } 
        #fullbg_select { 
            background-color:gray; 
            left:0; 
            opacity:0.5; 
            position:absolute; 
            top:0; 
            z-index:3; 
            filter:alpha(opacity=50); 
            -moz-opacity:0.5; 
            -khtml-opacity:0.5; 
        } 
        #dialog_select { 
            background-color:#fff; 
            border:5px solid rgba(0,0,0, 0.4); 
            height:500px; 
            left:50%; 
            margin:-200px 0 0 -200px; 
            padding:1px; 
            position:fixed !important; /* 浮动对话框 */ 
            position:absolute; 
            top:40%; 
            width:500px; 
            z-index:5; 
            border-radius:5px; 
            display:none; 
        } 
        #dialog_select p { 
            margin:0 0 12px; 
            height:24px; 
            line-height:24px; 
            background:#CCCCCC; 
        } 
        #dialog_select p.close { 
            text-align:right; 
            padding-right:10px; 
            z-index: 6;
        } 
        #dialog_select p.titles { 
            font-size: 17px;
            font-weight: bold;
            text-align: left;
            padding-left: 15px;
            height: 45px;
            line-height: 45px;
            background-color: #fff;
            border-bottom: 1px solid #ccc;
        } 
        #dialog_select p.close a { 
            color:rgb(102, 96, 96); 
            text-decoration:none; 
        } 
        .select_is{
            padding: 0;
            width: 600px;
            height: 500px;
        }
        .select_is li{
            height:43px;
            width: 81%;
            cursor:pointer;
            line-height: 43px;
            text-align: left;
            font-size: 17px;
            padding-left: 20px;
            /* font-weight: bold; */
        }
        .select_is li:hover{
            background-color: #ccc;
            font-weight: bold;
            text-align: center;
        }
        /* 修改  编辑框 */
        #main_revamp { 
            /* height:1800px; 
            padding-top:90px;  */
            text-align:center; 
        } 
        #fullbg_revamp { 
            background-color:gray; 
            left:0; 
            opacity:0.5;
            width: 100%;
            position:absolute; 
            top:0; 
            z-index:3; 
            filter:alpha(opacity=50); 
            -moz-opacity:0.5; 
            -khtml-opacity:0.5; 
        } 
        #dialog_revamp { 
            background-color:#fff; 
            border:5px solid rgba(0,0,0, 0.4); 
            height:600px; 
            left:17%; 
            margin:-200px 0 0 -200px; 
            padding:1px; 
            position:fixed !important; /* 浮动对话框 */ 
            position:absolute; 
            top:35%; 
            width:1292px; 
            z-index:5; 
            border-radius:5px; 
            display:none; 
        } 
        #dialog_revamp p { 
            margin:0 0 12px; 
            height:24px; 
            line-height:24px; 
            background:#CCCCCC; 
        } 
        #dialog_revamp p.close { 
            text-align:right; 
            padding-right:10px; 
        } 
        #dialog_revamp p.close a { 
            color:rgb(102, 96, 96); 
            text-decoration:none; 
        } 
        .input_sty{
            overflow:auto;
            background-attachment:fixed;
            background-repeat:no-repeat;
            border-style:solid; 
            border-color:#FFFFFF;
        }
        .cell{
            text-align: left
        }
        .has-gutter tr{
            height: 35px;
            font-size: 15px;
        }
        .has-gutter tr th{
            background-color: #bbb;
        }
        .tab_title{
            height: 40px;
            text-align: left;
            padding-left: 20px;
            font-size: 15px;
            line-height: 40px;
        }
        .present_button{
            padding: 6px 25px;
            margin: 15px 25px;
            /* font-size: 14px; */
            font-weight: bold;
        }
        .body_text textarea{
            border: none;
            resize: none;
            height: 100%;
            text-align: center;
            /* line-height: 2px; */
            /* height: 20px; */
            border:0;
            outline:none;
        }

        /* 确定按钮 */
        
        #main_sureToSubmit { 
            /* height:1800px; 
            padding-top:90px;  */
            text-align:center; 
        } 
        #fullbg_sureToSubmit { 
            background-color:gray; 
            left:0; 
            opacity:0.5; 
            position:absolute; 
            top:0; 
            z-index:5; 
            filter:alpha(opacity=50); 
            -moz-opacity:0.5; 
            -khtml-opacity:0.5; 
        } 
        #dialog_sureToSubmit { 
            background-color:#fff; 
            border: none;
            border:5px solid rgba(0,0,0, 0.4); 
            height:170px; 
            left:50%; 
            margin:-200px 0 0 -200px; 
            padding:1px; 
            position:fixed !important; /* 浮动对话框 */ 
            position:absolute; 
            top:60%; 
            width:357px; 
            z-index:7; 
            border-radius:5px; 
            display:none; 
        } 
        #dialog_sureToSubmit p { 
            margin:0 0 12px; 
            height:24px; 
            line-height:24px; 
            background:#CCCCCC; 
        } 
        #dialog_sureToSubmit p.close { 
            text-align:right; 
            padding-right:10px; 
        } 
        #dialog_sureToSubmit p.close a { 
            color:#fff; 
            text-decoration:none; 
        }
        .dia_but2{
            height: 50px;
            width: 100px;
            border-radius:10%;
            border: none;
            margin: 55px 0px;
            font-size: 15px;
            background-color:#E9D98C; 
            text-align: center;
            line-height: 50px;
            font-weight: bold;
            margin-left: 44px;
        }
        /* 修改 表头 */
        .th_style{
            height: 40px;
            background-color: #ccc;
        }
        .el-button{
            margin: 4px 9px; 
        }
        .selsctDialog .el-button:hover{
            background-color: darkblue;
            border:1px solid #fff
        }
        /* 修改下拉 */
       .float-e-margins .btn {
            margin-bottom: 3px !important;
        }
       .ele-BUT{
           display: inline-block;
            font-size: 12px;
           height: 21px;
            color: #1c84c6;
            border: 1px solid #1c84c6;
            border-radius:3px;
       }
       .form-control{
           padding: 0;
       }
        .change-css{
            cursor: pointer;
            text-align: center!important;
            line-height: 20px;
            background-color:whitesmoke;
        }
        .active-css{
            background-color: lightskyblue;
            border-radius: 2px;
        }
        .active-css-child{
            color:red!important;
            line-height: 20px;
        }
        .hover-css{
            background-color: gainsboro;
            color:dimgray!important;
            border-radius: 2px;
            line-height: 20px;
        }
        /* 上传附件 */
        .uploadResume .el-upload .el-upload__input{
           display: none !important;
        }
        .uploadResume .el-upload-list{
            display: none
        }
        .but_floatFood{
            display: inline-block !important;
            width: auto;
            min-height: 30px;
            margin: 0 1%;
            line-height: 30px;
        }
        /* 自适应 */
        .dataTables_scrollHeadInner{
            width: 100% !important;
        }
        .dataTables_scrollHeadInner table{
            width: 100% !important;
        }
        .dataTables_scrollBody table{
            width: 100% !important;
        }
        /* layer.tiele delete */
        .layui-layer .layui-layer-title{
           display: none !important;
       }
       .notSelectData{
            color:#e4393c;text-align: center;font-size: 15px
       }
       li.active > a{
            background-color: #1c84c6 !important;
            color: #fff !important;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
                <div class="title_top">
                    <h4>供应商名录列表</h4>
                        <div style="display: inline-block;width:100%;margin-top: 3px;">
                            <div class="fa-hover col-md-1 col-sm-3 change-css active-css but_floatFood" data-id="1" onclick="outbound(1)" style="margin:0 1% 0 0"><a href="javascript:;" class="active-css-child"><i class="fa fa-tv">部门待审核</i></a></div>
                            <div class="fa-hover col-md-1 col-sm-3 change-css but_floatFood" data-id="2" onclick="outbound(2)"><a href="javascript:;"><i class="fa fa-tv">质控待审核</i></a></div>
                            <div class="fa-hover col-md-1 col-sm-3 change-css but_floatFood" data-id="5" onclick="outbound(3)"><a href="javascript:;"><i class="fa fa-tv">总经理待审核</i></a></div>
                            <div class="fa-hover col-md-1 col-sm-3 change-css but_floatFood" data-id="3" onclick="outbound(4)"><a href="javascript:;"><i class="fa fa-tv">合格名录</i></a></div>
                            <div class="fa-hover col-md-1 col-sm-3 change-css but_floatFood" data-id="4" onclick="outbound(5)"><a href="javascript:;"><i class="fa fa-tv">不合格名录</i></a></div>
                            <input type="hidden" id="orderType" value="1">
                        </div>
                        <button class="btn btn-xs btn-outline btn-success refresh">刷 新</button>
                        <p style="width: auto;">
                            <button class="btn btn-xs btn-outline btn-success audit_staff" @click="fun()"><span class="glyphicon glyphicon-adjust"></span>部门审核</button>
                            <button class="btn btn-xs btn-outline btn-success add_staff"><span class="glyphicon glyphicon-plus"></span>新 增</button>
                            <button class="btn btn-xs btn-outline btn-success edit_staff"><span class="glyphicon glyphicon-edit"></span>修 改</button>
                        </p>
                        <!-- 二级 -->
                        <p>
                            <button class="btn btn-xs btn-outline btn-success accuse_staff" @click="fun()"><span class="glyphicon glyphicon-adjust"></span>质控审核</button>
                        </p>
                        <!-- 总 -->
                        <p>
                            <button class="btn btn-xs btn-outline btn-success audit_staff" @click="fun()"><span class="glyphicon glyphicon-adjust"></span>总经理审核</button>
                        </p>
                        <!-- 完成 -->
                        <p>
                            <button class="btn btn-xs btn-outline btn-success contract_staff"><span class="glyphicon glyphicon-check"></span>下推采购合同</button>
                        </p>
                        <!-- 不合格 -->
                        <p>
                            <button class="btn btn-xs btn-outline btn-success edit_staff"><span class="glyphicon glyphicon-edit"></span>修 改</button>
                        </p>
                        <button class="btn btn-xs btn-outline btn-success details_staff"><span class="glyphicon glyphicon-align-justify"></span>详 情</button>
                        <select class="form-control chosen-select btn-outline ele-BUT push_down" name="userId" id="useId" style="width:6%;" tabindex="2">
                            <option value="1">--本人--</option>
                            <option value="2">--所有--</option>
                        </select>
                    </div>
            <div class="table-responsive">
                <table id="staff" class="table table-bordered table-hover table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>供应商编号</th>
                        <th>负责人</th>
                        <th>供应商名称</th>
                        <th>营业执照</th>
                        <th>企业性质</th>
                        <th>法人代表</th>
                        <th>开户行</th>
                        <th>账号</th>
                        <th>审核状态</th>
                        <th>质控审核状态</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="ibox-content" id="app">
            <ul class="nav nav-tabs" role="tablist" v-if="unData">
                <li role="presentation" class="active"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">供应商联系信息</a></li>
                <li role="presentation"><a href="#education" aria-controls="education" role="tab" data-toggle="tab">地址信息</a></li>
                <li role="presentation"><a href="#qualification" aria-controls="qualification" role="tab" data-toggle="tab">资质信息</a></li>
                <li role="presentation"><a href="#development" aria-controls="development" role="tab" data-toggle="tab">获奖情况</a></li>
                <li role="presentation"><a href="#punish" aria-controls="punish" role="tab" data-toggle="tab">客户情况</a></li>
                <li role="presentation"><a href="#contract" aria-controls="contract" role="tab" data-toggle="tab">合作信息</a></li>
                <li role="presentation"><a href="#change" aria-controls="change" role="tab" data-toggle="tab">股权结构</a></li>
                <li role="presentation"><a href="#financeData" aria-controls="financeData" role="tab" data-toggle="tab">财务信息</a></li>
                <li role="presentation"><a href="#teamData" aria-controls="teamData" role="tab" data-toggle="tab">团队信息</a></li>
                <li role="presentation"><a href="#audit" aria-controls="audit" role="tab" data-toggle="tab">质控评估状态</a></li>
            </ul>
            <div class="tab-content"  v-if="unData">
                <div role="tabpanel" class="tab-pane active" id="contact">
                    <table class="table table-striped table-hover table-border">
                        <tr>
                            <th>联系人</th>
                            <th>姓名</th>
                            <th>电话</th>
                            <th>手机</th>
                            <th>传真</th>
                            <th>电子邮件</th>
                        </tr> 
                        <tr v-for="item in contact">
                            <td>{{item.contact_position  || ''}}</td>
                            <td>{{item.contact  || ''}}</td>
                            <td>{{item.telephone  || ''}}</td>
                            <td>{{item.phone  || ''}}</td>
                            <td>{{item.fax  || ''}}</td>
                            <td>{{item.e_mail  || ''}}</td>
                        </tr>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="education">
                    <table class="table table-striped table-hover table-border">
                        <tr>
                            <th>地址信息</th>
                            <th>地址描述</th>
                        </tr>
                        <tr v-for="item in address">
                            <td>{{item.address  || ''}}</td>
                            <td>{{item.addr_description  || ''}}</td>
                        </tr>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="qualification">
                        <table class="table table-striped table-hover table-border">
                            <tr>
                                <th>资质名称</th>
                                <th>颁发机构</th>
                                <th>生效时间</th>
                                <th>失效时间</th>
                                <th>证书状态</th>
                                <th>证书名称</th>
                                <th>证书预览</th>
                            </tr>
                            <tr v-for="item in certification">
                                <td>{{item.cer_name  || ''}}</td>
                                <td>{{item.issuing_authority  || ''}}</td>
                                <td>{{formatDateTime(item.start_time)  || ''}}</td>
                                <td>{{formatDateTime(item.stop_time)  || ''}}</td>
                                <td v-if="item.file_status === '0'">未上传</td>
                                <td v-else-if="item.file_status === '1'">已上传</td>
                                <td v-else>未知</td>
                                <td>{{item.file_name || ''}}</td>
                                <td>
                                    <el-button type="success" size="mini" @click="awardsLookUp(item)">预览证书</el-button>
                                </td>
                            </tr>
                        </table>
                    </div>
                <div role="tabpanel" class="tab-pane" id="financeData">
                        <table class="table table-striped table-hover table-border">
                            <tr>
                                <th>近两年盈利业绩</th>
                                <th>资产总额</th>
                                <th>主营收入</th>
                                <th>净利润</th>
                                <th>利润率</th>
                            </tr>
                            <tr v-for="item in finance">
                                <td>{{item.finance_year  || ''}}</td>
                                <td>{{item.total_assets  || ''}}</td>
                                <td>{{item.main_income  || ''}}</td>
                                <td>{{item.net_profit  || ''}}</td>
                                <td>{{item.profit_rat  || ''}}</td>
                            </tr>
                        </table>
                    </div>
                <div role="tabpanel" class="tab-pane" id="teamData">
                        <table class="table table-striped table-hover table-border">
                            <tr>
                                <th>类别</th>
                                <th>人员数量</th>
                                <th>备注</th>
                            </tr>
                            <tr v-for="item in team">
                                <td>{{item.team_cate  || ''}}</td>
                                <td>{{item.team_number  || ''}}</td>
                                <td>{{item.tips  || ''}}</td>
                            </tr>
                        </table>
                    </div>
                <div role="tabpanel" class="tab-pane" id="development">
                        <table class="table table-striped table-hover table-border">
                            <tr>
                                <th>获奖名称</th>
                                <th>颁发机构</th>
                                <th>获奖时间</th>
                                <th>记录人</th>
                                <th>证书状态</th>
                                <th>证书名称</th>
                                <th>证书预览</th>
                            </tr> 
                            <tr v-for="item in awards">
                                <td>{{item.awards_name  || ''}}</td>
                                <td>{{item.issuing_authority  || ''}}</td>
                                <td>{{formatDateTime(item.validity_time)  || ''}}</td>
                                <td>{{item.name  || ''}}</td>
                                <td v-if="item.file_status === '0'">未上传</td>
                                <td v-else-if="item.file_status === '1'">已上传</td>
                                <td v-else>未知</td>
                                <td>{{item.file_name || ''}}</td>
                                <td>
                                    <el-button type="success" size="mini" @click="previewAwardPdfLookUp(item)">预览证书</el-button>
                                </td>
                            </tr>
                        </table>
                    </div>
                
                <div role="tabpanel" class="tab-pane" id="punish">
                        <table class="table table-striped table-hover table-border">
                            <tr>
                                <th>客户名称</th>
                                <th>项目</th>
                                <th>联系人</th>
                                <th>电话</th>
                                <th>实施时间</th>
                                <th>项目金额</th>
                            </tr> 
                            <tr v-for="item in customer">
                                <td>{{item.cus_name  || ''}}</td>
                                <td>{{item.main_project  || ''}}</td>
                                <td>{{item.main_contact  || ''}}</td>
                                <td>{{item.main_phone  || ''}}</td>
                                <td>{{formatDateTime(item.project_exec_time)  || ''}}</td>
                               <td>{{item.project_amount  || ''}}</td>
                            </tr>
                        </table>
                    </div>

                <div role="tabpanel" class="tab-pane" id="contract">
                    <table class="table table-striped table-hover table-border">
                        <tr>
                            <th>机构名称</th>
                            <th>项目</th>
                            <th>联系人</th>
                            <th>电话</th>
                            <th>时间</th>
                            <th>项目金额</th>
                        </tr>
                        <tr v-for="item in cooperation">
                            <td>{{item.institution_name  || ''}}</td>
                            <td>{{item.main_project  || ''}}</td>
                            <td>{{item.main_contact  || ''}}</td>
                            <td>{{item.main_phone  || ''}}</td>
                            <td>{{formatDateTime(item.project_exec_time)  || ''}}</td>
                            <td>{{item.project_amount  || ''}}</td>
                        </tr>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="change">
                    <!-- <table class="table table-striped table-hover table-border table2000"> -->
                    <table class="table table-striped table-hover table-border">
                        <tr>
                            <th>股东名称</th>
                            <th>持股比例</th>
                            <th>变更时间</th>
                        </tr>
                        <tr v-for="item in equity">
                            <td>{{item.shareholder_name  || ''}}</td>
                            <td>{{item.shareholding_ratio  || ''}}</td>
                            <td>{{formatDateTime(item.update_time)  || ''}}</td>
                        </tr>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="audit">
                    <table class="table table-striped table-hover table-border">
                        <tr>
                            <th>审核名称</th>
                            <th>审核人</th>
                            <th>审核时间</th>
                            <th>备注</th>
                            <th>审核状态</th>
                            <th>证书名称</th>
                            <th>证书预览</th>
                        </tr>
                        <tr v-for="item in audit">
                            <td>{{item.type_name  || ''}}</td>
                            <td>{{item.name || ''}}</td>
                            <td>{{formatDateTime(item.audit_time) || ''}}</td>
                            <td>{{item.tips || ''}}</td>
                            <td v-if="item.status === '0'">未审核</td>
                            <td v-else-if="item.status === '1'">不合格</td>
                            <td v-else-if="item.status === '2'">合 格</td>
                            <td v-else-if="item.status === null">未知</td>
                            <td>{{item.file_name || ''}}</td>
                            <td>
                                <el-button type="success" size="mini" @click="previewSecondAuditPdfLookUp(item)">预览证书</el-button>
                            </td>
                </tr>
                    </table>
                </div>
            </div>
            <div class="notSelectData"  v-else>
                当前您没有选中数据或无数据
            </div>

            <!-- 一级审核 -->
            <el-dialog
                title="供应商审核："
                :visible.sync="dialogVisible_audit"
                width="30%"
                >
                <span>该供应商添加审核是否通过？</span>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="reviewButton(1)">不通过</el-button>
                    <el-button type="primary" @click="reviewButton(audit_jem)">通过</el-button>
                </span>
            </el-dialog>
            <!-- 二级级审核 -->
            <el-dialog title="需审核的内容：" :visible.sync="dialogTableVisible" width="70%">
                    <el-table :data="secondLevel" :highlight-current-row="true">
                        <el-table-column property="type_name" label="审核名称" width="160px"></el-table-column>
                        <el-table-column property="name" label="审核人"></el-table-column>
                        <el-table-column label="审核时间">
                            <template slot-scope="scope">
                                {{formatDateTime(scope.row.audit_time)}}
                            </template>
                        </el-table-column>
                        <el-table-column property="tips" label="备注"></el-table-column>
                        <el-table-column property="status" label="状态">
                            <template slot-scope="scope">
                                <div v-if="scope.row.status === '0'">未审核</div>
                                <div v-else-if="scope.row.status === '1'">不合格</div>
                                <div v-else-if="scope.row.status === '2'">合 格</div>
                                <div v-else-if="scope.row.status === null">未知</div>
                            </template>
                        </el-table-column>
                        <el-table-column property="address" label="操作">
                            <template slot-scope="scope">
                                <el-button type="warning" @click="approve(scope.row,scope.$index,scope.row.status,scope.row.id,scope.row.tips,scope.row.file_id)">审 核</el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </el-dialog>
    
                <!-- 二级 审核 再弹框 -->
                <el-dialog title="质控审核确认：" :visible.sync="dialogTableVisible_Movers" width="70%">
                    <el-table :data="inssfsdf">
                      <el-table-column property="type_name" label="审核名称" width="170"></el-table-column>
                      <el-table-column label="审核备注" width="400">
                          <template  slot-scope="scope">
                              <el-input type="textarea" v-model="two_tips"></el-input>
                          </template>
                      </el-table-column>
                      <el-table-column label="上传附件"  width="100">
                          <template  slot-scope="scope">
                              <el-upload
                                  class="uploadResume"
                                  action="<?php echo U('/dwin/purchase/upload');?>"
                                  :data="upLoadData"
                                  :on-success="papersUploadSuccess"
                                  :on-error="uploadError"
                                  :auto-upload="true"
                                  >
                                  <el-button size="small" type="primary" @click="clickUpdata_award()">上传证书</el-button>
                                  <span style="margin-left: 10px;color:green" v-if="updata_howSUCCESS">上传成功</span>
                                  <span style="margin-left: 10px;color:red" v-if="updata_howERRER">上传失败</span>
                              </el-upload>
                          </template>
                      </el-table-column>
                      <el-table-column label="操作">
                          <template  slot-scope="scope">
                              <el-button type="warning" size="mini" @click="checke_yes(1)">不合格</el-button>
                              <el-button type="success" size="mini" @click="checke_yes(2)">合<span>&nbsp;&nbsp;</span> 格</el-button>
                          </template>
                      </el-table-column>
                    </el-table>
                  </el-dialog>
            <!-- 修改选项 弹框 -->
            <el-dialog title="请选择你所修改的项：" class="selsctDialog" :visible.sync="dialogVisible" width="35%">
                <el-row>
                    <el-col :span="8" :offset="1">
                        <el-button type="primary" @click="eleClick_that(0)">基本信息</el-button>
                    </el-col>
                    <el-col :span="8">
                        <el-button type="primary" @click="eleClick_that(1)">地址信息</el-button>
                    </el-col>
                    <el-col :span="7">
                        <el-button type="primary" @click="eleClick_that(2)">获奖情况</el-button>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="8" :offset="1">
                        <el-button type="primary" @click="eleClick_that(4)">股权信息</el-button>
                        
                    </el-col>
                    <el-col :span="8">
                        <el-button type="primary" @click="eleClick_that(5)">财务信息</el-button>
                        
                    </el-col>
                    <el-col :span="7">
                        <el-button type="primary" @click="eleClick_that(6)">资质认证</el-button>
                        
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="8" :offset="1">
                        <el-button type="primary" @click="eleClick_that(3)">客户信息</el-button>
                    </el-col>
                    <el-col :span="8">
                            <el-button type="primary" @click="eleClick_that(7)">团队信息</el-button>
                    </el-col>
                    <el-col :span="7">
                        <el-button type="primary" @click="eleClick_that(8)">合作情况</el-button>
                    </el-col>
                </el-row>
                <el-row style="margin-bottom: 24px">
                    <el-col :span="22"  :offset="1">
                        <el-button type="primary" @click="eleClick_that(9)">联系人信息</el-button>
                    </el-col>
                </el-row>
            </el-dialog>

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
<!-- <script src="/Public/html/js/vue-fab.js"></script> -->

<script>
    var auditMsg = <?php echo (json_encode($auditMsg)); ?>;
    var secondAuditMsg = <?php echo (json_encode($secondAuditMsg)); ?>;
    var filterFlag = <?php echo (json_encode($checkFlag)); ?>;
    var table = $('#staff'). DataTable({
        ajax: {
            type: 'post',
            data: {
                function(){
                    if(obj){
                        obj.currentId = ''
                        obj.current_id    = '' 
                        obj.current_status = ''
                        vm.contact = []
                        vm.address = []
                        vm.awards = []
                        vm.audit = []
                        vm.certification = []
                        vm.contact = []
                        vm.cooperation = []
                        vm.customer =  []
                        vm.equity =  []
                        vm.finance = []
                        vm.team = []
                        vm.unData = false
                    }
                },
                staffLimit (){
                    return document.getElementById('useId').value;
                },
                audit_status: function () {
                    return document.getElementById('orderType').value;
                }
            },
        },
        "scrollY": 440,
        "scrollX": false,
        "scrollCollapse": true,
        "destroy"      : true,
        "paging"       : true,
        "autoWidth"	   : false,
        "pageLength": 25,
        serverSide: true,
        // order:[[21, 'desc']],
        columns: [
            {searchable: true, data: 'supplier_id'},
            {searchable: true, data: 'charge_name'},
            {searchable: true, data: 'supplier_name'},
            {searchable: true, data: 'business_licence'},
            {searchable: false, data: 'enterprise_cate'},
            {searchable: false, data: 'legal_name'},
            {searchable: false, data: 'account_bank'},
            {searchable: true, data: 'account_number'},
            {searchable: true, data: 'audit_status', render: function (data){return auditMsg[data]}},
            {searchable: true, data: 'second_audit', render: function (data){return secondAuditMsg[data]}}
        ],
        'fnRowCallback':function(nRow,aData,iDisplayIndex,iDisplayIndexFull){
            /*
                nRow:每一行的信息 tr  是Object
                aData：行 index
            */
            for(let key in nRow){
                var AD_ad = nRow['childNodes'][nRow['childNodes'].length - 2]
                var AD_sa = nRow['childNodes'][nRow['childNodes'].length - 1] 
                if(AD_ad.innerText == auditMsg[0]){
                    $(AD_ad).css('color','blue')
                }else if(AD_ad.innerText == auditMsg[1]){
                    $(AD_ad).css('color','red')
                }else if(AD_ad.innerText == auditMsg[2]){
                    $(AD_ad).css('color','#CC66CC')
                }else{
                    $(AD_ad).css('color','green')
                }
                if(AD_sa.innerText == secondAuditMsg[0]){
                    $(AD_sa).css('color','blue')
                }else if(AD_sa.innerText == secondAuditMsg[1]){
                    $(AD_sa).css('color','red')
                }else{
                    $(AD_sa).css('color','green')
                }
            }
        },
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
    // my/we
    $('.push_down').on('change', function () {
        table.ajax.reload()
    })
    var obj = {
        currentId:"",
        current_id:"",
        current_status:'',
        currentData:[],
        selectedObj:{},
        tabClickDiv : $('.change-css'),
        tabActiveDiv : $(".active-css"),
        kElement : document.getElementById("orderType"),
        tabMouseEnter: function (val) {
            var that = this;
            this.initData(that,false);
            this.tabClickDiv.removeClass('hover-css');
            this.tabClickDiv.children('a').removeClass('hover-css');
            val.children('a').addClass('hover-css');
            val.addClass('hover-css');
        },
        tabMouseLeave:function() {
            var that = this;
            this.initData(that,false);
            this.tabClickDiv.removeClass('hover-css');
            this.tabClickDiv.children('a').removeClass('hover-css');
        },
        tabClick:function (val) {
            var that = this;
            this.initData(that,false);
            this.tabClickDiv.removeClass('active-css');
            this.tabClickDiv.children('a').removeClass('active-css-child');
            val.children('a').addClass('active-css-child');
            val.addClass('active-css');
            var tmpOrderType = document.getElementById("orderType");
            tmpOrderType.value = $(".active-css").attr('data-id');
            table.ajax.reload();
            this.destroyData();
        },
        tbodyTrClick:function (val,that) {
            this.initData(that,true);
            $('tr').removeClass('selected')
            val.addClass('selected')
            vm.getButtonTitle(this.currentId)
        },
        destroyData: function () {
            vm.contact = [];
            vm.orderId = "";
            this.orderId       = "",
            this.currentId      = "",
            this.current_id    = '',
            this.current_status = '',
            this.currentData    = [],
            this.selectedObj   = {},
            this.tabClickDiv   =  "",
            this.tabActiveDiv  =  "",
            this.kElement      =  ""
        },
        initData : function (that, flag) {
            this.tabClickDiv =  $('.change-css');
            this.tabActiveDiv =  $(".active-css")
            this.kElement =  document.getElementById("orderType")
            if (flag === true && table.row(that).data()) {
                obj.currentData  = table.row(that).data();
                obj.currentId = obj.currentData.id
                obj.current_id    = obj.currentData.supplier_id;   // 订单主键
                obj.current_status = obj.currentData.audit_status
                
            }
        }
    }

    obj.tabClickDiv.on('mouseenter', function () {
        obj.selectedObj = $(this);
        obj.tabMouseEnter(obj.selectedObj);
    });
    obj.tabClickDiv.on('mouseleave', function () {
        obj.tabMouseLeave();
    });
    obj.tabClickDiv.on('click', function () {
        obj.selectedObj = $(this);
        obj.tabClick(obj.selectedObj);
    });
    $('tbody').on('click', 'tr', function () {
        var that = this;
        var objThis = $(this);
        obj.tbodyTrClick(objThis,that);
    })
    // 选中一行
    var currentId
    var current_id
    var current_status
    // var id
    var currentData
    // 切换操作行
    $('.title_top').children('p:eq(0)').css('display',"inline")
    $('.title_top').children('p:eq(0)').siblings('p').css('display',"none")
    function outbound(val){
        switch(val){
            case val:
                $('.title_top').children('p:eq('+ (val - 1) +')').css('display',"inline")
                $('.title_top').children('p:eq('+ (val - 1) +')').siblings('p').css('display',"none")
                break
        }
    }
    var vm = new Vue({
        el: '#app',
        data: function () {
            return {
                // gridData: [],
                dialogVisible_audit:false,
                centerDialogVisible:false,
                dialogTableVisible:false,
                dialogTableVisible_Movers:false,
                address: [],
                awards:[],
                audit: [],
                certification: [],
                contact: [],
                cooperation: [],
                customer: [],
                equity: [],
                finance: [],
                team: [],
                employeeDevelopment: {
                    allData: [],
                    currentData: [],
                    pageSize: 10,
                    page: 1,
                    total: 0
                },
                punish: {
                    allData: [],
                    currentData: [],
                    pageSize: 10,
                    page: 1,
                    total: 0
                },
                inssfsdf :[],
                two_tips:'',
                upLoadData:{
                    type:''
                },
                data_save : {
                    supplierPid : '',
                    status : '',
                    id : '',
                    tips : '',
                    file_id : ''
                },
                secondLevel:[],
                selectButton:[
                    '供应商基本信息',
                    '供应商地址信息',
                    '供应商获奖情况',
                    '供应商客户信息',
                    '供应商股权信息',
                    '供应商财务信息',
                    '供应商资质认证信息',
                    '供应商团队信息',
                    '供应商合作情况信息',
                    '供应商联系人信息'
                ],
                // 修改 页面title名定义
                cols:[],
                tableData:[],
                base_head:[],
                base_title:[ "供应商编号",  "供应商名称", "营业执照", "营业范围", "企业性质", "法人代表", "开户行", "账号", "创建人", "审核状态"],
                address_title:['地址信息','地址描述'],
                contact_title:["联系人","姓名","电话","手机","传真","电子邮件"],
                certification_title:["资质名称","颁发机构", "起止时间","上传证书状态"],
                awards_title:["获奖名称","颁发机构","时间","记录人","上传证书状态"],
                customer_title:["客户名称","项目","联系人","电话","实施时间","项目金额"],
                equity_title:["股东名称","持股比例","变更时间"],
                finance_title:["近两年盈利业绩","资产总额","主营收入","净利润","利润率"],
                team_title:["类别","人员数量","备注"],
                cooperation_title:["机构名称","项目","联系人","电话","时间","项目金额"],
                tbody_tr:[],
                tbody_show:'',
                this_type:'',
                indexs:'',
                dialogVisible:false,
                updata_howSUCCESS:false,
                updata_howERRER:false,
                unData:false,
                audit_jem:1
            }
        },
        created(){
            if(!filterFlag){
                $('.push_down').css('display','none')
            }
        },
        computed:{
            
        },
        watch:{
            dialogTableVisible_Movers:function(newVUE,oldVUE){
                if(!newVUE){
                    this.two_tips = ''
                }
            },
            dialogVisible:function(newVUE,oldVUE){
                if(!newVUE){
                    table.ajax.reload()
                }
            },
            dialogTableVisible:function(newValue,oldValue){
                if(!newValue){
                    table.ajax.reload()
                }
            }
        },
        methods: {
            // 获取数据 调用方法 封装
            getButtonTitle (currentId ){
                $.post('/Dwin/Purchase/getSupplierAllMsg', {id: currentId }, function (res) {
                    vm.unData = true
                    vm.address = res.data.address
                    vm.awards = res.data.awards
                    vm.audit = res.data.audit
                    vm.certification = res.data.certification
                    vm.contact = res.data.contact
                    vm.cooperation = res.data.cooperation
                    vm.customer = res.data.customer
                    vm.equity = res.data.equity
                    vm.finance = res.data.finance
                    vm.team   = res.data.team
                })
            },
            // 资质文件 预览LOOK
            awardsLookUp(item){
                if(item.file_url == null||item.file_url == ''){
                    layer.msg('没有找到文件！')
                }else{
                    if(item.file_type == 'pdf'){
                        window.open('<?php echo U("previewCerPdf", [], "");?>/id/' + item.id)
                    }else{
                        window.open(item.file_url)
                    }
                }
            },
            // 奖励证书 预览LOOK
            previewAwardPdfLookUp(item){
                if(item.file_url == null||item.file_url == ''){
                    layer.msg('没有找到文件！')
                }else{
                    if(item.file_type == 'pdf'){
                        window.open('<?php echo U("previewAwardPdf", [], "");?>/id/' + item.id)
                    }else{
                        window.open(item.file_url)
                    }
                }
            },
            // 质控审核 预览LOOK
            previewSecondAuditPdfLookUp(item){
                if(item.file_url == null||item.file_url == ''){
                    layer.msg('没有找到文件！')
                }else{
                    if(item.file_type == 'pdf'){
                        window.open('<?php echo U("previewSecondAuditPdf", [], "");?>/id/' + item.id)
                    }else{
                        window.open(item.file_url)
                    }
                }
            },
            clickItem: function (params) {

            },
            clickMainBtn: function () {

            },
            changeDevelopPage: function (page) {
                this.employeeDevelopment.page = page
                var start = (this.employeeDevelopment.page - 1) * this.employeeDevelopment.pageSize
                var end = page * this.employeeDevelopment.pageSize
                this.employeeDevelopment.currentData = this.employeeDevelopment.allData.slice(start, end)
            },
            changePunishPage: function (page) {
                this.punish.page = page
                var start = (this.punish.page - 1) * this.punish.pageSize
                var end = page * this.punish.pageSize
                this.punish.currentData = this.punish.allData.slice(start, end)
            },
             // 合格 / 不合格   二级审核
             checke_yes(vul){
                vm.data_save = {
                    supplierPid : obj.currentId,
                    status : vul,
                    id : this.uploadID,
                    tips : this.two_tips,
                    file_id : vm.data_save.file_id
                }
                var data = vm.data_save
                $.ajax({
                    url:'/dwin/purchase/secondAuditSupplier',
                    type:'post',
                    dataType:'json',
                    data:data,
                    success:function (res) {
                        if(res.status === 200){
                            vm.dialogTableVisible_Movers = false
                            var data = {
                                'id' : obj.currentId,
                                'type' : 'audit'
                            }
                            $.ajax({
                                url:'/dwin/purchase/supplierOtherMsg',
                                type:'post',
                                dataType:'json',
                                data:data,
                                success:function (res) {
                                    if(res.status === 200){
                                        var getData = res.data
                                        vm.secondLevel = getData
                                    }
                                }
                            })
                        }
                        layer.msg(res.msg)
                    }
                })
            },
            // 点击审核再弹框
            approve(row,index,status,id,tips,file_id){
                this.data_save.file_id = row.file_id
                this.upLoadData.type = ''
                this.inssfsdf.length = 0
                this.inssfsdf.push(this.secondLevel[index])
                vm.dialogTableVisible_Movers = true
                this.two_tips = tips,
                this.upLoadData.type = index + 3
                this.uploadID = id
                this.updata_howSUCCESS = false
                this.updata_howERRER = false
            },
            //  点击上传 资质文件
            clickUpdata_award(){

            },
            //  上传文件  成功回调  => 资质认证
            papersUploadSuccess (res,file) {
                this.updata_howSUCCESS = false
                this.updata_howERRER = false
                if(res.status == 200){
                    this.data_save.file_id = res.data.id
                    this.updata_howSUCCESS = true
                }else{
                    this.updata_howERRER = true
                }
                layer.msg(res.msg)
            },
            //  上传文件 失败 回调 => 资质认证
            uploadError (res) {
            },
            // 选择选中项 => ajax => 渲染页面
            eleClick_that (floor) {
                if(floor === 0){
                    var index = layer.open({
                        type: 2,
                        title: '修改供应商基本信息',
                        content: '/Dwin/Purchase/getSupplier?id=' + obj.currentId ,
                        area: ['90%', '90%'],
                        shadeClose:true,
                        end: function () {
                            // table.ajax.reload()
                            vm.getButtonTitle(obj.currentId )
                        }
                    })
                } else if (floor === 1) {
                    var index = layer.open({
                        type: 2,
                        title: '修改供应商地址信息',
                        content: '/Dwin/Purchase/getAddress?id= ' + obj.currentId ,
                        area: ['90%', '90%'],
                        shadeClose:true,
                        end: function () {
                            // table.ajax.reload()
                            vm.getButtonTitle(obj.currentId )
                        }
                    })
                } else if (floor === 2) {
                    var index = layer.open({
                        type: 2,
                        title: '修改供应商获奖信息',
                        content: '/Dwin/Purchase/getAwards?id= ' + obj.currentId ,
                        area: ['90%', '90%'],
                        shadeClose:true,
                        end: function () {
                            // table.ajax.reload()
                            vm.getButtonTitle(obj.currentId )
                        }
                    })
                } else if (floor === 3) {
                    var index = layer.open({
                        type: 2,
                        title: '修改供应商客户信息',
                        content: '/Dwin/Purchase/getCustomer?id= ' + obj.currentId ,
                        area: ['90%', '90%'],
                        shadeClose:true,
                        end: function () {
                            // table.ajax.reload()
                            vm.getButtonTitle(obj.currentId )
                        }
                    })
                } else if (floor === 4) {
                    var index = layer.open({
                        type: 2,
                        title: '修改供应商股权信息',
                        content: '/Dwin/Purchase/getEquity?id= ' + obj.currentId ,
                        area: ['90%', '90%'],
                        shadeClose:true,
                        end: function () {
                            // table.ajax.reload()
                            vm.getButtonTitle(obj.currentId )
                        }
                    })
                } else if (floor === 5) {
                    var index = layer.open({
                        type: 2,
                        title: '修改供应商财务信息',
                        content: '/Dwin/Purchase/getFinance?id= ' + obj.currentId ,
                        area: ['90%', '90%'],
                        shadeClose:true,
                        end: function () {
                            // table.ajax.reload()
                            vm.getButtonTitle(obj.currentId )
                        }
                    })
                }else if (floor === 6) {
                    var index = layer.open({
                        type: 2,
                        title: '修改供应商资质认证信息',
                        content: '/Dwin/Purchase/getCertification?id= ' + obj.currentId ,
                        area: ['90%', '90%'],
                        shadeClose:true,
                        end: function () {
                            // table.ajax.reload()
                            vm.getButtonTitle(obj.currentId )
                        }
                    })
                } else if (floor === 7) {
                    var index = layer.open({
                        type: 2,
                        title: '修改供应商团队信息',
                        content: '/Dwin/Purchase/getTeam?id= ' + obj.currentId ,
                        area: ['90%', '90%'],
                        shadeClose:true,
                        end: function () {
                            // table.ajax.reload()
                            vm.getButtonTitle(obj.currentId )
                        }
                    })
                }else if (floor === 8) {
                    var index = layer.open({
                        type: 2,
                        title: '修改供应商合作信息',
                        content: '/Dwin/Purchase/getCooperation?id= ' + obj.currentId ,
                        area: ['90%', '90%'],
                        shadeClose:true,
                        end: function () {
                            // table.ajax.reload()
                            vm.getButtonTitle(obj.currentId )
                        }
                    })
                }else if (floor === 9) {
                    var index = layer.open({
                        type: 2,
                        title: '修改供应商联系人信息',
                        content: '/Dwin/Purchase/getContact?id= ' + obj.currentId ,
                        area: ['90%', '90%'],
                        shadeClose:true,
                        end: function () {
                            // table.ajax.reload()
                            vm.getButtonTitle(obj.currentId )
                        }
                    })
                }
            },
             // 合格/不合格
            reviewButton(vul){
                    var data={"id":obj.currentId ,"status":vul};
                    ajax_pack('/dwin/purchase/firstAuditSupplier','post',data)
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
    // 刷新
    $('.refresh').on('click', function () {
        table.order([[5, 'desc']])
        table.ajax.reload()
    })
    //关闭  一级审核 遮罩 h
    function closeBg() {
        $("#fullbg,#dialog").hide();
    }
    //关闭 二级审核弹框 遮罩
    function closeBg_secondTime() {
        $("#fullbg_secondTime,#dialog_secondTime").hide();
    }
    //关闭 二级审核 再弹框 遮罩
    function closeBg_thereTime() {
        $("#fullbg_thereTime,#dialog_thereTime").hide();
    }
    //关闭 修改 选择层 遮罩
    function closeBg_select() {
        $("#fullbg_select ,#dialog_select ").hide();
    }
    //关闭 修改 编辑层 遮罩 select
    function closeBg_revamp() {
        $("#fullbg_revamp,#dialog_revamp").hide();
        vm.tbody_tr = []
        vm.indexs = ''
    }
    //关闭 最终确认 
    function closeBg_sureToSubmit() {
        $("#fullbg_sureToSubmit,#dialog_sureToSubmit").hide(); 
        vm.tbody_tr = []
    }
    // 添加
    $('.add_staff').on('click', function () {
        var index = layer.open({
            type: 2,
            title: '添加供应商信息',
            content: '/Dwin/Purchase/addSupplier?',
            area: ['90%', '98%'],
            shadeClose:true,
            end: function () {
                table.ajax.reload()
            }
        })
    })
    // 修改
    $('.edit_staff').on('click', function () {
        if (obj.current_id  ===  undefined || !obj.current_id){
            layer.msg('请选择一家供应商')
        } else {
            vm.dialogVisible = true
        }
    })
    // 详情页
    $('.details_staff').on('click', function () {
        if (obj.current_id  ===  undefined || !obj.current_id){
            layer.msg('请选择一家供应商')
        } else {
            var index = layer.open({
                type: 2,
                title: '供应商信息详情',
                // content: '/Dwin/Purchase/getAddPurchaseContract?id=' + obj.currentId ,
                content: '/Dwin/Purchase/supplierDetail?id=' + obj.currentId ,
                area: ['90%', '90%'],
                shadeClose:true,
                shift:1,
                end: function () {
                    table.ajax.reload()
                }
            })
        }
    })
    // 采购合同
    $('.contract_staff').on('click', function () {
        if (obj.current_id  ===  undefined || !obj.current_id){
            layer.msg('请选择一家供应商')
        } else {
            if (obj.current_status == 3) {
                var index = layer.open({
                    type: 2,
                    title: '采购合同信息',
                    content: '/Dwin/Purchase/addContract?supplierId=' + obj.currentId ,
                    area: ['90%', '90%'],
                    shadeClose:true,
                    end: function () {
                        table.ajax.reload()
                    }
                })
            }else if(obj.current_status == 1){
                layer.msg('该供应商审核不合格！')
            }else{
                layer.msg('该供应商还没审核完毕！')
            }
        }
    })
    // 部门审核
    $('.audit_staff').on('click', function () {
        if (obj.current_id  ===  undefined || !obj.current_id){
            layer.msg('请选择一家供应商')
        } else {
            vm.audit_jem = 1
            if(document.getElementById('orderType').value == 1){
                vm.audit_jem = vm.audit_jem + Number(document.getElementById('orderType').value);
            }else{
                vm.audit_jem = 3;
            }
            vm.dialogVisible_audit = true
        }
    })
    // 质控审核
    $('.accuse_staff').on('click', function () {
        if (obj.current_id === undefined || !obj.current_id){
            layer.msg('请选择一家供应商')
        } else {
            var data = {
                'id' : obj.currentId,
                'type' : 'audit'
            }
            $.ajax({
                url:'/dwin/purchase/supplierOtherMsg',
                type:'post',
                dataType:'json',
                data:data,
                success:function (res) {
                    if(res.status === 200){
                        var getData = res.data
                        vm.secondLevel = getData
                    }
                }
            })
            vm.dialogTableVisible = true
        }
    })
    // ajax封装
    function ajax_pack(url,way,data){
        $.ajax({
            url:url,
            type:way,
            dataType:'json',
            data:data,
            success:function (res) {
                if(res.status == 200){
                    table.ajax.reload()
                    vm.dialogVisible_audit = false
                    this.audit_jem = 1
                }
                layer.msg(res.msg)
            }
        })
    }

</script>
</body>
</html>