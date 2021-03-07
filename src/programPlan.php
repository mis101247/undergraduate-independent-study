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
	<script src="js/Chart.js"></script>

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
						<a class="active item" href="programPlan.php">學程規劃查詢</a>
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
			<a class="active item" href="programPlan.php"><h3>學程規劃查詢 </h3></a>
			<a class="item" href="programQuery.php"><h3>學程進度查詢 </h3></a>
			<a class="item" href="about.php"><h3>關於我們 </h3></a>
			<?php require('admin/whoru.php'); ?>
			<a class="item" href="php/logout.php"><h4><i class="sign out icon"></i>登出 </h4></a>
		  </div>
		
	</div>
	
	
</div>	<!-- ... 選單結束 ... -->


<br>

<div id="mytab"  class="ui container" >
	
	<?php
			$str1=''; 	$str2 ='';  //暫存字串變數
			$str1 .= ' <div  class="ui top attached tabular menu">';
				$first='active';
				require 'php/db_key.php';
				$t_program="SELECT * FROM program where `implement` =1 and `year_end` >=" . substr($_SESSION['s_UserId'],0,4) ; //  取得已上線學程資料&適用學年度
				$sqldata_t_program = $db->query($t_program);
				foreach($sqldata_t_program->fetchAll(PDO::FETCH_ASSOC)as $key => $row_program){
					$str1 .= ' <a  class="item '.$first.' " data-tab="R'.$row_program['p_id'].'">'.$row_program['p_name'].'</a>';
					
						$str2 .= '<div class="ui tab segment  '.$first.' " data-tab="R'.$row_program['p_id'].'">';
								$str2 .= '<div class="ui  '.$row_program['p_color'].' button" data-content="點我即展開分析圖" onclick="myfuction('.$row_program['p_id'].')">';
									$str2 .= '<h3 style="text-align:center;" >雷達分析圖</H3>';
								$str2 .= '</div>';

										$str2 .= '<div class="htmleaf-content">';
										
												$str2 .= '<div style="width:300px;margin:0 auto;">';
													$str2 .= '<canvas id="canvas'.$row_program['p_id'].'" height="0" width="0"></canvas>';
												$str2 .= '</div>';
									$str2 .= '</div>';
							
							  $str2 .= '<div class="ui top attached tabular menu">';
								$str2 .= '<a class="item active" data-tab="R'.$row_program['p_id'].'/a">一年級</a>';
								$str2 .= '<a class="item" data-tab="R'.$row_program['p_id'].'/b">二年級</a>';
								$str2 .= '<a class="item" data-tab="R'.$row_program['p_id'].'/c">三年級</a>';
								$str2 .= '<a class="item" data-tab="R'.$row_program['p_id'].'/d">四年級</a>';
								$str2 .= '<a class="item" data-tab="R'.$row_program['p_id'].'/z">未定義</a>';
							  $str2 .= '</div>';
							  $str2 .= '<div class="ui bottom attached tab segment active" data-tab="R'.$row_program['p_id'].'/a" id="R'.$row_program['p_id'].'_1"></div>';
							  $str2 .= '<div class="ui bottom attached tab segment" data-tab="R'.$row_program['p_id'].'/b" id="R'.$row_program['p_id'].'_2"></div>';
							  $str2 .= '<div class="ui bottom attached tab segment" data-tab="R'.$row_program['p_id'].'/c" id="R'.$row_program['p_id'].'_3"></div>';
							  $str2 .= '<div class="ui bottom attached tab segment" data-tab="R'.$row_program['p_id'].'/d" id="R'.$row_program['p_id'].'_4"></div>';
							  $str2 .= '<div class="ui bottom attached tab segment" data-tab="R'.$row_program['p_id'].'/z" id="R'.$row_program['p_id'].'_0"></div>';
						$str2 .= '</div>';
					
						
					$first = '';
				}
			$str1 .= ' </div>';
		
			echo $str1;
			echo $str2;
			
			$last=$row_program['p_id'];
		?>
	
		 

</div>







<script>


$('.ui .accordion')  .accordion(); //手風琴動作
$('#mytab .menu .item') .tab();//Tab
$('.button').popup({inline: true});//彈跳

var p_color = [];

