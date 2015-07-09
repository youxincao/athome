<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" />
<link rel="stylesheet" type="text/css" media="screen" href="/athome/Public/css/liquid-slider.css">
<script type="text/javascript" src="/athome/Public/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/athome/Public/js/jquery.form.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#gps_query_form').ajaxForm({
            beforeSubmit: checkForm,
            success:  complete,
            dataType: 'json'
        });

        $('#add_device_form').ajaxForm({
            beforeSubmit: checkFormAdd,
            success:  completeAdd,
            dataType: 'json'
        });

        $('#alarm_query_form').ajaxForm({
            beforeSubmit: checkFormAlarm,
            success:  completeAlarm,
            dataType: 'json'
        });
        
        function checkForm(){
            if('' == $.trim($('#gps_device_sn').val())){
                alert("设备号不能为空");
                return false;
            }
        }

        function complete(data){
            if( ! data.status ){
                alert("该设备不存在");
                return ;
            }
        }  

        function checkFormAdd(){
            if('' == $.trim($('#add_device_sn').val())){
                alert("设备号不能为空");
                return false;
            }
        }

        function completeAdd(data){
            if( ! data.status ){
                alert("添加失败");
                return ;
            }else {
                alert("添加成功");
                return;
            }
        }  

        function checkFormAlarm(){
            if('' == $.trim($('#alarm_device_sn').val())){
                alert("设备号不能为空");
                return false;
            }
        }

        function completeAlarm(data){
            if( ! data.status ){
                alert("该设备不存在");
                return ;
            }
        }     
    });     
</script>

<style>
table {
    *border-collapse: collapse; /* IE7 and lower */
    border-spacing: 0;
    width: 100%;    
}

.bordered {
    border: solid #ccc 1px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: 0 1px 1px #ccc; 
    -moz-box-shadow: 0 1px 1px #ccc; 
    box-shadow: 0 1px 1px #ccc;         
}

.bordered tr:hover {
    background: #fbf8e9;
    -o-transition: all 0.1s ease-in-out;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -ms-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;     
}    
    
.bordered td, .bordered th {
    border-left: 1px solid #ccc;
    border-top: 1px solid #ccc;
    padding: 10px;
    text-align: left;    
}

