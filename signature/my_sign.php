<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Signature Customer</title>
		<link href="./css/jquery.signaturepad.css" rel="stylesheet">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="./js/numeric-1.2.6.min.js"></script> 
		<script src="./js/bezier.js"></script>
		<script src="./js/jquery.signaturepad.js"></script> 
		
		<script type='text/javascript' src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>
		<script src="./js/json2.min.js"></script>
		
		
		<style type="text/css">
			body{
				font-family:monospace;
				text-align:center;
			}
			#btnSaveSign {
				color: #fff;
				background: #f99a0b;
				padding: 5px;
				border: none;
				border-radius: 5px;
				font-size: 20px;
				margin-top: 10px;
			}
			#signArea{
				width:304px;
				margin: 50px auto;
			}
			.sign-container {
				width: 60%;
				margin: auto;
			}
			.sign-preview {
				width: 150px;
				height: 50px;
				border: solid 1px #CFCFCF;
				margin: 10px 5px;
			}
			.tag-ingo {
				font-family: cursive;
				font-size: 12px;
				text-align: left;
				font-style: oblique;
			}
		</style>
	</head>
	<body>

		<h2>Signature Customer</h2>
		<?php 
		if(isset($_POST['id_spk']) == null){
			$id_spk = 0;
			$spk_number = 0;
		} else {
			// $id_spk = $_POST['id_spk'];
			$spk_number = $_POST['spk_number'];
			// echo $id_spk;
			echo $spk_number;
		}

		// $id_spk = 4;
		?>
		
		<div id="signArea" >
			<h2 class="tag-ingo">Put signature below,</h2>
			<div class="sig sigWrapper" style="height:auto;">
				<div class="typed"></div>
				<canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
			</div>
		</div>
		
		<button id="btnSaveSign">Save Signature</button>
		
		<div class="sign-container">
		<?php
		$image_list = glob("./doc_signs/*.png");
		foreach($image_list as $image){
			//echo $image;
		?>
		<img src="<?php echo $image; ?>" class="sign-preview" />
		<?php
		
		}
		?>
		</div>
		
		
		<script>
			$(document).ready(function() {
				$('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
			});
			
			$("#btnSaveSign").click(function(e){
				html2canvas([document.getElementById('sign-pad')], {
					onrendered: function (canvas) {
						var canvas_img_data = canvas.toDataURL('image/png');
						var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
						var spk_number = <?php echo $spk_number;?>;
						//ajax call to save image inside folder
						$.ajax({
							url: 'save_sign.php',
							data: { img_data:img_data ,spk_number:spk_number },
							type: 'post',
							dataType: 'json',
							success: function (response) {
							   window.location.reload();
							}
						});
					}
				});
			});
		  </script> 
		

	</body>
</html>
