<?php  

$cid = $_POST['cid'];
$score = $_POST['score'];
$p_id = (int)($_POST['p_id']);

session_start(); 

require 'db_key.php';
include('akey.php'); 
include('soap/nusoap.php');  //引用套件
      
	  
$p_credit=0; //儲存學程學分
$program_and_lesson_sql="SELECT * FROM `program_and_lesson` where  `p_id` = '" . $p_id .   "'   and `l_id` = '" . $cid  ."'"  ;
$sqldata = $db->query($program_and_lesson_sql);
foreach($sqldata->fetchAll(PDO::FETCH_ASSOC)as $row){
	$p_credit=$row['p_credit'];
}

	  
$url = 'http://awf.kuas.edu.tw/RhCloud/prhcloud.asmx?WSDL';
$client = new nusoap_client($url, 'wsdl');
$client->decodeUTF8(false);

$err = $client->getError();
if ($err)  return false;

if ((int)$score>=60){
	
//-----------------------------------------------------用開課科目流水編號查詢介接課程資料
$param = array(
              'AID' => $AID,
              'APW' => $APW,
              'StdID' =>	$_SESSION['s_UserId'],
          );
$get_open_cid_result = $client->call('GetStdEleCourseList', $param);//先查出openCID
$get_open_cid_result_json= json_decode($get_open_cid_result);

	for ($t=0;$t<count($get_open_cid_result_json);$t++){
		if (	(	($get_open_cid_result_json[$t]->{'CID'})==$cid) &&	( 	(int)($get_open_cid_result_json[$t]->{'Score'})>=60 )	){
			
			$param = array(
				  'AID' => $AID,
				  'APW' => $APW,
				  'OpenCID' => $get_open_cid_result_json[$t]->{'OpenCID'},
			  );
			$result = $client->call('GetCourseListByOpenCID', $param);
			$result = str_replace("\u0000","",$result);
			$result = str_replace('\r\n',"@",$result);
		}
		
	}
	
}
//-------------------------------------------------------
elseif ((int)$score<60){
		//-----------------------------------------------------用科目代碼查詢介接課程資料
		$param = array(
					  'AID' => $AID,
					  'APW' => $APW,
					  'CID' => $cid,
				  );
		$result = "";
		//$result = $client->call('GetCourseListByCID', $param);
		$result = str_replace("\u0000","",$result);
		$result = str_replace('\r\n',"@",$result);
		//-------------------------------------------------------	
}
$json= json_decode($result);
if (is_null($json)!=1){

$out_json= '{"info":"success","content":[';//欲輸出json

for ($j=0;$j<count($json);$j++){ 
	if (     (($json[$j]->{'Year'})>100)   && ( ( (int)$json[$j]->{'Hour'}) >= $p_credit) ) { //過濾條件 101學年起 且 學程學分要 大於等於 課程學分
			$out_json = $out_json . '{'    ;
			$out_json = $out_json . '"year": "' .  $json[$j]->{'Year'} .'",'     ;
			if (($json[$j]->{'Sms'})==1){$out_json = $out_json . '"sms": "上學期",'     ;}
				elseif (($json[$j]->{'Sms'})==2){$out_json = $out_json . '"sms": "下學期",'     ;}
			$out_json = $out_json . '"UAName": "' . $json[$j]->{'UAName'}  .'",'     ;
			$out_json = $out_json . '"CAName": "' . $json[$j]->{'CAName'}  .'",'     ;
			$out_json = $out_json . '"credit": "' . $json[$j]->{'Credit'}  .'",'     ;
			$out_json = $out_json . '"hour": "' . $json[$j]->{'Hour'}  .'",'     ;//取得學程的學分
			if (($json[$j]->{'Mso'})=="M"){$out_json = $out_json . '"mso": "必修",'     ;}
				elseif (($json[$j]->{'Mso'})=="O"){$out_json = $out_json . '"mso": "選修",'     ;}
			$out_json = $out_json . '"tealist": "' . $json[$j]->{'TeaList'}  .'",'     ;
			
			//課程大綱避免json格式出錯
			$temp =$json[$j]->{'tpa_spec'};
			$temp = str_replace('{',"｛",$temp);
			$temp = str_replace('}',"｝",$temp);
			$temp = str_replace('[',"［",$temp);
			$temp = str_replace(']',"］",$temp);
			$temp = str_replace(',',"，",$temp);
			$temp = str_replace('	',"",$temp);
			$temp = str_replace("'",'’',$temp);
		
			$out_json = $out_json . '"tpa_spec": "' . $temp  . '"'     ;
			$out_json = $out_json . "},"    ;				//開課學年度、上/下學期、學分、時數、必選修、授課老師、教學綱要
	}		
}
   $out_json = substr($out_json,0,strlen($out_json)-1); // 將最後1個逗點去掉
$out_json = $out_json .  "]}";


//完成組合後查看是否為正確json格式
if ($out_json !='{"info":"success","content":]}' ){

	if ((int)$score<60 ){ //低於六十才會寫入本地資料 且有資料 
	$file = fopen($_SERVER['DOCUMENT_ROOT']."/json/program_and_lesson_info/pid_".$p_id."cid_".$cid.".json","w"); //寫入檔案檔案  //$_SERVER['DOCUMENT_ROOT']根目錄
	fwrite($file,$out_json);
	fclose($file);
	}
	echo ($out_json);
}
else
	{//查詢失敗則用本地資料
	$file = fopen($_SERVER['DOCUMENT_ROOT']."/json/program_and_lesson_info/pid_".$p_id."cid_".$cid.".json","r"); //讀入檔案檔案  //$_SERVER['DOCUMENT_ROOT']根目錄
	echo fread($file,filesize($_SERVER['DOCUMENT_ROOT']."/json/program_and_lesson_info/pid_".$p_id."cid_".$cid.".json"));
	fclose($file);
	}	

}


else {//查詢失敗則用本地資料
$file = fopen($_SERVER['DOCUMENT_ROOT']."/json/program_and_lesson_info/pid_".$p_id."cid_".$cid.".json","r"); //讀入檔案檔案  //$_SERVER['DOCUMENT_ROOT']根目錄
echo fread($file,filesize($_SERVER['DOCUMENT_ROOT']."/json/program_and_lesson_info/pid_".$p_id."cid_".$cid.".json"));
fclose($file);
}

	

   


include('clear.php'); 

?>


