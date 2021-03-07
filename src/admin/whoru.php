<?php  
$check = 0;
if ($_SESSION['s_UserId'] == "1101137247") {	$check = 1;}
if ($_SESSION['s_UserId'] == "1101137149") {	$check = 1;}
if ($_SESSION['s_UserId'] == "1101137206") {	$check = 1;}
if ($_SESSION['s_UserId'] == "1101137243") {	$check = 1;}
if ($_SESSION['s_UserId'] == "1101137216") {	$check = 1;}
if ($check == 1) {
	echo '<a class="item" href="/admin/main.php"><i class="paw icon"></i><span>管理學程課程(後台)</span></a>';
}
?>


