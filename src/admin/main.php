<?php require 'safe/check_admin.php'; ?>



<!DOCTYPE html>
<html lang="zh-TW">
<head>
<title>MIS學程規劃系統</title>
<link rel="icon" href="/images/ICON.png" type="image/x-icon" > 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">

	

	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="//oss.maxcdn.com/semantic-ui/2.0.7/semantic.min.css">
	<script src="//oss.maxcdn.com/semantic-ui/2.0.7/semantic.min.js"></script>
	
	<script src="sweetalert/dist/sweetalert.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="sweetalert/dist/sweetalert.css">
	
	<link rel="stylesheet" href="/css/my_style.css">
	<script src="/js/my_javascript.js"></script>
	
<style>.form input {display: block !important;}</style>  <!-- 在sweetalert input 會被none -->

	
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
						<a class="item" href="/home.php" ><img src="/images/ICONw.png"></a>
						<a class="item" href="/main.php" >學程常見問題</a>
						<a class="item" href="/programPlan.php">學程規劃查詢</a>
						<a class="item" href="/programQuery.php">學程進度查詢</a>
						<a class="item" href="/about.php">關於我們</a>
						<div class="right menu">
							<div class="header item"><i class="student icon"></i><?php echo $_SESSION['s_UserName']; ?></div>
							<a class="active item" href="/admin/main.php"><i class="paw icon"></i><span>管理學程課程(後台)</span></a>
							<a class="item" href="/php/logout.php"><i class="sign out icon"></i>登出</a>
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
			<a class="item" href="/home.php" ><img class="ui middle aligned tiny image" src="/images/ICONw.png"></a>
			<div class="item"><h4><i class="student icon"></i><?php echo $_SESSION['s_UserName']; ?></h4></div>
			<a class="item" href="/main.php" >	<h3>學程常見問題 </h3></a>
			<a class="item" href="/programPlan.php"><h3>學程規劃查詢 </h3></a>
			<a class="item" href="/programQuery.php"><h3>學程進度查詢 </h3></a>
			<a class="item" href="/about.php"><h3>關於我們 </h3></a>
			<a class="active item" href="/admin/main.php"><i class="paw icon"></i><span>管理學程課程(後台)</span></a>
			<a class="item" href="/php/logout.php"><h4><i class="sign out icon"></i>登出 </h4></a>
		  </div>
		
	</div>
	
	
</div>	<!-- ... 選單結束 ... -->

</br>

<div class="ui container">