var radarChartData=new Array();
	
	<?php 
	$str ="";
	
	require 'php/db_key.php';
	$t_program="SELECT * FROM program where `implement` =1"  ; //  取得已上線學程資料
	$sqldata_t_program = $db->query($t_program);
	foreach($sqldata_t_program->fetchAll(PDO::FETCH_ASSOC)as $key => $row_program){
		echo 'p_color['.$row_program['p_id'].']=\''.$row_program['p_color'].'\';';
		$str .= 'radarChartData['.$row_program['p_id'].'] = {';
				$str .= 'labels: ["邏輯能力","設計能力","程式能力","企業組織","行銷能力","社交能力","創意思考"],';
				$str .= 'datasets: [';
					$str .= '{';
						$str .= 'label: "My First dataset",';
						$str .= 'fillColor: "rgba(220,0,0,0.2)",';
						$str .= 'strokeColor: "rgba(220,220,220,1)",';
						$str .= 'pointColor: "rgba(220,220,220,1)",';
						$str .= 'pointStrokeColor: "#fff",';
						$str .= 'pointHighlightFill: "#fff",';
						$str .= 'pointHighlightStroke: "rgba(220,220,220,1)",';
						$str .= 'data: ['.$row_program['radar_1'].','.$row_program['radar_2'].','.$row_program['radar_3'].','.$row_program['radar_4'].','.$row_program['radar_5'].','.$row_program['radar_6'].','.$row_program['radar_7'].']';
					$str .= '}';
				$str .= ']';
			$str .= '};';
	}
	echo $str;
?>


$.getJSON( "/json/program_and_lesson.json", function( json ) {
	
	for ( i=1;i<=<?php echo $last;?>;i++){ //課程1~4
		
		for (j=1;j<=4;j++){//年級1~4
		
		//
		text = "<table class='ui unstackable  table center aligned'>		  <thead>		<tr><th colspan='4' class='ui inverted "+p_color[i]+" table center aligned medium header'>上學期</th> </tr>		<tr >		<th class='five wide'>課程名稱</th>    <th class='three wide'>學程學分</th>    <th class='four wide'>學程時數</th>	<th class='four wide'>學程必選修</th>			  </tr>		 </thead> <tbody> ";//上學期
		text_t = text ; //判斷是否為空
		
		text2 = "<table class='ui unstackable  table center aligned'>		  <thead>		<tr><th colspan='4' class='ui inverted "+p_color[i]+" table center aligned medium header'>下學期</th> </tr>  	<tr >		<th class='five wide'>課程名稱</th>    <th class='three wide'>學程學分</th>    <th class='four wide'>學程時數</th>	<th class='four wide'>學程必選修</th>			  </tr>		 </thead> <tbody> ";//下學期
		text2_t = text2; //判斷是否為空
		
		text3="<table class='ui unstackable  table center aligned'>		  <thead>		<tr><th colspan='4' class='ui inverted "+p_color[i]+" table center aligned medium header'>尚未定義時間</th> </tr>		<tr >		<th class='five wide'>課程名稱</th>    <th class='three wide'>學程學分</th>    <th class='four wide'>學程時數</th>	<th class='four wide'>學程必選修</th>			  </tr>		 </thead> <tbody>" ; //尚未定義時間課程
		text3_t = text3;
		
		  $.each( json, function( index ) {
				  if  (json[index].p_id==i && json[index].course_time==j*2-1  )  {//上學期
						text = text + "  <tr>      <td>"+  json[index].name  +"</td>      <td>"+  json[index].p_credit  +"</td>      <td>"+  json[index].p_hour   +"</td>      <td>"+  json[index].p_obl_or_ele  +"</td>    </tr>";
					  }
				  else if (json[index].p_id==i && json[index].course_time==j*2  ){//下學期
					   	text2 = text2 + "  <tr>      <td>"+  json[index].name  +"</td>      <td>"+  json[index].p_credit  +"</td>      <td>"+  json[index].p_hour  +"</td>      <td>"+  json[index].p_obl_or_ele  +"</td>    </tr>";
					}				  
					else if (json[index].p_id==i && json[index].course_time=="0"  ){//未定義
					   	text3 = text3 + "  <tr>      <td>"+  json[index].name  +"</td>      <td>"+  json[index].p_credit   +"</td>      <td>"+   json[index].p_hour   +"</td>      <td>"+  json[index].p_obl_or_ele  +"</td>    </tr>";
					}
				  else if(   (text == text_t  || text2 == text2_t || text3==text3_t ) &&   json.length-1 == index) {
					  if (text == text_t){text = text  + "  <tr>    <td colspan='4' >  無   </td> </tr>";}
					  if (text2 == text2_t) {text2 = text2 + "  <tr>   <td colspan='4' >  無   </td> </tr>";}
					  if (text3 == text3_t) {text3 = text3 + "  <tr>   <td colspan='4' >  無   </td> </tr>";}
				  }
				  
			 });
			 
			 
		jQuery("#R"+ i +"_"+ j ).append(text +   "</tbody></table>");
		jQuery("#R"+ i +"_"+ j ).append(text2 +   "</tbody></table>");		
		}
		
		jQuery("#R"+ i +"_0" ).append(text3 +   "</tbody></table>");
	}
	
	
	
 });
 

	

	
	function myfuction(index){
		document.getElementById('canvas'+index).width=300;
		document.getElementById('canvas'+index).height=300;
		window.myRadar = new Chart(document.getElementById('canvas'+index).getContext('2d')).Radar(radarChartData[index],{
			responsive: true
		});
	}
	
	</script>

	
</body>
</html>
