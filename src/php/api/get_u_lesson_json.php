<?php  

$UntId = $_POST['UntId'];

include('akey.php'); 
include('soap/nusoap.php');  //引用套件
   
	  
$url = 'http://awf.kuas.edu.tw/RhCloud/prhcloud.asmx?WSDL';
$client = new nusoap_client($url, 'wsdl');
$client->decodeUTF8(false);

$err = $client->getError();
if ($err)  return false;


	
//-----------------------------------------------------用開課科目流水編號查詢介接課程資料
$param = array(
              'AID' => $AID,
              'APW' => $APW,
			  'UntId' => $UntId,
          );
$get_open_cid_result = $client->call('GetUnitOpenCourseList', $param);//先查出openCID
$get_json= json_decode($get_open_cid_result);


//-------------------------------------------------------

$out_json='[';

for ($i=0;$i<count($get_json);$i++){
	$out_json .= '{' ;
	//[ { "CID": "01557", "CName": "國文(一)", "Credit": 2.0, "Mso": "M", "Year": "1", "Sms": 1 }
	$out_json .=  '"CID": "' . $get_json[$i]->{'CID'}  .'",'     ;
	$out_json .=  '"CName": "' . $get_json[$i]->{'CName'}  .'",'     ;
	$out_json .=  '"Credit": "' . $get_json[$i]->{'Credit'}  .'",'     ;
	
	if (($get_json[$i]->{'Mso'})=="M"){$out_json .=  '"mso": "obl",'     ;}
	elseif (($get_json[$i]->{'Mso'})=="O"){$out_json .= '"mso": "ele",'     ;}
	
	$temp =( (int)($get_json[$i]->{'Year'}) * 2 )- ((int)($get_json[$i]->{'Sms'}) % 2) ;
	
	$out_json .=  '"course_time": "' . $temp .'" '     ;
	
	$out_json .= '},' ;
}
	$out_json = substr($out_json,0,strlen($out_json)-1); // 將最後1個逗點去掉
   $out_json = $out_json .  "]";


echo $out_json;


?>