<div id="mytab">
	

	
	<?php 
		require 'dosomething/db_key.php';
			
		if (empty($_GET['o_active'])){$o_active=1;}
		else {$o_active=(int)$_GET['o_active'];}
				

		
			
		$str_top ='<div  class="ui top attached tabular menu">';
		$temp_active ='' ; //預設顯示
		$t_program="SELECT * FROM program  "  ; // 學程必選修排序
		$sqldata_t_program = $db->query($t_program);
		foreach($sqldata_t_program->fetchAll(PDO::FETCH_ASSOC)as $key => $row_program){
			if ($o_active ==  (int)$row_program['p_id']){$temp_active ='active';}
			$str_top .= '<a class="item ' . $temp_active . ' " data-tab="R'. $row_program['p_id'] .'">'. $row_program['p_name'] .'</a>';
			$temp_active ='';
			$last_pid= (int)$row_program['p_id'] ;
		}
		$str_top .= '<a class="item" ><button onclick="f_p_insert('.($last_pid+1).')" class="ui facebook button"><i class="add circle icon"></i>新增學程</button></a>';
		$str_top .= '</div>';
		echo $str_top ;
		
		$temp_active ='' ; //預設顯示
		$sqldata_t_program = $db->query($t_program);
		foreach($sqldata_t_program->fetchAll(PDO::FETCH_ASSOC)as $key => $row_program){
			if ($o_active ==  (int)$row_program['p_id']){$temp_active ='active';}
			$str='';
			$str .= '<div class="ui bottom attached tab segment ' . $temp_active . ' "  data-tab="R'. $row_program['p_id'] .'" >';
			$str .= '<table class="ui compact celled definition blue  table center aligned unstackable">';
			$str .= '<thead class="full-width">';
			$str .= '<tr>';
			$str .= '<th  class="one wide">學程ID</th><th  class="three wide">學程名稱</th><th  class="two wide">總學分</th><th class="two wide">最低應修學分</th><th class="one wide">代表色</th><th class="one wide">代表Icon</th><th class="one wide">檔案</th><th class="one wide">上線？</th><th class="four wide" >操作</th>';
			$str .= '</tr>';
			$str .= '</thead>';
			$str .= '<tbody >';
			$str .= '<td>'. $row_program['p_id'] .'</td> <td>'. $row_program['p_name'] .'</td> <td>'. $row_program['credit_total'] .'</td> <td> '. $row_program['credit_low'] .'</td> <td ><div class="ui  '. $row_program['p_color'] .' inverted segment"></div></td><td ><i class="'. $row_program['p_icon'] .' large icon"></i></td> ';
			
			if ($row_program['p_file_name'] !=""){
			$str .='<td ><a class="item" href="/downloads/'. $row_program['p_file_name'] .'" target="_blank"><i class="red file pdf outline large icon link"></i></a></td>';
			}
			else {
			$str .='<td >無檔案</td>';	
			}			
			
			if ($row_program['implement'] ==1){
			$str .=' <td>已上線</td> ';
			}
			else {
			$str .=' <td>準備中</td> ';	
			}
			
			
			
			//       多一個的字串 ,\''. $row_program['p_name'] .'\'
			$str .='<td ><button onclick="f_p_edit(\''. $row_program['p_id'] .'\',\''. $row_program['p_name'] .'\',\''. $row_program['credit_total'] .'\',\''. $row_program['credit_low'] .'\',\''. $row_program['p_color'] .'\',\''. $row_program['p_icon'] .'\',\''. $row_program['p_file_name'] .'\',\''. $row_program['implement'] .'\')" class="ui instagram  button"><i class="edit  icon"></i>修改學程資訊</button></td>';
			$str .= '</tbody>';
			$str .= '</table>';
			$str .= '<table class="ui compact celled definition red table center aligned unstackable">';
			$str .= '<thead class="full-width">';
			$str .= '<tr>';
			$str .= '<th  class="one wide">課程ID</th><th  class="three wide">課程名稱</th><th  class="one wide">學程學分數</th><th  class="one wide">學程時數</th><th  class="two wide">學程必/選修</th><th  class="two wide">開課時間</th><th  class="one wide">備註</th><th class="five wide" colspan="2"> <button onclick="f_insert(\''. $row_program['p_id'] .'\',\''. $row_program['p_name'] .'\')" class="ui red button"><i class="add circle icon"></i>新增課程</button></th>';
			$str .= '</tr>';
			$str .= '</thead>';
			$str .= '<tbody id="t_R'. $row_program['p_id'] .'">';
			$str .= '</tbody>';
			$str .= '</table>';
			
			
			
			$str .= '<table class="ui compact celled  yellow table center aligned unstackable">';
			$str .= '<thead class="full-width">';
			$str .= '<tr>';
			$str .= '<th colspan="7">雷達分析數值</th>';
			$str .= '</tr>';
			$str .= '</thead>';
			
			$str .= '<tbody>';
			
			$str .= '<tr ><td>邏輯能力</td><td>設計能力</td><td>程式能力</td><td>企業組織</td><td>行銷能力</td><td>社交能力</td><td>創意思考</td></tr>';
			$str .= '<tr>';
			
			
			$str .= '<td><div class="ui fluid transparent input"> <input type="number" max="100" min="0" value="'.$row_program['radar_1'].'" style="text-align:center;" id="radar_'.$row_program['p_id'].'_1"></div></td>';
			$str .= '<td><div class="ui fluid transparent input"> <input type="number" max="100" min="0" value="'.$row_program['radar_2'].'" style="text-align:center;" id="radar_'.$row_program['p_id'].'_2"></div></td>';
			$str .= '<td><div class="ui fluid transparent input"> <input type="number" max="100" min="0" value="'.$row_program['radar_3'].'" style="text-align:center;" id="radar_'.$row_program['p_id'].'_3"></div></td>';
			$str .= '<td><div class="ui fluid transparent input"> <input type="number" max="100" min="0" value="'.$row_program['radar_4'].'" style="text-align:center;" id="radar_'.$row_program['p_id'].'_4"></div></td>';
			$str .= '<td><div class="ui fluid transparent input"> <input type="number" max="100" min="0" value="'.$row_program['radar_5'].'" style="text-align:center;" id="radar_'.$row_program['p_id'].'_5"></div></td>';
			$str .= '<td><div class="ui fluid transparent input"> <input type="number" max="100" min="0" value="'.$row_program['radar_6'].'" style="text-align:center;" id="radar_'.$row_program['p_id'].'_6"></div></td>';
			$str .= '<td><div class="ui fluid transparent input"> <input type="number" max="100" min="0" value="'.$row_program['radar_7'].'" style="text-align:center;" id="radar_'.$row_program['p_id'].'_7"></div></td>';
			$str .= '</tr>';
			
			$str .= '<tr><td colspan="7"><button class="ui center floated  inverted  brown  button" onclick="f_edit_radar('. $row_program['p_id'] .')">更新數值</button></td></tr>';
			
			$str .= '</tbody>';
			
			
			$str .= '</table>';
			
			
			$str .= '</div>';
			
			echo $str;
			$temp_active = '';
		}
		
		
		$db = null;  
	?>
	
 </br>
  
</div>


</div>





<script>


