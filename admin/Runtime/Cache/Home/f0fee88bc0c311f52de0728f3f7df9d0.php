<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" />
<link rel="stylesheet" type="text/css" media="screen" href="/athome/Public/css/liquid-slider.css">
</head>
<body class='no-js' style="margin:0">
<div class="liquid-slider"  id="slider-id">
  <div>
    <h2 class="title">Slide 1</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque. Sed volutpat ante id mauris laoreet vestibulum. Nam blandit felis non neque cursus aliquet. Morbi vel enim dignissim massa dignissim commodo vitae quis tellus. Nunc non mollis nulla. Sed consectetur elit id mi consectetur bibendum. Ut enim massa, sodales tempor convallis et, iaculis ac massa. Etiam suscipit nisl eget lorem pellentesque quis iaculis mi mattis. Aliquam sit amet purus lectus. Maecenas tempor ornare sollicitudin.</p>
  </div>
  <div>
    <h2 class="title">Slide 2</h2>
    <p>Proin nec turpis eget dolor dictum lacinia. Nullam nunc magna, tincidunt eu porta in, faucibus sed magna. Suspendisse laoreet ornare ullamcorper. Nulla in tortor nibh. Pellentesque sed est vitae odio vestibulum aliquet in nec leo.</p>
  </div>
  <div>
    <h2 class="title">Slide 3</h2>
    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
  </div>
  <div>
    <h2 class="title">Slide 4</h2>
    <p>Proin nec turpis eget dolor dictum lacinia. Nullam nunc magna, tincidunt eu porta in, faucibus sed magna. Suspendisse laoreet ornare ullamcorper. Nulla in tortor nibh. Pellentesque sed est vitae odio vestibulum aliquet in nec leo.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque. Sed volutpat ante id mauris laoreet vestibulum. Nam blandit felis non neque cursus aliquet. Morbi vel enim dignissim massa dignissim commodo vitae quis tellus. Nunc non mollis nulla. Sed consectetur elit id mi consectetur bibendum. Ut enim massa, sodales tempor convallis et, iaculis ac massa. Etiam suscipit nisl eget lorem pellentesque quis iaculis mi mattis. Aliquam sit amet purus lectus. Maecenas tempor ornare sollicitudin.</p>
  </div>
</div>
<script src="http://www.lanrenzhijia.com/ajaxjs/jquery.min.js"></script>
<script src="/athome/Public/js/jquery.easing.1.3.js"></script>
<script src="/athome/Public/js/jquery.touchSwipe.min.js"></script>
<script src="/athome/Public/js/jquery.liquid-slider.min.js"></script>
<title>支持移动浏览器(手机、ipad等)左右滑动切换tab标签</title>
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