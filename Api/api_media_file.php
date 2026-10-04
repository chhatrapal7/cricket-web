<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

define('UPLOAD_PATH', '../images/');

include_once '../td_includes.php';


if ($_POST['action']=="submit_player_detail") {

	$pl_name = $_POST['pl_name'];
	$pl_status = $_POST['pl_status'];
	$pl_age = $_POST['pl_age'];
	$pl_city = $_POST['pl_city'];
	$pl_number = $_POST['pl_number'];
	$file = $_POST['file'];
	$new_pl_slug = md5(time());
    
		$valid_formats = array("jpg", "png", "jpeg");
		$name=$_FILES['file']['name'];
		$filename = stripslashes($name);
		$tempfile=$_FILES["file"]["tmp_name"];
		$filesize=$_FILES['file']['size'];
		$ext = $login->getExtension($filename);
		$ext = strtolower($ext);

//    echo $ext;die;

		if(in_array($ext,$valid_formats)){
            //  echo"2=". $ext." ".$valid_formats;die;

				if($filesize<(1024*51200)){
                        // echo"2=".$filesize;die;
                  
					$actual_catImg_name = 'img_'.$new_pl_slug.'.'.$ext;
					$target_file =$Iconuploadpath.''.basename($actual_catImg_name);                
					$imgpath= $imageurl.basename($actual_catImg_name);
					$imgname=basename($actual_catImg_name);
                        // echo"3=".$tempfile.'--'.$target_file;

					if (move_uploaded_file($tempfile,$target_file)){

                        // echo"2=".$tempfile."".$target_file;die;

					    // echo"=".$pl_name." ".$pl_status." ".$pl_age." ".$pl_city." ".$pl_number." ".$file." ".$new_pl_slug." ".$imgname;
					
						$save=$login->submit_player_detail($pl_name,$pl_status,$pl_age,$pl_city,$pl_number,$new_pl_slug,$imgname);
						
						if ($save) {
						    
							echo "Attachment successfully updated.";                        
						}
						else{
							echo "Somehthing went wrong, please try again.";
						}
					}
				}
				else{
					echo "File size exceed to 50MB";
				}
			}
			else{
				echo "May be you have selected an invalid file or not selected any files.";
			}
	}


	

    ?>