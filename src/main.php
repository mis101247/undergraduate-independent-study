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
						<a class="active item" href="main.php" >學程常見問題</a>
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
		<div class="ui large main menu  inverted"style="background-color: #004f72;  ">
					<div class="ui  menu  inverted  fluid container "style="background-color: #004f72;">
						<div class="item"><i class="big link sidebar icon" onclick="f_menu()"></i></div>
						<div class="header item">	<h1>MIS學程規劃系統 </h1></div>
					</div>
		</div>
		
		<div class="ui sidebar inverted vertical menu" id="show_menu" style="background-color: #004f72;  ">
			<a class="item" href="home.php" ><img class="ui middle aligned tiny image" src="images/ICONw.png"></a>
			<div class="item"><h4><i class="student icon"></i><?php echo $_SESSION['s_UserName']; ?></h4></div>
			<a class="active item" href="main.php" >	<h3>學程常見問題 </h3></a>
			<a class="item" href="programPlan.php"><h3>學程規劃查詢 </h3></a>
			<a class="item" href="programQuery.php"><h3>學程進度查詢 </h3></a>
			<a class="item" href="about.php"><h3>關於我們 </h3></a>
			<?php require('admin/whoru.php'); ?>
			<a class="item" href="php/logout.php"><h4><i class="sign out icon"></i>登出 </h4></a>
		  </div>
	
	</div>
	
	
