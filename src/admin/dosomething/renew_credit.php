<?php  

require 'db_key.php';


$program_sql="SELECT * FROM `program"  ;
$program_data = $db->query($program_sql);
foreach($program_data->fetchAll(PDO::FETCH_ASSOC)as $row_p){ 
	$credit_obl=0;
	$credit_ele=0;
	
	$program_and_lesson_sql="SELECT * FROM `program_and_lesson` where `p_id` = '" . $row_p['p_id']  ."'"  ;
	$program_and_lesson_data = $db->query($program_and_lesson_sql);
	foreach($program_and_lesson_data->fetchAll(PDO::FETCH_ASSOC)as $program_and_lesson_row){ //各學程各課
	   if ($program_and_lesson_row['p_obl_or_ele']=="obl"){$credit_obl += $program_and_lesson_row['p_credit'];} //累加必修學分
	   elseif ($program_and_lesson_row['p_obl_or_ele']=="ele"){$credit_ele += $program_and_lesson_row['p_credit'];} //累加選修學分
	}

	$renew_program_credit="UPDATE  `program` SET  `credit_obl` = '" .  $credit_obl . "' , `credit_ele` = '" .  $credit_ele . "'   WHERE  `p_id` =" .  $row_p['p_id']  ; 
	$renew_sql = $db->query($renew_program_credit);
	$renew_sql->execute(); 

}


$db = null;  
?>


