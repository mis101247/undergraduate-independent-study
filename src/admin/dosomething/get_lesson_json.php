<?php  



require 'db_key.php';


$tt="SELECT * FROM lesson "  ;
	
$sqldata = $db->query($tt);


$str ="";

$str = $str. "["  ;

   foreach($sqldata->fetchAll(PDO::FETCH_ASSOC)as $row){
	 $str = $str.  "{";
     $str = $str.   "\"l_id\":" .  "\"" .  trim($row['l_id']) .   "\" ,"   ;  
     $str = $str.   "\"name\":" .  "\"" .  $row['l_name'] .   "\",  "   ;  
     $str = $str.   "\"dep_id\":" .  "\"" .  $row['dep_id'] .   "\",  "   ;  
     $str = $str.   "\"t_id\":" .  "\"" .  $row['t_id'] .   "\",  "   ;  
     $str = $str.   "\"credit\":" .  "\"" .  $row['credit'] .   "\",  "   ;  
     $str = $str.   "\"obl_or_ele\":" .  "\"" .  $row['obl_or_ele']  .   "\""   ;  
	 
	 $str = $str.  "}";
	 $str = $str.  ",";
	}
 $str = substr($str,0,strlen($str)-1); // 將最後1個逗點去掉
$str = $str.  "]";

echo $str  ;

$db = null;  
?>


