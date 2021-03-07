<?php
session_start();
session_unset();
?>


<!DOCTYPE html>
<html lang="zh-TW">
    
    
    
    
    <head>
        <link rel="icon" href="images/ICON.png" type="image/x-icon" /> 
        <title>MIS學程規劃系統</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">

		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="//oss.maxcdn.com/semantic-ui/2.0.7/semantic.min.css">
		<script src="//oss.maxcdn.com/semantic-ui/2.0.7/semantic.min.js"></script>
		
		<script src="/admin/sweetalert/dist/sweetalert.min.js"></script> 
		<link rel="stylesheet" type="text/css" href="/admin/sweetalert/dist/sweetalert.css">

    </head>

    <body     data-spy="scroll" data-target=".navbar" data-offset="12" >


<div class="ui one column stackable grid">
    <div class="ui computer only column">

		<div class="scroll_go  ui  top fixed  inverted menu">
		  <a class="item"  href="#t1">
			<img src="/images/ICONw.png">
		  </a>
		  <a class="item" href="#t2">資通訊開發</a>
		  <a class="item" href="#t3">企業資源規劃</a>
		  <a class="item" href="#t4">創新網路行銷</a>
		  <a class="item" href="#t5">互動設計</a>
		  
		  <div class="right menu">
				<a class="item" href="login.php"><i class="user icon"></i>Login</a>
		  </div>

		</div>
        </div>
        <div class="ui mobile tablet only column  " >
            <div class="scroll_go  ui  bottom fixed  inverted menu">
          <a class="item"  href="#t11">
            <img src="/images/ICONw.png">
          </a>
          <a class="item" href="#t22">資通訊</a>
          <a class="item" href="#t33">企業資源</a>
          <a class="item" href="#t44">網路行銷</a>
          <a class="item" href="#t55">互動設計</a>
          
                <a class="item" href="login.php"><i class="user icon"></i>Login</a>
          

        </div>
</div>
</div>


        <script>
			swal("停止更新通知!", "哈囉，我是柯佑，由於團隊畢業了所以功能不再更新，如果有任何問題都可以寫信給我《814007@gmail.com》，另外103級起廢止互動設計學程敬請學弟妹注意，謝謝。", "warning");
            $(".scroll_go> a").click(function () {
                $("html,body").animate({scrollTop: $($(this).attr("href")).offset().top}, 800);
            });
			

        </script>



<div class="ui one column stackable grid">
    <div class="ui computer only column">
		   <div id="t1"><img src="images/div5.jpg" class="ui fluid image"  style="height: 100vh;"></div> 
            <div id="t2"><img src="images/div1.jpg" class="ui fluid image" style="height: 100vh;"></div>
            <div id="t3"><img src="images/div2.jpg" class="ui fluid image" style="height: 100vh;"></div>
            <div id="t4"><img src="images/div3.jpg" class="ui fluid image" style="height: 100vh;"></div>
            <div id="t5"><img src="images/div4.jpg" class="ui fluid image" style="height: 100vh;"></div>
</div>
<div class="ui mobile tablet only column" style="padding: 0 0 0 0 !important;">
            <div id="t11"><img src="images/div52.jpg" class="ui fluid image" ></div>
            <div id="t22"><img src="images/div12.jpg" class="ui fluid image" ></div>
            <div id="t33"><img src="images/div22.jpg" class="ui fluid image" ></div>
            <div id="t44"><img src="images/div32.jpg" class="ui fluid image" ></div>
            <div id="t55"><img src="images/div42.jpg" class="ui fluid image" ></div>
</div>
</div>




    </body>
</html>
