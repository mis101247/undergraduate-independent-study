<?php  
 require '../safe/check_admin.php'; 

$p_id = (int)$_POST['p_id'];
$p_name = $_POST['p_name'];
$credit_total = (int)$_POST['p_credit_total'];
$credit_low = (int)$_POST['p_credit_low'];
$p_color = $_POST['p_color'];
$p_icon = $_POST['p_icon'];
$p_file_name = $_POST['p_file_name'];
$implement = (int)$_POST['implement'];

require 'db_key.php';


//修改program_and_lesson內的學程必選修 和 學程開課時間 和 學程學分數 
$edit_program="UPDATE  `program` SET  `p_name` = '" .  $p_name . "' , `credit_total` = '" .  $credit_total . "' , `credit_low` = '" .  $credit_low . "' , `p_color` = '" .  $p_color . "' ,  `p_icon` = '" .  $p_icon . "' ,  `p_file_name` =  '" .  $p_file_name. "' ,  `implement` =  '" .  $implement ."'   WHERE  `p_id` =" .  $p_id  ; 
$sqldata = $db->query($edit_program);
$sqldata->execute(); 

require 'renew_pl_json.php'; //因為可能修改成已上線

$db = null;  
?>