$("#mytab .menu .item") .tab(); //tab功能寫入
//----------------------------------------------------------------------------顯示在版面上的資訊---------------------------------------------------
$.getJSON( "dosomething/get_pl_json.php", function( json ) { //根目錄下的json資料夾

		  $.each( json, function( index ) {
			  
			  var	temp_course_time="";
				switch (json[index].course_time) {
					case "0":        temp_course_time = "未定義";        break;
					case "1":        temp_course_time = "大一上學期";        break;
					case "2":        temp_course_time = "大一下學期";        break;
					case "3":        temp_course_time = "大二上學期";        break;
					case "4":        temp_course_time = "大二下學期";        break;
					case "5":        temp_course_time = "大三上學期";        break;
					case "6":        temp_course_time = "大三下學期";        break;
					case "7":        temp_course_time = "大四上學期";        break;
					case "8":        temp_course_time = "大四下學期";        break;
				}	 
					var str_remark="";
					if ( json[index].remark!=""){str_remark="<i class='activating element large icons link' data-content='"+ json[index].remark+"' data-variation='wide'><i class='big loading lemon icon'></i><i class='info  icon'></i></i>";}
			  
				  		jQuery("#t_R"+json[index].p_id  ).append(" <tr >      <td>"+ json[index].l_id+"</td>      <td>"+ json[index].name+"</td>      <td>"+ json[index].p_credit+"</td>      <td>"+ json[index].p_hour+"</td>  	  		<td>"+ json[index].p_obl_or_ele+"</td>			<td>"+ temp_course_time +"</td><td>"+str_remark+"</td>	<td><button  onclick='f_edit("+json[index].p_id+",\""+json[index].l_id+"\",\""+json[index].name+"\",\""+json[index].p_credit+"\",\""+json[index].p_hour+"\",\""+json[index].p_obl_or_ele+"\",\""+json[index].course_time+"\",\""+json[index].remark+"\"   )'  class='ui teal button'><i class='edit icon'></i>修改課程</button></td>  <td><button onclick='f_delete("+json[index].p_id+",\""+json[index].l_id+"\",\""+json[index].name+"\")' class='ui grey button'><i class='remove circle icon'></i>刪除課程</button></td>  </tr>"); // →\"← 寫入"符號
			 });
			 $('.activating.element')  .popup();//訊息提示動作
 });

 
  //--學程學程學程學程學程學程學程學程學程學程學程學程-----------新增＂學程＂的視窗---------------學程學程學程學程學程學程學程學程學程學程學程學程學程學程學程學程
function f_p_insert(last_pid){ //這次要的p_id
	
	var str='<form  class="ui form" id="myform" >';
	
	str += '<img src="images/onload.png" onload="$(\'.ui.dropdown\') .dropdown(); " style="display:none;">';
	
	str +='<h1 class="ui  header" style="font-weight: bold;">建立新學程</h1>';
	
	str += '<div class="field">    <label>新學程名稱</label>  <input id="insert_p_name" type="text" >	<label>學程總學分</label>   		<input id="insert_p_credit_total" type="number" value="0">  	<label>學程最低應修學分</label>   		<input id="insert_p_credit_low" type="number" value="0"> 	<label>代表色</label>   			' ;
	
	
	str+='<div class="ui selection dropdown ">  <input type="hidden" value="pink" id="myselectcolor">  <i class="dropdown icon"></i>  <div class="default text" ><div class="ui pink label">　　　</div>Pink(預設)</div>  <div class="menu">  <div class="item" data-value="pink"><div class="ui pink label">　　　</div>Pink</div>  <div class="item" data-value="red"><div class="ui red label">　　　</div>Red</div> <div class="item" data-value="orange"><div class="ui orange label">　　　</div>Orange</div> <div class="item" data-value="yellow"><div class="ui yellow label">　　　</div>Yellow</div> <div class="item" data-value="olive"><div class="ui olive label">　　　</div>Olive</div> <div class="item" data-value="green"><div class="ui green label">　　　</div>Green</div> <div class="item" data-value="teal"><div class="ui teal label">　　　</div>Teal</div> <div class="item" data-value="blue"><div class="ui blue label">　　　</div>Blue</div> <div class="item" data-value="violet"><div class="ui violet label">　　　</div>Violet</div> <div class="item" data-value="purple"><div class="ui purple label">　　　</div>Purple</div> <div class="item" data-value="brown"><div class="ui brown label">　　　</div>Brown</div> <div class="item" data-value="grey"><div class="ui grey label">　　　</div>Grey</div> <div class="item" data-value="black"><div class="ui black label">　　　</div>Black</div>  </div></div>';
	
	str+='<label>代表Icon</label><div  class="ui fluid  search special selection dropdown " id="icon-select">  <input type="hidden" name="select_icon" >  <i class="dropdown icon"></i>  <div class="default text">Select icon</div>  <div class="menu">';
	
	 $.getJSON( "dosomething/icons.json", function( json ) {	
	  $.each( json, function(index) {
		str += " <div class='item' data-value='"+json[index]+"'><i class='"+json[index]+" big icon'></i>"+json[index]+"</div>" ;
	  });
	 
	str +='</div></div> <label>學程資料檔案上傳</label><a href="javascript:;" onclick="window.open(\'dosomething/upload_file.php\',\'_blank\',\'width=\'+512+\',height=\'+384+\',resizable=yes,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,scrollbars=yes,resizable=1\');"><div class="ui fluid instagram button">至此做上傳動作 </div></a> <label>檔案名稱回填</label><input id="insert_p_file_name" type="text" >'
	
	str+='</form>';
	
	str+='<style>' ;
	str+=	'.ui.form {font-size:1em !important;}'; //字型大小
	str+=	'.ui.selection.dropdown{color: black  !important;}.sweet-alert p {font-weight:bold!important;}' //字的顏色、粗體
	str+=	'.ui.selection.dropdown .menu {max-height: 10rem !important;}'; //調整選單最高
	str+= '</style>';

	swal({
		title:null ,
		text: str,
		showCancelButton: true,
		cancelButtonText: "暫時不要!",
		confirmButtonColor: '#DD6B55',
		confirmButtonText: '確定',
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
		html: true
	},
	function(){
		
		var postForm = { 
				'new_p_id' : last_pid,
				'p_name' :document.getElementById("insert_p_name").value,
				'p_credit_total' :document.getElementById("insert_p_credit_total").value,
				'p_credit_low' :document.getElementById("insert_p_credit_low").value,
				'p_color' :document.getElementById("myselectcolor").value,
				'p_icon' :document.getElementsByName('select_icon')[0].value,
				'p_file_name' : document.getElementById("insert_p_file_name").value

		};//包裝資料
				setTimeout(function(){			
				$.ajax({ //Process the form using $.ajax()
						type      : 'POST', //Method type
						url       : 'dosomething/insert_p.php', //Your form processing file URL
						data      : postForm, //Forms name
						dataType  : 'text',
						success   : function(data) {
											//alert (data);
										}
					});
				swal({title:"新增完成",type: "success"},function(){location.replace(location.href.split("?")[0]+'?o_active='+last_pid);});   	
			}, 2000);//兩秒

			
	});
	
	}); //getJSON 如此變數才不會消失
}

