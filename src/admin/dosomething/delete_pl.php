<?php  
 require '../safe/check_admin.php'; 

$p_id = $_POST['p_id'];
$l_id = $_POST['l_id'];


require 'db_key.php';


//刪除program_and_lesson內的學程必選修 和 學程開課時間 
$delete_program_and_lesson="DELETE FROM   `program_and_lesson`   WHERE  `p_id` =" .  $p_id . " and  `l_id`="  .  $l_id   ; 
$sqldata = $db->query($delete_program_and_lesson);



require 'renew_credit.php';
require 'renew_pl_json.php';
 

$db = null; 
?>


