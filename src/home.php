<?php
require_once('php/check_signed.php'); //檢查有無登入
?>



<!DOCTYPE html>
<html lang="zh-TW">
    <head>
        <link rel="icon" href="images/ICON.png" type="image/x-icon" /> 
        <title>MIS學程規劃系統</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">

        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="//oss.maxcdn.com/semantic-ui/2.0.7/semantic.min.css">
        <script src="//oss.maxcdn.com/semantic-ui/2.0.7/semantic.min.js"></script>

        <link rel="stylesheet" href="css/my_style.css">
        <script src="js/my_javascript.js"></script>
 <style>
body{
  background-image: url("images/mainbg.jpg");
   background-repeat: no-repeat;
   background-attachment: fixed;
   -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
 
#word {
     
	 position: absolute;
    margin: auto;
  
    right: 0;
    bottom: 0;
  
}
 </style>
    </head>

    <body>
  

        
<!-- ... 上方選單 ... -->
<div class="ui one column stackable grid">

	<!-- ... 電腦版選單 ... -->
	<div class="ui computer only column">
			<div class="ui vertical segment  inverted" style="margin-bottom: -15px ; background-color: #004f72;" >
			 <div  class="ui huge header " >MIS學程規劃系統</div>
		</div>
		<div class="ui  main menu  inverted"style="background-color: #004f72;">
					<div class="ui  menu  inverted  container "style="background-color: #004f72;">
						<a class="active item" href="home.php" ><img src="images/ICONw.png"></a>
						<a class="item" href="main.php" >學程常見問題</a>
						<a class="item" href="programPlan.php">學程規劃查詢</a>
						<a class="item" href="programQuery.php">學程進度查詢</a>
						<a class="item" href="about.php">關於我們</a>
						<div class="right menu">
							<div class="header item"><i class="student icon"></i><?php echo $_SESSION['s_UserName']; ?></div>
							<?php require('admin/whoru.php'); ?>
							<a class="item" href="php/logout.php"><i class="sign out icon"></i>登出</a>
						</div>
					</div>
		</div>
	</div>

	<!-- ... 手機、平板選單 ... -->
	<div class="ui mobile tablet only column  " >
		<div class="ui large main menu  inverted  "style="background-color: #004f72;  ">
					<div class="ui  menu  inverted  fluid container "style="background-color: #004f72;">
						<div class="item"><i class="big link sidebar icon" onclick="f_menu()"></i></div>
						<div class="header item">	<h1>MIS學程規劃系統 </h1></div>
					</div>
		</div>
		<div class="ui sidebar inverted vertical  menu" id="show_menu" style="background-color: #004f72;  ">
			<a class="active item" href="home.php" ><img class="ui middle aligned tiny image" src="images/ICONw.png"></a>
			<div class="item"><h4><i class="student icon"></i><?php echo $_SESSION['s_UserName']; ?></h4></div>
			<a class="item" href="main.php" >	<h3>學程常見問題 </h3></a>
			<a class="item" href="programPlan.php"><h3>學程規劃查詢 </h3></a>
			<a class="item" href="programQuery.php"><h3>學程進度查詢 </h3></a>
			<a class="item" href="about.php"><h3>關於我們 </h3></a>
			<?php require('admin/whoru.php'); ?>
			<a class="item" href="php/logout.php"><h4><i class="sign out icon"></i>登出 </h4></a>
		  </div>
		
	</div>
	
	
</div>	<!-- ... 選單結束 ... -->

<div class="ui one column stackable grid">
    <div class="ui computer only column">
		</br>
      	<img id="word" src="images/homeword.png" style="position:relative;top:50%;left:30%;width:40%;">
	</div>
	<div class="ui mobile tablet only column  " >
		<img src="/images/homeword1.png" style="width:100%;">
		
	</div>	
</div>
 
          

        <script>

            $('.ui.accordion').accordion();//手風琴
            $('#mytab .menu .item').tab();//Tab
            $('#future .menu .item').tab();//Tab


        </script>
    </body>
</html>


