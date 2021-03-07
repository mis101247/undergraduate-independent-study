<?php 
require_once('php/check_signed.php'); //檢查有無登入
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
     <link rel="icon" href="images/ICON.png" type="image/x-icon" > 
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
						<a class="active item" href="programQuery.php">學程進度查詢</a>
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
			<a class="item" href="programPlan.php"><h3>學程規劃查詢 </h3></a>
			<a class="active item" href="programQuery.php"><h3>學程進度查詢 </h3></a>
			<a class="item" href="about.php"><h3>關於我們 </h3></a>
			<?php require('admin/whoru.php'); ?>
			<a class="item" href="php/logout.php"><h4><i class="sign out icon"></i>登出 </h4></a>
		  </div>
		
	</div>
	
	
</div>	<!-- ... 選單結束 ... -->

<br>

<div class="ui  container segment">
  <div class="ui active  dimmer" id="hide_it" >
    <div class="ui text loader">資料接收中...</div>
  </div>
	
<div class="ui   accordion ">
  
	  <?php
	require 'php/db_key.php';
  	$t_program="SELECT * FROM program where `implement` =1 and `year_end` >=" . substr($_SESSION['s_UserId'],0,4) ." and  `year_start` <=" . substr($_SESSION['s_UserId'],0,4) ; //  取得已上線學程資料&適用學年度
	$sqldata_t_program = $db->query($t_program);
	foreach($sqldata_t_program->fetchAll(PDO::FETCH_ASSOC)as $key => $row_program){
				
				$haha =$row_program['credit_low'] ;
				if ($row_program['p_id']==4){$haha = 17;}
				
				$str='';
				$str.='<div class="ui raised segment">';
					$str.='<div class="title"> ';
						$str.='<div class="ui large header"><i class="'. $row_program['p_icon'] .' icon"></i>'. $row_program['p_name'] .'</div>';
						
						$str.='<div class="ui  progress '. $row_program['p_color'] .' active" data-percent="0"  id="R'. $row_program['p_id'] .'_aria">';
							$str.='<div class="bar" style="transition-duration: 300ms;">';
								$str.='<div class="progress"> </div>';
							$str.='</div>';
						$str.='</div>';
						
					$str.='</div>';
					
					$str.='<div class="content">';
					
						$str.='<table class="ui unstackable table center aligned">';
						$str.='<thead>';

								$str.='<tr><th colspan="4" class="ui inverted '. $row_program['p_color'] .' table   medium header">必修 共'. $row_program['credit_obl'] .'學分，你修了<span id="R'. $row_program['p_id'] .'_r_get"></span> 學分 （學程最低應修學分  '. $haha .' 學分）</th>  </tr>';
								$str.='<tr >';
								$str.='<th class="five wide left aligned"  ><h3>課程名稱</h3></th>				  <th class="two wide  "><h3>學分/時數</h3></th>				  <th class="four wide  "><h3>修課狀況</h3></th>				  <th class="five wide  "  ><h3>課程資訊</h3></th>';
								$str.='</tr>';

						$str.='</thead>';
						
						$str.='<tbody  id="R'. $row_program['p_id'] .'_r"></tbody>';


						$str.='</table>';
						
						if ($row_program['credit_ele']>0){
						$str.='<table class="ui unstackable table center aligned">';
								$str.='<thead>';
									$str.='<tr><th colspan="4" class="ui inverted '. $row_program['p_color'] .' table   medium header">選修 共'. $row_program['credit_ele'] .'學分，你修了<span id="R'. $row_program['p_id'] .'_e_get"></span> 學分</th> </tr>';

									$str.='<tr>';
									$str.='<th class="five wide left aligned"  ><h3>課程名稱</h3></th>				  <th class="two wide  "><h3>學分/時數</h3></th>				  <th class="four wide  "><h3>修課狀況</h3></th>				  <th class="five wide  " ><h3>課程資訊</h3></th>';
									$str.='</tr>';
								$str.='</thead>';
								$str.='<tbody  id="R'. $row_program['p_id'] .'_e">';

								$str.='</tbody>';

						$str.='</table>';
						}


					$str.='</div>';
				$str.='</div>';
				
				echo $str;
		
	}
  ?>
	
