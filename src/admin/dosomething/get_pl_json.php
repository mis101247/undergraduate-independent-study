<?php  



require 'db_key.php';



	
$t_program_and_lesson="SELECT * FROM program_and_lesson  ORDER BY  `p_obl_or_ele` DESC  "  ; // 學程必選修排序
$sqldata_t_program_and_lesson = $db->query($t_program_and_lesson);


$str ="["  ;//暫存變數_最後echo

   foreach($sqldata_t_program_and_lesson->fetchAll(PDO::FETCH_ASSOC)as $key => $row_program_and_lesson){

					$str = $str .  "{";
					$str = $str .   "\"p_id\":" .  "\"" .  trim($row_program_and_lesson['p_id']) .   "\" ,"   ;  
					$str = $str .   "\"l_id\":" .  "\"" .  trim($row_program_and_lesson['l_id']) .   "\" ,"   ;  
					 $str = $str .     "\"name\":" .  "\"" .  trim($row_program_and_lesson['l_name']) .   "\" ,"   ;  
					 $str = $str .     "\"p_credit\":" .  "\"" .  ($row_program_and_lesson['p_credit']) .   "\" ,"   ;  
					 $str = $str .     "\"p_hour\":" .  "\"" .  ($row_program_and_lesson['p_hour']) .   "\" ,"   ;  
					$str = $str .   "\"remark\":" .  "\"" .  ($row_program_and_lesson['remark']) .   "\" ,"   ; //備註
					 if ($row_program_and_lesson['p_obl_or_ele']=='obl'){$str = $str .     "\"p_obl_or_ele\":" .  "\"" .  "必修" . "\" ,"   ;  } else {$str = $str .     "\"p_obl_or_ele\":" .  "\"" .  "選修" . "\", "   ;  } 
					$str = $str .     "\"course_time\":" .  "\"" .  ($row_program_and_lesson['course_time']) .   "\" "   ;  
					 $str = $str .  "}";	 
					 $str = $str .  ",";
		
   }
   
   
   $str = substr($str,0,strlen($str)-1); // 將最後1個逗點去掉
   $str = $str .  "]";
   echo $str;

$db = null;  
?>