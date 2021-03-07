<?php  
 require '../safe/check_admin.php'; 

$new_p_id = $_POST['new_p_id'];
$p_name = $_POST['p_name'];
$credit_total = $_POST['p_credit_total'];
$credit_low = $_POST['p_credit_low'];
$p_color = $_POST['p_color'];
$p_icon = $_POST['p_icon'];
$p_file_name = $_POST['p_file_name'];
	



require 'db_key.php';




//p_id p_name credit_total credit_low  p_color  p_icon p_file_name
//新增program內的 學程id 、 課程ID 、學程必選修 、課程開課時間、備註
$insert_program="INSERT INTO `program` ( `p_id`, `p_name`, `credit_total`, `credit_low`, `p_color`, `p_icon`, `p_file_name`) VALUES ( '" .  $new_p_id . "', '" .  $p_name . "', '" .  $credit_total . "', '" .  $credit_low. "', '" .  $p_color ."', '" .  $p_icon ."', '" .  $p_file_name ."')";
$sqldata = $db->query($insert_program);
   

   
   $db = null; 
?>