function f_icon_action(){ $('#icon-select').dropdown({direction: 'upward'});}
  
//--學程學程學程學程學程學程學程學程學程學程學程學程-----------修改＂學程＂的視窗---------------學程學程學程學程學程學程學程學程學程學程學程學程學程學程學程學程
function f_p_edit(p_id,o_p_name,o_total,o_low,o_color,o_icon,o_file_name,implement){ 
	
	var str='<form  class="ui form" id="myform" >';  	 
	
	str += '<img src="images/onload.png" onload="$(\'.ui.dropdown\') .dropdown(); " style="display:none;">';
	
	str +='<h1 class="ui  header" style="font-weight: bold;">修改 '+o_p_name+ ' 學程資訊</h1>';
	
	str +='<div class="field">    <label>修改學程名稱</label>  <input id="insert_p_name" type="text" value="'+o_p_name+'">	<label>學程總學分</label>   		<input id="insert_p_credit_total" type="number" value="'+o_total+'">  	<label>學程最低應修學分</label>   		<input id="insert_p_credit_low" type="number" value="'+o_low+'"> 	<label>代表色</label>   			' ;
	
	
	str+='<div class="ui selection dropdown ">  <input type="hidden" value="'+o_color+'" id="myselectcolor">  <i class="dropdown icon"></i>  <div class="default text" ><div class="ui '+o_color+' label">　　　</div>'+o_color+'</div>  <div class="menu">  <div class="item" data-value="red"><div class="ui red label">　　　</div>Red</div> <div class="item" data-value="orange"><div class="ui orange label">　　　</div>Orange</div> <div class="item" data-value="yellow"><div class="ui yellow label">　　　</div>Yellow</div> <div class="item" data-value="olive"><div class="ui olive label">　　　</div>Olive</div> <div class="item" data-value="green"><div class="ui green label">　　　</div>Green</div> <div class="item" data-value="teal"><div class="ui teal label">　　　</div>Teal</div> <div class="item" data-value="blue"><div class="ui blue label">　　　</div>Blue</div> <div class="item" data-value="violet"><div class="ui violet label">　　　</div>Violet</div> <div class="item" data-value="purple"><div class="ui purple label">　　　</div>Purple</div> <div class="item" data-value="pink"><div class="ui pink label">　　　</div>Pink</div> <div class="item" data-value="brown"><div class="ui brown label">　　　</div>Brown</div> <div class="item" data-value="grey"><div class="ui grey label">　　　</div>Grey</div> <div class="item" data-value="black"><div class="ui black label">　　　</div>Black</div>  </div></div>';
	
	str+='<label>代表Icon</label><div  class="ui fluid  search special selection dropdown " id="icon-select">  <input type="hidden" name="select_icon"  value="'+o_icon+'">  <i class="dropdown icon"></i>  <div class="default text">	<i class="'+o_icon+' big icon"></i>'+o_icon+' </div>  <div class="menu">';
	

	
	 $.getJSON( "dosomething/icons.json", function( json ) {	
	  $.each( json, function(index) {
		str += " <div class='item' data-value='"+json[index]+"'><i class='"+json[index]+" big icon'></i>"+json[index]+"</div>" ;
	  });
	 
	str +='</div></div> <label>學程資料檔案上傳</label>  <a href="javascript:;" onclick="window.open(\'dosomething/upload_file.php\',\'_blank\',\'width=\'+512+\',height=\'+384+\',resizable=yes,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,scrollbars=yes,resizable=1\');"><div class="ui  fluid instagram button">至此做上傳動作 </div></a> <label>檔案名稱回填</label><input id="insert_p_file_name" type="text"  value="'+o_file_name+'">'
	
	if (implement=='0'){
		str += '<label>是否能上線</label><select class="ui dropdown" id="edit_p_implement"  ><option value="0" >準備中</option><option value="1" >可上線</option></select>  ';
		}
	else{
		str += '<label>是否能上線</label><select class="ui dropdown" id="edit_p_implement"  ><option value="1" >可上線</option><option value="0" >準備中</option></select>  ';
		}
	
	
	
	
	str+='</form>';
	
	str+='<style>' ;
	str+=	'.ui.form {font-size:1em !important;}'; //字型大小
	str+=	'.ui.selection.dropdown{color: black  !important;}.sweet-alert p {font-weight:bold!important;}' //字的顏色、粗體
	str+=	'.ui.selection.dropdown .menu {max-height: 10rem !important;}'; //調整選單最高
	str+= '</style>';

	swal({
		title: null ,
		text: str,
		showCancelButton: true,
		cancelButtonText: "暫時不要!",
		confirmButtonColor: '#DD6B55',
		confirmButtonText: '確定',
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
		html: true
	},
	function(){
		
		var postForm = { 
				'p_id' : p_id,
				'p_name' :document.getElementById("insert_p_name").value,
				'p_credit_total' :document.getElementById("insert_p_credit_total").value,
				'p_credit_low' :document.getElementById("insert_p_credit_low").value,
				'p_color' :document.getElementById("myselectcolor").value,
				'p_icon' :document.getElementsByName('select_icon')[0].value,
				'p_file_name' : document.getElementById("insert_p_file_name").value,
				'implement' : document.getElementById("edit_p_implement").value

		};//包裝資料
				setTimeout(function(){			
				$.ajax({ //Process the form using $.ajax()
						type      : 'POST', //Method type
						url       : 'dosomething/edit_p.php', //Your form processing file URL
						data      : postForm, //Forms name
						dataType  : 'text',
						success   : function(data) {
											//alert (data);
										}
					});
				swal({title:"完成編輯",type: "success"},function(){location.replace(location.href.split("?")[0]+'?o_active='+p_id);});   	
			}, 2000);//兩秒

			
	});
	
	}); //getJSON 如此變數才不會消失
}


 
 //--課課課課課課課課課課課課課課課課課課課課課課課---------------------------------------新增＂學程的課＂的視窗-------------------------課課課課課課課課課課課課課課課課課課課課課課課