</div>	<!-- ... 選單結束 ... -->

		
  <h1 class="ui header" style="position:relative;top:-25px;">學程常見問題</h1>
   <P  align="center"  style="position:relative;top:-25px;" >許多人對於學程方面有許多疑問，因此我們彙整了以下比較常見的問題給大家參考。</P>
    <P  align="center"     style="position:relative;top:-25px;"> 若同學們還有更多問題可寄信至wbwty103@gmail.com發問，我們會盡快為您解答。</P>
	<div class="ui container raised segment" style="position:relative;top:-25px;">
	 <div align="center" class="ui styled fluid accordion"    >

              

                <div  style="background-color:#d1d1d1" align="center" class="title"><i class="dropdown icon"></i>學程要怎麼修?</div>
                <div class="content">
                    <p style="color:navy;"  align="center" class="transition hidden">四門學程系上都有規定必修與選修之課程，簡單的說，就是大學四年要修完所需的必選修學分。<BR>
                        <font color="#0036a5" style="position:relative;top:10px;">以下為必選修科目：</font></p>
                    <div id="mytab">
						<?php
							$str1=''; 	$str2 ='';  //暫存字串變數
							$str1 .= ' <div  class="ui top attached tabular menu">';
								$first='active';
								require 'php/db_key.php';
								$t_program="SELECT * FROM program where `implement` =1 and `year_end` >=" . substr($_SESSION['s_UserId'],0,4) ; //  取得已上線學程資料&適用學年度
								$sqldata_t_program = $db->query($t_program);
								foreach($sqldata_t_program->fetchAll(PDO::FETCH_ASSOC)as $key => $row_program){
									$str1 .= ' <a  class="item '.$first.' " data-tab="R'.$row_program['p_id'].'">'.$row_program['p_name'].'</a>';
									
									$str2 .= ' <div class="ui bottom attached  tab segment '.$first.'" data-tab="R'.$row_program['p_id'].'">';
											$str2 .= '<table class="ui unstackable  table">';
												$str2 .= '<thead>';
													$str2 .= '<tr><th colspan="4" class="ui inverted '.$row_program['p_color'].' table center aligned medium header">必修</th> </tr>';
													$str2 .= '<tr>';
														$str2 .= '<th class="four wide">科目</th>		<th class="four wide center aligned">學分/小時</th>		<th class="four wide">科目</th>		<th class="four wide center aligned">學分/小時</th>';
													$str2 .= '</tr>';
												$str2 .= '</thead>';
												$str2 .= '<tbody id="R'.$row_program['p_id'].'_r">';

												$str2 .= '</tbody>';
											$str2 .= '</table>';
										
										if ($row_program['credit_ele'] >0 ){
											$str2 .= '<table class="ui unstackable table">';
												$str2 .= '<thead>';
													$str2 .= '<tr><th colspan="4" class="ui inverted '.$row_program['p_color'].' table center aligned medium header">選修</th> </tr>';
													$str2 .= '<tr>';
														$str2 .= '<th class="four wide">科目</th>		<th class="four wide center aligned">學分/小時</th>		<th class="four wide">科目</th>		<th class="four wide center aligned">學分/小時</th>';
													$str2 .= '</tr>';
												$str2 .= '</thead>';
												$str2 .= '<tbody  id="R'.$row_program['p_id'].'_e">';

												$str2 .= '</tbody>';
											$str2 .= '</table>';	
										}
											$str2 .= '<table class="ui unstackable table  center aligned ">';
												$str2 .= '<thead>';
													$str2 .= '<tr><th class="ui inverted '.$row_program['p_color'].' table  ">附件下載</th> </tr>';
												$str2 .= '</thead>';
												$str2 .= '<tbody >';
													$str2 .= '<tr>';
														$str2 .= '<td><a class="item" href="/downloads/'. $row_program['p_file_name'] .'" target="_blank"><button class="ui facebook icon button"><i class="download icon"></i>'. $row_program['p_file_name'] .'</button></a></td>';
													$str2 .= '</tr>';
												$str2 .= '</tbody>';
											$str2 .= '</table>';	
										
										$str2 .= '</div>';		
									$first = '';
								}
							$str1 .= ' </div>';
						
							echo $str1;
							echo $str2;
						?>

                    </div>
                </div>

                <div class="title"  ><i class="dropdown icon"></i>沒有選學程會怎樣嗎?</div>
                <div class="content">
                    <p class="transition hidden" style="color:navy;">系上規定本系學生必須選擇一門學程為畢業門檻，若沒有選擇，則無法畢業。</p>
                </div>

                <div style="background-color:#d1d1d1" class="title"><i class="dropdown icon"></i>一次只能選一門學程嗎?</div>
                <div class="content">
                    <p class="transition hidden" style="color:navy;">若清楚的分配課程的時間，且負擔不會太重，是可以選擇一個以上的學程。</p>
                </div>

                <div class="title"><i class="dropdown icon"></i>專題老師一定要和學程的負責老師一樣嗎?</div>
                <div class="content">
                    <p class="transition hidden" style="color:navy;">不一定，專題和學程不一定要同一位老師。</p>
                </div>

                <div style="background-color:#d1d1d1" class="title"><i class="dropdown icon"></i>若想換學程可以嗎?</div>
                <div class="content">
                    <p class="transition hidden" style="color:navy;">可以，只要大學四年能修完學程的必選修之學分就行了。</p>
                </div>

                <div class="title"><i class="dropdown icon"></i>學長姐有推薦的學程嗎?</div>
                <div class="content">
                    <p class="transition hidden" style="color:navy;">我們推薦你選有興趣，且未來出路相關的學程，對於就業培養具有相關的專業能力。</p>
                </div>

                <div  style="background-color:#d1d1d1" class="title"><i class="dropdown icon"></i>資通訊系統開發學程與互動設計學程的課會不會修不完?</div>
                <div class="content">
                    <p class="transition hidden" style="color:navy;">若清楚的規劃課程時間，四年一定可以順利修完。因此能在大一大二就規劃學程是最好的。</p>
                </div>

                <div class="title"><i class="dropdown icon"></i>各學程未來的出路?</div>
				
                <div class="content">
                     <p class="transition hidden" style="color:red;">※僅供參考使用，並不絕對。</p>
                    <div id="future">
                        <div  class="ui top attached tabular menu">
                            <a  class="item active" data-tab="R11">創新網路學程</a>
                            <a  class="item" data-tab="R22">資通訊系統開發學程</a>
                            <a  class="item" data-tab="R33">企業資源規劃學程</a>
                            <a  class="item" data-tab="R44">互動設計學程</a>
                        </div>

                        <div class="ui bottom attached tab segment active"  data-tab="R11">							
                            <table class="ui unstackable table">
                                <thead>
                                    <tr><th colspan="2" class="ui inverted green table center aligned medium header">創新網路學程-未來出路</th> </tr>
                                    <tr>
                                        <th class="eight wide">職業</th>		<th class="eight wide">連結</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>行銷企劃人員</td>		<td><a Target="_blank" href="http://pda.104.com.tw/my104/assist/analysisdetail?JOBCAT=2004001005">詳細分析</a></td>
                                    </tr>
                                    <tr>
                                        <td>網站行銷企劃</td>		<td><a Target="_blank" href="http://pda.104.com.tw/my104/assist/analysisdetail?JOBCAT=2004001007">詳細分析</a></td>
                                    </tr>
                                    <tr>
                                        <td>業務助理</td>		<td><a Target="_blank" href="http://pda.104.com.tw/my104/assist/analysisdetail?JOBCAT=2005003013">詳細分析</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="ui bottom attached  tab segment" data-tab="R22">
                            <table class="ui unstackable table">
                                <thead>
                                    <tr><th colspan="4" class="ui inverted red table center aligned medium header">資通訊系統開發學程-未來出路</th> </tr>
                                    <tr>
                                        <th class="eight wide">職業</th>		<th class="eight wide">連結</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>網頁設計工程師</td>		<td><a Target="_blank" href="http://pda.104.com.tw/my104/assist/analysisdetail?JOBCAT=2007001006#areaTab-tab">詳細分析</a></td>
                                    </tr>
                                    <tr>
                                        <td>資料庫管理人員</td>		<td><a Target="_blank" href="http://pda.104.com.tw/my104/assist/analysisdetail?JOBCAT=2007002002">詳細分析</a></td>
                                    </tr>
                                    <tr>
                                        <td>軟體設計工程師</td>		<td><a Target="_blank" href="http://pda.104.com.tw/my104/assist/analysisdetail?JOBCAT=2007001004">詳細分析</a></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="ui bottom attached  tab segment" data-tab="R33"> 
                            <table class="ui unstackable table">
                                <thead>
                                    <tr><th colspan="4" class="ui inverted  table center aligned medium header"style="background-color: #ff8700;">企業資源規劃學程-未來出路</th> </tr>
                                    <tr>
                                        <th class="eight wide">職業</th>		<th class="eight wide">連結</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>軟體相關專案管理師</td>		<td><a Target="_blank" href="http://pda.104.com.tw/my104/assist/analysisdetail?JOBCAT=2004003003">詳細分析</a></td>
                                    </tr>
                                    <tr>
                                        <td>電腦系統分析師</td>		<td><a Target="_blank" href="http://pda.104.com.tw/my104/assist/analysisdetail?JOBCAT=2007001007">詳細分析</a></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="ui bottom attached  tab segment" data-tab="R44"> 
                            <table class="ui unstackable table">
                                <thead>
                                    <tr><th colspan="4" class="ui inverted blue table center aligned medium header">互動設計學程-未來出路</th> </tr>
                                    <tr>
                                        <th class="eight wide"> 職業</th>		<th class="eight wide">連結</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>網頁設計師</td>		<td><a Target="_blank" href="http://pda.104.com.tw/my104/assist/analysisdetail?JOBCAT=2013001006">詳細分析</a></td>
                                    </tr>
                                    <tr>
                                        <td>電腦繪圖人員</td>		<td><a Target="_blank" href="http://pda.104.com.tw/my104/assist/analysisdetail?JOBCAT=2013001012">詳細分析</a></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>


        </div>

			
			</div>
			
			
			
			
			
 
     
           


          



        <script>


            $.getJSON("json/program_and_lesson.json", function (json) {
				
				var o_pid =json[0].p_id; //查看上一個和下一個有無一樣 若無則輸出
				var temp_left_right=0;
				var str_obl =''; //必修暫存字串 
				var str_ele =''; //選修暫存字串 
				
				$.each( json, function( index ) {//已修過/未修迴圈	
						
					var str_remark =""; //備註
					if (json[index].remark!=""){str_remark="　<i class='activating element large icons link' data-content='"+ json[index].remark+"' data-variation='wide'><i class='big loading lemon icon'></i><i class='info  icon'></i></i>";}
							
						if (json[index].p_obl_or_ele=="必修"){
							if (temp_left_right %2 ==0 ){
								str_obl += '<tr>' ;
								str_obl += '<td>' + json[index].name +str_remark+'</td>';
								str_obl += '<td class="center aligned">' + json[index].p_credit + '/'+ json[index].p_hour +'</td>';
								temp_left_right++;
							}
							else  {
								str_obl += '<td>' + json[index].name+str_remark +'</td>';
								str_obl += '<td class="center aligned">' + json[index].p_credit + '/'+ json[index].p_hour +'</td>';
								str_obl += '</tr>' ;
								jQuery("#R"+  json[index].p_id +"_r"  ).append(str_obl);	
								str_obl =''; temp_left_right=0;	 //清除					
							} 
						}
						else {
							if (temp_left_right %2 ==0){
								str_ele += '<tr>' ;
								str_ele += '<td>' + json[index].name+str_remark +'</td>';
								str_ele += '<td class="center aligned">' + json[index].p_credit + '/'+ json[index].p_hour +'</td>';
								temp_left_right++;
							}
							else{
								str_ele += '<td>' + json[index].name +str_remark +'</td>';
								str_ele += '<td class="center aligned">' + json[index].p_credit + '/'+ json[index].p_hour +'</td>';
								str_ele += '</tr>' ;
								jQuery("#R"+  json[index].p_id +"_e"  ).append(str_ele);
								str_ele ='';temp_left_right=0;  //清除					
							} 
						}
					
				    if (index+1 !=json.length){
					
						if ((json[index+1].p_id != o_pid) ) {//查看上一個和下一個有無一樣 若無則輸出
							if (json[index].p_obl_or_ele=="必修" ){
							if (str_obl!=''){str_obl +='<td></td><td></td></tr>';	}
							jQuery("#R"+ o_pid +"_r"  ).append(str_obl);	
							str_obl ='';
							}
							else {
							if (str_ele!=''){str_ele +='<td></td><td></td></tr>';}
							jQuery("#R"+ o_pid +"_e"  ).append(str_ele);
							str_ele =''; 
							}
							temp_left_right=0;  //清除
							o_pid = json[index+1].p_id ; //換
							
						}
					}
					else {
						if (str_obl!=''){jQuery("#R"+ o_pid +"_r"  ).append(str_obl);}
						if (str_ele!=''){jQuery("#R"+ o_pid +"_e"  ).append(str_ele);}
					}
						
						

				});  //--------------$.each( json.lesson, function( index ) {//已修過/未修迴圈
				
				
				$('.activating.element')  .popup();//備註訊息提示動作
            });
			
			$('.ui.accordion').accordion();//手風琴
            $('#mytab .menu .item').tab();//Tab
            $('#future .menu .item').tab();//Tab
			

        </script>
    </body>
</html>
