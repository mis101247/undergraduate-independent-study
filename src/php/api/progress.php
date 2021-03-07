<?php  



require 'db_key.php';
include('akey.php'); 

session_start();

include('soap/nusoap.php');  //引用套件
      
$url = 'http://awf.kuas.edu.tw/RhCloud/prhcloud.asmx?WSDL';
$client = new nusoap_client($url, 'wsdl');
$client->decodeUTF8(false);

$err = $client->getError();
if ($err)  return false;
//-----------------------------------------------------
$param = array(
              'AID' => $AID,
              'APW' => $APW,
              'StdID' => $_SESSION['s_UserId'] ,
          );
$result = $client->call('GetStdEleCourseList', $param);
//-------------------------------------------------------
$get= json_decode($result);
$program_json='{"program":[';
$lesson_json= ',"lesson":[';//欲輸出json

$program_sql="SELECT * FROM `program` where `implement` =1"  ;
$program_data = $db->query($program_sql);
foreach($program_data->fetchAll(PDO::FETCH_ASSOC)as $row_p){ //已上線學程
		$program_json = $program_json .'{' ;
		$program_json = $program_json  . '"p_id": ' .   $row_p['p_id'] .','     ;
		$program_json = $program_json  . '"p_name": "' .  $row_p['p_name'] .'",'     ;
		$program_json = $program_json . '"credit_total": ' .   $row_p['credit_total'] .','     ;
		$program_json = $program_json . '"credit_low": ' .   $row_p['credit_low'] . ','     ;
		$program_json = $program_json . '"credit_obl": ' .   $row_p['credit_obl'] . ','     ;
		$program_json = $program_json . '"credit_ele": ' .   $row_p['credit_ele']      ;
		$program_json = $program_json . '},'     ;
		
		$obl_total=0;  $ele_total=0;
		$program_and_lesson_sql="SELECT * FROM `program_and_lesson` where `p_id` = '" . $row_p['p_id']  ."'"  ;
		$sqldata = $db->query($program_and_lesson_sql);
		foreach($sqldata->fetchAll(PDO::FETCH_ASSOC)as $row){ //各學程各課
		   if ($row['p_obl_or_ele']=="obl"){$obl_total += $row['p_credit'];} //累加必修學分
		   elseif ($row['p_obl_or_ele']=="ele"){$ele_total += $row['p_credit'];} //累加必修學分
			$p=0;
			for ($j=0;$j<count($get);$j++){ //有成績的課
					if    ($row['l_id'] ==($get[$j]->{'CID'})  && (int)($get[$j]->{'Score'})>=60  ){
						$lesson_json = $lesson_json . '{'    ;
						$lesson_json = $lesson_json . '"p_id": "' .  $row_p['p_id'] .'",'     ;
						$lesson_json = $lesson_json . '"CID": "' . $get[$j]->{'CID'}  .'",'     ;
						$lesson_json = $lesson_json . '"CName": "' . $get[$j]->{'CName'}  .'",'     ;
						$lesson_json = $lesson_json . '"Credit": "' . $row['p_credit']  .'",'     ;//取得學程的學分
						$lesson_json = $lesson_json . '"Hour": "' . $get[$j]->{'Hour'}  .'",'     ;
						if ($row['p_obl_or_ele']=="obl"){$lesson_json = $lesson_json . '"Mso": "必修",'     ;}
						if ($row['p_obl_or_ele']=="ele"){$lesson_json = $lesson_json . '"Mso": "選修",'     ;}
						 $lesson_json = $lesson_json . '"Score": "' . $get[$j]->{'Score'}  . '",'     ;
						 $lesson_json = $lesson_json . '"remark": "' . $row['remark']  . '"'     ;
						$lesson_json = $lesson_json . "},"    ;				//課ID、課名、學分、時數、必選修、分數、備註
						$p=1;//有課
					}
			}
			for ($j=0;$j<count($get);$j++){ //有成績的課 //但停修或正在修
					if    ($row['l_id'] ==($get[$j]->{'CID'})  && (int)($get[$j]->{'Score'})=="*" && $p==0  ){
						$lesson_json = $lesson_json . '{'    ;
						$lesson_json = $lesson_json . '"p_id": "' .  $row_p['p_id'] .'",'     ;
						$lesson_json = $lesson_json . '"CID": "' . $get[$j]->{'CID'}  .'",'     ;
						$lesson_json = $lesson_json . '"CName": "' . $get[$j]->{'CName'}  .'",'     ;
						$lesson_json = $lesson_json . '"Credit": "' . $row['p_credit'] .'",'     ; //取得學程的學分
						$lesson_json = $lesson_json . '"Hour": "' . $get[$j]->{'Hour'}  .'",'     ;
						if ($row['p_obl_or_ele']=="obl"){$lesson_json = $lesson_json . '"Mso": "必修",'     ;}
						if ($row['p_obl_or_ele']=="ele"){$lesson_json = $lesson_json . '"Mso": "選修",'     ;}
						 $lesson_json = $lesson_json . '"Score": "修課中",'     ;
						 $lesson_json = $lesson_json . '"remark": "' . $row['remark']  . '"'     ;
						$lesson_json = $lesson_json . "},"    ;				//課ID、課名、學分、時數、必選修、分數
						$p=1;//有課
					}
			}
			if ($p==0){ //未修過的話
							$lesson_json = $lesson_json . '{'    ;
							$lesson_json = $lesson_json . '"p_id": "' .  $row['p_id'] .'",'     ;
							$lesson_json = $lesson_json . '"CID": "' .  trim($row['l_id']) .'",'     ;
							$lesson_json = $lesson_json . '"CName": "' . $row['l_name']  .'",'     ;
							$lesson_json = $lesson_json . '"Credit": "' . $row['p_credit']  .'",'     ;//取得學程的學分
							$lesson_json = $lesson_json . '"Hour": "' . $row['p_hour']  .'",'     ;
							if ($row['p_obl_or_ele']=="obl"){$lesson_json = $lesson_json . '"Mso": "必修",'     ;}
							if ($row['p_obl_or_ele']=="ele"){$lesson_json = $lesson_json . '"Mso": "選修",'     ;}
							$lesson_json = $lesson_json . '"Score": "0",'     ;
							$lesson_json = $lesson_json . '"remark": "' . $row['remark']  . '"'     ;
							$lesson_json = $lesson_json . "},"    ;				//課ID、課名、學分、時數、必選修、分數
						
			}
			
		}

		
}	
$program_json = substr($program_json,0,strlen($program_json)-1); // 將最後1個逗點去掉
$program_json = $program_json .  "]";

$lesson_json = substr($lesson_json,0,strlen($lesson_json)-1); // 將最後1個逗點去掉
$lesson_json = $lesson_json .  "]}";
   echo $program_json.$lesson_json;


include('clear.php'); 

?>


