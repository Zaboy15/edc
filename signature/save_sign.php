<?php 
	$result = array();
	$imagedata = base64_decode($_POST['img_data']);
	$id_spk = $_POST['id_spk'];
	$spk_number = $_POST['spk_number'];

	$filename = md5(date("dmYhisA"));
	//Location to where you want to created sign image
	$file_name1 = 'doc_signs/'.$filename.'.png';
	$file_name = './'.$file_name1;
	file_put_contents($file_name,$imagedata);
	
	mysql_connect("localhost","u4580489_dev","P@ssw0rdmyteacher");
	mysql_select_db("testsignature");

	// move_uploaded_file($imagedata,$file_name);
					$query = mysql_query("INSERT INTO customer VALUES(NULL, '$file_name1',$spk_number)");
					if($query > 0){
						
						$result['status'] = 1;
	$result['file_name'] = $file_name;
	echo json_encode($result);
					}else{
						echo 'GAGAL MENGUPLOAD GAMBAR';
					}
	
?>