function f_insert(p_id,p_name){ //傳入資料 有 課程id 課程名稱
	
	
	var str='<form onpageshow="" class="ui form" id="myform">' ;
	str +='<h1 class="ui  header" style="font-weight: bold;">新增 '+p_name+ ' 學程的課</h1>';
	str += '<img src="images/onload.png" onload="$(\'.ui.dropdown\') .dropdown(); $(\'.ui.dropdown.upward\').dropdown({direction: \'upward\'});" style="display:none;">';
	
	str += ' <div class="field">   <h2 class="ui orange header" style="margin-bottom:2px;font-weight: bold;">Step1.選擇查課方式</h2>	<div class="ui selection dropdown">  <input type="hidden" onchange="f_new_or_select_u(this.value);">  <i class="dropdown icon"></i>  <div class="default text">選擇查課方式</div>  <div class="menu">    <div class="item" data-value="0">查詢系所近兩學期所開的課(校務系統)</div>    <div class="item" data-value="1">自訂新課／校務系統中無資料．．．</div>  </div></div>'
	
	str +='<div class="field"  id="inside_form" style="margin-top:5px;">';
	
	str +='</div>';
	

  
 str += '</form>';

	str+='<style>' ;
	str+=	'.ui.form {font-size:1em !important;}'; //字型大小
	str+=	'.ui.selection.dropdown{color: black  !important;}.sweet-alert p {font-weight:bold!important;}' //字的顏色、粗體
	str+=	'.sweet-alert {top:20% !important;}';  //視窗顯示高度
	str+=	'.ui.selection.dropdown .menu {max-height: 10rem !important;}'; //調整選單最高
	str+=    '.sweet-alert fieldset{display:none !important;}';
	str+= '</style>';
  
  
	swal({
		title: null ,
		text: str,
		showCancelButton: true,
		cancelButtonText: "暫時不要!",
		confirmButtonColor: '#DD6B55',
		confirmButtonText: '確定',
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
		customClass: '.margin_bottom' ,
		html: true
	},
	function(){
		if (document.getElementById("search-select").value!=""){
		var postForm = { 
				'p_id' : p_id,
				'l_id' : document.getElementById("search-select").value,
				'l_name'     : document.getElementById("search-select").options[document.getElementById("search-select").selectedIndex].text,
				'p_credit'     : document.getElementById("insert_p_credit").value,
				'p_hour'     : document.getElementById("insert_p_hour").value,
				'p_obl_or_ele'     : document.getElementById("insert_p_obl_or_ele").value,
				'course_time'     : document.getElementById("insert_course_time").value,
				'remark'     : document.getElementById("insert_remark").value
		};//包裝資料
				setTimeout(function(){			
				$.ajax({ //Process the form using $.ajax()
						type      : 'POST', //Method type
						url       : 'dosomething/insert_pl.php', //Your form processing file URL
						data      : postForm, //Forms name
						dataType  : 'text',
						success   : function(data) {
											//alert (data);
										}
					});
				swal({title:"新增完成",type: "success"},function(){location.replace(location.href.split("?")[0]+'?o_active='+p_id);});   	
			}, 2000);//兩秒
		}
		else{
			setTimeout(function(){			
					swal({title:"新增失敗",text:"課程名稱錯誤",type: "error"});
			}, 500);//兩秒
			
		} 
			
	});
	

}


