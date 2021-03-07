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


//修改program_and_lesson內的學程必選修 和 學程開課時間 和 學程學分數 
$edit_program_and_lesson="UPDATE  `program_and_lesson` SET  `l_name` = '" .  $l_name . "' , `p_credit` = '" .  $p_credit . "' , `p_hour` = '" .  $p_hour . "' , `p_obl_or_ele` = '" .  $p_obl_or_ele . "' ,  `course_time` = '" .  $course_time . "' ,  `remark` =  '" .  $remark ."'   WHERE  `p_id` =" .  $p_id . " and  `l_id`="  .  $l_id   ; 
$sqldata = $db->query($edit_program_and_lesson);
$sqldata->execute(); 


//修改lesson內的  課程名稱 和 時數 -禁止修改
//$edit_lesson="UPDATE  `lesson` SET  `l_name` = '" .  $l_name . "' ,  `hour` = '" .  $hour . "' ,  `obl_or_ele` = '" .  $obl_or_ele . "'   WHERE   `l_id`="  .  $l_id   ; 
//$sqldata_lesson = $db->query($edit_lesson);
//$sqldata_lesson->execute(); 
   
require 'renew_credit.php';
require 'renew_pl_json.php';
 

$db = null;  
?>


