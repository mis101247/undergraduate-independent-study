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
						<a class="item" href="home.php" ><img src="images/ICONw.png"></a>
						<a class="item" href="main.php" >學程常見問題</a>
						<a class="item" href="programPlan.php">學程規劃查詢</a>
						<a class="item" href="programQuery.php">學程進度查詢</a>
						<a class="active item" href="about.php">關於我們</a>
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
		<div class="ui large main menu  inverted"style="background-color: #004f72;  ">
					<div class="ui  menu  inverted  fluid container "style="background-color: #004f72;">
						<div class="item"><i class="big link sidebar icon" onclick="f_menu()"></i></div>
						<div class="header item">	<h1>MIS學程規劃系統 </h1></div>
					</div>
		</div>
		
		<div class="ui sidebar inverted vertical menu" id="show_menu" style="background-color: #004f72;  ">
			<a class="item" href="home.php" ><img class="ui middle aligned tiny image" src="images/ICONw.png"></a>
			<div class="item"><h4><i class="student icon"></i><?php echo $_SESSION['s_UserName']; ?></h4></div>
			<a class="item" href="main.php" >	<h3>學程常見問題 </h3></a>
			<a class="item" href="programPlan.php"><h3>學程規劃查詢 </h3></a>
			<a class="item" href="programQuery.php"><h3>學程進度查詢 </h3></a>
			<a class="active item" href="about.php"><h3>關於我們 </h3></a>
			<?php require('admin/whoru.php'); ?>
			<a class="item" href="php/logout.php"><h4><i class="sign out icon"></i>登出 </h4></a>
		  </div>
		
	</div>
	
	
</div>	<!-- ... 選單結束 ... -->

<div class="ui column grid container" style="width:80%;margin: 0px auto;">
  <div class="column">
    <div class="ui raised segment">

<h2 class="ui horizontal divider header"><i class="users icon"></i>作者群</h2>

<table class="ui definition table">
  <tbody>
    <tr>
      <td class="two wide column">統籌&程式設計</td>
      <td>蕭文婷（Candy）</td>
  
    <tr>
      <td>功能設計</td>
      <td>柯昱佑（Keyo）</td>
    </tr>
    <tr>
      <td>資料庫設計</td>
      <td>劉庭煟（Wei）</td>
    </tr>
    <tr>
     <td>架構設計</td>
      <td>林羿貝（Bei）</td>
    </tr> <tr>
     <td>介面設計</td>
      <td>王靖文（Wen）</td>
    </tr>
  </tbody>
</table>
		
    </div>
  </div>
</div>

  
 
  <p></p>
</div>
<div class="ui column grid container" style="width:80%;margin: 0px auto;">
  <div class="column">
    <div class="ui segment">
        <h2 class="ui horizontal divider header"><i class="paint brush icon"></i>設計理念</h2>
       
			 <div class="ui clearing divider"></div>

      	<P align="left">我們是來自高應大101級資管系的學生，因為專題的關係讓我們變成一個團隊</P>
      	<P align="left">是資管系的學生都知道，「學程」很常聽到，卻又有點陌生，總是要等到大三選擇專題指導老師的時候才會正視「學程」</P>
      	<P align="left">心裡難免會想「如果當初早一點修課就好了」，憑著這句話，讓我們了解到了學生們有著這樣的需求</P>
            <p align="left">誘發我們製作此專題，為的就是要讓你們沒有後悔的理由，更早正視自己的未來，選擇自己的道路。</P>
    </div>
  </div>
</div>

<div class="ui column grid container" style="width:80%;margin: 0px auto;">
  <div class="column">
    <div class="ui segment">
        <h2 class="ui horizontal divider header"><i class="mail outline icon"></i>聯絡我們</h2>
			 <div class="ui clearing divider"></div>
  <i class="mail icon"></i><a href="mailto:wbwty103@gmail.com">mailto:wbwty103@gmail.com</a>
                      
                       <p align="left">歡迎給予我們意見及建議，謝謝您的來信指教！</p>
    </div>
  </div>
</div>

</br>



</body>
</html>
