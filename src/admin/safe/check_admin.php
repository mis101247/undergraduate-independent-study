<?php  


session_start(); 


 if (empty($_SESSION['s_UserId'])){
	header("location:/reject.php");
}
else{
	$get = 0;
	require 'client_db_key.php';
	$admin_list_t="SELECT count(*) as num FROM  `admin_list` where `admin_uid` =  " . $_SESSION['s_UserId']   ;
	$admin_list_sqldata = $db->query($admin_list_t);
	   foreach($admin_list_sqldata->fetchAll(PDO::FETCH_ASSOC)as $row){
			$get = $row['num'];
	   }
	$db = null; 
	if ($get!=1){header("location:/reject.php");}
} 

?>


