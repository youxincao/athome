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
        <th>#</th>        
        <th>IMDB Top 10 Movies</th>
        <th>Year</th>
    </tr>
    </thead>
    <tr>
        <td>1</td>        
        <td>The Shawshank Redemption</td>

        <td>1994</td>
    </tr>        
    <tr>
        <td>2</td>         
        <td>The Godfather</td>
        <td>1972</td>
    </tr>
    <tr>

        <td>3</td>         
        <td>The Godfather: Part II</td>
        <td>1974</td>
    </tr>    
    <tr>
        <td>4</td> 
        <td>The Good, the Bad and the Ugly</td>
        <td>1966</td>

    </tr>
    <tr>
        <td>5</td> 
        <td>Pulp Fiction</td>
        <td>1994</td>
    </tr>
    <tr>
        <td>6</td> 
        <td>12 Angry Men</td>

        <td>1957</td>
    </tr>
    <tr>
        <td>7</td> 
        <td>Schindler's List</td>
        <td>1993</td>
    </tr>    
    <tr>

        <td>8</td> 
        <td>One Flew Over the Cuckoo's Nest</td>
        <td>1975</td>
    </tr>
    <tr>
        <td>9</td> 
        <td>The Dark Knight</td>

        <td>2008</td>
    </tr>
    <tr>
        <td>10</td> 
        <td>The Lord of the Rings: The Return of the King</td>
        <td>2003</td>
    </tr> 

</table>

    <h3 >添加设备</h3>
    <form action="/athome/admin.php/Home/Admin/add_device" method="post">
        <input type="text" name="device_sn" autocomplete="on" /> 
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
      <form action="/athome/admin.php/Home/Admin/alarm_info" method="post" />
        <label>输入SN号： </label>
        <input type="text" name="device_sn" autocomplete="on" /> 
        <button type="submit">查询</button>
     </form>
  </div>

  <div>
    <h2 class="title">测试界面</h2>
  </div>
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