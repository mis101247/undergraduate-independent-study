<!DOCTYPE html>
<html lang="zh-TW">
    <head>
         <link rel="icon" href="images/ICON.png" type="image/x-icon" /> 
        <title>登入</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">

        

	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="//oss.maxcdn.com/semantic-ui/2.0.7/semantic.min.css">
	<script src="//oss.maxcdn.com/semantic-ui/2.0.7/semantic.min.js"></script>		
	
	<link rel="stylesheet" href="css/my_style.css">
		   <style type="text/css">
				body {
				 background: url('https://upload.wikimedia.org/wikipedia/commons/d/dd/Code_presentation_background.png') repeat fixed center center;
				}
				body > .grid {
				  height: 100%;
				}
				.image {
				  margin-top: -100px;
				}
				.column {
				  max-width: 400px;
				}
				.field h1 {
					text-align: center;
					color: #000;
					font-size: 18px;
					text-transform: uppercase;
					margin-top: 0;
					margin-bottom: 20px;
				}
				.ui.orange.segment:not(.inverted) {
					border-top: 10px solid #f2711c;
				}
		  </style>
	
    </head>

    <body>



		<div class="ui middle aligned center aligned grid">
		  <div class="column">
		  
			<img src="images/logo.png" class="ui image medium centered">
			
		  
			<form class="ui large form " action="php/api/login.php" method="POST">
			  <div class="ui stacked segment orange raised">
				<div class="field">	
					<h1>LOGIN</h1>
					 <?php if ($_GET['err']==1) {echo '<div class="ui tertiary raised red inverted center aligned segment"><i class="remove user icon"></i>帳號或密碼無效。</div>';}?>
					 
				</div>
				
				<div class="field">			  
				  <div class="ui left icon input">
					<i class="user icon"></i>
					<input type="text" name="s_id" placeholder="學號" required="required">
				  </div>
				</div>
				<div class="field">
				  <div class="ui left icon input">
					<i class="lock icon"></i>
					<input type="password" name="s_password" placeholder="密碼" required="required">
				  </div>
				  <p class="ui pointing red basic label">使用者名稱與密碼同校務系統</p>
				</div>
				
				<button type="submit" class="ui fluid large submit button orange  ">
					<div ><i class="right arrow icon"></i>登入</div>
				</button>
			  </div>

			  <div class="ui error message"></div>

			</form>

		  </div>
		</div>




    </body>
</html>
