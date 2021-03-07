<?php  
 require '../safe/check_admin.php'; 
 
$p_id = $_POST['p_id'];
$l_id = $_POST['l_id'];
$l_name = $_POST['l_name'];
$p_credit = $_POST['p_credit'];
$p_hour = $_POST['p_hour'];
$p_obl_or_ele = $_POST['p_obl_or_ele'];
$course_time = $_POST['course_time'];
$remark = $_POST['remark'];




require 'db_key.php';





//新增program_and_lesson內的 學程id 、 課程ID 、學程必選修 、課程開課時間、備註
$insert_program_and_lesson="INSERT INTO `program_and_lesson` ( `p_id`, `l_id`, `l_name`, `p_credit`, `p_hour`, `p_obl_or_ele`, `course_time`, `remark`) VALUES ( '" .  $p_id . "', '" .  $l_id . "', '" .  $l_name . "', '" .  $p_credit. "', '" .  $p_hour ."', '" .  $p_obl_or_ele ."', '" .  $course_time ."', '" .  $remark . "')";
$sqldata = $db->query($insert_program_and_lesson);
   
	require 'renew_credit.php';
   require 'renew_pl_json.php';
   
   
   $db = null; 
?>