function f_new_or_select_u(choose){
		
		$("#inside_form").empty(); //清空
		var str='';
		
	if (choose==0){
			
			
		var uname =[ { "UID": "UM78", "UFName": "資訊管理系", "UAName": "資管系"},{ "UID": "UH58", "UFName": "文化創意產業系", "UAName": "文創系"},  { "UID": "UM65", "UFName": "財富與稅務管理系", "UAName": "財管系"}, { "UID": "UM74", "UFName": "企業管理系", "UAName": "企管系"}, { "UID": "UM76", "UFName": "觀光管理系", "UAName": "觀光系"},{ "UID": "UC02", "UFName": "會計系", "UAName": "會計系"}, { "UID": "UC06", "UFName": "金融系", "UAName": "金融系"}, { "UID": "UC07", "UFName": "財政稅務系", "UAName": "財稅系"}, { "UID": "UC11", "UFName": "國際企業系", "UAName": "國企系"}, { "UID": "UH00", "UFName": "人文社會學院", "UAName": "人文社會學院"}, { "UID": "UH51", "UFName": "應用外語系", "UAName": "應外系"}, { "UID": "UH52", "UFName": "文化事業發展系", "UAName": "文化系"}, { "UID": "UH53", "UFName": "人力資源發展系", "UAName": "人資系"}, { "UID": "UE15", "UFName": "資訊工程系", "UAName": "資工系"}, { "UID": "UE16", "UFName": "化學工程與材料工程系", "UAName": "化材系"}, { "UID": "UE23", "UFName": "土木工程系", "UAName": "土木系"}, { "UID": "UE25", "UFName": "機械工程系", "UAName": "機械系"}, { "UID": "UE27", "UFName": "電機工程系", "UAName": "電機系"}, { "UID": "UE29", "UFName": "電子工程系", "UAName": "電子系"}, { "UID": "UE31", "UFName": "模具工程系", "UAName": "模具系"}, { "UID": "UE72", "UFName": "工業工程與管理系", "UAName": "工管系"} ];
		
		
		str +='<h2 class="ui blue header" style="margin-bottom:2px;font-weight: bold;">Step2.選擇系所</h2>';
		str +='<select   class="ui search dropdown upward2" onchange="f_select_u(this.value);"> ';
		 
		for (var i =0 ; i<uname.length;i++){
			str +='<option value="'+  uname[i].UID +'" >'+ uname[i].UFName+'</option>';			
		}
		
		str +='</select>';	
		
		str +='<div class="field"  id="u_lesson_form" style="margin-top:5px;"></div>'; //儲存選課
		str +='<div class="field"  id="u_lesson_info_form" style="margin-top:5px;"></div>'; //儲存確認資訊
	
		

	}
	else if(choose==1) { //選擇自定義
		
		
		str +='<h2 class="ui blue header" style="margin-bottom:2px;font-weight: bold;">Step2.自定義以下資料</h2>';
		
		str +='<select    id="search-select"  style="display:none;">  </select>'; //儲存用
		str +='<input type="text" placeholder="自定義課程名稱" onblur="f_insert_option(this.value,\'99999\');">';
		 
		 str =str +"<label>學程必選修</label>   		<select class='ui dropdown second' id='insert_p_obl_or_ele'  >           		<option value='obl' >必修</option>   <option value='ele' >選修</option></select>  <label>學程學分數</label>  <div class='ui input'>  <input id='insert_p_credit' type='number' value='0'></div>   <label>學程時數</label> 	<div class='ui input'>  <input id='insert_p_hour' type='number' value='0'></div>	<label>開課時間</label>   		<select class='ui dropdown second' id='insert_course_time'  >           		<option value='0' >未定義</option>      	<option value='1' >大一上學期</option><option value='2' >大一下學期</option><option value='3' >大二上學期</option><option value='4' >大二下學期</option><option value='5' >大三上學期</option><option value='6' >大三下學期</option><option value='7' >大四上學期</option><option value='8' >大四下學期</option></select>" ;
			
	}
	
	str += '<label>備註(沒有的話請留空)</label><textarea rows="1" id="insert_remark"></textarea> '; 
	
	jQuery("#inside_form").append(str);
	$('.ui.dropdown.second') .dropdown(); 
	$('.ui.dropdown.upward2').dropdown({direction: 'upward'});
}