.bordered th {
    background-color: #dce9f9;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ebf3fc), to(#dce9f9));
    background-image: -webkit-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:    -moz-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:     -ms-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:      -o-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:         linear-gradient(top, #ebf3fc, #dce9f9);
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset; 
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;  
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;        
    border-top: none;
    text-shadow: 0 1px 0 rgba(255,255,255,.5); 
}

.bordered td:first-child, .bordered th:first-child {
    border-left: none;
}

.bordered th:first-child {
    -moz-border-radius: 6px 0 0 0;
    -webkit-border-radius: 6px 0 0 0;
    border-radius: 6px 0 0 0;
}

.bordered th:last-child {
    -moz-border-radius: 0 6px 0 0;
    -webkit-border-radius: 0 6px 0 0;
    border-radius: 0 6px 0 0;
}

.bordered th:only-child{
    -moz-border-radius: 6px 6px 0 0;
    -webkit-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
}

.bordered tr:last-child td:first-child {
    -moz-border-radius: 0 0 0 6px;
    -webkit-border-radius: 0 0 0 6px;
    border-radius: 0 0 0 6px;
}

.bordered tr:last-child td:last-child {
    -moz-border-radius: 0 0 6px 0;
    -webkit-border-radius: 0 0 6px 0;
    border-radius: 0 0 6px 0;
}
</style>
</head>
<body class='no-js' style="margin:0">
<div class="liquid-slider"  id="slider-id">
  <div>
    <h2 class="title">用户管理</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque. Sed volutpat ante id mauris laoreet vestibulum. Nam blandit felis non neque cursus aliquet. Morbi vel enim dignissim massa dignissim commodo vitae quis tellus. Nunc non mollis nulla. Sed consectetur elit id mi consectetur bibendum. Ut enim massa, sodales tempor convallis et, iaculis ac massa. Etiam suscipit nisl eget lorem pellentesque quis iaculis mi mattis. Aliquam sit amet purus lectus. Maecenas tempor ornare sollicitudin.</p>
  </div>
  <div>
    <h2 class="title">设备管理</h2>
    <h3 >设备列表</h3>
    <table class="bordered">
    <thead>
    <tr>
        <th>id</th>        
        <th>sn</th>
        <th>time</th>
    </tr>
    </thead>

    <?php if(is_array($device_list)): $i = 0; $__LIST__ = $device_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$device): $mod = ($i % 2 );++$i;?><tr>
        <td><?php echo ($device['id']); ?></td>        
        <td><?php echo ($device['sn']); ?></td>
        <td><?php echo ($device['recodetime']); ?></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>

    <h3 >添加设备</h3>
    <form id="add_device_form" action="/athome/admin.php/Home/Admin/add_device" method="post">
        <input id="add_device_sn" type="text" name="device_sn" autocomplete="on" /> 
        <button type="submit">添加</button>
    </form>

  </div>
    <div>
    <h2 class="title">GPS信息</h2>
      <form id="gps_query_form" action="/athome/admin.php/Home/Admin/gps_info" method="post" />
        <label>输入SN号： </label>
        <input id="gps_device_sn" type="text" name="device_sn" autocomplete="on" /> 
        <button type="submit">查询</button>
     </form>
  </div>

  <div>
    <h2 class="title">报警信息</h2>
      <form id="alarm_query_form" action="/athome/admin.php/Home/Admin/alarm_info" method="post" />
        <label>输入SN号： </label>
        <input id="alarm_device_sn" type="text" name="device_sn" autocomplete="on" /> 
        <button type="submit">查询</button>
     </form>
  </div>

  <div>
    <h2 class="title">测试界面</h2>
    <h3>发送GPS信息</h3>
        <form id="add_gps_form" action="/athome/admin.php/Home/Admin/add_gps" method="post" />
            <label>输入SN号： </label>
            <input id="add_gps_device_sn" type="text" name="sn" autocomplete="on" /> <br />
            <label>输入经度： </label>
            <input id="add_gps_lat" type="text" name="latitude" autocomplete="on" /> <br />
            <label>输入纬度： </label>
            <input id="add_gps_lon" type="text" name="longgtude" autocomplete="on" /> <br />
            <label>输入精度： </label>
            <input id="add_gps_pre" type="text" name="precision" autocomplete="on" /> <br />
            <button type="submit">确定</button>
        </form>
    <h3>发送报警信息</h3>
        <form id="add_alarm_form" action="/athome/admin.php/Home/Admin/add_alarm" method="post" />
            <label>输入SN号： </label>
            <input id="add_alarm_device_sn" type="text" name="sn" autocomplete="on" /> <br /> 
            <label>输入错误码： </label>
            <input id="add_alarm_code" type="text" name="precision" autocomplete="on" /> <br />
            <button type="submit">确定</button>
        </form>
  </div
    alarm <form id="add_gps_form" action="/athome/admin.php/Home/Admin/add_gps" method="post" />
            <label>输入SN号： </label>
            <input id="add_gps_device_sn" type="text" name="sn" autocomplete="on" /> <br />
            <label>输入经度： </label>
            <input id="add_gps_lat" type="text" name="latitude" autocomplete="on" /> <br />
            <label>输入纬度： </label>
            <input id="add_gps_lon" type="text" name="longgtude" autocomplete="on" /> <br />
            <label>输入精度： </label>
            <input id="add_gps_pre" type="text" name="precision" autocomplete="on" /> <br />
            <button type="submit">确定</button>
        </form>
</div>
<script src="/athome/Public/js/jquery.easing.1.3.js"></script>
<script src="/athome/Public/js/jquery.touchSwipe.min.js"></script>
<script src="/athome/Public/js/jquery.liquid-slider.min.js"></script>
<title>管理</title>
<script>
    $(function(){

      /* Here is the slider using default settings */
      $('#slider-id').liquidSlider();


      /* If you want to adjust the settings, you set an option
         as follows:

          $('#slider-id').liquidSlider({
            autoSlide:false,
            autoHeight:false
          });

         Find more options at http://liquidslider.kevinbatdorf.com/
      */

      /* If you need to access the internal property or methods, use this:

      var sliderObject = $.data( $('#slider-id')[0], 'liquidSlider');
      console.log(sliderObject);

      */


    });
</script>
</body>
</html>