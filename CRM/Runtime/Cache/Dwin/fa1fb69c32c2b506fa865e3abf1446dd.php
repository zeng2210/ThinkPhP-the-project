<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="/Public/html/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="/Public/html/plugins/fullcalendar/fullcalendar.print.min.css" rel="stylesheet" media='print'>
    <link href="/Public/html/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Public/html/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <style>
        .fc-time{
            display : none;
        }
        /* 语言选择 */
        #top {
            background: #eee;
            border-bottom: 1px solid #ddd;
            padding: 0 10px;
            line-height: 40px;
            font-size: 12px;
        }
        /* 日历 */
        #calendar {
            margin: 40px auto;
            padding: 0 10px;
        }
        /* Event 参数 className 的值 */
        .done:before {
            content:"【 已完成 】";
            background-color:yellow;
            color:green;
            text-align:center;
            font-weight:bold;
            width:100%;
        }
        /* Event 参数 className 的值 */
        .doing:before {
            content:"【 未完成 】";
            background-color:yellow;
            color:red;
            text-align:center;
            font-weight:bold;
        }
        .fc-day-number,.fc-week-number{
            font-size:1.4em!important;
        }
        .fc-content{
            font-size: 1.2em!important;
        }
        .fc-today{
            background-color: #EEEE00!important;
        }
        .fc-today .fc-day-number{
            color: red!important;
        }

    </style>
</head>
<body>
<div id='top'>

    语言选择:
    <select id='locale-selector'></select>

</div>

<div id='calendar'></div>

</body>
<script src='/Public/html/plugins/fullcalendar/lib/moment.min.js'></script>
<script src='/Public/html/plugins/fullcalendar/lib/jquery.min.js'></script>
<script src='/Public/html/plugins/fullcalendar/fullcalendar.min.js'></script>
<script src='/Public/html/plugins/fullcalendar/locale-all.js'></script>
<script src="/Public/html/js/plugins/layer/layer.js"></script>
<script src="/Public/html/js/plugins/layer/laydate/laydate.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var initialLocaleCode = 'zh-cn';

        $('#calendar').fullCalendar({
            header : {
                left   : 'prev,next today',
                center : 'title',
                right  : 'month'
            },
            defaultDate : '2018-03-12',
            locale      : initialLocaleCode,
            buttonIcons : false, // show the prev/next text
            weekNumbers : true,
            navLinks : true, // can click day/week names to navigate views
            editable : true,
            eventLimit : true, // allow "more" link when too many events
            events : {
                url  : "/Dwin/System/getSchedule",
                type : 'post'
            },
            //月视图下日历格子宽度和高度的比例
            aspectRatio : 2,
            //月视图的显示模式，fixed：固定显示6周高；liquid：高度随周数变化；variable: 高度固定
            weekMode : 'liquid',
            //初始化时的默认视图，month、agendaWeek、agendaDay
            defaultView : 'month',
            //agenda视图下是否显示all-day
            allDaySlot : true,
            //agenda视图下all-day的显示文本
            allDayText : '全天',
            //agenda视图下两个相邻时间之间的间隔
            slotMinutes : 30,
            //区分工作时间
            businessHours : true,
            //非all-day时，如果没有指定结束时间，默认执行120分钟
            defaultEventMinutes : 120,
            eventClick : function( event ){

                var id    = event.id;
                var title = event.title;
                var start = event.start.format('YYYY-MM-DD HH:mm');
                var color = event.color;
                var flag  = event.flag;
                var checkInfoHtml = "";
                console.log(flag);
                checkInfoHtml +=
                    "<div class='container-fluid'>" +
                    "<div class='row'>" +
                    "<div class='col-xs-12' style='margin-top:50px;'>" +
                        "<p><b>当前事件日期 " + start + "</b></p>" +
                        "<lable><b>事件标题</b></lable>" +
                        "<input id='title' name='title' class='form-control' value='" + title + "'>" +
                        "<input type='hidden' id='date_id' name='date_id' class='form-control' value='" + id + "'>" +
                        "<lable><b>类型选择</b></lable>" +
                        "<select name='flag' id='flag' class='form-control'>";
                            if (parseInt(flag) == 1) {
                                checkInfoHtml +="<option value='1' selected>计入工作日</option>" +
                                                "<option value='0'>不计入工作日</option>";
                            } else {
                                checkInfoHtml +="<option value='1'>计入工作日</option>" +
                                                "<option value='0' selected>不计入工作日</option>";
                            }

                checkInfoHtml +="</select>" +
                    "</div>" +
                    "<div class='col-xs-12 text-center' style='margin:50px 0;'>" +
                    "<button type='button' class='btn btn-outline btn-success' id='checkOkBtn'>修改</button>&emsp;" +
                    "</div>";
                var checkIndex = layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['440px', '440px'], //宽高
                    end : function () {

                    },
                    content :  checkInfoHtml
                });
                var checkOkBtn = $("#checkOkBtn");
                checkOkBtn.off('click');
                checkOkBtn.on('click', function () {
                    layer.confirm('是否确认提交修改？',
                        {
                            btn  : ['确认', '再想想'],
                            icon : 6,
                            end : function () {
                                layer.close(checkIndex);
                            }
                        }, function() {
                            $.ajax({
                                type : 'POST',
                                url  : "/Dwin/System/editSchedule",
                                data : {
                                    id    :$("#date_id").val(),
                                    title :$("#title").val(),
                                    flag  :$("#flag").val()
                                },
                                success : function(data) {
                                    layer.close(checkIndex);
                                    layer.msg(data['msg'], function () {});
                                }
                            });
                        }, function() {
                            layer.close(checkIndex);
                        });
                });
            // ...
        }
            //设置为true时，如果数据过多超过日历格子显示的高度时，多出去的数据不会将格子挤开，而是显示为 +...more ，点击后才会完整显示所有的数据
        });

        // build the locale selector's options
        $.each($.fullCalendar.locales, function(localeCode) {
            $('#locale-selector').append(
                $('<option/>')
                    .attr('value', localeCode)
                    .prop('selected', localeCode == initialLocaleCode)
                    .text(localeCode)
            );
        });

        // when the selected option changes, dynamically change the calendar option
        $('#locale-selector').on('change', function() {
            if (this.value) {
                $('#calendar').fullCalendar('option', 'locale', this.value);
            }
        });
    });
</script>
</html>