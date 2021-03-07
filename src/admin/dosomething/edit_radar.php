<?php  
 require '../safe/check_admin.php'; 

$p_id = (int)$_POST['p_id'];
$radar_1 = (int)$_POST['radar_1'];
$radar_2 = (int)$_POST['radar_2'];
$radar_3 = (int)$_POST['radar_3'];
$radar_4 = (int)$_POST['radar_4'];
$radar_5 = (int)$_POST['radar_5'];
$radar_6 = (int)$_POST['radar_6'];
$radar_7 = (int)$_POST['radar_7'];


require 'db_key.php';


//修改program_and_lesson內的學程必選修 和 學程開課時間 和 學程學分數 
$edit_program="UPDATE  `program` SET  `radar_1` = '" .  $radar_1 . "' , `radar_2` = '" .  $radar_2 . "' , `radar_3` = '" .  $radar_3 . "' , `radar_4` = '" .  $radar_4 . "' ,  `radar_5` = '" .  $radar_5 . "' ,  `radar_6` =  '" .  $radar_6. "' ,  `radar_7` =  '" .  $radar_7 ."'   WHERE  `p_id` =" .  $p_id  ; 
$sqldata = $db->query($edit_program);
$sqldata->execute(); 


$db = null;  
?>


