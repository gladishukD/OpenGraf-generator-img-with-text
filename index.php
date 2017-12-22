<?php header('Content-Type: text/html; charset= utf-8'); ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body style="margin: 0">
    
		<div class="container" >

		
		<div id="result"></div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript">
		function createImage()
		{
			var textcreate3 = $("#textcreate3").val();
			var textcreate4 = $("#textcreate4").val();
			var textcreate5 = $("#textcreate5").val();
			var stamp_path = $("#stamp_path").val();
			var file_new = $("#file_new").val();
			$("#result").html("<img src=\"generator.php?text3="+textcreate3+"&text4="+textcreate4+"&text5="+textcreate5+"&stamp_path=images/"+stamp_path+"&file_new=/"+file_new+"\" style='width: 100%; max-width: 1074px; max-height: 480px;' />")
		}
        createImage();
		</script>

  </body>
</html>