</div><!--進度表 -->

		
		
</div><!--<div class="ui  container segment"> -->

<!--課程資訊框-->
<div class="ui large  coupled modal transition hidden  " style="margin-top: -212.5px;">

    
     <div class="header"><span id="lesson_info_name"></span>─課程資訊</div><i class="close icon"></i>
    <div class="content ">
      <div class="ui form">
        <div class="field">
				<div class="ui  container segment" style="overflow:scroll;overflow-X:hidden; height:50vh;">
					  <div class="ui active  dimmer transition hidden" id="loadding_info" >
						<div class="ui text loader">資料接收中...</div>
					  </div>
						<table class="ui unstackable  celled striped center aligned table">
						  <thead>
							<tr>					  <th>開課學年度/學期</th>	  <th>開課班級</th>		  <th>學分/時數</th>		   <th>必選修</th>	   <th>授課老師</th>		<th>教學綱要</th>			</tr>
						  </thead>
							 
							<tbody id="lesson_info_show"   >
							
							</tbody>
						  
						</table>
				</div> 
        </div>
      </div>
    </div>
    <div class="actions">
	
    </div>
</div>
		<!--課程資訊框-之課程大綱-->
<div class="ui small second coupled modal transition hidden " style="margin-top: -92.5px; display: block !important;">
    <div class="header">課程大綱</div>
    <div class="content">
      <div class="description">
        <p id="lesson_info_tpa_spec"></p>
      </div>
    </div>
    <div class="actions">
      <div class="ui approve button"><i class="checkmark icon"></i>OK</div>
    </div>
</div>
<!--課程資訊框結束-->


<style  type="text/css">

.ui.table tr.positive {
	background: #dff0d8 !important;
	color: black !important;
}


</style>


