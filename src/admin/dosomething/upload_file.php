<?php require '../safe/check_admin.php'; ?>


<!DOCTYPE html>
<html lang="zh-TW">
<head>
     <link rel="icon" href="images/ICON.png" type="image/x-icon" > 
	<title>MIS學程規劃系統</title>
	
     <meta http-equiv="content-type" charset="utf-8">
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="//oss.maxcdn.com/semantic-ui/2.0.7/semantic.min.css">
	<script src="//oss.maxcdn.com/semantic-ui/2.0.7/semantic.min.js"></script>	
    </head>
	
	<style>
	*:not(.icon){
		font-family: '微軟正黑體', 'Helvetica', 'Lucida Grande', 'Arial', sans-serif!important ;
		}
	 body {
		 background-color: #004f72;
		 }
	
	</style>
	
<body>

</br>
</br>

<div class="ui center aligned  container">
	
		<h2 class="ui icon header">
		  <i class=" inverted cloud upload icon"></i>
		  <div class="content" style="color:#ffffff;">學程檔案上傳</div>
		</h2>

	<form id="form_id" class="ui form " action="" method="POST" enctype="multipart/form-data">

	<div class="field">
		<div class="ui action input">
			<input type="text" id="_attachmentName" >
			<label for="attachmentName" class="ui icon button btn-file">
				 <i class="attachment big file pdf outline icon"></i>
				 <input type="file" id="attachmentName" name="attachmentName" style="display: none">
			</label>
		</div>
	</div>        



	

		  
		  
		  <div class="ui hidden message " id="success_message" style="background-color: #004f72;  box-shadow:0 0 0 1px #004f72 inset,0 0 0 0 transparent;">
			  <button type="submit" class="ui red big button"><i class=" upload icon"></i> 上傳... </button>
		  </div>
		  

			


		
	</form>
	



</div>   

<script>
var fileExtentionRange = '.pdf .doc .docx';
var MAX_SIZE = 5; // MB
var issuccess=true;
$(document).on('change', '.btn-file :file', function() {
    var input = $(this);

    if (navigator.appVersion.indexOf("MSIE") != -1) { // IE
        var label = input.val();

        input.trigger('fileselect', [ 1, label, 0 ]);
    } else {
        var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        var numFiles = input.get(0).files ? input.get(0).files.length : 1;
        var size = input.get(0).files[0].size;

        input.trigger('fileselect', [ numFiles, label, size,issuccess ]);
    }
});

$('.btn-file :file').on('fileselect', function(event, numFiles, label, size) {
	
    $('#attachmentName').attr('name', 'attachmentName'); // allow upload.

	issuccess =true;
     

    var postfix = label.substr(label.lastIndexOf('.'));
    if (fileExtentionRange.indexOf(postfix.toLowerCase()) > -1) {
        if (size > 1024 * 1024 * MAX_SIZE ) {
            jQuery("#form_id").append('<div class="ui error message">	<div class="header">選擇檔案錯誤</div>	<p>檔案大小不得超過 '+MAX_SIZE+' MB</p>	 </div>');
				issuccess =false;
            $('#attachmentName').removeAttr('name'); // cancel upload file.
        } else {
            $('#_attachmentName').val(label);
        }
    } else {
		jQuery("#form_id").append('<div class="ui error message">	<div class="header">選擇檔案錯誤</div>	<p>只允許PDF檔</p>	 </div>');
			issuccess =false;
        $('#attachmentName').removeAttr('name'); // cancel upload file.
    }
	
	if (issuccess ==true){
		$( "#success_message").removeClass( "hidden" ); //顯示成功資訊
		$( "#form_id").removeClass( "error" ); //移除失敗
	}
	else{
		$( "#success_message").addClass( "hidden" ); //隱藏成功資訊
		$( "#form_id").addClass( "error" ); //加入失敗訊息
	}
	

	
});


</script>


</body>

</html>

<?php
	if(isset($_FILES['attachmentName'])){
		$errors= array();
		$file_name = $_FILES['attachmentName']['name'];
		$file_size =$_FILES['attachmentName']['size'];
		$file_tmp =$_FILES['attachmentName']['tmp_name'];
		$file_type=$_FILES['attachmentName']['type'];   

		if($file_size > (1024 * 1024*5)){
		$errors[]='File size must be excately 5 MB';
		}				
		if(empty($errors)==true ){
			move_uploaded_file($file_tmp,"../../downloads/".iconv("UTF-8","BIG5",$file_name));
			rename("../../downloads/".iconv("UTF-8","BIG5",$file_name),"../../downloads/".$file_name);
			if ($file_name!=""){echo '<script>document.getElementById("form_id").innerHTML =  document.getElementById("form_id").innerHTML + \'<h2 style="color:#ffffff;">複製下面檔名並回填</h2><div class="ui fluid icon input">  <input type="text" value="'.$file_name.'">  <i class="big copy icon"></i></div>\';</script>';}
			
		}else{
			print_r($errors);
		}
	}
?>