<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新项目公示</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/Public/html/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <style type="text/css">
        html {
            color: black;}
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <form id="iform">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <h3>新项目公示</h3>
                            <div class="form-group">
                                <div>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th colspan="7"><span style="color: black;">项目基本信息</span></th>
                                        </tr>
                                        <tr>
                                            <td>项目名称</td>
                                            <td>客户名称</td>
                                            <td>研发内容</td>
                                            <td>项目计划启动日期</td>
                                            <td>预计完成日期</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="input-group">
                                                    <input id="proName" name="proname" type="text" placeholder="xxx研发项目..." class="form-control proName"/>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <select name="customer_id" id="customerId"  data-placeholder="..." class="chosen-select" tabindex="2">
                                                        <option value="">请选择项目客户</option>
                                                        <option value="500000">迪文内部项目</option>
                                                        <?php if(is_array($cus)): $i = 0; $__LIST__ = $cus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option name="<?php echo ($vol["cname"]); ?>" value="<?php echo ($vol["cid"]); ?>" hassubinfo="true"><?php echo ($vol["cname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <select name="prjType" id="prjType" data-placeholder="选择项目研发类型" class="chosen-select" multiple="multiple" style="width: 200px;" tabindex="4">
                                                        <option value="1">硬件开发</option>
                                                        <option value="2">软件开发</option>
                                                        <option value="3">美工项目</option>
                                                    </select>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="input-group">
                                                    <input type="text" id="protime" onclick="WdatePicker( {el:this,dateFmt:'yyyy-MM-dd'} )" class="form-control"/>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" id="prjDLine" onclick="WdatePicker( {el:this,dateFmt:'yyyy-MM-dd'} )" class="form-control"/>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th colspan="7"><span style="color: black;">项目绩效信息</span></th>
                                        </tr>
                                        <tr>
                                            <td>研发费(元)</td>
                                            <td>维护(元)</td>
                                            <td>方案/临时(元)</td>
                                            <td>PCB设计(元)</td>
                                            <td>代码设计(元)</td>
                                            <td>文档撰写(元)</td>
                                            <td>项目总绩效(元)</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><input id="prjPrice" name="proprice" type="number" placeholder="" class="form-control checkNum"/></td>
                                            <td><input id="prjMaint" name="prjMaint" type="number" placeholder="" class="form-control checkNum"/></td>
                                            <td><input id="prjTemp" name="prjTemp" type="number" placeholder="" class="form-control checkNum"/></td>
                                            <td><input id="prjPCB" name="prjPCB" type="number" placeholder="" class="form-control checkNum"/></td>
                                            <td><input id="codeDesign" name="codeDesign" type="number" placeholder="" class="form-control checkNum"/></td>
                                            <td><input id="docWrite" name="docWrite" type="number" placeholder="" class="form-control checkNum"/></td>
                                            <td><input id="bonus" name="bonus" type="number" class="form-control"/></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-group">
                                    <h4 style="color: black;">需求信息（请尽量详细）</h4>
                                    <div class="form-group">
                                        <textarea style=" height: 75px; width:100%; font-size: 14px;" name="detail" id="proNeeds"></textarea>
                                    </div>
                                    <input class="btn btn-info" type="button" id="sub" value="提交" onclick="getSubmitInfo()">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<script src="/Public/html/js/jquery-1.11.3.min.js"></script>
<script src="/Public/html/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/Public/html/js/demo/form-advanced-demo.min.js"></script>
<script src="/Public/html/js/dwin/WdatePicker.js"></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script type="text/javascript">
    var checkText  = [];
    var checkVal   = [];


    // 获取多选下拉菜单中的数组，并且显示对应的input框
        $("#prjType").change(function(){

            checkText   = [];
            checkVal    = [];

            $('#prjType :selected').each(function(i, selected){
                checkText[i] = $(selected).text();
            });
            $('#prjType :selected').each(function(i, selected){
                checkVal[i]  = $(selected).val();
            });
            console.log(checkVal);
        return checkText,checkVal;
    });

    function isEmpty(data)
    {
        if (data == "") {
            return 0;
        } else {
            return data;
        }
    }
    $(".checkNum").on('change', function () {
        var _proPrice      = parseInt(isEmpty($("#prjPrice").val()) ? $("#prjPrice").val() : 0);
        var _prjMaint      = parseInt(isEmpty($("#prjMaint").val()) ? $("#prjMaint").val() : 0);
        var _prjTemp       = parseInt(isEmpty($("#prjTemp").val()) ? $("#prjTemp").val() : 0);
        var _prjPCB        = parseInt(isEmpty($("#prjPCB").val()) ? $("#prjPCB").val() : 0);
        var _codeDesign    = parseInt(isEmpty($("#codeDesign").val()) ? $("#codeDesign").val() : 0);
        var _docWrite      = parseInt(isEmpty($("#docWrite").val()) ? $("#docWrite").val() : 0);
        var _total = _proPrice * 0.45  + _prjMaint + _prjTemp + _prjPCB + _codeDesign + _docWrite;
        $("#bonus").val(_total);
    });

    function getSubmitInfo(){
        //增加项目完成时间
        var _proName       = $("#proName").val();
        var _customerid    = $("#customerId").val();
        var _proNeeds      = $("#proNeeds").val();
        var _protime       = $("#protime").val();
        var _prjDLine      = $("#prjDLine").val();
        var _auditid       = $("#auditid").val();
        var _bonus         = $("#bonus").val();
        var _proPrice      = parseInt(isEmpty($("#prjPrice").val()) ? $("#prjPrice").val() : 0);
        var _prjMaint      = parseInt(isEmpty($("#prjMaint").val()) ? $("#prjMaint").val() : 0);
        var _prjTemp       = parseInt(isEmpty($("#prjTemp").val()) ? $("#prjTemp").val() : 0);
        var _prjPCB        = parseInt(isEmpty($("#prjPCB").val()) ? $("#prjPCB").val() : 0);
        var _codeDesign    = parseInt(isEmpty($("#codeDesign").val()) ? $("#codeDesign").val() : 0);
        var _docWrite      = parseInt(isEmpty($("#docWrite").val()) ? $("#docWrite").val() : 0);

        var _prjType       = checkVal;
        var _prjTypeName     = checkText;
        if (_proName == "") {layer.alert('项目名称未填写', {icon : 5});return false;}
        if (_customerid == "") {layer.alert('未选择客户', {icon : 5});return false;}
        if (_prjType == "") {layer.alert('未选择项目类型', {icon : 5});return false;}
        if (_protime == "") {layer.alert('项目开始时间未填写', {icon : 5});return false;}
        if (_prjDLine == "") {layer.alert('项目完成时间未填写', {icon : 5});return false;}
        if (_bonus == "") {layer.alert('绩效为空！', {icon : 5});return false;}
        if (_auditid == "") {layer.alert('未选择项目审核人',{icon:5});return false;}
        $.ajax({
            type:'POST',
            url : "/Dwin/Research/addPublicPrj",
            data: {
                        proname           :  _proName,
                        proneeds          :  _proNeeds,
                        protime           :  _protime,
                        prjdtime          :  _prjDLine,
                        auditorid         :  _auditid,
                        customerid        :  _customerid,
                        proprice          :  _proPrice,
                        promaint          :  _prjMaint,
                        protemp           :  _prjTemp,
                        propcb            :  _prjPCB,
                        codedesign        :  _codeDesign,
                        docwrite          :  _docWrite,
                        performancebonus  :  _bonus,
                        pids              :  _prjType,
                        pnames            :  _prjTypeName
                  },
            success : function(msg){
                    if (msg == 1) {
                        layer.msg(
                            '添加成功',
                            {
                                icon : 6,
                                time : 1000
                            },
                            function () {
                                window.location.href = "/Dwin/Research/showOwnPrj/k/1";
                            }
                        );
                    } else {
                        layer.msg('数据有误，添加失败');
                    }
            }
        });
    }


</script>
</body>
</html>