<script>
//學程ID、課ID、課名、學分、時數、必選修、分數  "p_id"、"CID"、"CName"、"Credit"、"Hour"、"Mso"、"Score"
$.getJSON( "php/api/progress.php", function( json ) {
	
	var p_temp=new Array(4);//各學程 暫存字串
	
	for (var i=0;i<json.program.length;i++){  //看有幾個已上線學程
	
			p_temp[0]= ""; p_temp[1]= "";	p_temp[2]= 0; 	p_temp[3]= 0; //初始化// 0為必修字串、1為選修字串、2為必修已得學分、3為選修已得學分
	
			$.each( json.lesson, function( index ) {//已修過/未修迴圈
				if ( json.program[i].p_id ==json.lesson[index].p_id){
					var str_remark =""; //備註
					if (json.lesson[index].remark!=""){str_remark="<i class='activating element large icons link' data-content='"+ json.lesson[index].remark+"' data-variation='wide'><i class='big loading lemon icon'></i><i class='info  icon'></i></i>";}
									   
				if  ( parseInt(json.lesson[index].Score)>=60){//判斷學程課有無修過
					
					 
					if (json.lesson[index].Mso=="必修"){
						p_temp[0]=p_temp[0] + "<tr class='positive'><td  class='left aligned'>"+ json.lesson[index].CName +" "+str_remark+"</td><td >"+ json.lesson[index].Credit +"/"+ json.lesson[index].Hour +"</td><td >(已修過) 分數: "+ json.lesson[index].Score +"</td><td ><button  id='btn_id_"+json.lesson[index].p_id+json.lesson[index].CID+"' onclick='f_info(\""+json.lesson[index].p_id+"\",\""+json.lesson[index].CName+"\",\""+json.lesson[index].CID+"\",\""+json.lesson[index].Score+"\")' class='ui google plus button btn_class'>課程資訊</button></td></tr>" ;
						p_temp[2]=p_temp[2] + parseInt(json.lesson[index].Credit);
						
					}
					
					if (json.lesson[index].Mso=="選修"){
						p_temp[1]=p_temp[1] + "<tr class='positive'><td  class='left aligned'>"+ json.lesson[index].CName +" "+str_remark+"</td><td >"+ json.lesson[index].Credit +"/"+ json.lesson[index].Hour +"</td><td >(已修過) 分數: "+ json.lesson[index].Score +"</td><td ><button id='btn_id_"+json.lesson[index].p_id+json.lesson[index].CID+"' onclick='f_info(\""+json.lesson[index].p_id+"\",\""+json.lesson[index].CName+"\",\""+json.lesson[index].CID+"\",\""+json.lesson[index].Score+"\")' class='ui google plus button btn_class'>課程資訊</button></td></tr>" ;
						p_temp[3]=p_temp[3] + parseInt(json.lesson[index].Credit);
					}

				 }
				 else if(json.lesson[index].Score=="修課中"){//修課中
					if (json.lesson[index].Mso=="必修"){
						p_temp[0]=p_temp[0] + "<tr ><td class='left aligned'>"+ json.lesson[index].CName +" "+str_remark+"</td><td >"+ json.lesson[index].Credit +"/"+ json.lesson[index].Hour +"</td><td >(修課中/已停修)</td><td ><button id='btn_id_"+json.lesson[index].p_id+json.lesson[index].CID+"' onclick='f_info(\""+json.lesson[index].p_id+"\",\""+json.lesson[index].CName+"\",\""+json.lesson[index].CID+"\",\""+json.lesson[index].Score+"\")' class='ui google plus button btn_class'>課程資訊</button></td></tr>" ;
					}
					
					if (json.lesson[index].Mso=="選修"){
						p_temp[1]=p_temp[1] + "<tr ><td class='left aligned'>"+ json.lesson[index].CName +" "+str_remark+"</td><td >"+ json.lesson[index].Credit +"/"+ json.lesson[index].Hour +"</td><td >(修課中/已停修)</td><td ><button id='btn_id_"+json.lesson[index].p_id+json.lesson[index].CID+"' onclick='f_info(\""+json.lesson[index].p_id+"\",\""+json.lesson[index].CName+"\",\""+json.lesson[index].CID+"\",\""+json.lesson[index].Score+"\")' class='ui google plus button btn_class'>課程資訊</button></td></tr>" ;
					}
				 } 
				  else{//未修課			 
					if (json.lesson[index].Mso=="必修"){
						p_temp[0]=p_temp[0] + "<tr ><td class='left aligned'>"+ json.lesson[index].CName +" "+str_remark+"</td><td >"+ json.lesson[index].Credit +"/"+ json.lesson[index].Hour +"</td><td >(未修過)</td><td ><button id='btn_id_"+json.lesson[index].p_id+json.lesson[index].CID+"' onclick='f_info(\""+json.lesson[index].p_id+"\",\""+json.lesson[index].CName+"\",\""+json.lesson[index].CID+"\",\""+json.lesson[index].Score+"\")' class='ui google plus button btn_class'>課程資訊</button></td></tr>" ;
					}
					
					if (json.lesson[index].Mso=="選修"){
						p_temp[1]=p_temp[1] + "<tr ><td class='left aligned'>"+ json.lesson[index].CName +" "+str_remark+"</td><td >"+ json.lesson[index].Credit +"/"+ json.lesson[index].Hour +"</td><td >(未修過)</td><td ><button id='btn_id_"+json.lesson[index].p_id+json.lesson[index].CID+"' onclick='f_info(\""+json.lesson[index].p_id+"\",\""+json.lesson[index].CName+"\",\""+json.lesson[index].CID+"\",\""+json.lesson[index].Score+"\")' class='ui google plus button btn_class'>課程資訊</button></td></tr>" ;
					}
				 } 
					 
				} 
			});  //--------------$.each( json.lesson, function( index ) {//已修過/未修迴圈
	
		jQuery("#R"+json.program[i].p_id+"_r").append(p_temp[0]);
		jQuery("#R"+json.program[i].p_id+"_r_get").append("<span>"+  p_temp[2] +  "</span>");
		if (json.program[i].credit_ele>0){
			jQuery("#R"+json.program[i].p_id+"_e").append(p_temp[1]);
			jQuery("#R"+json.program[i].p_id+"_e_get").append("<span>"+  p_temp[3] +  "</span>");
		}
		
		//計算進度的演算法
		obl_percent = (json.program[i].credit_obl /  json.program[i].credit_total ) * 100; //必修所佔的趴數
		ele_percent = 100- obl_percent; //剩下就是選修的
		each_obl_percent = obl_percent /json.program[i].credit_obl ;  //每一必修學分可得
		if (json.program[i].credit_low == json.program[i].credit_obl) {each_ele_percent=0;}
		 else {each_ele_percent = ele_percent / (json.program[i].credit_low- json.program[i].credit_obl) ;}//每一選修可得
		 var get = each_obl_percent * p_temp[2] ;
		 if (each_ele_percent *p_temp[3] >=ele_percent) { get+= ele_percent; } else { get+= each_ele_percent *p_temp[3] ;}
		 get =get.toFixed(0);
		 $('#R'+json.program[i].p_id+'_aria').progress({  autoSuccess: false,percent: get});
		//console.log(get); 計算取得百分比
	
	
	}//已上線學程迴圈
	

    $('.activating.element')  .popup();//訊息提示動作
	document.getElementById('hide_it').remove(); //移除遮罩
	
});



