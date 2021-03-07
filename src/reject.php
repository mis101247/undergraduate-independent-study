<!DOCTYPE html>
<html lang="zh-TW">
<head>
<title>MIS學程規劃系統</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">

	
	
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="/admin/sweetalert/dist/sweetalert.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="/admin/sweetalert/dist/sweetalert.css">

</head>


<body style="background-color: #004f72;  ">



<script>

swal({
	title: "拒絕存取",
	text: "你沒有權限完成此動作，確定後跳轉", 
	type: "error",
	closeOnConfirm: false,
	showLoaderOnConfirm: true, 
	}, function(){
		setTimeout(function(){ 
			window.location = '/';
		}, 500); 
		});
</script>


</body>
</html>
