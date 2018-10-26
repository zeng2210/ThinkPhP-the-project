<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新项目申请</title>
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
                            <h3>公示项目立项</h3>
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
                                            <td>研发部门</td>
                                            <td>项目启动日期</td>
                                            <td>预计完成日期</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="input-group">
                                                    <select name="proname" id="proName"  data-placeholder="..." class="proName chosen-select" tabindex="2">
                                                    <option value="">请选立项项目</option>
                                                    <?php if(is_array($prjData)): $i = 0; $__LIST__ = $prjData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option name="<?php echo ($vol["proname"]); ?>" value="<?php echo ($vol["proid"]); ?>" hassubinfo="true"><?php echo ($vol["proname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <select name="customer_id" id="customerId"  data-placeholder="..." class="chosen-select" tabindex="2">
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <select name="department" id="department0_0" data-placeholder="..." class="chosen-select" tabindex="2">
                                                        <option value="">请选择项目研发部门</option>
                                                        <?php if(is_array($dept)): $i = 0; $__LIST__ = $dept;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option name="<?php echo ($vol["name"]); ?>" value="<?php echo ($vol["id"]); ?>" hassubinfo="true"><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
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
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th colspan="7"><span style="color: black;">研发人员及绩效分配(百分比)</span></th>
                                        </tr>
                                        <tr>
                                            <td>参与人</td>
                                            <td>绩效分配(%)</td>
                                            <td>审核人</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="input-group">
                                                    <select name="partner" id="department1_0" data-placeholder="选择项目参与人" class="chosen-select" multiple="multiple" style="width: 200px;" tabindex="4">
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" id="jixiao"></div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <select id="auditid" name="auditid" data-placeholder="选择审核人..." class="chosen-select" tabindex="2">
                                                        <option value="">请选择审核人</option>
                                                        <?php if(is_array($audit)): $i = 0; $__LIST__ = $audit;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option name="<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <h4 style="color: black;">备注信息（项目需求等）</h4>
                                    <div class="form-group">
                                        <textarea style=" height: 75px; width:100%; font-size: 14px;" name="detail" id="proNeeds"></textarea>
                                    </div>
                                    <input type="button" id="sub" value="提交" onclick="getSubmitInfo()">
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
    var jixiaolist = [];
    var _proPrice, _prjMaint, _prjTemp, _prjPCB, _codeDesign, _docWrite, _total;

    // 获取多选下拉菜单中的数组，并且显示对应的input框
        $("#department1_0").change(function(){
            var liInner = '';
            checkText   = [];
            checkVal    = [];

            $('#department1_0 :selected').each(function(i, selected){
                checkText[i] = $(selected).text();
            });
            $('#department1_0 :selected').each(function(i, selected){
                checkVal[i]  = $(selected).val();
            });
            if (checkVal.length != 0) {
                for( var i = 0; i < checkText.length; i++){
                        liInner  += checkText[i] + "<br/>" + "<input type='number' class='form-control jixiaolist' name='" + checkVal[i] + "'><br/>";
                    }
            } else {
                liInner = "";
            }
                $("#jixiao").html('');
                $("#jixiao").html(liInner);
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
    var cusId    = $('#customerId');
    var deptSel  = $('#department1_0');
    var proT     = $("#protime");
    var prjDLine = $("#prjDLine");
    var prjPrice = $("#prjPrice");
    var prjMaintain = $("#prjMaint");
    var prjTemp = $("#prjTemp");
    var prjPcb = $("#prjPCB");
    var codeDesign = $("#codeDesign");
    var docWrite = $("#docWrite");
    var proNeeds = $("#proNeeds");
    // 选择项目后进行返回数据
    $("#proName").on('change', function() {
        var pid = $(this).val();
        $.ajax({
            type : 'POST',
            url : "/Dwin/Research/addProject",
            data : {
                prjId : pid
            },
            success : function (msg) {
                console.log(msg);
                var option_str = '', partner_str = '';
                option_str += '<option name="region_' + '" value="' +  msg['basic'][0]['cid'] + '">' +  msg['basic'][0]['cusname'] + '</option>';

                for (var i = 0; i < msg['staff'].length; i++) {
                    partner_str += '<option name="region_staff" value="' + msg['staff'][i].staff_id + '">' + msg['staff'][i].staffname + '</option>';
                }

                $('option[name="region_"]').remove();
                cusId.append(option_str);
                cusId.chosen('destroy');
                cusId.chosen();


                $('option[name="region_staff"]').remove();
                deptSel.append(partner_str);
                deptSel.chosen('destroy');
                deptSel.chosen();
                proT.val("");
                prjDLine.val("");
                prjPrice.val("");
                prjMaintain.val("");
                prjTemp.val("");
                prjPcb.val("");
                codeDesign.val("");
                docWrite.val("");
                proNeeds.val("");

                proT.val(msg['basic']['prostring']);
                prjDLine.val(msg['basic']['delistirng']);
                prjPrice.val(msg['basic'][0]['proprice']);
                prjMaintain.val(msg['basic'][0]['promaint']);
                prjTemp.val(msg['basic'][0]['protemp']);
                prjPcb.val(msg['basic'][0]['propcb']);
                codeDesign.val(msg['basic'][0]['codedesign']);
                docWrite.val(msg['basic'][0]['docwrite']);
                proNeeds.val(msg['basic'][0]['proneeds']);
                _proPrice    = parseInt(isEmpty(prjPrice.val()) ? prjPrice.val() : 0);
                _prjMaint    = parseInt(isEmpty(prjMaintain.val()) ? prjMaintain.val() : 0);
                _prjTemp     = parseInt(isEmpty(prjTemp.val()) ? prjTemp.val() : 0);
                _prjPCB      = parseInt(isEmpty(prjPcb.val()) ? prjPcb.val() : 0);
                _codeDesign  = parseInt(isEmpty(codeDesign.val()) ? codeDesign.val() : 0);
                _docWrite    = parseInt(isEmpty(docWrite.val()) ? docWrite.val() : 0);
                $("#bonus").val(msg['basic'][0]['performbonus']);
            }
        });
    });


    $(".checkNum").on('change', function () {
        _proPrice   = parseInt(isEmpty(prjPrice.val()) ? prjPrice.val() : 0);
        _prjMaint   = parseInt(isEmpty(prjMaintain.val()) ? prjMaintain.val() : 0);
        _prjTemp    = parseInt(isEmpty(prjTemp.val()) ? prjTemp.val() : 0);
        _prjPCB     = parseInt(isEmpty(prjPcb.val()) ? prjPcb.val() : 0);
        _codeDesign = parseInt(isEmpty(codeDesign.val()) ? codeDesign.val() : 0);
        _docWrite   = parseInt(isEmpty(docWrite.val()) ? docWrite.val() : 0);
        _total      = _proPrice*0.45 + _prjMaint + _prjTemp + _prjPCB + _codeDesign + _docWrite;
        $("#bonus").val("");
        $("#bonus").val(_total);
    });

    function getSubmitInfo(){
        //增加项目完成时间
        var _proName     = $("#proName option:selected").text();
        var _customerid  = $("#customerId").val();
        var _depart      = $("#department0_0").val();
        var _group       = $("#department1_0").val();
        var _proNeeds    = proNeeds.val();
        var _protime     = proT.val();
        var _prjDLine    = prjDLine.val();
        var _auditid     = $("#auditid").val();
        var _bonus       = $("#bonus").val();
        var _proPrice    = parseInt(isEmpty(prjPrice.val()) ? prjPrice.val() : 0);
        var _prjMaint    = parseInt(isEmpty(prjMaintain.val()) ? prjMaintain.val() : 0);
        var _prjTemp     = parseInt(isEmpty(prjTemp.val()) ? prjTemp.val() : 0);
        var _prjPCB      = parseInt(isEmpty(prjPcb.val()) ? prjPcb.val() : 0);
        var _codeDesign  = parseInt(isEmpty(codeDesign.val()) ? codeDesign.val() : 0);
        var _docWrite    = parseInt(isEmpty(docWrite.val()) ? docWrite.val() : 0);
        var _publicprjid = $("#proName option:selected").val();

        $(".jixiaolist").each(function(i) {
            jixiaolist[i]  = parseInt(isEmpty($(this).val()) ? $(this).val() : 0);
        });
        var _multiId    = checkVal;
        var _multiText  = checkText;
        var _jxValList  = jixiaolist;
        var total       = eval(_jxValList.join("+"));
        if (_proName == "") {layer.alert('项目名称未填写', {icon : 5});return false;}
        if (_customerid == "") {layer.alert('未选择客户', {icon : 5});return false;}
        if (_depart == "") {layer.alert('未选择研发部门', {icon : 5});return false;}
        if (_protime == "") {layer.alert('项目开始时间未填写', {icon : 5});return false;}
        if (_prjDLine == "") {layer.alert('项目完成时间未填写', {icon : 5});return false;}
        if (_bonus == "") {layer.alert('绩效为空！', {icon : 5});return false;}
        if (total != 100) {layer.alert('绩效分配有误',{icon:5});return false;}
        if (_auditid == "") {layer.alert('未选择项目审核人',{icon:5});return false;}
        $.ajax({
            type:'POST',
            url : "/Dwin/Research/addProjectOk",
            data: {
                        proname           :  _proName,
                        projectDepartment :  _depart,
                        projectgroup      :  _group,
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
                        pids              :  _multiId,
                        pnames            :  _multiText,
                        jxvallists        :  _jxValList,
                        publicprjid       :  _publicprjid
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