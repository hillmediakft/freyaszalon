<!DOCTYPE html>
<html lang="hu">
<head>
	<meta charset="UTF-8">
	<title>Vframework hírlevél küldése</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="<?php echo $description;?>" name="description" />
	<base href="<?php echo URL;?>">
</head>
<body style="background-color: pink;">
	<p>
		Én vagyok az új ablak!
	</p>

	
		<div id="message-box">
		
			<!-- BEGIN PROGRESS BAR -->	
			<div id="message" style="display:none; border:1px solid #000; padding:10px; width:350px; height:150px; overflow:auto; background:#eee;"></div> 	
			<div id="message_done"></div>
			<br />	
			<progress id="progress_bar" value="0" max="100" style="display:none; width: 350px;"></progress>			
			<div id="progress_pc" style="text-align:right; display:block; margin-top:5px;"></div>
			<!-- END PROGRESS BAR -->	
		
		</div>
		
		<br />

        <input type="button" id="stop_progress"  value="Folyamat leállítása" />
	
	
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<?php //foreach($this->js_link as $value) { echo $value; } ?>
	<!-- END PAGE LEVEL SCRIPTS -->
	
	<script src="<?php echo ADMIN_ASSETS;?>plugins/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_ASSETS;?>plugins/jquery-migrate.min.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>    

	<script src="public/admin_assets/js/pages/newsletter_eventsource_window.js" type="text/javascript"></script>
	
</body>
</html>