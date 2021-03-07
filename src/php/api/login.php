<?php  

$s_id = $_POST['s_id'];
$s_id = addslashes($s_id);
$s_id = str_replace("_","\_",$s_id);
$s_id = str_replace("%","\%",$s_id);
$s_id = str_replace("#","",$s_id);

$s_password = $_POST['s_password'];
$s_password = addslashes($s_password);
$s_password = str_replace("_","\_",$s_password);
$s_password = str_replace("%","\%",$s_password);
$s_password = str_replace("#","",$s_password);

if(!empty($_SERVER['HTTP_CLIENT_IP'])){
   $client_ip = $_SERVER['HTTP_CLIENT_IP'];
}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
   $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
   $client_ip= $_SERVER['REMOTE_ADDR'];
}

include('akey.php'); 
$User_ID = $s_id;
$User_PW = $s_password;
$from_Clientip = $client_ip;

include('soap/nusoap.php');  //引用套件
      
$url = 'http://awf.kuas.edu.tw/RhCloud/prhcloud.asmx?WSDL';
$client = new nusoap_client($url, 'wsdl');
$client->decodeUTF8(false);

$err = $client->getError();
if ($err)  return false;

//------------------登入模組---------------------------
$param = array(
              'AID' => $AID,
              'APW' => $APW,
              'User_ID' => $User_ID,
              'User_PW' => $User_PW,
              'from_Clientip' => $from_Clientip,
          );
$result = $client->call('KuasSSOAPI', $param);
//-------------------------------------------------------

$get_json = json_decode($result);
$flag = $get_json[0]->{'PassFlag'}; 
session_start();

if ($flag == "200")
{
	$_SESSION['logged_in']=TRUE;
	$_SESSION['s_PassFlag'] = $get_json[0]->{'PassFlag'}; 
	$_SESSION['s_UserId'] = $get_json[0]->{'UserId'}; 
    $_SESSION['s_UserName'] = $get_json[0]->{'UserName'}; 
    $_SESSION['s_Email'] = $get_json[0]->{'Email'}; 
    $_SESSION['s_Identity'] = $get_json[0]->{'Identity'}; 
	include('clear.php'); 
    header("location:/home.php");
}
else
{            
	$_SESSION['logged_in']=FALSE;
	include('clear.php'); 
	header("location:/login.php?err=1");
}




?>