$('.ui .accordion')  .accordion(); //手風琴動作


 //----------------------------------------------------------------------------查詢課程資料視窗---------------------------------------------------
 
 temp ="" //全域變數
 
function f_info(p_id,l_name,cid,score){ //傳入資料 有 學程ID 、 課程名稱 、課id 、 分數
	$( "#btn_id_"+p_id+cid).addClass( "loading" ); //按鈕loadding
	$( ".btn_class").addClass( "disabled" ); //鎖住按鈕
	$('#loadding_info').dimmer('show');
	$("#lesson_info_name").empty(); //清空
	$("#lesson_info_show").empty(); //清空
	jQuery("#lesson_info_name").append(l_name); //課程名稱填入
	
	var postForm = {'cid' : cid,'score' : score,'p_id' : p_id};//包裝資料
		 $.ajax({ //Process the form using $.ajax()
            type    : 'POST', //Method type
            url       : 'php/api/lesson_info_json.php', //Your form processing file URL
            data      : postForm, //Forms name
            dataType  : 'json',
            success   : function(json) {//回傳格式year、sms、credit、hour、mso、tealist、tpa_spec
				if (json.info=="success"){			
					$.each( json.content, function(index) {
						var temp ='<button onclick="f_info_tpa_spec(\''+json.content[index].tpa_spec+'\')" class="ui google plus button">課程大綱</button>';
						
						jQuery("#lesson_info_show").append('<tr> <td>'+json.content[index].year+'年度'+json.content[index].sms+'</td> <td>'+json.content[index].CAName+'</td> <td>'+json.content[index].credit+'/'+json.content[index].hour+'</td> <td>'+json.content[index].mso+'</td> <td>'+json.content[index].tealist+'</td>		<td>'+temp+'</td> </tr>');
						
					});
				}
				else if(json.info=="new"){
					jQuery("#lesson_info_show").append('<tr><th colspan="6"> 此課程為新課程，尚未有課程大綱。</th> </tr>');
				}
								
				$('#loadding_info').dimmer('hide');
				$( "#btn_id_"+p_id+cid).removeClass( "loading" ); //移除按鈕loadding
				$( ".btn_class").removeClass( "disabled" ); //解除其他按紐
				$('.large.modal')  .modal('show');
			},//成功結束
			error: function(){//查無課程大綱
                jQuery("#lesson_info_show").append('<tr><th colspan="6"> Oops... 查無課程大綱，請重新查詢。</th> </tr>');
				$('#loadding_info').dimmer('hide');
				$( "#btn_id_"+p_id+cid).removeClass( "loading" ); //移除按鈕loadding
				$( ".btn_class").removeClass( "disabled" ); //解除其他按紐
				$('.large.modal')  .modal('show');
			}
        });

}

function f_info_tpa_spec(content){
	$('.coupled.modal')  .modal({    allowMultiple: true  }); //在原浮動視窗再跳出一個浮動
	$("#lesson_info_tpa_spec").empty();    //清空
	jQuery("#lesson_info_tpa_spec").append(content.replace(/\@/g,'</br>'));  //加入
	$('.second.modal')  .modal('show'); //show視窗
}


</script>


</body>
</html>