function f_select_u(UID){ //選擇系所後會查詢課程
	$('.ui.search.dropdown.upward2').addClass('disabled loading');
	$("#u_lesson_form").empty(); //清空
	$("#u_lesson_info_form").empty();	
	
	$.ajax({ //Process the form using $.ajax()
		type      : 'POST', //Method type
		url       : '/php/api/get_u_lesson_json.php', //Your form processing file URL
		data      :  {'UntId' : UID} , //Forms name
		dataType  : 'json',
		success   : function(json) {
			
			
			str ='';
			str +='<h2 class="ui violet header" style="margin-bottom:2px;font-weight: bold;">Step3.選擇課</h2>';
			str += '<input id="insert_p_credit" style="display:none!important;">'; 
			str += '<input id="insert_p_hour" style="display:none!important;">';
			str += '<input id="insert_p_obl_or_ele" style="display:none!important;">';
			str += '<input id="insert_course_time" style="display:none!important;">';
			str +='<select    id="search-select"  style="display:none!important;">  </select>'; //儲存用
			
			str +='<select   class="ui search dropdown upward3" onchange="f_select_u_lesson(this.value);"> ';
			
			
			
			  $.each( json, function(index) {
				var temp = "['"+json[index].CID+"','"+json[index].CName+"','"+json[index].Credit+"','"+json[index].mso+"','"+json[index].course_time+"']";
				str += '<option value="'+temp+'">'+json[index].CName+'</option >';
			  });
			
			str +='</select>';
			
			
			
			jQuery("#u_lesson_form").append(str);
			$('.ui.search.dropdown.upward2').removeClass('disabled loading');
			$('.ui.dropdown.third') .dropdown(); 
			$('.ui.dropdown.upward3').dropdown({direction: 'upward'});
		}
	});
}
function f_select_u_lesson(value){
	
	value = value.replace(/'/g,'"');
	json =  JSON.parse(value);
	//["01557","國文(一)","2","obl","1"]
	f_insert_option(json[1],json[0]);
	document.getElementById("insert_p_credit").value = json[2] ;
	document.getElementById("insert_p_hour").value = json[2] ;
	document.getElementById("insert_p_obl_or_ele").value = json[3] ;
	document.getElementById("insert_course_time").value =json[4];
	
	if (json[3]=='obl'){json[3]='必修';}	else {json[3]='選修';}
	
	if (json[4]=='1'){json[4]='大一上學期';}
	if (json[4]=='2'){json[4]='大一下學期';}
	if (json[4]=='3'){json[4]='大二上學期';}
	if (json[4]=='4'){json[4]='大二下學期';}
	if (json[4]=='5'){json[4]='大三上學期';}
	if (json[4]=='6'){json[4]='大三下學期';}
	if (json[4]=='7'){json[4]='大四上學期';}
	if (json[4]=='8'){json[4]='大四下學期';}
	
	str='';
	str += '<h2 class="ui red header" style="margin-bottom:2px;font-weight: bold;">Step4.確認課程資料</h2>' ;
	
	str+='<table class="ui brown very compact table center aligned  striped" >  <tbody>  <tr><td colspan="4" style="paddling:.1em !important;"><h3 class="ui brown header" style="margin-bottom:2px;margin-top:5px;">'+json[1]+'</h3></td>   </tr>  <tr style="paddling:.1em !important;">      <td>ID</td>           <td>學分/時數</td>      <td>必選修</td>      <td>開課時段</td>    </tr>       <tr>      <td>'+json[0]+'</td>          <td>'+json[2]+'/'+json[2]+'</td>      <td>'+json[3]+'</td>      <td>'+json[4]+'</td>    </tr>  </tbody></table>';
	
	jQuery("#u_lesson_info_form").empty();	
	jQuery("#u_lesson_info_form").append(str);
	
}


function f_insert_option(text,value){ //自定義時 課程名稱放入 CID為99999的空間內
	if( (document.getElementById("search-select").options[0])!=null   ){
		document.getElementById("search-select").removeChild(document.getElementById("search-select").options[0]);  
	}
	if (text ==''){value=''}; //不給加入
    var x = document.createElement("option");
    x.setAttribute("value", value);
    var t = document.createTextNode(text);
    x.appendChild(t);
    document.getElementById("search-select").appendChild(x);
}


 
  //----------------------------------------------------------------------------刪除學程課的視窗---------------------------------------------------
function f_delete(p_id,l_id,l_name){
	var	p_name="";
	switch (p_id) {
		case 1:        p_name = "創新網路學程";        break;
		case 2:        p_name = "資通訊系統開發學程";        break;
		case 3:        p_name = "企業資源規劃學程";        break;
		case 4:        p_name = "互動設計學程";        break;
	}	
	swal({
		title: "Are you sure?",
		text: "<h3 style='color:#FF3333'> 您將刪除 " +p_name +" 中的 " +l_name +" 。</h3>",
		type: "warning",
		showCancelButton: true,
		cancelButtonText: "暫時不要!",
		confirmButtonColor: '#DD6B55',
		confirmButtonText: '確定',
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
		html: true
	},
	function(){
		var postForm = { 
				'p_id' : p_id,
				'l_id' : l_id,
		};//包裝資料
		setTimeout(function(){			
				$.ajax({ //Process the form using $.ajax()
						type      : 'POST', //Method type
						url       : 'dosomething/delete_pl.php', //Your form processing file URL
						data      : postForm, //Forms name
						dataType  : 'text',
						success   : function(data) {
											//alert (data);
										}
					});
				swal({title:"已刪除",type: "success"},function(){location.replace(location.href.split("?")[0]+'?o_active='+p_id);});   	
			}, 2000);//兩秒
	});
}

 //----------------------------------------------------------------------------編輯學程課的視窗---------------------------------------------------
 function f_edit(p_id,l_id,l_name,p_credit,p_hour,p_obl_or_ele,course_time,remark){
	 	 
	 if (p_obl_or_ele=="必修"){var temp_p_obl_or_ele ="selected"; var temp2_p_obl_or_ele ="" ; }else {var temp_p_obl_or_ele ="" ;  var temp2_p_obl_or_ele ="selected" ;}
	 
	 var temp_course_time = new Array("", "", "", "", "", "", "", "", "");
	 for (var i=0;i<=8;i++){
		  if (parseInt(course_time)==i){temp_course_time[i]="selected";}
	 }
	 
	 var t_course_time ="<label>開課時間</label>    		<select class='ui dropdown' id='fo_course_time' >  <option value='0' "+ temp_course_time[0] +" >未定義</option><option value='1' "+ temp_course_time[1]  +" >大一上學期</option><option value='2' "+ temp_course_time[2]  +" >大一下學期</option><option value='3' "+ temp_course_time[3]  +" >大二上學期</option><option value='4' "+ temp_course_time[4]  +" >大二下學期</option><option value='5' "+ temp_course_time[5]  +" >大三上學期</option><option value='6' "+ temp_course_time[6]  +" >大三下學期</option><option value='7' "+ temp_course_time[7]  +" >大四上學期</option><option value='8' "+ temp_course_time[8]  +" >大四下學期</option>    		</select>";
	 
	 var str ="<form  class='ui form' id='myform'>  	 <div class='field'>    		<label>課程名稱</label>   		<input  id='fo_l_name' type='text'  value="+ l_name +">		<label>學程學分數</label>   		<input type='number' id='fo_p_credit'  value="+ p_credit +">	<label>學程時數</label>   		<input type='number' id='fo_p_hour'  value="+ p_hour +">			<label>學程必選修</label>    		<select class='ui dropdown' id='fo_p_obl_or_ele'  >           		<option value='obl' "+ temp_p_obl_or_ele +">必修</option>      		<option value='ele'  "+ temp2_p_obl_or_ele +">選修</option>    		</select> " + t_course_time + "	</div> <label>備註</label><textarea rows='2' id='fo_remark'>"+remark+"</textarea></form>";
	 
	 str += '<img src="images/onload.png" onload="$(\'.ui.dropdown\') .dropdown(); " style="display:none;">';	 
	 
	 
	 str+='<style>' ;
	str+=	'.ui.form {font-size:1em !important;}'; //字型大小
	str+=	'.ui.selection.dropdown{color: black  !important;}.sweet-alert p {font-weight:bold!important;}' //字的顏色、粗體
	str+=	'.ui.selection.dropdown .menu {max-height: 10rem !important;}'; //調整選單最高
	str+= '</style>';
	 
swal({
		title: "編輯課程資料",
		text: str,
		showCancelButton: true,
		cancelButtonText: "取消!",
		confirmButtonColor: '#DD6B55',
		confirmButtonText: '確定修改',
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
		html: true
	},
	function(){
		var postForm = { 
				'p_id' : p_id,
				'l_id' : l_id,
				'l_name' : document.getElementById("fo_l_name").value,
				'p_credit'     : document.getElementById("fo_p_credit").value,
				'p_hour'     : document.getElementById("fo_p_hour").value,
				'p_obl_or_ele'     : document.getElementById("fo_p_obl_or_ele").value,
				'course_time'     : document.getElementById("fo_course_time").value,
				'remark': document.getElementById("fo_remark").value
		};//包裝資料
		 $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : 'dosomething/edit_pl.php', //Your form processing file URL
            data      : postForm, //Forms name
            dataType  : 'text',
            success   : function(data) {
								//alert (data);
                            }
        });
		
		setTimeout(function(){   
				//觸動刪除
				swal({title:"完成編輯",type: "success"},function(){location.replace(location.href.split("?")[0]+'?o_active='+p_id);});   	
		}, 2000);//兩秒
		
	});
}
 
 
function f_dropdown_action(){
	$('.ui.dropdown') .dropdown();
}

function f_edit_radar(p_id){
	var postForm = { 
				'p_id' : p_id,
				'radar_1' : document.getElementById('radar_'+p_id+'_1').value,
				'radar_2' : document.getElementById('radar_'+p_id+'_2').value,
				'radar_3' : document.getElementById('radar_'+p_id+'_3').value,
				'radar_4' : document.getElementById('radar_'+p_id+'_4').value,
				'radar_5' : document.getElementById('radar_'+p_id+'_5').value,
				'radar_6' : document.getElementById('radar_'+p_id+'_6').value,
				'radar_7' : document.getElementById('radar_'+p_id+'_7').value
		};//包裝資料
	
	 $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : 'dosomething/edit_radar.php', //Your form processing file URL
            data      : postForm, //Forms name
            dataType  : 'text',
            success   : function(data) {
								swal({title:"完成編輯",type: "success"},function(){location.replace(location.href.split("?")[0]+'?o_active='+p_id);});   	
                            }
     });

	
}

</script>
	
</body>
</html>
